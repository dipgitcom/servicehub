<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['service', 'serviceProvider'])
            ->where('user_id', Auth::id())
            ->orderBy('booking_date', 'desc')
            ->get();
            
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Display a listing of the user's bookings.
     */
    public function myBookings()
    {
        $bookings = Booking::with(['service', 'serviceProvider'])
            ->where('user_id', Auth::id())
            ->orderBy('booking_date', 'desc')
            ->get();
            
        return view('bookings.my-bookings', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Service $service = null)
    {
        $services = Service::where('is_active', true)->get();
        return view('bookings.create', compact('services', 'service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'notes' => 'nullable|string',
        ]);

        $service = Service::findOrFail($request->service_id);

        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->service_id = $request->service_id;
        $booking->service_provider_id = $service->service_provider_id;
        $booking->booking_date = $request->booking_date;
        $booking->booking_time = $request->booking_time;
        $booking->status = 'pending';
        $booking->notes = $request->notes;
        $booking->price = $service->price;
        $booking->save();

        return redirect()->route('bookings.my-bookings')
            ->with('success', 'Booking created successfully. We will confirm your booking soon.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        // Check if the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('bookings.my-bookings')
                ->with('error', 'You are not authorized to view this booking.');
        }

        $booking->load(['service', 'serviceProvider']);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        // Check if the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('bookings.my-bookings')
                ->with('error', 'You are not authorized to edit this booking.');
        }

        // Only allow editing if the booking is pending
        if ($booking->status !== 'pending') {
            return redirect()->route('bookings.my-bookings')
                ->with('error', 'You can only edit pending bookings.');
        }

        $services = Service::where('is_active', true)->get();
        return view('bookings.edit', compact('booking', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // Check if the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('bookings.my-bookings')
                ->with('error', 'You are not authorized to update this booking.');
        }

        // Only allow updating if the booking is pending
        if ($booking->status !== 'pending') {
            return redirect()->route('bookings.my-bookings')
                ->with('error', 'You can only update pending bookings.');
        }

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'notes' => 'nullable|string',
        ]);

        $service = Service::findOrFail($request->service_id);

        $booking->service_id = $request->service_id;
        $booking->service_provider_id = $service->service_provider_id;
        $booking->booking_date = $request->booking_date;
        $booking->booking_time = $request->booking_time;
        $booking->notes = $request->notes;
        $booking->price = $service->price;
        $booking->save();

        return redirect()->route('bookings.my-bookings')
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        // Check if the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('bookings.my-bookings')
                ->with('error', 'You are not authorized to cancel this booking.');
        }

        // Only allow cancellation if the booking is pending or confirmed
        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return redirect()->route('bookings.my-bookings')
                ->with('error', 'You can only cancel pending or confirmed bookings.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->route('bookings.my-bookings')
            ->with('success', 'Booking cancelled successfully.');
    }
}
