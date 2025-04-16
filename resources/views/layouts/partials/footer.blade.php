<footer class="footer mt-5 pt-5 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>CONTACT</h5>
                <p>16516 / 8809643240103</p>
                <p>info@servicehub.xyz</p>
                <p>Corporate Address<br>
                House 454, Road No: 31,<br>
                Mohakhali DOHS, Dhaka</p>
                <h5 class="mt-4">TRADE LICENSE NO</h5>
                <p>TRAD/DNCC/145647/2022</p>
            </div>
            
            <div class="col-md-3">
                <h5>OTHER PAGES</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ route('help') }}">Help</a></li>
                    <li><a href="{{ route('terms') }}">Terms of use</a></li>
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('refund') }}">Refund & Return Policy</a></li>
                    <li><a href="{{ route('sitemap') }}">Sitemap</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h5>COMPANY</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('manager') }}">sManager</a></li>
                    <li><a href="{{ route('business') }}">sBusiness</a></li>
                    <li><a href="{{ route('delivery') }}">sDelivery</a></li>
                    <li><a href="{{ route('bondhu') }}">sBondhu</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h5>DOWNLOAD OUR APP</h5>
                <p>Tackle your to-do list wherever you are with our mobile app & make your life easy.</p>
                <div class="app-links">
                    <a href="#"><img src="{{ asset('images/appstore.jpeg') }}" alt="App Store"></a>
                    <a href="#"><img src="{{ asset('images/play-store.png') }}" alt="Google Play"></a>
                </div>
                <div class="social-links mt-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p>Copyright © {{ date('Y') }} ServiceHub Platform Limited | All Rights Reserved</p>
        </div>
    </div>
</footer>