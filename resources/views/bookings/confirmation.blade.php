@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <div class="confirmation-icon mb-4">
                <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
            </div>
            
            <h1>Booking Confirmed!</h1>
            <p class="lead">Your booking has been successfully placed.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Booking Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Booking ID:</div>
                            <div class="col-md-8">{{ $booking->id }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Service:</div>
                            <div class="col-md-8">{{ $booking->service->name }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Date & Time:</div>
                            <div class="col-md-8">{{ $booking->booking_date->format('M d, Y h:i A') }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Service Provider:</div>
                            <div class="col-md-8">{{ $booking->serviceProvider->business_name }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Address:</div>
                            <div class="col-md-8">{{ $booking->address }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Total Amount:</div>
                            <div class="col-md-8">${{ $booking->total_amount }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Payment Method:</div>
                            <div class="col-md-8">{{ ucfirst($booking->payment_method) }}</div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Payment Status:</div>
                            <div class="col-md-8">
                                <span class="badge bg-{{ $booking->payment_status === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="{{ route('bookings.my-bookings') }}" class="btn btn-primary me-2">View My Bookings</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection