@extends('layouts.app')

@section('styles')
<!-- Add this to ensure our custom styles are loaded and have priority -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="servicehub-container">
    @if(isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endif

    <!-- Hero Section -->
    <div class="hero-section" style="background-image: url('{{ asset('images/hero-bg.jpeg') }}');">
        <div class="container">
            <div class="hero-content">
                <h1>Your Personal Assistant</h1>
                <p>One-stop solution for your services. Order any service, anytime.</p>
                <div class="search-container">
                    <div class="location-selector">
                        <i class="bi bi-geo-alt-fill"></i>
                        <select class="form-select">
                            <option>Gulshan</option>
                            <option>Banani</option>
                            <option>Dhanmondi</option>
                            <option>Uttara</option>
                        </select>
                    </div>
                    <div class="search-input">
                        <form action="{{ route('services.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Find your service here e.g. AC, Car, Facial ..." name="search">
                                <button class="btn btn-primary search-btn" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scrollable Service Categories Section -->
    <div class="service-categories-scroll-section">
        <div class="container position-relative">
            <div class="service-scroll-container">
                <div class="service-scroll-item">
                    <a href="{{ route('services.by-category', 'ac-repair') }}" class="service-scroll-link">
                        <div class="service-icon">
                            <i class="bi bi-snow"></i>
                        </div>
                        <span>AC Repair Services</span>
                    </a>
                </div>
                <div class="service-scroll-item">
                    <a href="{{ route('services.by-category', 'appliance-repair') }}" class="service-scroll-link">
                        <div class="service-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                        <span>Appliance Repair</span>
                    </a>
                </div>
                <div class="service-scroll-item">
                    <a href="{{ route('services.by-category', 'cleaning') }}" class="service-scroll-link">
                        <div class="service-icon">
                            <i class="bi bi-brush"></i>
                        </div>
                        <span>Cleaning Solution</span>
                    </a>
                </div>
                <div class="service-scroll-item">
                    <a href="{{ route('services.by-category', 'beauty-wellness') }}" class="service-scroll-link">
                        <div class="service-icon">
                            <i class="bi bi-gem"></i>
                        </div>
                        <span>Beauty & Wellness</span>
                    </a>
                </div>
                <div class="service-scroll-item">
                    <a href="{{ route('services.by-category', 'shifting') }}" class="service-scroll-link">
                        <div class="service-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <span>Shifting</span>
                    </a>
                </div>
                <div class="service-scroll-item">
                    <a href="{{ route('services.by-category', 'shop') }}" class="service-scroll-link">
                        <div class="service-icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        <span>ServiceHub Shop</span>
                    </a>
                </div>
                <div class="service-scroll-item">
                    <a href="{{ route('services.by-category', 'mens-care') }}" class="service-scroll-link">
                        <div class="service-icon">
                            <i class="bi bi-scissors"></i>
                        </div>
                        <span>Men's Care & Salon</span>
                    </a>
                </div>
                <div class="service-scroll-item">
                    <a href="{{ route('services.by-category', 'health-care') }}" class="service-scroll-link">
                        <div class="service-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <span>Health & Care</span>
                    </a>
                </div>
                <div class="service-scroll-item">
                    <a href="{{ route('services.by-category', 'electronics') }}" class="service-scroll-link">
                        <div class="service-icon">
                            <i class="bi bi-cpu"></i>
                        </div>
                        <span>Electronics Repair</span>
                    </a>
                </div>
                <div class="service-scroll-item all-services-item">
                    <a href="{{ route('services.index') }}" class="service-scroll-link">
                        <div class="service-icon">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </div>
                        <span>All Services</span>
                    </a>
                </div>
            </div>
            <button class="scroll-nav-btn scroll-prev" id="scrollPrev">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="scroll-nav-btn scroll-next" id="scrollNext">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>

    <!-- Service Categories Section -->
    <div class="container service-categories-section">
        <div class="row service-icons">
            @if(isset($categories) && count($categories) > 0)
                @foreach($categories as $category)
                <div class="col-md-2 col-6 mb-4">
                    <a href="{{ route('services.by-category', $category->slug) }}" class="service-category-item">
                        <div class="icon-wrapper">
                            <i class="bi bi-{{ $category->icon ?? 'grid' }}"></i>
                        </div>
                        <h5>{{ $category->name }}</h5>
                    </a>
                </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- For Your Home Section -->
    <div class="container home-services-section">
        <h2 class="section-title">For Your Home</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <a href="{{ route('services.by-category', 'plumbing') }}" class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('images/plumbing.jpeg') }}" alt="Plumbing & Sanitary Services">
                    </div>
                    <h5>Plumbing & Sanitary Services</h5>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="{{ route('services.by-category', 'shifting') }}" class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('images/houseshifting.jpeg') }}" alt="House Shifting Services">
                    </div>
                    <h5>House Shifting Services</h5>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="{{ route('services.by-category', 'cleaning') }}" class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('images/cleaning.jpeg') }}" alt="Home Cleaning">
                    </div>
                    <h5>Home Cleaning</h5>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="{{ route('services.by-category', 'gas-stove') }}" class="service-card">
                    <div class="service-image">
                        <img src="{{ asset('images/gas.jpeg') }}" alt="Gas Stove/Burner Services">
                    </div>
                    <h5>Gas Stove/Burner Services</h5>
                </a>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="container how-it-works-section">
        <div class="section-header">
            <span class="section-label">HOW IT WORKS</span>
            <h2 class="section-title">Easiest way to get a service</h2>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="how-it-works-image">
                    <img src="{{ asset('images/app-preview.jpeg') }}" alt="App Preview" class="img-fluid">
                    <div class="play-button">
                        <i class="bi bi-play-fill"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="steps-container">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3>Select the Service</h3>
                            <p>Pick the service you are looking for- from the website or the app.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3>Pick your schedule</h3>
                            <p>Pick your convenient date and time to avail the service. Pick the service provider based on their rating.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3>Place Your Order & Relax</h3>
                            <p>Review and place the order. Now just sit back and relax. We'll assign the expert service provider's schedule for you.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Can't Find Service Section -->
    <div class="container-fluid request-service-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2>Can't find your desired service? Let us know 24/7 in 12000.</h2>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-end">
                    <a href="#" class="btn btn-primary me-3">Request a service</a>
                    <a href="tel:16516" class="btn btn-outline-primary">
                        <i class="bi bi-telephone-fill me-2"></i> 12000
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Download App Section -->
    <div class="container download-app-section">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/app-mockup.jpg') }}" alt="App Mockup" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="download-content">
                    <span class="section-label">DOWNLOAD OUR APP</span>
                    <h2>Any Service, Any Time, Anywhere.</h2>
                    <p>Give us your mobile number. You'll get an SMS with the app download link.</p>
                    <div class="app-download-form">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Type your mobile number">
                            <button class="btn btn-primary" type="button">Get the app</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Services Section -->
    @if(isset($popularServices) && count($popularServices) > 0)
    <div class="container popular-services-section">
        <h2 class="section-title">Popular Services</h2>
        <div class="row">
            @foreach($popularServices as $service)
            <div class="col-md-3 mb-4">
                <div class="card service-card">
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->title }}">
                    @else
                        <img src="{{ asset('images/service-placeholder.jpeg') }}" class="card-img-top" alt="{{ $service->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->title }}</h5>
                        <p class="card-text text-muted">{{ $service->category->name ?? 'Service' }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price">{{ number_format($service->price, 2) }} BDT</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('services.show', $service->slug) }}" class="btn btn-outline-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Top Service Providers Section -->
    @if(isset($topProviders) && count($topProviders) > 0)
    <div class="container top-providers-section">
        <h2 class="section-title">Top Service Providers</h2>
        <div class="row">
            @foreach($topProviders as $provider)
            <div class="col-md-3 mb-4">
                <div class="card provider-card text-center">
                    <div class="card-body">
                        @if($provider->profile_image)
                            <img src="{{ asset('storage/' . $provider->profile_image) }}" class="rounded-circle mb-3" width="100" height="100" alt="{{ $provider->business_name }}">
                        @else
                            <img src="{{ asset('images/provider-placeholder.jpeg') }}" class="rounded-circle mb-3" width="100" height="100" alt="{{ $provider->business_name }}">
                        @endif
                        <h5 class="card-title">{{ $provider->business_name }}</h5>
                        <p class="card-text text-muted">{{ $provider->location->name ?? 'Location' }}</p>
                        <div class="rating">
                            <span class="badge bg-success">
                                <i class="bi bi-star-fill"></i> {{ number_format($provider->rating, 1) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Recently Viewed Section -->
    <div class="container recently-viewed-section">
        <h2 class="section-title">Recently View</h2>
        <div class="row">
            <!-- This would be populated with dynamic content based on user's browsing history -->
            <div class="col-md-4 mb-4">
                <div class="service-card">
                    <img src="{{ asset('images/cleaning.jpeg') }}" alt="Home Cleaning" class="img-fluid">
                    <h5>Home Cleaning</h5>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="service-card">
                    <img src="{{ asset('images/ac-repair.jpeg') }}" alt="AC Repair" class="img-fluid">
                    <h5>AC Repair</h5>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="service-card">
                    <img src="{{ asset('images/beauty-service.jpeg') }}" alt="Beauty Services" class="img-fluid">
                    <h5>Beauty Services</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Widget -->
    <div class="chat-widget">
        <button class="chat-button">
            <i class="bi bi-chat-fill"></i>
        </button>
        <div class="chat-popup">
            <div class="chat-header">
                <span>Welcome to ServiceHub! Ask your query here. 👋</span>
                <button class="close-chat"><i class="bi bi-x"></i></button>
            </div>
            <div class="chat-body">
                <!-- Chat messages would go here -->
            </div>
            <div class="chat-footer">
                <input type="text" placeholder="Type your message...">
                <button><i class="bi bi-send-fill"></i></button>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top">
        <i class="bi bi-arrow-up"></i>
    </button>
</div>
@endsection

@section('scripts')
<script>
    // Ensure JS is loaded
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Home page loaded');
        
        // Horizontal scroll for service categories
        const scrollContainer = document.querySelector('.service-scroll-container');
        const scrollPrev = document.getElementById('scrollPrev');
        const scrollNext = document.getElementById('scrollNext');
        
        if (scrollContainer && scrollNext && scrollPrev) {
            // Check if scrolling is needed
            const checkScrollButtons = () => {
                const isScrollable = scrollContainer.scrollWidth > scrollContainer.clientWidth;
                
                if (isScrollable) {
                    scrollPrev.style.display = scrollContainer.scrollLeft > 0 ? 'flex' : 'none';
                    scrollNext.style.display = 
                        scrollContainer.scrollLeft + scrollContainer.clientWidth < scrollContainer.scrollWidth 
                        ? 'flex' : 'none';
                } else {
                    scrollPrev.style.display = 'none';
                    scrollNext.style.display = 'none';
                }
            };
            
            // Initial check
            checkScrollButtons();
            
            // Scroll buttons functionality
            scrollNext.addEventListener('click', () => {
                scrollContainer.scrollBy({ left: 300, behavior: 'smooth' });
                setTimeout(checkScrollButtons, 400);
            });
            
            scrollPrev.addEventListener('click', () => {
                scrollContainer.scrollBy({ left: -300, behavior: 'smooth' });
                setTimeout(checkScrollButtons, 400);
            });
            
            // Update on resize
            window.addEventListener('resize', checkScrollButtons);
            
            // Update on scroll
            scrollContainer.addEventListener('scroll', checkScrollButtons);
        }
    });
</script>
@endsection
