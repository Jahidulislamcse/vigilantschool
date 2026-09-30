<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', $settings['site_title'] ?? 'Kider - Preschool & Grammar School')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="@yield('meta_keywords', 'school, preschool, kindergarten, grammar school, education, classes, teachers')" name="keywords">
    <meta content="@yield('meta_description', $settings['meta_description'] ?? 'Modern kindergarten and grammar school')" name="description">

    <!-- Favicon -->
    <link href="{{ asset($settings['site_favicon'] ?? 'kider/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('kider/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('kider/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('kider/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('kider/css/style.css') }}" rel="stylesheet">
    <!-- Brand Theme Stylesheet -->
    <link href="{{ asset('kider/css/vigilant-theme.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar Component -->
        @include('frontend.partials.navbar')

        <!-- Main Content Slot -->
        @yield('content')

        <!-- Footer Component -->
        @include('frontend.partials.footer')

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('kider/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('kider/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('kider/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('kider/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('kider/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
