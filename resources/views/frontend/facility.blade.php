@extends('layouts.frontend')

@section('title', 'School Facilities & Infrastructure - ' . ($settings['site_title'] ?? 'Vigilant International School'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'School Facilities', 'breadcrumb' => 'Facilities'])

    <!-- Facilities Overview Start -->
    @if(isset($facilities) && $facilities->count() > 0)
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="text-center mx-auto mb-4 mb-md-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 700px;">
                <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-2 font-weight-bold">Infrastructure & Amenities</span>
                <h1 class="mb-3">Our Core Campus Facilities</h1>
                <p class="text-muted">Equipped with interactive classrooms, dual educators, equipped laboratories, 24/7 security, and after-school academic programs.</p>
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
                            <i class="fa {{ $facility->icon ?? 'fa-school' }} text-{{ $theme }}"></i>
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
    <!-- Facilities Overview End -->


    <!-- School Timing & Shift Schedule Section Start -->
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="bg-light rounded-4 p-3 p-md-5 border">
                <div class="text-center mx-auto mb-4 mb-md-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-2 font-weight-bold">Academic Schedule</span>
                    <h2 class="mb-2">School Timing & Shift Schedule</h2>
                    <p class="text-muted small">Sessions: January - December Session &bull; July - June Session</p>
                </div>

                <div class="row g-4 justify-content-center">
                    <!-- Morning Shift Card -->
                    <div class="col-md-6 col-lg-5 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="card h-100 border-0 shadow-sm shift-card">
                            <div class="card-header bg-primary text-white text-center py-3">
                                <h5 class="mb-0 text-white"><i class="fa fa-sun me-2"></i> Morning Shift</h5>
                            </div>
                            <div class="card-body p-3 p-md-4">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
                                        <span class="fw-semibold">Play Group</span>
                                        <span class="badge bg-primary time-badge">08:00 AM - 10:15 AM</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
                                        <span class="fw-semibold">Nursery</span>
                                        <span class="badge bg-primary time-badge">08:00 AM - 10:30 AM</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
                                        <span class="fw-semibold">KG (Kindergarten)</span>
                                        <span class="badge bg-primary time-badge">08:00 AM - 10:45 AM</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Day Shift Card -->
                    <div class="col-md-6 col-lg-5 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="card h-100 border-0 shadow-sm shift-card">
                            <div class="card-header bg-dark text-white text-center py-3">
                                <h5 class="mb-0 text-white"><i class="fa fa-clock me-2"></i> Day Shift & Primary</h5>
                            </div>
                            <div class="card-body p-3 p-md-4">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
                                        <span class="fw-semibold">Play Group</span>
                                        <span class="badge bg-dark time-badge">10:45 AM - 01:00 PM</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
                                        <span class="fw-semibold">Nursery</span>
                                        <span class="badge bg-dark time-badge">10:45 AM - 01:15 PM</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
                                        <span class="fw-semibold">KG (Kindergarten)</span>
                                        <span class="badge bg-dark time-badge">10:45 AM - 01:30 PM</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3 flex-wrap gap-2">
                                        <span class="fw-semibold">Std-I to Std-X</span>
                                        <span class="badge bg-secondary time-badge">08:00 AM - 01:00 PM</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- School Timing & Shift Schedule Section End -->


    <!-- Essential Facilities & Activities List Start -->
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="row g-4 g-lg-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h3 class="mb-3 mb-md-4 text-dark"><i class="fa fa-list-check text-primary me-2"></i> Classroom Activities & Safety</h3>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-users-rectangle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">Two Teachers in Each Classroom</h6>
                                    <p class="text-muted small mb-0">From Play Group to Std-IV, ensuring individual guidance for every student.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-video"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">C.C Cameras with Sound System</h6>
                                    <p class="text-muted small mb-0">Continuous monitoring across all classrooms for utmost child safety.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-bolt-lightning"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">Stand by IPS Power Backup</h6>
                                    <p class="text-muted small mb-0">Uninterrupted electricity during school hours ensuring full classroom comfort.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-book-open-reader"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">Lessons Prepared at School (Junior Sections)</h6>
                                    <p class="text-muted small mb-0">Most all daily lessons are practiced and prepared in class, reducing homework stress.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h3 class="mb-3 mb-md-4 text-dark"><i class="fa fa-trophy text-primary me-2"></i> Co-Curricular & Care Programs</h3>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-graduation-cap"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">After Class Assistance Programme (ACAP)</h6>
                                    <p class="text-muted small mb-0">Special remedial care for students requiring extra academic reinforcement.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">Weekly & Monthly Guardian Meetings</h6>
                                    <p class="text-muted small mb-0">Active dialogue between teachers and parents for student progress tracking.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-palette"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">Co-Curricular Competitions & Events</h6>
                                    <p class="text-muted small mb-0">Debates, handwriting, storytelling, Surah recitation, sports, and science fairs.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checklist-item">
                                <div class="checklist-icon">
                                    <i class="fa fa-hand-holding-dollar"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">No Hidden Expenses</h6>
                                    <p class="text-muted small mb-0">Transparent and fair tuition structure with full accountability.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Essential Facilities & Activities List End -->


    <!-- Call To Action Start -->
    @if(isset($about) && $about && $about->cta_title)
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
