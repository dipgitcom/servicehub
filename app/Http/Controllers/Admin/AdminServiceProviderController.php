<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = ServiceProvider::with(['user', 'location'])->get();
        return view('admin.providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::whereDoesntHave('serviceProvider')->get();
        $locations = Location::all();
        return view('admin.providers.create', compact('users', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:service_providers,user_id',
            'business_name' => 'required|string|max:255',
            'description' => 'required|string',
            'phone' => 'required|string|max:20',
            'location_id' => 'required|exists:locations,id',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $provider = new ServiceProvider();
        $provider->user_id = $request->user_id;
        $provider->business_name = $request->business_name;
        $provider->description = $request->description;
        $provider->phone = $request->phone;
        $provider->location_id = $request->location_id;
        $provider->is_verified = $request->has('is_verified');

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('providers', 'public');
            $provider->profile_image = $imagePath;
        }

        $provider->save();

        // Update user role to provider
        $user = User::find($request->user_id);
        $user->role = 'provider';
        $user->save();

        return redirect()->route('admin.service-providers.index')
            ->with('success', 'Service Provider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceProvider $serviceProvider)
    {
        $serviceProvider->load(['user', 'location', 'services']);
        return view('admin.providers.show', compact('serviceProvider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceProvider $serviceProvider)
    {
        $locations = Location::all();
        return view('admin.providers.edit', compact('serviceProvider', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceProvider $serviceProvider)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'description' => 'required|string',
            'phone' => 'required|string|max:20',
            'location_id' => 'required|exists:locations,id',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $serviceProvider->business_name = $request->business_name;
        $serviceProvider->description = $request->description;
        $serviceProvider->phone = $request->phone;
        $serviceProvider->location_id = $request->location_id;
        $serviceProvider->is_verified = $request->has('is_verified');

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($serviceProvider->profile_image) {
                Storage::disk('public')->delete($serviceProvider->profile_image);
            }
            
            $imagePath = $request->file('profile_image')->store('providers', 'public');
            $serviceProvider->profile_image = $imagePath;
        }

        $serviceProvider->save();

        return redirect()->route('admin.service-providers.index')
            ->with('success', 'Service Provider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceProvider $serviceProvider)
    {
        // Check if provider has services or bookings
        if ($serviceProvider->services()->count() > 0 || $serviceProvider->bookings()->count() > 0) {
            return redirect()->route('admin.service-providers.index')
                ->with('error', 'Cannot delete provider with associated services or bookings.');
        }

        // Delete image if exists
        if ($serviceProvider->profile_image) {
            Storage::disk('public')->delete($serviceProvider->profile_image);
        }

        // Update user role back to user
        $user = $serviceProvider->user;
        $user->role = 'user';
        $user->save();

        $serviceProvider->delete();

        return redirect()->route('admin.service-providers.index')
            ->with('success', 'Service Provider deleted successfully.');
    }
}
