@extends('layouts.app')

@section('styles')
<!-- Add this to ensure our custom styles are loaded and have priority -->
<style>
    .payment-container {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .payment-method {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .payment-method:hover, .payment-method.active {
        border-color: #d81b60;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .payment-method.active {
        background-color: rgba(216, 27, 96, 0.05);
    }
    
    .payment-method-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .payment-method-logo {
        height: 40px;
        object-fit: contain;
    }
    
    .payment-summary {
        background-color: #f5f5f5;
        border-radius: 8px;
        padding: 20px;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    
    .summary-total {
        font-weight: 700;
        font-size: 18px;
        border-top: 1px solid #ddd;
        padding-top: 10px;
        margin-top: 10px;
    }
    
    .google-pay-button {
        background-color: #000;
        border-radius: 4px;
        padding: 12px 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
        cursor: pointer;
    }
    
    .google-pay-button img {
        height: 24px;
    }
    
    .receipt-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        border: 1px solid #eee;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: none;
    }
    
    .receipt-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .receipt-logo {
        max-width: 150px;
        margin-bottom: 15px;
    }
    
    .receipt-success {
        color: #28a745;
        font-size: 24px;
        margin-bottom: 5px;
    }
    
    .receipt-details {
        margin-bottom: 30px;
    }
    
    .receipt-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    
    .receipt-row:last-child {
        border-bottom: none;
    }
    
    .receipt-actions {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 30px;
    }
    
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        display: none;
    }
    
    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #f5f5f5;
        border-top: 5px solid #d81b60;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">ServiceHub Pay</h1>
                <p class="text-muted">Secure and convenient payment for your services</p>
            </div>
        </div>
    </div>
    
    <div class="container mb-5">
        <div class="row">
            <!-- Payment Form -->
            <div class="col-md-12">
                <div class="payment-container" id="paymentForm">
                    <!-- Service Details -->
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Service Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6>Home Cleaning Service</h6>
                                    <p class="text-muted mb-0">Standard cleaning package - 3 hours</p>
                                    <p class="text-muted mb-0">Scheduled for: May 10, 2025, 10:00 AM</p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <h5 class="text-primary mb-0">৳ 1,500</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Methods -->
                    <h5 class="mb-3">Select Payment Method</h5>
                    
                    <div class="payment-method active" data-method="google-pay">
                        <div class="payment-method-header">
                            <div>
                                <h6 class="mb-0">Google Pay</h6>
                                <p class="text-muted mb-0">Pay securely with Google Pay</p>
                            </div>
                            <img src="{{ asset('images/google-pay-logo.png') }}" alt="Google Pay" class="payment-method-logo">
                        </div>
                        <div class="payment-method-body mt-3" id="googlePayContainer">
                            <!-- Google Pay button will be inserted here -->
                        </div>
                    </div>
                    
                    <div class="payment-method" data-method="credit-card">
                        <div class="payment-method-header">
                            <div>
                                <h6 class="mb-0">Credit/Debit Card</h6>
                                <p class="text-muted mb-0">Pay with Visa, Mastercard, or other cards</p>
                            </div>
                            <div>
                                <img src="{{ asset('images/visa-logo.png') }}" alt="Visa" class="payment-method-logo me-2" style="height: 30px;">
                                <img src="{{ asset('images/mastercard-logo.png') }}" alt="Mastercard" class="payment-method-logo" style="height: 30px;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="payment-method" data-method="bkash">
                        <div class="payment-method-header">
                            <div>
                                <h6 class="mb-0">bKash</h6>
                                <p class="text-muted mb-0">Pay with your bKash account</p>
                            </div>
                            <img src="{{ asset('images/bkash-logo.png') }}" alt="bKash" class="payment-method-logo">
                        </div>
                    </div>
                    
                    <!-- Payment Summary -->
                    <div class="payment-summary mt-4">
                        <h5 class="mb-3">Payment Summary</h5>
                        <div class="summary-row">
                            <span>Service Charge</span>
                            <span>৳ 1,500</span>
                        </div>
                        <div class="summary-row">
                            <span>VAT (15%)</span>
                            <span>৳ 225</span>
                        </div>
                        <div class="summary-row">
                            <span>Discount</span>
                            <span>- ৳ 100</span>
                        </div>
                        <div class="summary-row summary-total">
                            <span>Total Amount</span>
                            <span>৳ 1,625</span>
                        </div>
                    </div>
                    
                    <!-- Payment Button (for non-Google Pay methods) -->
                    <div class="d-grid gap-2 mt-4">
                        <button type="button" class="btn btn-primary btn-lg" id="payNowButton">Pay Now</button>
                    </div>
                </div>
                
                <!-- Receipt (hidden initially) -->
                <div class="receipt-container" id="receiptContainer">
                    <div class="receipt-header">
                        <img src="{{ asset('images/logo.png') }}" alt="ServiceHub" class="receipt-logo">
                        <h4 class="receipt-success">Payment Successful!</h4>
                        <p class="text-muted">Thank you for your payment</p>
                    </div>
                    
                    <div class="receipt-details">
                        <div class="receipt-row">
                            <span>Transaction ID</span>
                            <span id="transactionId">GP78945612300</span>
                        </div>
                        <div class="receipt-row">
                            <span>Date & Time</span>
                            <span id="transactionDate">May 5, 2025, 2:30 PM</span>
                        </div>
                        <div class="receipt-row">
                            <span>Payment Method</span>
                            <span id="paymentMethod">Google Pay</span>
                        </div>
                        <div class="receipt-row">
                            <span>Service</span>
                            <span>Home Cleaning Service</span>
                        </div>
                        <div class="receipt-row">
                            <span>Amount</span>
                            <span>৳ 1,625</span>
                        </div>
                        <div class="receipt-row">
                            <span>Status</span>
                            <span class="text-success">Paid</span>
                        </div>
                    </div>
                    
                    <div class="receipt-actions">
                        <button type="button" class="btn btn-outline-primary" id="downloadReceiptButton">
                            <i class="bi bi-download me-2"></i> Download Receipt
                        </button>
                        <button type="button" class="btn btn-primary" id="viewBookingButton">
                            <i class="bi bi-calendar-check me-2"></i> View Booking
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Payment method selection
        const paymentMethods = document.querySelectorAll('.payment-method');
        paymentMethods.forEach(method => {
            method.addEventListener('click', function() {
                // Remove active class from all methods
                paymentMethods.forEach(m => m.classList.remove('active'));
                // Add active class to clicked method
                this.classList.add('active');
            });
        });
        
        // Google Pay integration - simulated for demo
        const googlePayContainer = document.getElementById('googlePayContainer');
        if (googlePayContainer) {
            const googlePayButton = document.createElement('button');
            googlePayButton.className = 'google-pay-button';
            googlePayButton.innerHTML = '<img src="https://developers.google.com/static/pay/api/images/pay_with_googlepay_button_517x96.png" alt="Google Pay">';
            googlePayButton.addEventListener('click', processPayment);
            googlePayContainer.appendChild(googlePayButton);
        }
        
        // Pay Now button click handler
        const payNowButton = document.getElementById('payNowButton');
        if (payNowButton) {
            payNowButton.addEventListener('click', function() {
                const activeMethod = document.querySelector('.payment-method.active');
                if (activeMethod) {
                    const method = activeMethod.dataset.method;
                    if (method === 'google-pay') {
                        // Google Pay is handled by its own button
                        return;
                    }
                    
                    // For other payment methods, simulate payment process
                    processPayment();
                }
            });
        }
        
        // Process payment function
        function processPayment() {
            // Show loading overlay
            const loadingOverlay = document.getElementById('loadingOverlay');
            if (loadingOverlay) {
                loadingOverlay.style.display = 'flex';
            }
            
            // Simulate payment processing
            setTimeout(function() {
                // Hide loading overlay
                if (loadingOverlay) {
                    loadingOverlay.style.display = 'none';
                }
                
                // Hide payment form and show receipt
                const paymentForm = document.getElementById('paymentForm');
                const receiptContainer = document.getElementById('receiptContainer');
                
                if (paymentForm && receiptContainer) {
                    paymentForm.style.display = 'none';
                    receiptContainer.style.display = 'block';
                    
                    // Set transaction details
                    const transactionId = document.getElementById('transactionId');
                    const transactionDate = document.getElementById('transactionDate');
                    const paymentMethod = document.getElementById('paymentMethod');
                    
                    if (transactionId) {
                        transactionId.textContent = 'GP' + Math.floor(Math.random() * 10000000000);
                    }
                    
                    if (transactionDate) {
                        transactionDate.textContent = new Date().toLocaleString();
                    }
                    
                    if (paymentMethod) {
                        const activeMethod = document.querySelector('.payment-method.active');
                        if (activeMethod) {
                            const methodName = activeMethod.querySelector('h6');
                            if (methodName) {
                                paymentMethod.textContent = methodName.textContent;
                            }
                        }
                    }
                    
                    // Scroll to receipt
                    receiptContainer.scrollIntoView({ behavior: 'smooth' });
                }
            }, 2000);
        }
        
        // Download receipt button
        const downloadReceiptButton = document.getElementById('downloadReceiptButton');
        if (downloadReceiptButton) {
            downloadReceiptButton.addEventListener('click', function() {
                alert('Receipt download functionality will be implemented here.');
            });
        }
        
        // View booking button
        const viewBookingButton = document.getElementById('viewBookingButton');
        if (viewBookingButton) {
            viewBookingButton.addEventListener('click', function() {
                window.location.href = "{{ route('bookings') }}";
            });
        }
    });
</script>
@endsection
