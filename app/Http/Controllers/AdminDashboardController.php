<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;

class AdminDashboardController extends Controller
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
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get counts for dashboard
        $serviceCount = Service::count();
        $categoryCount = ServiceCategory::count();
        $userCount = User::count();
        
        return view('admin.dashboard', compact('serviceCount', 'categoryCount', 'userCount'));
    }

    /**
     * Show the services management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function services()
    {
        // Get all services
        $services = Service::with('category')->get();
        
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the categories management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categories()
    {
        // Get all categories
        $categories = ServiceCategory::all();
        
        return view('admin.categories.index', compact('categories'));
    }
}
