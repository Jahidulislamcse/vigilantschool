<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0 shadow-sm">
    <a href="{{ route('home') }}" class="navbar-brand">
        <h1 class="m-0 text-primary d-flex align-items-center">
            @if(!empty($settings['site_logo']))
                <img src="{{ asset($settings['site_logo']) }}" alt="{{ $settings['site_title'] ?? 'Vigilant International School' }}" style="height: 45px;" class="me-2">
            @else
                <i class="fa fa-book-reader me-3"></i>
            @endif
            <span>{{ $settings['site_title'] ?? 'Vigilant International School' }}</span>
        </h1>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
            <a href="#" class="nav-item nav-link">Classes</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('facilities') ? 'active' : '' }}" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                    <a href="{{ route('facilities') }}" class="dropdown-item {{ request()->routeIs('facilities') ? 'active' : '' }}">School Facilities</a>
                    <a href="#" class="dropdown-item">Popular Teachers</a>
                    <a href="#" class="dropdown-item">Make Appointment</a>
                    <a href="#" class="dropdown-item">Testimonial</a>
                </div>
            </div>
            <a href="#" class="nav-item nav-link">Contact Us</a>
        </div>
        <a href="#" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Join Us<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
<!-- Navbar End -->
