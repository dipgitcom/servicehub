@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body text-center">
                    @if(Auth::user()->profile_image)
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/user-placeholder.jpg') }}" alt="{{ Auth::user()->name }}" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @endif
                    <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                    <p class="text-muted mb-3">{{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>
            
            <div class="list-group mb-4">
                <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">Profile</a>
                <a href="{{ route('bookings.my-bookings') }}" class="list-group-item list-group-item-action">My Bookings</a>
                <a href="{{ route('profile.change-password') }}" class="list-group-item list-group-item-action">Change Password</a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Booking Details</h5>
                    <a href="{{ route('bookings.my-bookings') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Back to My Bookings
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="booking-status mb-3">
                                <span class="fw-bold">Status: </span>
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="badge bg-success">Confirmed</span>
                                @elseif($booking->status == 'completed')
                                    <span class="badge bg-primary">Completed</span>
                                @elseif($booking->status == 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </div>
                            
                            <h6 class="fw-bold">Booking Information</h6>
                            <p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                            <p><strong>Date:</strong> {{ $booking->booking_date->format('F d, Y') }}</p>
                            <p><strong>Time:</strong> {{ $booking->booking_time }}</p>
                            <p><strong>Price:</strong> {{ number_format($booking->price, 2) }} BDT</p>
                            <p><strong>Booked On:</strong> {{ $booking->created_at->format('F d, Y h:i A') }}</p>
                        </div>
                        
                        <div class="col-md-6">
                            <h6 class="fw-bold">Service Information</h6>
                            <p><strong>Service:</strong> {{ $booking->service->title ?? 'N/A' }}</p>
                            <p><strong>Provider:</strong> {{ $booking->serviceProvider->business_name ?? 'N/A' }}</p>
                            <p><strong>Category:</strong> {{ $booking->service->category->name ?? 'N/A' }}</p>
                            <p><strong>Duration:</strong> {{ $booking->service->duration ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    @if($booking->notes)
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="fw-bold">Additional Notes</h6>
                            <p>{{ $booking->notes }}</p>
                        </div>
                    </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                @if($booking->status == 'pending')
                                    <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-primary">Edit Booking</a>
                                    
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Cancel Booking</button>
                                    </form>
                                @elseif($booking->status == 'completed')
                                    <a href="#" class="btn btn-primary">Write a Review</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
