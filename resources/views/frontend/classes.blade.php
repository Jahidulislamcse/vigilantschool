@extends('layouts.frontend')

@section('title', 'Classes & Programs - ' . ($settings['site_title'] ?? 'Kider'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'Classes', 'breadcrumb' => 'Classes'])

    <!-- Classes Start -->
    @if(isset($classes) && $classes->count() > 0)
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">School Classes & Programs</h1>
                <p>Carefully structured learning programs designed to stimulate intellect, creativity, and social empathy.</p>
            </div>
            <div class="row g-4">
                @foreach($classes as $index => $class)
                <div class="col-lg-4 col-md-6 wow fadeInUp d-flex flex-column" data-wow-delay="{{ 0.1 * (($index % 3) + 1) }}s">
                    <div class="classes-item">
                        <div class="classes-img-wrapper">
                            <img class="img-fluid" src="{{ asset($class->image ?? 'kider/img/classes-1.jpg') }}" alt="{{ $class->title }}">
                        </div>
                        <div class="classes-item-body">
                            <a class="classes-title" href="{{ route('appointment') }}">{{ $class->title }}</a>
                            <div class="classes-teacher-box">
                                <div class="teacher-info">
                                    <img class="rounded-circle flex-shrink-0" src="{{ asset($class->teacher->photo ?? 'kider/img/user.jpg') }}" alt="{{ $class->teacher->name ?? 'Faculty' }}" style="width: 40px; height: 40px; object-fit: cover;">
                                    <div class="ms-2 ms-sm-3 text-truncate">
                                        <h6 class="text-primary mb-0 fw-bold">{{ $class->teacher->name ?? 'Lead Faculty' }}</h6>
                                        <small class="text-muted">{{ $class->teacher->designation ?? 'Educator' }}</small>
                                    </div>
                                </div>
                                <span class="bg-primary text-white rounded-pill py-1 px-2 px-sm-3 small fw-bold flex-shrink-0">{{ $class->fee }}</span>
                            </div>
                            <div class="classes-stats">
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="classes-stat-col stat-age">
                                            <h6 class="text-primary">Age:</h6>
                                            <small class="text-muted text-truncate" title="{{ $class->age_range }}">{{ $class->age_range }}</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="classes-stat-col stat-time">
                                            <h6 class="text-success">Time:</h6>
                                            <small class="text-muted text-truncate" title="{{ $class->time_schedule }}">{{ $class->time_schedule }}</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="classes-stat-col stat-capacity">
                                            <h6 class="text-warning">Capacity:</h6>
                                            <small class="text-muted text-truncate" title="{{ $class->capacity }}">{{ $class->capacity }}</small>
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
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded p-5 text-center">
                <h2 class="mb-3">Ready to Enroll Your Child?</h2>
                <p class="mb-4">Schedule a personal school tour or submit an admissions inquiry today.</p>
                <a href="{{ route('appointment') }}" class="btn btn-primary rounded-pill py-3 px-5">Book An Appointment Now</a>
            </div>
        </div>
    </div>

    <!-- Testimonial Start -->
    @if(isset($testimonials) && $testimonials->count() > 0)
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">What Our Parents Say!</h1>
                <p>Real stories and experiences shared by our parents and community.</p>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                @foreach($testimonials as $test)
                <div class="testimonial-item bg-light rounded p-5">
                    <p class="fs-5">{{ $test->content }}</p>
                    <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset($test->avatar ?? 'kider/img/testimonial-1.jpg') }}" style="width: 90px; height: 90px; object-fit: cover;" alt="{{ $test->client_name }}">
                        <div class="ps-3">
                            <h3 class="mb-1">{{ $test->client_name }}</h3>
                            <span>{{ $test->profession }}</span>
                        </div>
                        <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- Testimonial End -->
@endsection
