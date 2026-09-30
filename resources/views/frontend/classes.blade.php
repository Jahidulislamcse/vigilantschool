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
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.1 * (($index % 3) + 1) }}s">
                    <div class="classes-item">
                        <div class="bg-light rounded-circle w-75 mx-auto p-3">
                            <img class="img-fluid rounded-circle" style="height: 180px; width: 100%; object-fit: cover;" src="{{ asset($class->image ?? 'kider/img/classes-1.jpg') }}" alt="{{ $class->title }}">
                        </div>
                        <div class="bg-light rounded p-4 pt-5 mt-n5">
                            <a class="d-block text-center h3 mt-3 mb-4" href="{{ route('appointment') }}">{{ $class->title }}</a>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle flex-shrink-0" src="{{ asset($class->teacher->photo ?? 'kider/img/user.jpg') }}" alt="{{ $class->teacher->name ?? 'Teacher' }}" style="width: 45px; height: 45px; object-fit: cover;">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-1">{{ $class->teacher->name ?? 'Instructor' }}</h6>
                                        <small>{{ $class->teacher->designation ?? 'Teacher' }}</small>
                                    </div>
                                </div>
                                <span class="bg-primary text-white rounded-pill py-2 px-3">{{ $class->fee }}</span>
                            </div>
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="border-top border-3 border-primary pt-2">
                                        <h6 class="text-primary mb-1">Age:</h6>
                                        <small>{{ $class->age_range }}</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-success pt-2">
                                        <h6 class="text-success mb-1">Time:</h6>
                                        <small>{{ $class->time_schedule }}</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-warning pt-2">
                                        <h6 class="text-warning mb-1">Capacity:</h6>
                                        <small>{{ $class->capacity }}</small>
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
