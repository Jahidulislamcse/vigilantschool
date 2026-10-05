@extends('layouts.frontend')

@section('title', 'Parent Testimonials - ' . ($settings['site_title'] ?? 'Kider'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'Testimonials', 'breadcrumb' => 'Testimonial'])

    <!-- Testimonial Start -->
    @if(isset($testimonials) && $testimonials->count() > 0)
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="text-center mx-auto mb-4 mb-md-5" style="max-width: 600px;">
                <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-2 font-weight-bold">Guardian Feedback</span>
                <h1 class="mb-3">What Our Parents Say!</h1>
                <p class="text-muted">Read honest reviews and testimonials from our lovely community of parents and guardians.</p>
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
