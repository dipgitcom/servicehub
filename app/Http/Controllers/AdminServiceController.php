<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceOption;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the services.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = Service::with('category')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $categories = ServiceCategory::all();
        return view('admin.services.create', compact('categories'));
    }

    /**
     * Store a newly created service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:service_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
        }

        // Create service
        $service = Service::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'icon' => $request->icon ?? 'tools',
            'is_featured' => $request->has('is_featured'),
            'status' => $request->has('status'),
        ]);

        // Create service options if provided
        if ($request->has('option_names') && is_array($request->option_names)) {
            foreach ($request->option_names as $key => $name) {
                if (!empty($name)) {
                    ServiceOption::create([
                        'service_id' => $service->id,
                        'name' => $name,
                        'description' => $request->option_descriptions[$key] ?? '',
                        'price' => $request->option_prices[$key] ?? $service->price,
                        'original_price' => $request->option_original_prices[$key] ?? ($service->price * 1.2),
                        'status' => 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.services')->with('success', 'Service created successfully!');
    }

    /**
     * Show the form for editing the specified service.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $service = Service::with('options')->findOrFail($id);
        $categories = ServiceCategory::all();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:service_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ]);

        $service = Service::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $imagePath = $request->file('image')->store('services', 'public');
        } else {
            $imagePath = $service->image;
        }

        // Update service
        $service->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'icon' => $request->icon ?? 'tools',
            'is_featured' => $request->has('is_featured'),
            'status' => $request->has('status'),
        ]);

        // Update service options
        if ($request->has('option_ids') && is_array($request->option_ids)) {
            // Update existing options
            foreach ($request->option_ids as $key => $optionId) {
                if (!empty($optionId)) {
                    $option = ServiceOption::find($optionId);
                    if ($option) {
                        $option->update([
                            'name' => $request->option_names[$key] ?? '',
                            'description' => $request->option_descriptions[$key] ?? '',
                            'price' => $request->option_prices[$key] ?? $service->price,
                            'original_price' => $request->option_original_prices[$key] ?? ($service->price * 1.2),
                        ]);
                    }
                }
            }
        }

        // Add new options
        if ($request->has('new_option_names') && is_array($request->new_option_names)) {
            foreach ($request->new_option_names as $key => $name) {
                if (!empty($name)) {
                    ServiceOption::create([
                        'service_id' => $service->id,
                        'name' => $name,
                        'description' => $request->new_option_descriptions[$key] ?? '',
                        'price' => $request->new_option_prices[$key] ?? $service->price,
                        'original_price' => $request->new_option_original_prices[$key] ?? ($service->price * 1.2),
                        'status' => 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.services')->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified service from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        // Delete service options
        $service->options()->delete();

        // Delete image if exists
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        // Delete service
        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Service deleted successfully!');
    }
}
