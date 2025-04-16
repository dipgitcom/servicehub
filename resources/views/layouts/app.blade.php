<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServiceHub - Find the Perfect Service Provider</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="ServiceHub">
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('services.index') }}">All Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('payment') }}">ServiceHub Pay</a>
                        </li>
                    </ul>
                    
                    <div class="ms-3">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        @else
                            <div class="dropdown">
                                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('profile') }}">My Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ route('bookings') }}">My Bookings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5 class="mb-4">CONTACT</h5>
                    <p class="mb-2">16516 / 8809643240103</p>
                    <p class="mb-2">info@servicehub.xyz</p>
                    <p class="mb-4">Corporate Address<br>House 454, Road No: 31,<br>Mohakhali DOHS, Dhaka</p>
                    <h5 class="mb-2">TRADE LICENSE NO</h5>
                    <p>TRAD/DNCC/145647/2022</p>
                </div>
                
                <div class="col-md-3 mb-4">
                    <h5 class="mb-4">OTHER PAGES</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('blog') }}" class="text-decoration-none text-dark">Blog</a></li>
                        <li class="mb-2"><a href="{{ route('help') }}" class="text-decoration-none text-dark">Help</a></li>
                        <li class="mb-2"><a href="{{ route('terms') }}" class="text-decoration-none text-dark">Terms of use</a></li>
                        <li class="mb-2"><a href="{{ route('privacy') }}" class="text-decoration-none text-dark">Privacy Policy</a></li>
                        <li class="mb-2"><a href="{{ route('refund') }}" class="text-decoration-none text-dark">Refund & Return Policy</a></li>
                        <li class="mb-2"><a href="{{ route('sitemap') }}" class="text-decoration-none text-dark">Sitemap</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 mb-4">
                    <h5 class="mb-4">COMPANY</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('manager') }}" class="text-decoration-none text-dark">sManager</a></li>
                        <li class="mb-2"><a href="{{ route('business') }}" class="text-decoration-none text-dark">sBusiness</a></li>
                        <li class="mb-2"><a href="{{ route('delivery') }}" class="text-decoration-none text-dark">sDelivery</a></li>
                        <li class="mb-2"><a href="{{ route('bondhu') }}" class="text-decoration-none text-dark">sBondhu</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 mb-4">
                    <h5 class="mb-4">DOWNLOAD OUR APP</h5>
                    <p>Tackle your to-do list wherever you are with our mobile app & make your life easy.</p>
                    <div class="d-flex gap-2 mb-3">
                        <a href="#" class="text-decoration-none">
                            <img src="{{ asset('images/app-store.png') }}" alt="App Store" height="40">
                        </a>
                        <a href="#" class="text-decoration-none">
                            <img src="{{ asset('images/google-play.png') }}" alt="Google Play" height="40">
                        </a>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="#" class="social-icon">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center pt-4 mt-4 border-top">
                <p class="mb-0">Copyright © {{ date('Y') }} ServiceHub Platform Limited | All Rights Reserved</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield('scripts')
</body>
</html>
