<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceOption;

class ServiceController extends Controller
{
    /**
     * Display a listing of all services.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get all categories
        $categories = ServiceCategory::where('status', 1)->get();
        
        // Get services grouped by category
        $servicesByCategory = [];
        
        foreach ($categories as $category) {
            $services = Service::where('category_id', $category->id)
                              ->where('status', 1)
                              ->get();
            
            if ($services->count() > 0) {
                $servicesByCategory[] = [
                    'category' => $category,
                    'services' => $services
                ];
            }
        }
        
        return view('services.index', compact('categories', 'servicesByCategory'));
    }
    
    /**
     * Display services by category.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function byCategory($slug)
    {
        // Find the category by slug
        $category = ServiceCategory::where('slug', $slug)->firstOrFail();
        
        // Get all categories for the sidebar
        $categories = ServiceCategory::where('status', 1)->get();
        
        // Get featured services in this category (for the top section)
        $featuredServices = Service::where('category_id', $category->id)
                                  ->where('is_featured', 1)
                                  ->where('status', 1)
                                  ->take(3)
                                  ->get();
        
        // Get all services in this category
        $services = Service::where('category_id', $category->id)
                          ->where('status', 1)
                          ->get();
        
        return view('services.by-category', compact('category', 'categories', 'featuredServices', 'services'));
    }
    
    /**
     * Display the specified service.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($slug)
    {
        // Find the service by slug
        $service = Service::where('slug', $slug)->firstOrFail();
        
        // Get the service options
        $serviceOptions = ServiceOption::where('service_id', $service->id)->get();
        
        // Get related services (same category, excluding current service)
        $relatedServices = Service::where('category_id', $service->category_id)
                                ->where('id', '!=', $service->id)
                                ->where('status', 1)
                                ->take(3)
                                ->get();
        
        return view('services.show', compact('service', 'serviceOptions', 'relatedServices'));
    }
    
    /**
     * Search for services.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $query = $request->input('search');
        
        // Get all categories for the sidebar
        $categories = ServiceCategory::where('status', 1)->get();
        
        // Search for services
        $services = Service::where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->where('status', 1)
                        ->get();
        
        return view('services.search', compact('services', 'categories', 'query'));
    }
}
