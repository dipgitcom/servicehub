<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Booking;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);
        
        /** @var Booking $booking */
        $booking = Booking::findOrFail($validated['booking_id']);
        
        // Check if user owns this booking
        if ($booking->user_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to review this booking.');
        }
        
        // Check if booking is completed
        if ($booking->status !== 'completed') {
            return back()->with('error', 'You can only review completed bookings.');
        }
        
        // Check if already reviewed
        if ($booking->review) {
            return back()->with('error', 'You have already reviewed this booking.');
        }
        
        $review = new Review();
        $review->user_id = Auth::id();
        $review->service_provider_id = $booking->service_provider_id;
        $review->booking_id = $booking->id;
        $review->rating = $validated['rating'];
        $review->comment = $validated['comment'];
        $review->save();
        
        // Update service provider rating
        $serviceProvider = ServiceProvider::find($booking->service_provider_id);
        $avgRating = $serviceProvider->reviews()->avg('rating');
        $serviceProvider->rating = $avgRating;
        $serviceProvider->save();
        
        return back()->with('success', 'Your review has been submitted successfully.');
    }
}