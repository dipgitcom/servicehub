@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
<style>
    .services-page {
        padding: 40px 0;
    }
    
    .services-sidebar {
        background-color: #f9f9f9;
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
    
    .category-header {
        margin-bottom: 30px;
    }
    
    .category-header h1 {
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--secondary-color);
    }
    
    .category-header p {
        color: var(--dark-gray);
        font-size: 16px;
    }
    
    .featured-services {
        margin-bottom: 40px;
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
    
    .service-list-section {
        margin-top: 40px;
    }
    
    .service-list-section h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--secondary-color);
    }
    
    .service-list {
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
        
        .service-list {
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
                    @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('services.by-category', $cat->slug) }}" 
                           class="{{ $category->id == $cat->id ? 'active' : '' }}">
                            <i class="bi bi-{{ $cat->icon ?? 'grid' }} me-2"></i> {{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        <!-- Main content area -->
        <div class="col-lg-9">
            <div class="category-header">
                <h1>{{ $category->name }}</h1>
                <p>{{ $category->description }}</p>
            </div>
            
            <!-- Featured Services Section -->
            @if(count($featuredServices) > 0)
            <div class="featured-services">
                <div class="featured-services-grid">
                    @foreach($featuredServices as $service)
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
            </div>
            @endif
            
            <!-- All Services List Section -->
            <div class="service-list-section">
                <h2>All {{ $category->name }}</h2>
                <div class="service-list">
                    @foreach($services as $service)
                    <a href="{{ route('services.show', $service->slug) }}" class="service-list-item">
                        <i class="bi bi-{{ $service->icon ?? $category->icon ?? 'grid' }}"></i>
                        <span>{{ $service->title }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
