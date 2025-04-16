@extends('layouts.app')

@section('title', 'Service Providers Near You')

@section('styles')
<style>
    #map {
        height: 500px;
        width: 100%;
    }
    
    .provider-card {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }
    
    .provider-card:hover {
        background-color: #f5f5f5;
    }
    
    .provider-card.active {
        background-color: #f8bbd0;
    }
</style>
@endsection

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Service Providers Near You</h1>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Providers</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="providers-list">
                            @foreach($serviceProviders as $provider)
                                <div class="provider-card" data-id="{{ $provider->id }}" data-lat="{{ $provider->latitude }}" data-lng="{{ $provider->longitude }}">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $provider->profile_image) }}" alt="{{ $provider->business_name }}" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <h5 class="mb-1">{{ $provider->business_name }}</h5>
                                            <div class="rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $provider->rating)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-warning"></i>
                                                    @endif
                                                @endfor
                                                <span class="ms-1">({{ $provider->reviews->count() }})</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div id="map"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    let map;
    let markers = [];
    
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 12
        });
        
        // Get user's location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    
                    map.setCenter(pos);
                    
                    // Add marker for user's location
                    new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: 'Your Location',
                        icon: {
                            url: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
                        }
                    });
                    
                    // Add markers for service providers
                    addServiceProviderMarkers();
                },
                () => {
                    console.log('Error: The Geolocation service failed.');
                    addServiceProviderMarkers();
                }
            );
        } else {
            console.log('Error: Your browser doesn\'t support geolocation.');
            addServiceProviderMarkers();
        }
    }
    
    function addServiceProviderMarkers() {
        const providerCards = document.querySelectorAll('.provider-card');
        
        providerCards.forEach(card => {
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            const id = card.dataset.id;
            
            if (lat && lng) {
                const marker = new google.maps.Marker({
                    position: { lat, lng },
                    map: map,
                    title: card.querySelector('h5').textContent
                });
                
                marker.addListener('click', () => {
                    providerCards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                });
                
                markers[id] = marker;
            }
        });
        
        // Add click event to provider cards
        providerCards.forEach(card => {
            card.addEventListener('click', () => {
                const id = card.dataset.id;
                const lat = parseFloat(card.dataset.lat);
                const lng = parseFloat(card.dataset.lng);
                
                if (lat && lng) {
                    map.setCenter({ lat, lng });
                    map.setZoom(15);
                    
                    providerCards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    
                    // Bounce the marker
                    if (markers[id]) {
                        markers[id].setAnimation(google.maps.Animation.BOUNCE);
                        setTimeout(() => {
                            markers[id].setAnimation(null);
                        }, 1500);
                    }
                }
            });
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
@endsection