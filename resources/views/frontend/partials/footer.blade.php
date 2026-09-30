<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h3 class="text-white mb-4">Get In Touch</h3>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ $settings['contact_address'] ?? '123 Street, New York, USA' }}</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ $settings['contact_phone'] ?? '+012 345 67890' }}</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ $settings['contact_email'] ?? 'info@example.com' }}</p>
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
                <h3 class="text-white mb-4">Quick Links</h3>
                <a class="btn btn-link text-white-50" href="#">About Us</a>
                <a class="btn btn-link text-white-50" href="#">Contact Us</a>
                <a class="btn btn-link text-white-50" href="#">Our Facilities</a>
                <a class="btn btn-link text-white-50" href="#">Privacy Policy</a>
                <a class="btn btn-link text-white-50" href="#">Terms & Condition</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3 class="text-white mb-4">Photo Gallery</h3>
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
                <h3 class="text-white mb-4">Newsletter</h3>
                <p>Stay informed with our latest news, announcements, and school events.</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5 text-white" type="text" placeholder="Your email">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
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
