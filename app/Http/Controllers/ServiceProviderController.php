<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Support\Facades\Auth; // Add this at the top

class ServiceProviderController extends Controller
{
    public function dashboard()
    {
        $provider = Auth::user()->serviceProvider; // Use Auth::user() instead of auth()->user()
        
        $totalBookings = Booking::where('service_provider_id', $provider->id)->count();
        $pendingBookings = Booking::where('service_provider_id', $provider->id)
                                ->where('status', 'pending')
                                ->count();
        $completedBookings = Booking::where('service_provider_id', $provider->id)
                                  ->where('status', 'completed')
                                  ->count();
        $totalEarnings = Booking::where('service_provider_id', $provider->id)
                              ->where('payment_status', 'paid')
                              ->sum('total_amount');
                              
        $recentBookings = Booking::where('service_provider_id', $provider->id)
                               ->orderBy('created_at', 'desc')
                               ->take(5)
                               ->get();
                               
        return view('provider.dashboard', compact(
            'provider', 
            'totalBookings', 
            'pendingBookings', 
            'completedBookings', 
            'totalEarnings', 
            'recentBookings'
        ));
    }
    
    public function bookings()
    {
        $provider = Auth::user()->serviceProvider; // Use Auth::user() instead of auth()->user()
        
        $bookings = Booking::where('service_provider_id', $provider->id)
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);
                          
        return view('provider.bookings', compact('bookings'));
    }
    
    public function updateBookingStatus(Request $request, $bookingId)
    {
        $provider = Auth::user()->serviceProvider; // Use Auth::user() instead of auth()->user()
        $booking = Booking::where('id', $bookingId)
                        ->where('service_provider_id', $provider->id)
                        ->firstOrFail();
                        
        $validated = $request->validate([
            'status' => 'required|in:confirmed,completed,cancelled',
        ]);
        
        $booking->status = $validated['status'];
        $booking->save();
        
        return back()->with('success', 'Booking status updated successfully.');
    }
    
    public function profile()
    {
        $provider = Auth::user()->serviceProvider; // Use Auth::user() instead of auth()->user()
        $services = Service::all();
        
        return view('provider.profile', compact('provider', 'services'));
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Use Auth::user() instead of auth()->user()
        $provider = $user->serviceProvider ?? new ServiceProvider();
        
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone_number' => 'required|string|max:20',
            'profile_image' => 'nullable|image|max:1024',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);
        
        if (!$provider->id) {
            $provider->user_id = $user->id;
        }
        
        $provider->business_name = $validated['business_name'];
        $provider->description = $validated['description'];
        $provider->phone_number = $validated['phone_number'];
        
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('providers', 'public');
            $provider->profile_image = $imagePath;
        }
        
        $provider->save();
        
        // Sync services
        if ($request->has('services')) {
            $provider->services()->sync($request->services);
        }
        
        return back()->with('success', 'Profile updated successfully.');
    }
}