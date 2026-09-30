@extends('layouts.frontend')

@section('title', 'About Us - ' . ($settings['site_title'] ?? 'Vigilant International School'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'About Us', 'breadcrumb' => 'About Us'])

    <!-- About Section Start -->
    @if($about)
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-3 font-weight-bold">
                        {{ $about->tagline ?? 'About Our School' }}
                    </span>
                    <h1 class="mb-3 mb-md-4">{{ $about->title }}</h1>
                    <p class="fs-5 fw-medium text-dark mb-3">{{ $about->description_1 }}</p>
                    <p class="mb-4 text-muted">{{ $about->description_2 }}</p>
                    
                    <!-- Prospectus Highlights Points -->
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-certificate"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">British Council</h6>
                                    <small class="text-muted">Corporate Member</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-book-open"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">Edexcel Curriculum</h6>
                                    <small class="text-muted">International Standard</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">3 Semesters System</h6>
                                    <small class="text-muted">Structured Academic Year</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-users-rectangle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">2 Teachers in Class</h6>
                                    <small class="text-muted">Play Group to Std-IV</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($about->founder_name)
                    <div class="d-flex align-items-center p-3 bg-light rounded-3 border">
                        <img class="rounded-circle flex-shrink-0" src="{{ asset($about->founder_photo ?? 'kider/img/user.jpg') }}" alt="{{ $about->founder_name }}" style="width: 52px; height: 52px; object-fit: cover;">
                        <div class="ms-3">
                            <h6 class="text-primary mb-0 font-weight-bold">{{ $about->founder_name }}</h6>
                            <small class="text-muted">{{ $about->founder_role ?? 'Vigilant International School' }}</small>
                        </div>
                    </div>
                    @endif
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
    <!-- About Section End -->

    <!-- Call To Action Start -->
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
                            <a class="btn btn-secondary py-3 px-4 px-md-5 align-self-start rounded-pill" href="{{ $about->cta_button_url ?? '#' }}">{{ $about->cta_button_text ?? 'Visit First Then Decide' }}<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Call To Action End -->
@endsection
