<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="ServiceHub">
                </a>
            </div>
            
            <div class="location-selector">
                <i class="fas fa-map-marker-alt"></i>
                <select class="form-select">
                    @foreach($locations ?? [] as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="search-bar">
                <form action="{{ route('services.index') }}" method="GET">
                    <input type="text" name="search" placeholder="Find your service here e.g. AC, Car, Facial..." class="form-control">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            
            <div class="header-actions">
                <a href="{{ route('payment') }}" class="btn btn-outline-primary">ServiceHub Pay</a>
                <a href="{{ route('services.index') }}" class="btn btn-link">All Services</a>
                
                @guest
                    <a href="{{ route('login') }}" class="user-icon">
                        <i class="fas fa-user-circle"></i>
                    </a>
                @else
                    <div class="dropdown">
                        <a class="user-icon dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                            @else
                                <i class="fas fa-user-circle"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">My Account</a></li>
                            <li><a class="dropdown-item" href="{{ route('bookings.my-bookings') }}">My Bookings</a></li>
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
</header>