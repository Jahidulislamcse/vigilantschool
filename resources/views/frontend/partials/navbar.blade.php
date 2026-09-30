<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0 shadow-sm">
    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center py-2">
        @if(!empty($settings['site_logo']))
            <img src="{{ asset($settings['site_logo']) }}" alt="{{ $settings['site_title'] ?? 'Vigilant International School' }}" class="me-2" style="height: 52px; width: auto; object-fit: contain;">
        @else
            <i class="fa fa-graduation-cap text-primary fs-1 me-2"></i>
        @endif
        <div class="brand-title-wrap text-start">
            <span class="brand-title-main">Vigilant</span>
            <span class="brand-title-sub">International School</span>
        </div>
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
        <a href="#" class="btn btn-secondary rounded-pill px-4 py-2 d-none d-lg-inline-flex align-items-center fw-semibold">Join Us<i class="fa fa-arrow-right ms-2"></i></a>
    </div>
</nav>
<!-- Navbar End -->
