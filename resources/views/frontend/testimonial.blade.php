@extends('layouts.frontend')

@section('title', 'Parent Testimonials - ' . ($settings['site_title'] ?? 'Kider'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'Testimonials', 'breadcrumb' => 'Testimonial'])

    <!-- Testimonial Start -->
    @if(isset($testimonials) && $testimonials->count() > 0)
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">What Our Parents Say!</h1>
                <p>Read honest reviews and testimonials from our lovely community of parents and guardians.</p>
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
