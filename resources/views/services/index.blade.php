@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/servicehub-style.css') }}?v={{ time() }}">
<style>
    .services-page {
        padding: 40px 0;
    }
    
    .services-sidebar {
        background-color: #f9f9fa;
        border-radius: 8px;
        padding: 20px;
        position: sticky;
        top: 20px;
    }
    
    .services-sidebar h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    
    .services-sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
        max-height: 500px;
        overflow-y: auto;
    }
    
    .services-sidebar li {
        margin-bottom: 10px;
    }
    
    .services-sidebar a {
        display: block;
        padding: 10px 15px;
        color: var(--secondary-color);
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    
    .services-sidebar a:hover, 
    .services-sidebar a.active {
        background-color: var(--primary-color);
        color: white;
    }
    
    .page-header {
        margin-bottom: 30px;
    }
    
    .page-header h1 {
        font-size: 36px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--secondary-color);
    }
    
    .category-section {
        margin-bottom: 50px;
    }
    
    .category-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .category-header h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 0;
        color: var(--secondary-color);
    }
    
    .view-all {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
    }
    
    .view-all:hover {
        text-decoration: underline;
    }
    
    .featured-services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    
    .service-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--box-shadow);
        transition: all 0.3s ease;
        background-color: white;
        height: 100%;
        display: flex;
        flex-direction: column;
        text-decoration: none;
    }
    
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .service-image {
        height: 200px;
        overflow: hidden;
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .service-card:hover .service-image img {
        transform: scale(1.05);
    }
    
    .service-content {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .service-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--secondary-color);
    }
    
    .service-price {
        color: var(--primary-color);
        font-weight: 600;
        font-size: 18px;
        margin-top: auto;
    }
    
    .service-list {
        margin-top: 20px;
    }
    
    .service-list-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .service-list-item {
        display: flex;
        align-items: center;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--secondary-color);
    }
    
    .service-list-item:hover {
        background-color: #f0f0f0;
    }
    
    .service-list-item i {
        font-size: 20px;
        color: var(--primary-color);
        margin-right: 15px;
    }
    
    @media (max-width: 991px) {
        .featured-services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .service-list-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 767px) {
        .featured-services-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="container services-page">
    <div class="row">
        <!-- Sidebar with service categories -->
        <div class="col-lg-3 mb-4">
            <div class="services-sidebar">
                <h3>Service Categories</h3>
                <ul>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('services.by-category', $category->slug) }}">
                            <i class="bi bi-{{ $category->icon ?? 'grid' }} me-2"></i> {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        <!-- Main content area -->
        <div class="col-lg-9">
            <div class="page-header">
                <h1>All Services</h1>
            </div>
            
            @if(count($servicesByCategory) > 0)
                @foreach($servicesByCategory as $categoryData)
                    <div class="category-section">
                        <div class="category-header">
                            <h2>{{ $categoryData['category']->name }}</h2>
                            <a href="{{ route('services.by-category', $categoryData['category']->slug) }}" class="view-all">
                                View All <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        
                        <!-- Featured Services Grid -->
                        <div class="featured-services-grid">
                            @foreach($categoryData['services']->where('is_featured', 1)->take(3) as $service)
                                <a href="{{ route('services.show', $service->slug) }}" class="service-card">
                                    <div class="service-image">
                                        @if($service->image)
                                            <img src="{{ \App\Helpers\ImageHelper::getServiceImage($service->image) }}" alt="{{ $service->title }}">
                                        @else
                                            <img src="{{ asset('images/services/service-placeholder.jpeg') }}" alt="{{ $service->title }}">
                                        @endif
                                    </div>
                                    <div class="service-content">
                                        <h3 class="service-title">{{ $service->title }}</h3>
                                        <p class="text-muted">{{ \Illuminate\Support\Str::limit($service->description, 100) }}</p>
                                        <div class="service-price">৳{{ number_format($service->price, 0) }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        
                        <!-- All Services List -->
                        <div class="service-list">
                            <div class="service-list-grid">
                                @foreach($categoryData['services']->where('is_featured', 0)->take(6) as $service)
                                    <a href="{{ route('services.show', $service->slug) }}" class="service-list-item">
                                        <i class="bi bi-{{ $service->icon ?? $categoryData['category']->icon ?? 'grid' }}"></i>
                                        <span>{{ $service->title }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">
                    <h4>No services found</h4>
                    <p>It looks like there are no services in the database yet. Please add some services through the admin panel.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
