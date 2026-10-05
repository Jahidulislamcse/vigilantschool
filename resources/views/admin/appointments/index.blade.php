@extends('layouts.admin')

@section('title', 'Admissions & Campus Appointments')
@section('page-title', 'Admissions & Tour Bookings')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3 bg-white py-3">
                <div class="d-flex align-items-center">
                    <div class="bg-primary-subtle text-primary p-2 rounded-3 me-3">
                        <i class="fa fa-calendar-check fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Campus Tour & Admission Bookings</h6>
                        <small class="text-muted">Review parent appointment requests, child details, and manage tour schedules</small>
                    </div>
                </div>

                <!-- Status Filter Pills -->
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('admin.appointments.index') }}" class="btn {{ empty($status) ? 'btn-primary' : 'btn-outline-secondary' }}">
                        All ({{ \App\Models\Appointment::count() }})
                    </a>
                    <a href="{{ route('admin.appointments.index', ['status' => 'pending']) }}" class="btn {{ $status == 'pending' ? 'btn-warning text-dark' : 'btn-outline-secondary' }}">
                        Pending ({{ \App\Models\Appointment::where('status', 'pending')->count() }})
                    </a>
                    <a href="{{ route('admin.appointments.index', ['status' => 'contacted']) }}" class="btn {{ $status == 'contacted' ? 'btn-info text-white' : 'btn-outline-secondary' }}">
                        Contacted ({{ \App\Models\Appointment::where('status', 'contacted')->count() }})
                    </a>
                    <a href="{{ route('admin.appointments.index', ['status' => 'approved']) }}" class="btn {{ $status == 'approved' ? 'btn-success' : 'btn-outline-secondary' }}">
                        Approved ({{ \App\Models\Appointment::where('status', 'approved')->count() }})
                    </a>
                    <a href="{{ route('admin.appointments.index', ['status' => 'cancelled']) }}" class="btn {{ $status == 'cancelled' ? 'btn-danger' : 'btn-outline-secondary' }}">
                        Cancelled ({{ \App\Models\Appointment::where('status', 'cancelled')->count() }})
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70px;">#ID</th>
                                <th>Guardian / Contact</th>
                                <th>Child Name & Age</th>
                                <th>Requested Program</th>
                                <th>Date & Message</th>
                                <th style="width: 130px;">Status</th>
                                <th style="width: 160px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appointment)
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border">#{{ $appointment->id }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $appointment->guardian_name }}</div>
                                    <div class="small text-muted">
                                        <i class="fa fa-envelope me-1 text-primary"></i>
                                        <a href="mailto:{{ $appointment->guardian_email }}" class="text-decoration-none text-muted">{{ $appointment->guardian_email }}</a>
                                    </div>
                                    @if($appointment->guardian_phone)
                                    <div class="small text-muted">
                                        <i class="fa fa-phone me-1 text-success"></i>
                                        <a href="tel:{{ $appointment->guardian_phone }}" class="text-decoration-none text-dark fw-medium">{{ $appointment->guardian_phone }}</a>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $appointment->child_name }}</div>
                                    <small class="badge bg-info-subtle text-info border border-info-subtle">{{ $appointment->child_age }}</small>
                                </td>
                                <td>
                                    @if($appointment->schoolClass)
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                            <i class="fa fa-graduation-cap me-1"></i> {{ $appointment->schoolClass->title }}
                                        </span>
                                    @else
                                        <span class="text-muted small">General Inquiry</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted d-block"><i class="fa fa-clock me-1"></i> {{ $appointment->created_at->format('M d, Y h:i A') }}</small>
                                    @if($appointment->message)
                                        <small class="text-secondary text-truncate d-block" style="max-width: 250px;" title="{{ $appointment->message }}">
                                            "{{ $appointment->message }}"
                                        </small>
                                    @endif
                                    @if($appointment->admin_notes)
                                        <small class="text-info d-block mt-1">
                                            <i class="fa fa-note-sticky me-1"></i> Note: {{ $appointment->admin_notes }}
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    @if($appointment->status == 'pending')
                                        <span class="badge bg-warning text-dark px-2 py-1"><i class="fa fa-hourglass-half me-1"></i> Pending</span>
                                    @elseif($appointment->status == 'contacted')
                                        <span class="badge bg-info text-white px-2 py-1"><i class="fa fa-phone me-1"></i> Contacted</span>
                                    @elseif($appointment->status == 'approved')
                                        <span class="badge bg-success px-2 py-1"><i class="fa fa-circle-check me-1"></i> Approved</span>
                                    @elseif($appointment->status == 'cancelled')
                                        <span class="badge bg-danger px-2 py-1"><i class="fa fa-circle-xmark me-1"></i> Cancelled</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('admin.appointments.show', $appointment->id) }}" class="btn btn-sm btn-outline-primary" title="View Full Booking Details">
                                            <i class="fa fa-eye"></i> View
                                        </a>

                                        <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Appointment">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa fa-calendar-xmark fs-1 text-muted opacity-50 mb-3 d-block"></i>
                                    <h6>No appointment bookings found.</h6>
                                    <p class="small text-muted mb-0">When parents book campus tours from the website, their details will appear here.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($appointments->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $appointments->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
