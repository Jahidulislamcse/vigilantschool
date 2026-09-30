@extends('layouts.frontend')

@section('title', 'Contact Us - ' . ($settings['site_title'] ?? 'Kider'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'Contact Us', 'breadcrumb' => 'Contact'])

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Get In Touch With Us</h1>
                <p>Have questions about admissions, syllabus, or fee structure? Reach out to us directly.</p>
            </div>
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                        <i class="fa fa-map-marker-alt fa-2x text-primary"></i>
                    </div>
                    <h6>Campus Address</h6>
                    <p class="text-muted">{{ $settings['contact_address'] ?? '123 Street, New York, USA' }}</p>
                </div>
                <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                        <i class="fa fa-envelope-open fa-2x text-primary"></i>
                    </div>
                    <h6>Admissions Email</h6>
                    <p class="text-muted">{{ $settings['contact_email'] ?? 'info@vigilantschool.com' }}</p>
                </div>
                <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                        <i class="fa fa-phone-alt fa-2x text-primary"></i>
                    </div>
                    <h6>Call Us Directly</h6>
                    <p class="text-muted">{{ $settings['contact_phone'] ?? '+012 345 67890' }}</p>
                </div>
            </div>
            <div class="bg-light rounded">
                <div class="row g-0">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="h-100 d-flex flex-column justify-content-center p-5">
                            <h3 class="mb-4">Send Us A Direct Message</h3>

                            @if(session('success_contact'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-check-circle me-2"></i>{{ session('success_contact') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" name="name" class="form-control border-0" id="name" placeholder="Your Name" value="{{ old('name') }}" required>
                                            <label for="name">Your Name *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control border-0" id="email" placeholder="Your Email" value="{{ old('email') }}" required>
                                            <label for="email">Your Email *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" name="subject" class="form-control border-0" id="subject" placeholder="Subject" value="{{ old('subject') }}">
                                            <label for="subject">Subject</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea name="message" class="form-control border-0" placeholder="Leave a message here" id="message" style="height: 120px" required>{{ old('message') }}</textarea>
                                            <label for="message">Message *</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            @if(isset($settings['google_map_iframe']) && !empty($settings['google_map_iframe']))
                                @if(str_contains($settings['google_map_iframe'], '<iframe'))
                                    {!! $settings['google_map_iframe'] !!}
                                @else
                                    <iframe class="position-relative rounded w-100 h-100"
                                        src="{{ $settings['google_map_iframe'] }}"
                                        frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                                        tabindex="0"></iframe>
                                @endif
                            @else
                                <iframe class="position-relative rounded w-100 h-100"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.617540273612!2d-73.98784492426369!3d40.74844097138761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sbd!4v1680000000000!5m2!1sen!2sbd"
                                    frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                                    tabindex="0"></iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
