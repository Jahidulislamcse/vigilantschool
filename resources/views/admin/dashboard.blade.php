@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="row g-3 mb-4">
    <!-- Admissions Bookings Stat -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-4 border-primary">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Tour Bookings</span>
                        <h3 class="fw-bold my-1">{{ \App\Models\Appointment::count() }}</h3>
                        @php $pending = \App\Models\Appointment::where('status', 'pending')->count(); @endphp
                        @if($pending > 0)
                            <span class="badge bg-warning text-dark"><i class="fa fa-clock me-1"></i> {{ $pending }} Pending</span>
                        @else
                            <span class="badge bg-success-subtle text-success">Up to date</span>
                        @endif
                    </div>
                    <div class="bg-primary-subtle p-3 rounded-circle text-primary">
                        <i class="fa fa-calendar-check fs-4"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0">
                <a href="{{ route('admin.appointments.index') }}" class="small text-primary fw-semibold text-decoration-none">
                    Review Bookings <i class="fa fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Contact Inquiries Stat -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-4 border-danger">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Inquiries Inbox</span>
                        <h3 class="fw-bold my-1">{{ \App\Models\Contact::count() }}</h3>
                        @php $unread = \App\Models\Contact::where('is_read', false)->count(); @endphp
                        @if($unread > 0)
                            <span class="badge bg-danger"><i class="fa fa-envelope me-1"></i> {{ $unread }} Unread</span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary">All Read</span>
                        @endif
                    </div>
                    <div class="bg-danger-subtle p-3 rounded-circle text-danger">
                        <i class="fa fa-envelope-open-text fs-4"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0">
                <span class="small text-muted">Inbox In Development</span>
            </div>
        </div>
    </div>

    <!-- Academic Classes Stat -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-4 border-success">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Classes & Teachers</span>
                        <h3 class="fw-bold my-1">{{ \App\Models\SchoolClass::count() }} <small class="text-muted fs-6 fw-normal">/ {{ \App\Models\Teacher::count() }} Teachers</small></h3>
                        <span class="badge bg-success-subtle text-success">Active Programs</span>
                    </div>
                    <div class="bg-success-subtle p-3 rounded-circle text-success">
                        <i class="fa fa-graduation-cap fs-4"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0">
                <span class="small text-muted">Manager In Development</span>
            </div>
        </div>
    </div>

    <!-- Facilities & Sliders Stat -->
    <div class="col-sm-6 col-xl-3">
        <div class="card h-100 border-start border-4 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Campus Features</span>
                        <h3 class="fw-bold my-1">{{ \App\Models\Facility::count() }} <small class="text-muted fs-6 fw-normal">/ {{ \App\Models\Slider::count() }} Slides</small></h3>
                        <span class="badge bg-info-subtle text-info">Published</span>
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
</div>

<!-- Quick Action Strip -->
<div class="card mb-4 bg-light border">
    <div class="card-body py-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center">
                <div class="me-3 text-primary"><i class="fa fa-bolt fs-4"></i></div>
                <div>
                    <h6 class="mb-0 fw-bold">Active Management Modules</h6>
                    <small class="text-muted">Direct shortcuts to active school management features</small>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-primary btn-sm rounded-pill">
                    <i class="fa fa-calendar-check me-1"></i> Tour Bookings
                </a>
                <a href="{{ route('admin.facilities.index') }}" class="btn btn-info text-white btn-sm rounded-pill">
                    <i class="fa fa-school-flag me-1"></i> Facilities
                </a>
                <a href="{{ route('admin.about.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                    <i class="fa fa-circle-info me-1"></i> About & Mission
                </a>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                    <i class="fa fa-images me-1"></i> Hero Sliders
                </a>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="fa fa-sliders me-1"></i> School Settings
                </a>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill">
                    <i class="fa fa-arrow-up-right-from-square me-1"></i> View Website
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Admissions & Inquiries Row -->
<div class="row g-4 mb-4">
    <!-- Recent Tour / Admissions Bookings -->
    <div class="col-lg-8">
        <div class="card shadow-sm h-100">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-calendar-check text-primary me-2"></i>
                    <h6 class="mb-0 fw-bold">Recent Campus Tour & Admission Bookings</h6>
                </div>
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">View All ({{ \App\Models\Appointment::count() }})</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Guardian</th>
                                <th>Child</th>
                                <th>Interested Class</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentAppointments = \App\Models\Appointment::with('schoolClass')->latest()->take(5)->get();
                            @endphp
                            @forelse($recentAppointments as $app)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $app->guardian_name }}</div>
                                    <small class="text-muted">{{ $app->guardian_phone ?: $app->guardian_email }}</small>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $app->child_name }}</span>
                                    <small class="text-muted d-block">{{ $app->child_age }}</small>
                                </td>
                                <td>
                                    @if($app->schoolClass)
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                            {{ $app->schoolClass->title }}
                                        </span>
                                    @else
                                        <span class="text-muted small">General</span>
                                    @endif
                                </td>
                                <td>
                                    @if($app->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($app->status == 'contacted')
                                        <span class="badge bg-info text-white">Contacted</span>
                                    @elseif($app->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($app->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.appointments.show', $app->id) }}" class="btn btn-sm btn-light border">
                                        <i class="fa fa-eye text-primary"></i> View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No tour bookings received yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Facilities Mini List -->
    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-school-flag text-info me-2"></i>
                    <h6 class="mb-0 fw-bold">Active Facilities</h6>
                </div>
                <a href="{{ route('admin.facilities.index') }}" class="btn btn-sm btn-outline-info rounded-pill">All</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @php
                        $activeFacilities = \App\Models\Facility::orderBy('order', 'asc')->take(4)->get();
                    @endphp
                    @forelse($activeFacilities as $fac)
                    <div class="list-group-item p-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="p-2 rounded-circle bg-{{ $fac->color_theme }}-subtle text-{{ $fac->color_theme }} me-2 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <i class="fa {{ $fac->icon }} small"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-semibold small">{{ $fac->title }}</h6>
                            </div>
                        </div>
                        <a href="{{ route('admin.facilities.edit', $fac->id) }}" class="btn btn-sm btn-light border">
                            <i class="fa fa-pen-to-square small"></i>
                        </a>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted small">No facilities added yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
