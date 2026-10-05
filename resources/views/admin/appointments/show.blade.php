@extends('layouts.admin')

@section('title', 'Appointment Details #' . $appointment->id)
@section('page-title', 'Admission Appointment #' . $appointment->id)

@section('content')
<div class="row g-4">
    <!-- Left Column: Details -->
    <div class="col-lg-7">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-id-card text-primary me-2 fs-5"></i>
                    <h6 class="mb-0 fw-bold">Guardian & Child Information</h6>
                </div>
                <span class="badge bg-light text-dark border">Submitted: {{ $appointment->created_at->format('M d, Y • h:i A') }}</span>
            </div>
            <div class="card-body p-4">
                <div class="row g-4 mb-4">
                    <div class="col-sm-6">
                        <label class="text-muted small text-uppercase fw-semibold d-block">Guardian Full Name</label>
                        <h5 class="fw-bold text-dark mb-0">{{ $appointment->guardian_name }}</h5>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small text-uppercase fw-semibold d-block">Contact Phone</label>
                        @if($appointment->guardian_phone)
                            <a href="tel:{{ $appointment->guardian_phone }}" class="btn btn-outline-success btn-sm rounded-pill mt-1">
                                <i class="fa fa-phone me-1"></i> {{ $appointment->guardian_phone }}
                            </a>
                        @else
                            <span class="text-muted">Not provided</span>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small text-uppercase fw-semibold d-block">Guardian Email</label>
                        <a href="mailto:{{ $appointment->guardian_email }}" class="text-decoration-none text-primary fw-medium">
                            <i class="fa fa-envelope me-1"></i> {{ $appointment->guardian_email }}
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-muted small text-uppercase fw-semibold d-block">Current Status</label>
                        @if($appointment->status == 'pending')
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mt-1"><i class="fa fa-hourglass-half me-1"></i> Pending Review</span>
                        @elseif($appointment->status == 'contacted')
                            <span class="badge bg-info text-white px-3 py-2 rounded-pill mt-1"><i class="fa fa-phone me-1"></i> Guardian Contacted</span>
                        @elseif($appointment->status == 'approved')
                            <span class="badge bg-success px-3 py-2 rounded-pill mt-1"><i class="fa fa-circle-check me-1"></i> Tour Approved / Confirmed</span>
                        @elseif($appointment->status == 'cancelled')
                            <span class="badge bg-danger px-3 py-2 rounded-pill mt-1"><i class="fa fa-circle-xmark me-1"></i> Cancelled</span>
                        @endif
                    </div>
                </div>

                <hr class="text-muted opacity-25 my-4">

                <!-- Child Details -->
                <div class="bg-light p-3 rounded-3 mb-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa fa-child me-2 text-primary"></i> Child Academic Profile</h6>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Child Name</span>
                            <span class="fw-bold text-dark">{{ $appointment->child_name }}</span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Age</span>
                            <span class="fw-bold text-dark">{{ $appointment->child_age }}</span>
                        </div>
                        <div class="col-12">
                            <span class="text-muted small d-block">Interested Class / Program</span>
                            @if($appointment->schoolClass)
                                <span class="badge bg-primary text-white px-3 py-2 rounded-pill mt-1">
                                    <i class="fa fa-graduation-cap me-1"></i> {{ $appointment->schoolClass->title }} ({{ $appointment->schoolClass->age_range }})
                                </span>
                            @else
                                <span class="badge bg-secondary text-white px-3 py-2 rounded-pill mt-1">General Admission Inquiry</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Message Note -->
                <div>
                    <label class="text-muted small text-uppercase fw-semibold d-block mb-1">Guardian's Note / Message</label>
                    <div class="p-3 bg-white border rounded-3 text-secondary">
                        {{ $appointment->message ?: 'No additional message provided.' }}
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-0 py-3 d-flex justify-content-between">
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fa fa-arrow-left me-1"></i> Back to List
                </a>

                <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Delete this appointment record permanently?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger rounded-pill px-3">
                        <i class="fa fa-trash me-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Status Update & Admin Notes -->
    <div class="col-lg-5">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-pen-to-square text-success me-2 fs-5"></i>
                    <h6 class="mb-0 fw-bold">Manage Booking Status & Notes</h6>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.appointments.status', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="status" class="form-label fw-bold small text-secondary">Update Booking Status *</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>⏳ Pending Review</option>
                            <option value="contacted" {{ $appointment->status == 'contacted' ? 'selected' : '' }}>📞 Contacted Guardian</option>
                            <option value="approved" {{ $appointment->status == 'approved' ? 'selected' : '' }}>✅ Approved / Confirmed Tour</option>
                            <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="admin_notes" class="form-label fw-bold small text-secondary">Internal Administration Notes</label>
                        <textarea name="admin_notes" id="admin_notes" class="form-control" rows="5" placeholder="e.g. Scheduled walkthrough for Monday at 10:30 AM with Principal.">{{ old('admin_notes', $appointment->admin_notes) }}</textarea>
                        <small class="text-muted">These notes are visible to the school administration team only.</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill py-2">
                            <i class="fa fa-floppy-disk me-2"></i> Update Appointment Status
                        </button>
                    </div>
                </form>

                <hr class="my-4 text-muted opacity-25">

                <!-- Quick Direct Actions -->
                <h6 class="fw-bold small text-uppercase text-muted mb-3">Quick Actions</h6>
                <div class="d-grid gap-2">
                    @if($appointment->guardian_phone)
                    <a href="tel:{{ $appointment->guardian_phone }}" class="btn btn-outline-success btn-sm rounded-pill text-start px-3 py-2">
                        <i class="fa fa-phone me-2"></i> Call Guardian ({{ $appointment->guardian_phone }})
                    </a>
                    @endif
                    <a href="mailto:{{ $appointment->guardian_email }}?subject=Vigilant%20School%20Campus%20Tour%20Schedule&body=Dear%20{{ urlencode($appointment->guardian_name) }},%0D%0A%0D%0AThank%20you%20for%20your%20interest%20in%20Vigilant%20International%20School.%20We%20would%20like%20to%20invite%20you%20and%20{{ urlencode($appointment->child_name) }}%20for%20a%20campus%20walkthrough." class="btn btn-outline-primary btn-sm rounded-pill text-start px-3 py-2">
                        <i class="fa fa-envelope me-2"></i> Send Confirmation Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
