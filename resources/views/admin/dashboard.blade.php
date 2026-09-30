@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="row g-4 mb-4">
    <!-- Active Sliders Stat -->
    <div class="col-md-4">
        <div class="card h-100 border-start border-4 border-primary">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Hero Sliders</span>
                        <h3 class="fw-bold my-1">{{ \App\Models\Slider::count() }}</h3>
                        <span class="badge bg-primary-subtle text-primary">Published</span>
                    </div>
                    <div class="bg-primary-subtle p-3 rounded-circle text-primary">
                        <i class="fa fa-images fs-4"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0">
                <a href="{{ route('admin.sliders.index') }}" class="small text-primary fw-semibold text-decoration-none">
                    Manage Sliders <i class="fa fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Active Facilities Stat -->
    <div class="col-md-4">
        <div class="card h-100 border-start border-4 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">School Facilities</span>
                        <h3 class="fw-bold my-1">{{ \App\Models\Facility::count() }}</h3>
                        <span class="badge bg-info-subtle text-info">Active</span>
                    </div>
                    <div class="bg-info-subtle p-3 rounded-circle text-info">
                        <i class="fa fa-school-flag fs-4"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0">
                <a href="{{ route('admin.facilities.index') }}" class="small text-info fw-semibold text-decoration-none">
                    Manage Facilities <i class="fa fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Active Settings Stat -->
    <div class="col-md-4">
        <div class="card h-100 border-start border-4 border-success">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">School Profile</span>
                        <h4 class="fw-bold my-1 text-truncate" style="max-width: 220px;">{{ $settings['site_title'] ?? 'Vigilant' }}</h4>
                        <span class="badge bg-success-subtle text-success">Configured</span>
                    </div>
                    <div class="bg-success-subtle p-3 rounded-circle text-success">
                        <i class="fa fa-sliders fs-4"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0">
                <a href="{{ route('admin.settings.index') }}" class="small text-success fw-semibold text-decoration-none">
                    Edit Settings <i class="fa fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Action Strip -->
<div class="card mb-4 bg-light border">
    <div class="card-body py-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center">
                <div class="me-3 text-primary"><i class="fa fa-bolt fs-4"></i></div>
                <div>
                    <h6 class="mb-0 fw-bold">Quick Management Actions</h6>
                    <small class="text-muted">Shortcuts for updating facilities, mission narrative, and hero banners</small>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.facilities.create') }}" class="btn btn-info text-white btn-sm rounded-pill">
                    <i class="fa fa-plus me-1"></i> Add Facility
                </a>
                <a href="{{ route('admin.about.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                    <i class="fa fa-circle-info me-1"></i> Edit About & Mission
                </a>
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm rounded-pill">
                    <i class="fa fa-plus me-1"></i> Add Hero Slide
                </a>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="fa fa-sliders me-1"></i> School Profile
                </a>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill">
                    <i class="fa fa-arrow-up-right-from-square me-1"></i> View Website
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Facilities & Hero Sliders Row -->
<div class="row g-4">
    <!-- Active Facilities Overview -->
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fa fa-school-flag text-info me-2"></i>
                    <h6 class="mb-0 fw-bold">Active School Facilities</h6>
                </div>
                <a href="{{ route('admin.facilities.index') }}" class="btn btn-sm btn-outline-info rounded-pill">Manage All</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @php
                        $activeFacilities = \App\Models\Facility::orderBy('order', 'asc')->get();
                    @endphp
                    @forelse($activeFacilities as $fac)
                    <div class="list-group-item p-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="p-2 rounded-circle bg-{{ $fac->color_theme }}-subtle text-{{ $fac->color_theme }} me-3 d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fa {{ $fac->icon }}"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $fac->title }}</h6>
                                <small class="text-muted text-truncate d-block" style="max-width: 320px;">{{ $fac->short_description }}</small>
                            </div>
                        </div>
                        <a href="{{ route('admin.facilities.edit', $fac->id) }}" class="btn btn-sm btn-light border">
                            <i class="fa fa-pen-to-square"></i>
                        </a>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">No facilities added yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Active Sliders Overview -->
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fa fa-images text-primary me-2"></i>
                    <h6 class="mb-0 fw-bold">Active Homepage Sliders</h6>
                </div>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Manage All</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @php
                        $activeSliders = \App\Models\Slider::orderBy('order', 'asc')->get();
                    @endphp
                    @forelse($activeSliders as $slider)
                    <div class="list-group-item p-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}" class="rounded me-3 shadow-sm" style="width: 70px; height: 45px; object-fit: cover;">
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $slider->title }}</h6>
                                <small class="text-muted">{{ $slider->subtitle ?: 'Banner Slide' }}</small>
                            </div>
                        </div>
                        <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-light border">
                            <i class="fa fa-pen-to-square"></i>
                        </a>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">No sliders configured yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
