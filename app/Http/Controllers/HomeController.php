<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log; // Ensure this is imported

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            // Initialize empty arrays to prevent "undefined variable" errors
            $categories = [];
            $popularServices = [];
            $topProviders = [];
            
            // Check if tables exist before querying
            if (Schema::hasTable('service_categories')) {
                $categories = ServiceCategory::where('is_active', true)
                    ->orWhereNull('is_active')
                    ->get();
            }
            
            if (Schema::hasTable('services')) {
                $popularServices = Service::with(['category', 'serviceProvider'])
                    ->where(function($query) {
                        $query->where('is_active', true)
                            ->orWhereNull('is_active');
                    })
                    ->where(function($query) {
                        $query->where('is_featured', true)
                            ->orWhereNull('is_featured');
                    })
                    ->take(8)
                    ->get();
            }
            
            if (Schema::hasTable('service_providers')) {
                $topProviders = ServiceProvider::with('location')
                    ->where(function($query) {
                        $query->where('is_active', true)
                            ->orWhereNull('is_active');
                    })
                    ->where(function($query) {
                        $query->where('is_verified', true)
                            ->orWhereNull('is_verified');
                    })
                    ->orderBy('rating', 'desc')
                    ->take(4)
                    ->get();
            }
            
            return view('home', compact('categories', 'popularServices', 'topProviders'));
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Homepage error: ' . $e->getMessage());
            
            // Return the view with empty arrays to prevent undefined variable errors
            return view('home', [
               
                'categories' => [],
                'popularServices' => [],
                'topProviders' => []
            ]);
        }
    }
}