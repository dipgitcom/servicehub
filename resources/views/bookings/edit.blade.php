@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Booking</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('bookings.update', $booking) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="service_id" class="form-label">Select Service</label>
                            <select class="form-select @error('service_id') is-invalid @enderror" id="service_id" name="service_id" required>
                                <option value="">-- Select a Service --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ $booking->service_id == $service->id ? 'selected' : '' }}>
                                        {{ $service->title }} - {{ number_format($service->price, 2) }} BDT
                                        @if(isset($service->serviceProvider))
                                            ({{ $service->serviceProvider->business_name }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="booking_date" class="form-label">Booking Date</label>
                            <input type="date" class="form-control @error('booking_date') is-invalid @enderror" id="booking_date" name="booking_date" value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                            @error('booking_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="booking_time" class="form-label">Booking Time</label>
                            <select class="form-select @error('booking_time') is-invalid @enderror" id="booking_time" name="booking_time" required>
                                <option value="">-- Select a Time Slot --</option>
                                <option value="09:00 AM" {{ $booking->booking_time == '09:00 AM' ? 'selected' : '' }}>09:00 AM</option>
                                <option value="10:00 AM" {{ $booking->booking_time == '10:00 AM' ? 'selected' : '' }}>10:00 AM</option>
                                <option value="11:00 AM" {{ $booking->booking_time == '11:00 AM' ? 'selected' : '' }}>11:00 AM</option>
                                <option value="12:00 PM" {{ $booking->booking_time == '12:00 PM' ? 'selected' : '' }}>12:00 PM</option>
                                <option value="01:00 PM" {{ $booking->booking_time == '01:00 PM' ? 'selected' : '' }}>01:00 PM</option>
                                <option value="02:00 PM" {{ $booking->booking_time == '02:00 PM' ? 'selected' : '' }}>02:00 PM</option>
                                <option value="03:00 PM" {{ $booking->booking_time == '03:00 PM' ? 'selected' : '' }}>03:00 PM</option>
                                <option value="04:00 PM" {{ $booking->booking_time == '04:00 PM' ? 'selected' : '' }}>04:00 PM</option>
                                <option value="05:00 PM" {{ $booking->booking_time == '05:00 PM' ? 'selected' : '' }}>05:00 PM</option>
                            </select>
                            @error('booking_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="notes" class="form-label">Additional Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $booking->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Please provide any specific requirements or information that might help the service provider.</div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('bookings.my-bookings') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set minimum date for booking to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('booking_date').setAttribute('min', today);
    });
</script>
@endsection
