@extends('layouts.admin')

@section('title', 'Classes & Programs')
@section('page-title', 'Academic Classes & Programs')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-graduation-cap text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">School Classes & Programs</h6>
                        <small class="text-muted">Manage academic programs, age groups, timings, fees, and assigned faculty</small>
                    </div>
                </div>
                <a href="{{ route('admin.classes.create') }}" class="btn btn-primary rounded-pill px-3">
                    <i class="fa fa-plus me-1"></i> Add New Program
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70px;">Order</th>
                                <th style="width: 80px;">Image</th>
                                <th>Program Title</th>
                                <th>Assigned Faculty</th>
                                <th>Fee / Cost</th>
                                <th>Age Range</th>
                                <th>Time Schedule</th>
                                <th>Capacity</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 130px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($classes as $class)
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1">#{{ $class->order }}</span>
                                </td>
                                <td>
                                    <img src="{{ asset($class->image ?? 'kider/img/classes-1.jpg') }}" alt="{{ $class->title }}" class="rounded-circle shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $class->title }}</div>
                                    <small class="text-muted">{{ Str::limit($class->description, 45) }}</small>
                                </td>
                                <td>
                                    @if($class->teacher)
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($class->teacher->photo ?? 'kider/img/user.jpg') }}" alt="{{ $class->teacher->name }}" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                                            <div>
                                                <div class="fw-semibold small">{{ $class->teacher->name }}</div>
                                                <small class="text-muted" style="font-size: 0.72rem;">{{ $class->teacher->designation }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <span class="badge bg-secondary-subtle text-muted">Unassigned</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary px-2 py-1">{{ $class->fee }}</span>
                                </td>
                                <td>
                                    <small class="text-dark fw-medium">{{ $class->age_range }}</small>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $class->time_schedule }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-warning-subtle text-dark border">{{ $class->capacity }}</span>
                                </td>
                                <td>
                                    @if($class->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            <i class="fa fa-circle-check me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                            <i class="fa fa-circle-xmark me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.classes.edit', $class->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Program">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this program?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Program">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center py-5 text-muted">
                                    <i class="fa fa-graduation-cap fs-1 text-black-50 d-block mb-3"></i>
                                    <h5>No Classes or Programs Found</h5>
                                    <a href="{{ route('admin.classes.create') }}" class="btn btn-primary rounded-pill px-4">
                                        <i class="fa fa-plus me-1"></i> Create First Class Program
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
