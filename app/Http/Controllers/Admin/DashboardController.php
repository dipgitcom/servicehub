<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\Booking;
use App\Models\ServiceCategory;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Count statistics
        $stats = [
            'users' => User::where('role', 'user')->count(),
            'providers' => User::where('role', 'provider')->count(),
            'services' => 0,
            'bookings' => 0,
            'categories' => ServiceCategory::count(),
            'locations' => Location::count(),
        ];

        // Check if tables exist before querying
        if (Schema::hasTable('services')) {
            $stats['services'] = Service::count();
        }
        
        if (Schema::hasTable('bookings')) {
            $stats['bookings'] = Booking::count();
        }

        // Recent users
        $recentUsers = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Recent providers
        $recentProviders = User::where('role', 'provider')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Recent bookings
        $recentBookings = [];
        if (Schema::hasTable('bookings')) {
            $recentBookings = Booking::with(['user', 'service'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentProviders', 'recentBookings'));
    }
}
