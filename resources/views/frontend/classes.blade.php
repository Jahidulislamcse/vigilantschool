@extends('layouts.frontend')

@section('title', 'Classes & Programs - ' . ($settings['site_title'] ?? 'Kider'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'Classes', 'breadcrumb' => 'Classes'])

    <!-- Classes Start -->
    @if(isset($classes) && $classes->count() > 0)
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                <h1 class="mb-3">School Classes & Programs</h1>
                <p>Carefully structured learning programs designed to stimulate intellect, creativity, and social empathy.</p>
            </div>
            <div class="row g-4">
                @foreach($classes as $index => $class)
                <div class="col-lg-4 col-md-6 d-flex flex-column">
                    <div class="classes-item">
                        <div class="classes-img-wrapper">
                            <img class="img-fluid" src="{{ asset($class->image ?? 'kider/img/classes-1.jpg') }}" alt="{{ $class->title }}">
                        </div>
                        <div class="classes-item-body">
                            <a class="classes-title" href="{{ route('appointment') }}">{{ $class->title }}</a>
                            <div class="classes-teacher-box">
                                <div class="teacher-info">
                                    <img class="rounded-circle flex-shrink-0" src="{{ asset($class->teacher->photo ?? 'kider/img/user.jpg') }}" alt="{{ $class->teacher->name ?? 'Faculty' }}" style="width: 38px; height: 38px; object-fit: cover;">
                                    <div class="ms-2 text-truncate">
                                        <h6 class="text-primary mb-0 fw-bold">{{ $class->teacher->name ?? 'Lead Faculty' }}</h6>
                                        <small class="text-muted">{{ $class->teacher->designation ?? 'Educator' }}</small>
                                    </div>
                                </div>
                                <a href="{{ route('appointment') }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold flex-shrink-0 shadow-none"><i class="fa fa-calendar-check me-1"></i> Apply</a>
                            </div>
                            <div class="classes-stats">
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="classes-stat-col stat-age">
                                            <h6 class="text-primary">Age:</h6>
                                            <small title="{{ $class->age_range }}">{{ $class->age_range }}</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="classes-stat-col stat-time">
                                            <h6 class="text-success">Time:</h6>
                                            <small title="{{ $class->time_schedule }}">{{ $class->time_schedule }}</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="classes-stat-col stat-capacity">
                                            <h6 class="text-warning">Capacity:</h6>
                                            <small title="{{ $class->capacity }}">{{ $class->capacity }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- Classes End -->

    <!-- Appointment Banner Section -->
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="bg-light rounded-4 p-4 p-md-5 text-center border">
                <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-2 font-weight-bold">Admissions Open</span>
                <h2 class="mb-3">Ready to Enroll Your Child?</h2>
                <p class="mb-4 text-muted">Schedule a personal school tour or submit an admissions inquiry today.</p>
                <a href="{{ route('appointment') }}" class="btn btn-primary rounded-pill py-3 px-4 px-md-5 fw-bold">
                    <i class="fa fa-calendar-check me-2"></i> Book An Appointment Now
                </a>
            </div>
        </div>
    </div>

    <!-- Testimonial Start -->
    @if(isset($testimonials) && $testimonials->count() > 0)
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="text-center mx-auto mb-4 mb-md-5" style="max-width: 600px;">
                <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-2 font-weight-bold">Guardian Feedback</span>
                <h1 class="mb-3">What Our Parents Say!</h1>
                <p class="text-muted">Real stories and experiences shared by our parents and community.</p>
            </div>
            <div class="owl-carousel testimonial-carousel">
                @foreach($testimonials as $test)
                <div class="testimonial-item bg-light rounded-4 p-4 p-md-5 border">
                    <p class="fs-5 text-dark mb-4">"{{ $test->content }}"</p>
                    <div class="d-flex align-items-center bg-white p-2 rounded-pill shadow-sm">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset($test->avatar ?? 'kider/img/testimonial-1.jpg') }}" style="width: 65px; height: 65px; object-fit: cover;" alt="{{ $test->client_name }}">
                        <div class="ps-3">
                            <h5 class="mb-0 fw-bold text-dark">{{ $test->client_name }}</h5>
                            <small class="text-muted">{{ $test->profession }}</small>
                        </div>
                        <i class="fa fa-quote-right fa-2x text-primary ms-auto me-3 d-none d-sm-flex opacity-50"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- Testimonial End -->
@endsection
