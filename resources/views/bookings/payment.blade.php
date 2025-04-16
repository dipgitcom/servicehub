@extends('layouts.app')

@section('title', 'Payment')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Payment</h1>
        
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Select Payment Method</h5>
                        
                        <form action="{{ route('bookings.process-payment', $booking->id) }}" method="POST" id="payment-form">
                            @csrf
                            
                            <div class="payment-methods mb-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method" id="google-pay" value="google_pay" checked>
                                    <label class="form-check-label" for="google-pay">
                                        <img src="{{ asset('images/google-pay.png') }}" alt="Google Pay" height="30">
                                        Google Pay
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method" id="credit-card" value="credit_card">
                                    <label class="form-check-label" for="credit-card">
                                        <i class="far fa-credit-card me-2"></i>
                                        Credit/Debit Card
                                    </label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash">
                                    <label class="form-check-label" for="cash">
                                        <i class="fas fa-money-bill-wave me-2"></i>
                                        Cash on Delivery
                                    </label>
                                </div>
                            </div>
                            
                            <div id="card-element-container" class="mb-4 d-none">
                                <div class="mb-3">
                                    <label class="form-label">Card Number</label>
                                    <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" placeholder="MM/YY">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">CVV</label>
                                        <input type="text" class="form-control" placeholder="123">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Booking Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Service:</span>
                            <span>{{ $booking->service->name }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span>Date & Time:</span>
                            <span>{{ $booking->booking_date->format('M d, Y h:i A') }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span>Service Provider:</span>
                            <span>{{ $booking->serviceProvider->business_name }}</span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span>Price:</span>
                            <span>${{ $booking->total_amount }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Total:</span>
                            <span class="fw-bold">${{ $booking->total_amount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<!-- Add this inside the payment-methods div -->
<div class="google-pay-container mt-4 mb-4 d-none">
    <div id="google-pay-button" class="google-pay-button"></div>
</div>

<!-- Add this to the scripts section -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
        const cardElementContainer = document.getElementById('card-element-container');
        const googlePayContainer = document.querySelector('.google-pay-container');
        
        paymentMethodRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'credit_card') {
                    cardElementContainer.classList.remove('d-none');
                    googlePayContainer.classList.add('d-none');
                } else if (this.value === 'google_pay') {
                    cardElementContainer.classList.add('d-none');
                    googlePayContainer.classList.remove('d-none');
                } else {
                    cardElementContainer.classList.add('d-none');
                    googlePayContainer.classList.add('d-none');
                }
            });
        });
    });
</script>
<script src="https://pay.google.com/gp/p/js/pay.js"></script>
@endsection