@extends('layouts.admin')

@section('title', 'Add School Class')
@section('page-title', 'Create New Class / Program')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fa fa-plus-circle text-primary me-2 fs-5"></i>
                    <h6 class="mb-0 fw-bold">New Class / Academic Program</h6>
                </div>
                <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fa fa-arrow-left me-1"></i> Back to Classes
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.classes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <!-- Program Title -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Program / Class Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Kindergarten (KG)" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Assigned Teacher -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Assigned Teacher / Faculty</label>
                            <select name="teacher_id" class="form-select @error('teacher_id') is-invalid @enderror">
                                <option value="">-- Select Faculty (Optional) --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }} ({{ $teacher->designation }})
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Age Range -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Target Age Range <span class="text-danger">*</span></label>
                            <input type="text" name="age_range" class="form-control @error('age_range') is-invalid @enderror" value="{{ old('age_range') }}" placeholder="e.g. 5 - 6 Years" required>
                            @error('age_range')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Time Schedule -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Time Schedule <span class="text-danger">*</span></label>
                            <input type="text" name="time_schedule" class="form-control @error('time_schedule') is-invalid @enderror" value="{{ old('time_schedule') }}" placeholder="e.g. Morning: 8:00-10:45 | Day: 10:45-1:30" required>
                            @error('time_schedule')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Capacity -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Class Capacity <span class="text-danger">*</span></label>
                            <input type="text" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity', 'Limited Seats') }}" placeholder="e.g. 25 Seats / Limited Seats" required>
                            @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fee / Pricing -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Fee / Tuition Badge <span class="text-danger">*</span></label>
                            <input type="text" name="fee" class="form-control @error('fee') is-invalid @enderror" value="{{ old('fee', 'Affordable') }}" placeholder="e.g. Affordable / Standard / ৳3,500" required>
                            <small class="text-muted">Displayed as the pill badge on the top right of the card</small>
                            @error('fee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display Order -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Display Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 1) }}">
                            <small class="text-muted">Lower number appears first on the website</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Program Photo / Banner <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required onchange="previewImage(this, 'classImagePreview')">
                            <small class="text-muted">Recommended: High quality square or landscape photo (Max 3MB)</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2" id="previewContainer" style="display: none;">
                                <img id="classImagePreview" src="#" alt="Preview" class="rounded-circle shadow-sm border p-1" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Program Description & Syllabus Overview</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Brief synopsis of learning objectives, curriculum focus, and daily activities...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Active Toggle -->
                        <div class="col-12">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">Publish this Class on the Website</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 pt-3 border-top mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.classes.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                                <i class="fa fa-save me-1"></i> Save Class Program
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const container = document.getElementById('previewContainer');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
