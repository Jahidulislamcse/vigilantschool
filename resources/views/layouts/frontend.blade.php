<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', $settings['site_title'] ?? 'Kider - Preschool & Grammar School')</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=5.0" name="viewport">
    <meta name="theme-color" content="#0c4598">
    <!-- Primary SEO Meta Tags -->
    <meta name="title" content="@yield('title', ($settings['site_title'] ?? 'Vigilant International School') . ' - ' . ($settings['site_tagline'] ?? 'Constant effort in acquiring quality and quantity'))">
    <meta name="description" content="@yield('meta_description', $settings['meta_description'] ?? 'Vigilant International School - English Medium & English Version from Play Group to Class 8 with British Council and Edexcel curriculum standards.')">
    <meta name="keywords" content="@yield('meta_keywords', $settings['meta_keywords'] ?? 'school, english medium, english version, edexcel, british council, kindergarten, play group, primary school, high school, education')">
    <meta name="author" content="{{ $settings['school_name'] ?? 'Vigilant International School' }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    @if(!empty($settings['google_site_verification']))
    <meta name="google-site-verification" content="{{ $settings['google_site_verification'] }}">
    @endif

    <!-- Open Graph / Facebook / WhatsApp Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $settings['site_title'] ?? 'Vigilant International School' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $settings['site_title'] ?? 'Vigilant International School')">
    <meta property="og:description" content="@yield('meta_description', $settings['meta_description'] ?? 'Vigilant International School - Quality English Medium & English Version Education from Play Group to Class 8.')">
    <meta property="og:image" content="{{ asset($settings['og_image'] ?? $settings['site_logo'] ?? 'kider/img/carousel-1.jpg') }}">
    <meta property="og:image:alt" content="{{ $settings['site_title'] ?? 'Vigilant International School' }}">
    <meta property="og:locale" content="en_US">

    <!-- Twitter / X Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('title', $settings['site_title'] ?? 'Vigilant International School')">
    <meta name="twitter:description" content="@yield('meta_description', $settings['meta_description'] ?? 'Vigilant International School - Quality English Medium & English Version Education.')">
    <meta name="twitter:image" content="{{ asset($settings['og_image'] ?? $settings['site_logo'] ?? 'kider/img/carousel-1.jpg') }}">

    <!-- Schema.org JSON-LD Structured Data (Google Knowledge Graph) -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@type": "School",
      "name": "{{ $settings['school_name'] ?? 'Vigilant International School' }}",
      "alternateName": "{{ $settings['site_title'] ?? 'Vigilant School' }}",
      "url": "{{ url('/') }}",
      "logo": "{{ asset($settings['site_logo'] ?? 'kider/img/favicon.ico') }}",
      "image": "{{ asset($settings['og_image'] ?? 'kider/img/carousel-1.jpg') }}",
      "description": "{{ $settings['meta_description'] ?? 'English Medium & English Version School from Play Group to Class 8.' }}",
      "telephone": "{{ $settings['contact_phone'] ?? '' }}",
      "email": "{{ $settings['contact_email'] ?? '' }}",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $settings['contact_address'] ?? '' }}"
      },
      "sameAs": [
        @if(!empty($settings['facebook_url'])) "{{ $settings['facebook_url'] }}" @endif
      ]
    }
    </script>

    @if(!empty($settings['google_analytics_id']))
    <!-- Google tag (gtag.js) GA4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['google_analytics_id'] }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $settings['google_analytics_id'] }}');
    </script>
    @endif

    <!-- Favicon -->
    <link href="{{ asset($settings['site_favicon'] ?? 'kider/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Heebo:wght@400;500;600&family=Inter:wght@400;500;600;700&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('kider/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('kider/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('kider/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('kider/css/style.css') }}?v={{ time() }}" rel="stylesheet">
    <!-- Brand Theme Stylesheet -->
    <link href="{{ asset('kider/css/vigilant-theme.css') }}?v={{ time() }}" rel="stylesheet">

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
