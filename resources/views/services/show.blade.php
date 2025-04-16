@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
<style>
    .service-hero {
        background-color: #f5f5f5;
        padding: 60px 0;
        position: relative;
    }
    
    .service-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        z-index: 1;
    }
    
    .service-hero .container {
        position: relative;
        z-index: 2;
        color: white;
    }
    
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 20px;
    }
    
    .breadcrumb-item a {
        color: rgba(255,255,255,0.8);
    }
    
    .breadcrumb-item.active {
        color: white;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.5);
    }
    
    .service-title {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .service-rating {
        display: inline-flex;
        align-items: center;
        background-color: rgba(0,0,0,0.3);
        padding: 5px 10px;
        border-radius: 20px;
        margin-bottom: 10px;
    }
    
    .service-rating i {
        color: #ffc107;
        margin-right: 5px;
    }
    
    .service-safety {
        display: inline-flex;
        align-items: center;
        background-color: rgba(40,167,69,0.2);
        color: #28a745;
        padding: 5px 10px;
        border-radius: 20px;
        margin-left: 10px;
    }
    
    .service-safety i {
        margin-right: 5px;
    }
    
    .service-content {
        padding: 40px 0;
    }
    
    .service-sidebar {
        background-color: #17a2b8;
        color: white;
        border-radius: 8px;
        padding: 20px;
    }
    
    .service-sidebar h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .service-option {
        background-color: white;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        color: #333;
    }
    
    .service-option h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .service-option .price {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .service-option .current-price {
        font-weight: 600;
        font-size: 18px;
        color: #28a745;
    }
    
    .service-option .original-price {
        text-decoration: line-through;
        color: #6c757d;
        margin-right: 10px;
    }
    
    .service-option .add-btn {
        width: 100%;
        margin-top: 10px;
    }
    
    .service-tabs {
        margin-bottom: 30px;
    }
    
    .service-tabs .nav-link {
        font-weight: 600;
        color: #495057;
        border: none;
        border-bottom: 2px solid transparent;
        padding: 10px 20px;
    }
    
    .service-tabs .nav-link.active {
        color: var(--primary-color);
        border-bottom-color: var(--primary-color);
    }
    
    .tab-content {
        padding: 20px 0;
    }
    
    .service-description ul {
        padding-left: 20px;
    }
    
    .service-description ul li {
        margin-bottom: 10px;
    }
    
    .empty-cart {
        text-align: center;
        padding: 30px 0;
    }
    
    .empty-cart p {
        color: #6c757d;
        margin-top: 10px;
    }
    
    .checkout-footer {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-top: 20px;
    }
    
    .minimum-order {
        background-color: #fff3cd;
        color: #856404;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .minimum-order i {
        margin-right: 10px;
    }
    
    .checkout-btn {
        width: 100%;
        padding: 12px;
        font-weight: 600;
    }
    
    .related-services {
        padding: 40px 0;
        background-color: #f8f9fa;
    }
    
    .related-services h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .related-service-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .related-service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .related-service-image {
        height: 150px;
        overflow: hidden;
    }
    
    .related-service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .related-service-content {
        padding: 15px;
    }
    
    .related-service-content h3 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')
<!-- Service Hero Section -->
<div class="service-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ $service->image ? asset('storage/' . $service->image) : asset('images/services/service-placeholder.jpeg') }}') no-repeat center center; background-size: cover;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services.by-category', $service->category->slug) }}">{{ $service->category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
            </ol>
        </nav>
        
        <h1 class="service-title">{{ $service->title }}</h1>
        
        <div class="service-meta">
            <div class="service-rating">
                <i class="bi bi-star-fill"></i>
                <span>4.51 out of 5</span>
            </div>
            <div class="service-safety">
                <i class="bi bi-shield-check"></i>
                <span>SAFETY ENSURED</span>
            </div>
        </div>
    </div>
</div>

<!-- Service Content Section -->
<div class="service-content">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 mb-4">
                <!-- Service Tabs -->
                <ul class="nav nav-tabs service-tabs" id="serviceTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Service Overview</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="false">FAQ</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Details</button>
                    </li>
                </ul>
                
                <div class="tab-content" id="serviceTabContent">
                    <!-- Overview Tab -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                        <div class="service-description mt-4">
                            <h3>Service Description</h3>
                            <p>{{ $service->description }}</p>
                            
                            <h4 class="mt-4">Included in the Service:</h4>
                            <ul>
                                <li>AC Circuit Checkup: Thorough examination of the AC circuit to ensure proper functioning and safety.</li>
                                <li>Power consumption analysis to identify energy inefficiencies.</li>
                                <li>Performance optimization recommendations.</li>
                                <li>Detailed report of findings and suggestions.</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- FAQ Tab -->
                    <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                        <div class="accordion mt-4" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        How long does the service take?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        The service typically takes 30-60 minutes depending on the type and number of AC units being examined.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Do I need to be present during the service?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes, it's recommended that you or someone from your household is present during the service to discuss findings and recommendations.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        What should I prepare before the service?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Ensure access to your AC units and electrical panels. Having your recent electricity bills handy can also help with the analysis.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reviews Tab -->
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <div class="reviews-section mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3>Customer Reviews</h3>
                                <div class="overall-rating">
                                    <span class="badge bg-success"><i class="bi bi-star-fill me-1"></i> 4.51</span>
                                    <span class="text-muted ms-2">(179 ratings)</span>
                                </div>
                            </div>
                            
                            <!-- Sample Reviews -->
                            <div class="review-item mb-4 pb-4 border-bottom">
                                <div class="d-flex justify-content-between">
                                    <div class="reviewer-info">
                                        <h5>Ahmed H.</h5>
                                        <div class="review-date text-muted">March 15, 2024</div>
                                    </div>
                                    <div class="review-rating">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </div>
                                </div>
                                <p class="review-text mt-2">
                                    The technician was very professional and knowledgeable. He identified several issues with my AC that were causing high electricity bills. After implementing his suggestions, I've noticed a significant reduction in my monthly bills.
                                </p>
                            </div>
                            
                            <div class="review-item mb-4 pb-4 border-bottom">
                                <div class="d-flex justify-content-between">
                                    <div class="reviewer-info">
                                        <h5>Fatima R.</h5>
                                        <div class="review-date text-muted">February 28, 2024</div>
                                    </div>
                                    <div class="review-rating">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star text-warning"></i>
                                    </div>
                                </div>
                                <p class="review-text mt-2">
                                    Great service overall. The technician arrived on time and did a thorough check of my AC system. The only reason I'm not giving 5 stars is because I had to follow up multiple times to get the detailed report they promised.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Details Tab -->
                    <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                        <div class="service-details mt-4">
                            <h3>Service Details</h3>
                            <table class="table table-bordered mt-3">
                                <tbody>
                                    <tr>
                                        <th width="30%">Service Duration</th>
                                        <td>30-60 minutes</td>
                                    </tr>
                                    <tr>
                                        <th>Warranty</th>
                                        <td>7 days service warranty</td>
                                    </tr>
                                    <tr>
                                        <th>Service Provider</th>
                                        <td>{{ $service->serviceProvider->business_name ?? 'ServiceHub Certified Technicians' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Available Areas</th>
                                        <td>Gulshan, Banani, Dhanmondi, Uttara</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="service-sidebar">
                    <h2>AC Doctor</h2>
                    
                    <div class="service-rating mb-4">
                        <i class="bi bi-star-fill"></i>
                        <span>4.51 out of 5</span>
                    </div>
                    
                    @if(count($serviceOptions) > 0)
                        @foreach($serviceOptions as $option)
                            <div class="service-option">
                                <h3>{{ $option->name }}</h3>
                                <div class="price">
                                    @if($option->original_price)
                                        <span class="original-price">৳{{ number_format($option->original_price, 0) }}</span>
                                    @endif
                                    <span class="current-price">৳{{ number_format($option->price, 0) }}</span>
                                    <span class="text-muted ms-2">/ piece</span>
                                </div>
                                <button class="btn btn-primary add-btn">Add +</button>
                            </div>
                        @endforeach
                    @else
                        <!-- Default options if none are in the database -->
                        <div class="service-option">
                            <h3>1-2 Ton</h3>
                            <div class="price">
                                <span class="original-price">৳600</span>
                                <span class="current-price">৳449</span>
                                <span class="text-muted ms-2">/ piece</span>
                            </div>
                            <button class="btn btn-primary add-btn">Add +</button>
                        </div>
                        
                        <div class="service-option">
                            <h3>2.5-5 Ton</h3>
                            <div class="price">
                                <span class="original-price">৳600</span>
                                <span class="current-price">৳449</span>
                                <span class="text-muted ms-2">/ piece</span>
                            </div>
                            <button class="btn btn-primary add-btn">Add +</button>
                        </div>
                    @endif
                    
                    <div class="empty-cart mt-4">
                        <div class="text-center">
                            <h4 class="text-muted">Empty Cart</h4>
                            <p>Get your service done just with few clicks! so what are you waiting for?</p>
                        </div>
                    </div>
                    
                    <div class="checkout-footer">
                        <div class="minimum-order">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span>Minimum order amount is ৳1.</span>
                        </div>
                        
                        <button class="btn btn-secondary checkout-btn" disabled>
                            Proceed To Checkout <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Services Section -->
@if(count($relatedServices) > 0)
<div class="related-services">
    <div class="container">
        <h2>Related Services</h2>
        <div class="row">
            @foreach($relatedServices as $relatedService)
            <div class="col-md-4">
                <div class="related-service-card">
                    <div class="related-service-image">
                        @if($relatedService->image)
                            <img src="{{ \App\Helpers\ImageHelper::getServiceImage($relatedService->image) }}" alt="{{ $relatedService->title }}">
                        @else
                            <img src="{{ asset('images/services/service-placeholder.jpeg') }}" alt="{{ $relatedService->title }}">
                        @endif
                    </div>
                    <div class="related-service-content">
                        <h3>{{ $relatedService->title }}</h3>
                        <a href="{{ route('services.show', $relatedService->slug) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Service detail page loaded');
        
        // Add to cart functionality
        const addButtons = document.querySelectorAll('.add-btn');
        const emptyCart = document.querySelector('.empty-cart');
        const checkoutBtn = document.querySelector('.checkout-btn');
        
        addButtons.forEach(button => {
            button.addEventListener('click', function() {
                // In a real app, you would add the item to the cart
                // For now, just enable the checkout button and hide empty cart message
                emptyCart.style.display = 'none';
                checkoutBtn.disabled = false;
                checkoutBtn.classList.remove('btn-secondary');
                checkoutBtn.classList.add('btn-primary');
                
                // Show a success message
                alert('Service added to cart!');
            });
        });
    });
</script>
@endsection
