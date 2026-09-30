@extends('layouts.admin')

@section('title', 'School Facilities')
@section('page-title', 'School Facilities & Infrastructure')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-school-flag text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">School Facilities & Features</h6>
                        <small class="text-muted">Manage the campus infrastructure, classroom amenities, and activity zones</small>
                    </div>
                </div>
                <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary rounded-pill px-3">
                    <i class="fa fa-plus me-1"></i> Add Facility
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">Order</th>
                                <th style="width: 100px;">Icon & Theme</th>
                                <th>Facility Title</th>
                                <th>Description</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 140px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($facilities as $facility)
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1">#{{ $facility->order }}</span>
                                </td>
                                <td>
                                    <div class="p-2 rounded-circle bg-{{ $facility->color_theme }}-subtle text-{{ $facility->color_theme }} d-inline-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="fa {{ $facility->icon }} fs-5"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $facility->title }}</div>
                                    <small class="badge bg-{{ $facility->color_theme }} text-white text-capitalize">{{ $facility->color_theme }} theme</small>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $facility->short_description }}</small>
                                </td>
                                <td>
                                    @if($facility->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            <i class="fa fa-circle-check me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                            <i class="fa fa-circle-xmark me-1"></i> Disabled
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.facilities.edit', $facility->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Facility">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this facility?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Facility">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa fa-school-flag fs-1 text-black-50 d-block mb-3"></i>
                                    <h5>No Facilities Added Yet</h5>
                                    <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary rounded-pill px-4">
                                        <i class="fa fa-plus me-1"></i> Add First Facility
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
