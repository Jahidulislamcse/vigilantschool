@extends('layouts.frontend')

@section('title', ($settings['site_title'] ?? 'Vigilant International School') . ' - ' . ($settings['site_tagline'] ?? 'English Medium & English Version'))

@section('content')

    <!-- Carousel Start -->
    @if(isset($sliders) && $sliders->count() > 0)
    <div class="container-fluid p-0 mb-4 mb-md-5">
        <div class="owl-carousel header-carousel position-relative">
            @foreach($sliders as $slider)
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset($slider->image) }}" alt="{{ $slider->title }}">
                <div class="slider-overlay">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-12 col-md-10 col-lg-8 px-3 px-md-4">
                                @if($slider->subtitle)
                                    <div>
                                        <span class="slider-badge animated slideInDown">{{ $slider->subtitle }}</span>
                                    </div>
                                @endif
                                <h1 class="slider-title animated slideInDown">{{ $slider->title }}</h1>
                                <p class="slider-desc animated slideInDown mb-0">{{ $slider->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    <!-- Carousel End -->


    <!-- Facilities Start -->
    @if(isset($facilities) && $facilities->count() > 0)
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="text-center mx-auto mb-4 mb-md-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 700px;">
                <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-2 font-weight-bold">Campus Infrastructure</span>
                <h1 class="mb-3">Our School Facilities</h1>
                <p class="text-muted">Equipped with 2 dedicated teachers per junior classroom, science & computer labs, 24/7 CCTV surveillance, and after-class assistance programmes.</p>
            </div>
            <div class="row g-4">
                @php
                    $colors = ['primary', 'success', 'warning', 'info'];
                    $delay = 0.1;
                @endphp
                @foreach($facilities as $index => $facility)
                @php
                    $theme = $facility->color_theme ?: $colors[$index % 4];
                @endphp
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                    <div class="facility-item facility-card-{{ $theme }}">
                        <div class="facility-icon bg-{{ $theme }}">
                            <i class="fa-solid {{ $facility->icon ?? 'fa-school' }} text-{{ $theme }}"></i>
                        </div>
                        <div class="facility-text">
                            <h3>{{ $facility->title }}</h3>
                            <p>{{ $facility->short_description }}</p>
                        </div>
                    </div>
                </div>
                @php $delay += 0.15; @endphp
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- Facilities End -->


    <!-- About Us & Mission Start -->
    @if($about)
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-3 font-weight-bold">
                        {{ $about->tagline ?? 'About Our School' }}
                    </span>
                    <h1 class="mb-3 mb-md-4">{{ $about->title }}</h1>
                    <p class="mb-3 fw-medium text-dark">{{ $about->description_1 }}</p>
                    <p class="mb-4 text-muted">{{ $about->description_2 }}</p>
                    <div class="row g-3 align-items-center">
                        <div class="col-sm-6">
                            <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 w-100 w-sm-auto text-center" href="{{ route('about') }}">Read More</a>
                        </div>
                        @if($about->founder_name)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center bg-light p-2 rounded-3">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset($about->founder_photo ?? 'kider/img/user.jpg') }}" alt="{{ $about->founder_name }}" style="width: 48px; height: 48px; object-fit: cover;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-0 font-weight-bold">{{ $about->founder_name }}</h6>
                                    <small class="text-muted">{{ $about->founder_role ?? 'Academic Council' }}</small>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.3s">
                    <div class="row g-2 g-md-3">
                        <div class="col-12 text-center">
                            <img class="img-fluid w-75 rounded-circle bg-light p-2 p-md-3 shadow-sm" src="{{ asset($about->image_1 ?? 'kider/img/about-1.jpg') }}" alt="School Life">
                        </div>
                        <div class="col-6 text-start about-img-overlap">
                            <img class="img-fluid w-100 rounded-circle bg-light p-2 p-md-3 shadow-sm" src="{{ asset($about->image_2 ?? 'kider/img/about-2.jpg') }}" alt="Activities">
                        </div>
                        <div class="col-6 text-end about-img-overlap">
                            <img class="img-fluid w-100 rounded-circle bg-light p-2 p-md-3 shadow-sm" src="{{ asset($about->image_3 ?? 'kider/img/about-3.jpg') }}" alt="Classroom">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- About Us & Mission End -->


    <!-- Call To Action Banner Start -->
    @if($about && $about->cta_title)
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="cta-banner">
                <div class="row g-0">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="min-height: 280px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100" src="{{ asset($about->cta_image ?? 'kider/img/call-to-action.jpg') }}" style="object-fit: cover;" alt="Call to Action">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                        <div class="h-100 d-flex flex-column justify-content-center p-4 p-md-5 cta-banner-content">
                            <h1 class="mb-3">{{ $about->cta_title }}</h1>
                            <p class="mb-4 text-muted">{{ $about->cta_description }}</p>
                            <a class="btn btn-secondary py-3 px-4 px-md-5 align-self-start rounded-pill" href="{{ $about->cta_button_url ?? '#' }}">{{ $about->cta_button_text ?? 'Visit Our Campus' }}<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Call To Action Banner End -->

@endsection
