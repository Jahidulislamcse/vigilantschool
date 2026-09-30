@extends('layouts.admin')

@section('title', 'Add School Facility')
@section('page-title', 'Add New Facility')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-plus-circle text-primary me-2 fs-5"></i>
                    <h6 class="mb-0 fw-bold">Facility Details</h6>
                </div>
                <a href="{{ route('admin.facilities.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="fa fa-arrow-left me-1"></i> Back to Facilities
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.facilities.store') }}" method="POST">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-8">
                            <label class="form-label fw-bold small text-secondary">Facility Title *</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Interactive Classrooms (2 Teachers)" value="{{ old('title') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary">FontAwesome Icon Class *</label>
                            <input type="text" name="icon" class="form-control" placeholder="e.g. fa-chalkboard-user" value="{{ old('icon', 'fa-chalkboard-user') }}" required>
                            <small class="text-muted">e.g. <code>fa-chalkboard-user</code>, <code>fa-flask-vial</code>, <code>fa-shield-halved</code></small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary">Card Color Theme *</label>
                            <select name="color_theme" class="form-select" required>
                                <option value="primary" {{ old('color_theme') == 'primary' ? 'selected' : '' }}>Primary (Royal Blue)</option>
                                <option value="success" {{ old('color_theme') == 'success' ? 'selected' : '' }}>Success (Emerald Green)</option>
                                <option value="warning" {{ old('color_theme') == 'warning' ? 'selected' : '' }}>Warning (Golden Amber)</option>
                                <option value="info" {{ old('color_theme') == 'info' ? 'selected' : '' }}>Info (Sky Blue)</option>
                                <option value="secondary" {{ old('color_theme') == 'secondary' ? 'selected' : '' }}>Secondary (Crimson Red)</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-secondary">Sort Order</label>
                            <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                        </div>

                        <div class="col-md-3 d-flex align-items-center">
                            <div class="form-check form-switch mt-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold small text-secondary" for="is_active">Active</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary">Short Description *</label>
                            <textarea name="short_description" class="form-control" rows="3" placeholder="Describe the facility or feature for parents..." required>{{ old('short_description') }}</textarea>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.facilities.index') }}" class="btn btn-light px-4 rounded-pill">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            <i class="fa fa-save me-1"></i> Save Facility
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
