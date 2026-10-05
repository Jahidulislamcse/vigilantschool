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
            <div class="row g-2 g-md-3 g-lg-4">
                @php
                    $colors = ['primary', 'success', 'warning', 'info'];
                    $delay = 0.1;
                @endphp
                @foreach($facilities as $index => $facility)
                @php
                    $theme = $facility->color_theme ?: $colors[$index % 4];
                @endphp
                <div class="col-6 col-lg-3 wow fadeInUp" data-wow-delay="{{ $delay }}s">
                    <div class="facility-item facility-card-{{ $theme }}" role="button" tabindex="0" data-bs-toggle="modal" data-bs-target="#facilityModal{{ $facility->id }}" aria-haspopup="dialog" title="Click to view details">
                        <span class="facility-tap-badge"><i class="fa fa-arrow-up-right-from-square"></i></span>
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
    @include('frontend.partials.facility-modals')
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


    <!-- Classes & Academic Programs Start -->
    @if(isset($classes) && $classes->count() > 0)
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="text-center mx-auto mb-4 mb-md-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 650px;">
                <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-2 font-weight-bold">Academic Programs</span>
                <h1 class="mb-3">School Classes & Programs</h1>
                <p class="text-muted">Structured curriculum from Play Group to S.S.C & O Level with individual teacher attention and interactive learning environments.</p>
            </div>
            <div class="row g-4">
                @foreach($classes as $index => $class)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.1 * (($index % 3) + 1) }}s">
                    <div class="classes-item">
                        <div class="bg-light rounded-circle w-75 mx-auto p-3">
                            <img class="img-fluid rounded-circle" style="height: 180px; width: 100%; object-fit: cover;" src="{{ asset($class->image ?? 'kider/img/classes-1.jpg') }}" alt="{{ $class->title }}">
                        </div>
                        <div class="bg-light rounded p-4 pt-5 mt-n5">
                            <a class="d-block text-center h4 mt-3 mb-3 text-dark fw-bold text-decoration-none" href="{{ route('appointment') }}">{{ $class->title }}</a>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle flex-shrink-0" src="{{ asset($class->teacher->photo ?? 'kider/img/user.jpg') }}" alt="{{ $class->teacher->name ?? 'Faculty' }}" style="width: 44px; height: 44px; object-fit: cover;">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-0 fw-bold">{{ $class->teacher->name ?? 'Lead Faculty' }}</h6>
                                        <small class="text-muted">{{ $class->teacher->designation ?? 'Educator' }}</small>
                                    </div>
                                </div>
                                <span class="bg-primary text-white rounded-pill py-1 px-3 small fw-bold">{{ $class->fee }}</span>
                            </div>
                            <div class="row g-1">
                                <div class="col-4">
                                    <div class="border-top border-3 border-primary pt-2">
                                        <h6 class="text-primary mb-0 small fw-bold">Age:</h6>
                                        <small class="text-muted">{{ $class->age_range }}</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-success pt-2">
                                        <h6 class="text-success mb-0 small fw-bold">Time:</h6>
                                        <small class="text-muted text-truncate d-block" title="{{ $class->time_schedule }}">{{ $class->time_schedule }}</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-top border-3 border-warning pt-2">
                                        <h6 class="text-warning mb-0 small fw-bold">Capacity:</h6>
                                        <small class="text-muted">{{ $class->capacity }}</small>
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
    <!-- Classes & Academic Programs End -->


    <!-- Campus Tour & Admission Appointment Start -->
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="bg-light rounded-4 overflow-hidden border">
                <div class="row g-0">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="h-100 d-flex flex-column justify-content-center p-4 p-md-5">
                            <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-3 align-self-start font-weight-bold">
                                Admissions Open
                            </span>
                            <h1 class="mb-3">Book A School Tour & Appointment</h1>
                            <p class="mb-4 text-muted">Visit first then decide! Complete the short form below and our admissions team will contact you to confirm your scheduled campus tour.</p>
                            
                            @if(session('success_appointment'))
                                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                                    <i class="fa fa-circle-check me-2"></i>{{ session('success_appointment') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(isset($errors) && $errors->any())
                                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('appointment.submit') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" name="guardian_name" class="form-control bg-white border" id="home_gname" placeholder="Guardian Name" value="{{ old('guardian_name') }}" required>
                                            <label for="home_gname">Guardian Name *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="email" name="guardian_email" class="form-control bg-white border" id="home_gmail" placeholder="Guardian Email" value="{{ old('guardian_email') }}" required>
                                            <label for="home_gmail">Guardian Email *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" name="guardian_phone" class="form-control bg-white border" id="home_gphone" placeholder="Phone Number" value="{{ old('guardian_phone') }}" required>
                                            <label for="home_gphone">Phone Number *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" name="child_name" class="form-control bg-white border" id="home_cname" placeholder="Child Name" value="{{ old('child_name') }}" required>
                                            <label for="home_cname">Child Name *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" name="child_age" class="form-control bg-white border" id="home_cage" placeholder="Child Age" value="{{ old('child_age') }}" required>
                                            <label for="home_cage">Child Age *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <select name="class_id" class="form-select bg-white border" id="home_class_select">
                                                <option value="">Select Interested Class</option>
                                                @if(isset($classes))
                                                    @foreach($classes as $c)
                                                        <option value="{{ $c->id }}" {{ old('class_id') == $c->id ? 'selected' : '' }}>{{ $c->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <label for="home_class_select">Interested Class</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea name="message" class="form-control bg-white border" placeholder="Special requirements or message" id="home_message" style="height: 90px">{{ old('message') }}</textarea>
                                            <label for="home_message">Questions or Notes</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold" type="submit">
                                            <i class="fa fa-calendar-check me-2"></i> Submit Appointment Request
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s" style="min-height: 350px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100" src="{{ asset('kider/img/appointment.jpg') }}" style="object-fit: cover;" alt="Campus Appointment">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Campus Tour & Admission Appointment End -->


    <!-- Qualified Teachers & Faculty Start -->
    @if(isset($teachers) && $teachers->count() > 0)
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="text-center mx-auto mb-4 mb-md-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-2 font-weight-bold">Academic Faculty</span>
                <h1 class="mb-3">Our Dedicated Teachers</h1>
                <p class="text-muted">Passionate educators providing personalized mentoring, moral coaching, and academic excellence.</p>
            </div>
            <div class="row g-4">
                @foreach($teachers as $index => $teacher)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.1 * (($index % 3) + 1) }}s">
                    <div class="team-item position-relative text-center">
                        <img class="img-fluid rounded-circle w-75 p-2 bg-light shadow-sm" style="height: 240px; width: 240px !important; object-fit: cover;" src="{{ asset($teacher->photo ?? 'kider/img/team-1.jpg') }}" alt="{{ $teacher->name }}">
                        <div class="team-text">
                            <h3>{{ $teacher->name }}</h3>
                            <p class="text-muted">{{ $teacher->designation }}</p>
                            <div class="d-flex align-items-center justify-content-center">
                                @if($teacher->facebook_url)
                                    <a class="btn btn-square btn-primary mx-1 rounded-circle" href="{{ $teacher->facebook_url }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($teacher->twitter_url)
                                    <a class="btn btn-square btn-primary mx-1 rounded-circle" href="{{ $teacher->twitter_url }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($teacher->instagram_url)
                                    <a class="btn btn-square btn-primary mx-1 rounded-circle" href="{{ $teacher->instagram_url }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- Qualified Teachers & Faculty End -->


    <!-- Testimonials / Parent Reviews Start -->
    @if(isset($testimonials) && $testimonials->count() > 0)
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="text-center mx-auto mb-4 mb-md-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-2 font-weight-bold">Guardian Feedback</span>
                <h1 class="mb-3">What Our Parents Say!</h1>
                <p class="text-muted">Honest impressions and reviews from our active school community and parents.</p>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
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
    <!-- Testimonials / Parent Reviews End -->

@endsection
