@extends('layouts.frontend')

@section('title', ($settings['site_title'] ?? 'Vigilant International School') . ' - ' . ($settings['site_tagline'] ?? 'English Medium & English Version'))

@section('content')

    <!-- Carousel Start -->
    @if(isset($sliders) && $sliders->count() > 0)
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            @foreach($sliders as $slider)
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset($slider->image) }}" alt="{{ $slider->title }}" style="width: 100%; max-height: 700px; object-fit: cover;">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .38);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                @if($slider->subtitle)
                                    <h4 class="text-white text-uppercase mb-3 animated slideInDown font-weight-bold" style="letter-spacing: 2px;">{{ $slider->subtitle }}</h4>
                                @endif
                                <h1 class="display-2 text-white animated slideInDown mb-4">{{ $slider->title }}</h1>
                                <p class="fs-5 fw-medium text-white mb-0 pb-2">{{ $slider->description }}</p>
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
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 700px;">
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
                    <div class="facility-item">
                        <div class="facility-icon bg-{{ $theme }}">
                            <span class="bg-{{ $theme }}"></span>
                            <i class="fa {{ $facility->icon ?? 'fa-school' }} fa-3x text-{{ $theme }}"></i>
                            <span class="bg-{{ $theme }}"></span>
                        </div>
                        <div class="facility-text bg-{{ $theme }}">
                            <h3 class="text-{{ $theme }} mb-3">{{ $facility->title }}</h3>
                            <p class="mb-0">{{ $facility->short_description }}</p>
                        </div>
                    </div>
                </div>
                @php $delay += 0.2; @endphp
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- Facilities End -->


    <!-- About Us & Mission Start -->
    @if($about)
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-3 font-weight-bold">
                        {{ $about->tagline ?? 'About Our School' }}
                    </span>
                    <h1 class="mb-4">{{ $about->title }}</h1>
                    <p class="mb-3">{{ $about->description_1 }}</p>
                    <p class="mb-4 text-muted">{{ $about->description_2 }}</p>
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-6">
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('about') }}">Read More</a>
                        </div>
                        @if($about->founder_name)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle flex-shrink-0" src="{{ asset($about->founder_photo ?? 'kider/img/user.jpg') }}" alt="{{ $about->founder_name }}" style="width: 48px; height: 48px; object-fit: cover;">
                                <div class="ms-3">
                                    <h6 class="text-primary mb-1">{{ $about->founder_name }}</h6>
                                    <small class="text-muted">{{ $about->founder_role ?? 'Academic Council' }}</small>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img class="img-fluid w-75 rounded-circle bg-light p-3" src="{{ asset($about->image_1 ?? 'kider/img/about-1.jpg') }}" alt="School Life">
                        </div>
                        <div class="col-6 text-start" style="margin-top: -150px;">
                            <img class="img-fluid w-100 rounded-circle bg-light p-3" src="{{ asset($about->image_2 ?? 'kider/img/about-2.jpg') }}" alt="Activities">
                        </div>
                        <div class="col-6 text-end" style="margin-top: -150px;">
                            <img class="img-fluid w-100 rounded-circle bg-light p-3" src="{{ asset($about->image_3 ?? 'kider/img/about-3.jpg') }}" alt="Classroom">
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
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded">
                <div class="row g-0">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100 rounded" src="{{ asset($about->cta_image ?? 'kider/img/call-to-action.jpg') }}" style="object-fit: cover;" alt="Call to Action">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="h-100 d-flex flex-column justify-content-center p-5">
                            <h1 class="mb-4">{{ $about->cta_title }}</h1>
                            <p class="mb-4">{{ $about->cta_description }}</p>
                            <a class="btn btn-primary py-3 px-5 align-self-start" href="{{ $about->cta_button_url ?? '#' }}">{{ $about->cta_button_text ?? 'Visit Our Campus' }}<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Call To Action Banner End -->

@endsection
