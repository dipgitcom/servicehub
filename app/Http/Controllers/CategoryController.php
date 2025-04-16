<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Models\Service;

class CategoryController extends Controller
{
    /**
     * Manually add more service categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function addMoreCategories()
    {
        // New categories to add
        $newCategories = [
            [
                'name' => 'Home Renovation',
                'slug' => 'home-renovation',
                'description' => 'Professional home renovation and remodeling services',
                'icon' => 'home',
                'status' => 1
            ],
            [
                'name' => 'Car Services',
                'slug' => 'car-services',
                'description' => 'Comprehensive car maintenance and repair services',
                'icon' => 'car',
                'status' => 1
            ],
            [
                'name' => 'Computer & IT Services',
                'slug' => 'computer-it-services',
                'description' => 'Professional computer repair and IT support services',
                'icon' => 'laptop',
                'status' => 1
            ],
            [
                'name' => 'Event Management',
                'slug' => 'event-management',
                'description' => 'Professional event planning and management services',
                'icon' => 'calendar',
                'status' => 1
            ],
            [
                'name' => 'Home Security',
                'slug' => 'home-security',
                'description' => 'Professional home security installation and monitoring services',
                'icon' => 'lock',
                'status' => 1
            ]
        ];

        // Create categories
        foreach ($newCategories as $categoryData) {
            ServiceCategory::create($categoryData);
        }

        return redirect()->route('home')->with('success', 'Additional service categories have been added successfully!');
    }

    /**
     * Display a form to manually add a new category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:50',
        ]);

        $slug = \Illuminate\Support\Str::slug($request->name);

        ServiceCategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'icon' => $request->icon,
            'status' => 1
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }
}
