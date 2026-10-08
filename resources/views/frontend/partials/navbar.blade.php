<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-3 px-lg-5 py-2 py-lg-0 shadow-sm">
    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center py-1 py-lg-2">
        @if(!empty($settings['site_logo']))
            <img src="{{ asset($settings['site_logo']) }}" alt="{{ $settings['site_title'] ?? 'Vigilant International School' }}" class="me-2" style="height: 46px; width: auto; object-fit: contain;">
        @else
            <i class="fa fa-graduation-cap text-primary fs-1 me-2"></i>
        @endif
        <div class="brand-title-wrap text-start">
            <span class="brand-title-main">Vigilant</span>
            <span class="brand-title-sub">International School</span>
        </div>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto py-2 py-lg-0">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
            <a href="{{ route('classes') }}" class="nav-item nav-link {{ request()->routeIs('classes') ? 'active' : '' }}">Classes</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('facilities', 'team', 'appointment', 'testimonials') ? 'active' : '' }}" data-bs-toggle="dropdown">Explore</a>
                <div class="dropdown-menu rounded-3 border-0 shadow-sm m-0">
                    <a href="{{ route('facilities') }}" class="dropdown-item {{ request()->routeIs('facilities') ? 'active' : '' }}"><i class="fa fa-school text-primary me-2"></i> School Facilities</a>
                    <a href="{{ route('team') }}" class="dropdown-item {{ request()->routeIs('team') ? 'active' : '' }}"><i class="fa fa-chalkboard-user text-primary me-2"></i> Our Teachers</a>
                    <a href="{{ route('appointment') }}" class="dropdown-item {{ request()->routeIs('appointment') ? 'active' : '' }}"><i class="fa fa-calendar-check text-primary me-2"></i> Book A School Tour</a>
                    <a href="{{ route('testimonials') }}" class="dropdown-item {{ request()->routeIs('testimonials') ? 'active' : '' }}"><i class="fa fa-comments text-primary me-2"></i> Parent Reviews</a>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
        </div>
        <!-- Desktop Join Us Button -->
        <a href="{{ route('appointment') }}" class="btn btn-secondary rounded-pill px-4 py-2 d-none d-lg-inline-flex align-items-center fw-semibold">
            Join Us<i class="fa fa-arrow-right ms-2"></i>
        </a>
        <!-- Mobile Join Us Button -->
        <div class="d-lg-none pt-2 pb-1 border-top mt-2">
            <a href="{{ route('appointment') }}" class="btn btn-secondary rounded-pill w-100 py-2 d-flex align-items-center justify-content-center fw-semibold">
                Join Us<i class="fa fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</nav>
<!-- Navbar End -->
