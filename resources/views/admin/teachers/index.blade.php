@extends('layouts.admin')

@section('title', 'Teachers & Faculty')
@section('page-title', 'Educators & Academic Faculty')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-chalkboard-user text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Teachers & Faculty Roster</h6>
                        <small class="text-muted">Manage educators, head instructors, designations, and social media links</small>
                    </div>
                </div>
                <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary rounded-pill px-3">
                    <i class="fa fa-plus me-1"></i> Add Educator
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70px;">Order</th>
                                <th style="width: 80px;">Photo</th>
                                <th>Educator Name</th>
                                <th>Designation / Role</th>
                                <th>Assigned Classes</th>
                                <th>Social Profiles</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 130px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $teacher)
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1">#{{ $teacher->order }}</span>
                                </td>
                                <td>
                                    <img src="{{ asset($teacher->photo ?? 'kider/img/team-1.jpg') }}" alt="{{ $teacher->name }}" class="rounded-circle shadow-sm border p-1" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $teacher->name }}</div>
                                    <small class="text-muted">{{ Str::limit($teacher->bio, 40) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                        {{ $teacher->classes->count() }} Class(es)
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        @if($teacher->facebook_url)
                                            <a href="{{ $teacher->facebook_url }}" target="_blank" class="btn btn-sm btn-outline-primary p-1 rounded-circle" style="width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;" title="Facebook">
                                                <i class="fab fa-facebook-f fa-xs"></i>
                                            </a>
                                        @endif
                                        @if($teacher->twitter_url)
                                            <a href="{{ $teacher->twitter_url }}" target="_blank" class="btn btn-sm btn-outline-info p-1 rounded-circle" style="width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;" title="Twitter">
                                                <i class="fab fa-twitter fa-xs"></i>
                                            </a>
                                        @endif
                                        @if($teacher->instagram_url)
                                            <a href="{{ $teacher->instagram_url }}" target="_blank" class="btn btn-sm btn-outline-danger p-1 rounded-circle" style="width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;" title="Instagram">
                                                <i class="fab fa-instagram fa-xs"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($teacher->is_active)
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
                                        <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Teacher">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this teacher profile?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Teacher">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fa fa-chalkboard-user fs-1 text-black-50 d-block mb-3"></i>
                                    <h5>No Teachers or Faculty Profiles Found</h5>
                                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary rounded-pill px-4">
                                        <i class="fa fa-plus me-1"></i> Add First Educator Profile
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
