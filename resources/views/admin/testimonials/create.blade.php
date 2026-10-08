@extends('layouts.admin')

@section('title', 'Add Parent Review')
@section('page-title', 'Create Testimonial')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fa fa-plus-circle text-primary me-2 fs-5"></i>
                    <h6 class="mb-0 fw-bold">New Parent Testimonial</h6>
                </div>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fa fa-arrow-left me-1"></i> Back to Reviews
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <!-- Client Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Parent / Guardian Name <span class="text-danger">*</span></label>
                            <input type="text" name="client_name" class="form-control @error('client_name') is-invalid @enderror" value="{{ old('client_name') }}" placeholder="e.g. Engr. Rafiqul Islam" required>
                            @error('client_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profession / Relation -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Profession / Relation <span class="text-danger">*</span></label>
                            <input type="text" name="profession" class="form-control @error('profession') is-invalid @enderror" value="{{ old('profession') }}" placeholder="e.g. Parent of Standard-III Student" required>
                            @error('profession')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Rating -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Star Rating (1 - 5) <span class="text-danger">*</span></label>
                            <select name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ 5 Stars</option>
                                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ 4 Stars</option>
                                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ 3 Stars</option>
                                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ 2 Stars</option>
                                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ 1 Star</option>
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display Order -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Display Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 1) }}">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Avatar Photo -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Parent Avatar / Photo</label>
                            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" accept="image/*" onchange="previewImage(this, 'avatarPreview')">
                            <small class="text-muted">Max: 2MB (Optional)</small>
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2" id="previewContainer" style="display: none;">
                                <img id="avatarPreview" src="#" alt="Preview" class="rounded-circle shadow-sm border p-1" style="width: 50px; height: 50px; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Testimonial Content -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Review / Testimonial Quote <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="4" placeholder="Enter the parent's impression and review of the school..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Active Toggle -->
                        <div class="col-12">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">Publish this Testimonial on the Website</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 pt-3 border-top mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                                <i class="fa fa-save me-1"></i> Save Review
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
