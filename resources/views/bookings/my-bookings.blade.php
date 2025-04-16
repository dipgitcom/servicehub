@extends('layouts.app')

@section('styles')
<style>
    .bookings-page {
        padding: 40px 0;
    }
    
    .booking-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .booking-card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .booking-header {
        padding: 15px 20px;
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
    }
    
    .booking-id {
        font-size: 14px;
        color: #666;
    }
    
    .booking-status {
        font-size: 14px;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 20px;
    }
    
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-confirmed {
        background-color: #d1e7dd;
        color: #0f5132;
    }
    
    .status-completed {
        background-color: #cfe2ff;
        color: #084298;
    }
    
    .status-cancelled {
        background-color: #f8d7da;
        color: #842029;
    }
    
    .booking-body {
        padding: 20px;
    }
    
    .booking-service {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .booking-details {
        margin-bottom: 15px;
    }
    
    .booking-detail-item {
        display: flex;
        margin-bottom: 8px;
    }
    
    .booking-detail-label {
        width: 120px;
        font-weight: 500;
        color: #666;
    }
    
    .booking-price {
        font-size: 18px;
        font-weight: 600;
        color: #d81b60;
        margin-top: 15px;
    }
    
    .booking-actions {
        margin-top: 20px;
        display: flex;
        gap: 10px;
    }
    
    .empty-bookings {
        text-align: center;
        padding: 50px 0;
    }
    
    .empty-bookings i {
        font-size: 60px;
        color: #ddd;
        margin-bottom: 20px;
    }
    
    .empty-bookings h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }
    
    .empty-bookings p {
        color: #666;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<div class="container bookings-page">
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
                    <p class="text-muted mb-3">{{ ucfirst(Auth::user()->role ?? 'User') }}</p>
                </div>
            </div>
            
            <div class="list-group mb-4">
                <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">Profile</a>
                <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">Edit Profile</a>
                <a href="{{ route('bookings') }}" class="list-group-item list-group-item-action active">My Bookings</a>
                <a href="{{ route('profile.change-password') }}" class="list-group-item list-group-item-action">Change Password</a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">My Bookings</h1>
                <a href="{{ route('services.index') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i> Book a Service
                </a>
            </div>
            
            <!-- Sample bookings - In a real app, these would come from the database -->
            <div class="booking-card">
                <div class="booking-header d-flex justify-content-between align-items-center">
                    <div class="booking-id">Booking ID: #SH12345</div>
                    <div class="booking-status status-confirmed">Confirmed</div>
                </div>
                <div class="booking-body">
                    <div class="booking-service">AC Servicing</div>
                    <div class="booking-details">
                        <div class="booking-detail-item">
                            <div class="booking-detail-label">Date & Time:</div>
                            <div>May 15, 2025, 10:00 AM</div>
                        </div>
                        <div class="booking-detail-item">
                            <div class="booking-detail-label">Address:</div>
                            <div>House 123, Road 10, Banani, Dhaka</div>
                        </div>
                        <div class="booking-detail-item">
                            <div class="booking-detail-label">Service Type:</div>
                            <div>Split AC (1.5 Ton)</div>
                        </div>
                    </div>
                    <div class="booking-price">৳ 1,200</div>
                    <div class="booking-actions">
                        <button class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-x-circle me-2"></i> Cancel Booking
                        </button>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-calendar-plus me-2"></i> Reschedule
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="booking-card">
                <div class="booking-header d-flex justify-content-between align-items-center">
                    <div class="booking-id">Booking ID: #SH12344</div>
                    <div class="booking-status status-completed">Completed</div>
                </div>
                <div class="booking-body">
                    <div class="booking-service">Home Cleaning</div>
                    <div class="booking-details">
                        <div class="booking-detail-item">
                            <div class="booking-detail-label">Date & Time:</div>
                            <div>May 10, 2025, 09:00 AM</div>
                        </div>
                        <div class="booking-detail-item">
                            <div class="booking-detail-label">Address:</div>
                            <div>House 123, Road 10, Banani, Dhaka</div>
                        </div>
                        <div class="booking-detail-item">
                            <div class="booking-detail-label">Service Type:</div>
                            <div>Standard Cleaning</div>
                        </div>
                    </div>
                    <div class="booking-price">৳ 1,500</div>
                    <div class="booking-actions">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-star me-2"></i> Write a Review
                        </button>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-arrow-repeat me-2"></i> Book Again
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="booking-card">
                <div class="booking-header d-flex justify-content-between align-items-center">
                    <div class="booking-id">Booking ID: #SH12343</div>
                    <div class="booking-status status-pending">Pending</div>
                </div>
                <div class="booking-body">
                    <div class="booking-service">Plumbing Service</div>
                    <div class="booking-details">
                        <div class="booking-detail-item">
                            <div class="booking-detail-label">Date & Time:</div>
                            <div>May 20, 2025, 02:00 PM</div>
                        </div>
                        <div class="booking-detail-item">
                            <div class="booking-detail-label">Address:</div>
                            <div>House 123, Road 10, Banani, Dhaka</div>
                        </div>
                        <div class="booking-detail-item">
                            <div class="booking-detail-label">Service Type:</div>
                            <div>Pipe Leakage Repair</div>
                        </div>
                    </div>
                    <div class="booking-price">৳ 800</div>
                    <div class="booking-actions">
                        <button class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-x-circle me-2"></i> Cancel Booking
                        </button>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-calendar-plus me-2"></i> Reschedule
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- If no bookings are found, show this -->
            <!--
            <div class="empty-bookings">
                <i class="bi bi-calendar-x"></i>
                <h3>No Bookings Found</h3>
                <p>You haven't made any bookings yet. Book a service to get started.</p>
                <a href="{{ route('services.index') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i> Book a Service
                </a>
            </div>
            -->
        </div>
    </div>
</div>
@endsection
