<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    @if(!empty($settings['site_logo']))
                        <img src="{{ asset($settings['site_logo']) }}" alt="{{ $settings['site_title'] ?? 'Vigilant' }}" class="me-2 rounded bg-white p-1 shadow-sm" style="height: 54px; width: 54px; object-fit: contain;">
                    @endif
                    <h4 class="text-white mb-0">{{ $settings['site_title'] ?? 'Vigilant International School' }}</h4>
                </div>
                <p class="text-white-50 mb-3 small">{{ $settings['site_tagline'] ?? 'English Medium & English Version | Play Group to S.S.C & O Level' }}</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3 text-secondary"></i>{{ $settings['contact_address'] ?? 'Dhaka, Bangladesh' }}</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3 text-secondary"></i>{{ $settings['contact_phone'] ?? '+880 1700-000000' }}</p>
                <p class="mb-2"><i class="fa fa-envelope me-3 text-secondary"></i>{{ $settings['contact_email'] ?? 'info@vigilantschool.edu.bd' }}</p>
                <div class="d-flex pt-2">
                    @if(!empty($settings['twitter_url']))
                        <a class="btn btn-outline-light btn-social" href="{{ $settings['twitter_url'] }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    @else
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if(!empty($settings['facebook_url']))
                        <a class="btn btn-outline-light btn-social" href="{{ $settings['facebook_url'] }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @else
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(!empty($settings['youtube_url']))
                        <a class="btn btn-outline-light btn-social" href="{{ $settings['youtube_url'] }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    @else
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if(!empty($settings['linkedin_url']))
                        <a class="btn btn-outline-light btn-social" href="{{ $settings['linkedin_url'] }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    @else
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-4">Quick Links</h4>
                <a class="btn btn-link text-white-50" href="{{ route('about') }}">About Us</a>
                <a class="btn btn-link text-white-50" href="{{ route('facilities') }}">Our Facilities</a>
                <a class="btn btn-link text-white-50" href="{{ route('classes') }}">Classes & Programs</a>
                <a class="btn btn-link text-white-50" href="{{ route('appointment') }}">Book Appointment</a>
                <a class="btn btn-link text-white-50" href="{{ route('contact') }}">Contact Us</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-4">Photo Gallery</h4>
                <div class="row g-2 pt-2">
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('kider/img/classes-1.jpg') }}" alt="Gallery Image">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('kider/img/classes-2.jpg') }}" alt="Gallery Image">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('kider/img/classes-3.jpg') }}" alt="Gallery Image">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('kider/img/classes-4.jpg') }}" alt="Gallery Image">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('kider/img/classes-5.jpg') }}" alt="Gallery Image">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded bg-light p-1" src="{{ asset('kider/img/classes-6.jpg') }}" alt="Gallery Image">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-4">Newsletter</h4>
                <p>Stay informed with our latest news, announcements, and school events.</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5 text-white" type="text" placeholder="Your email">
                    <button type="button" class="btn btn-secondary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; {{ date('Y') }} <a class="border-bottom" href="{{ route('home') }}">{{ $settings['site_title'] ?? 'Kider' }}</a>, All Rights Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="#">Cookies</a>
                        <a href="#">Help</a>
                        <a href="#">FAQs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
