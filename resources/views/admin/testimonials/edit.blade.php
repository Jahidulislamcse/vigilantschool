@extends('layouts.admin')

@section('title', 'Edit Testimonial')
@section('page-title', 'Edit Review: ' . $testimonial->client_name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fa fa-pen-to-square text-primary me-2 fs-5"></i>
                    <h6 class="mb-0 fw-bold">Edit Review: {{ $testimonial->client_name }}</h6>
                </div>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fa fa-arrow-left me-1"></i> Back to Reviews
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Client Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Parent / Guardian Name <span class="text-danger">*</span></label>
                            <input type="text" name="client_name" class="form-control @error('client_name') is-invalid @enderror" value="{{ old('client_name', $testimonial->client_name) }}" required>
                            @error('client_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profession / Relation -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Profession / Relation <span class="text-danger">*</span></label>
                            <input type="text" name="profession" class="form-control @error('profession') is-invalid @enderror" value="{{ old('profession', $testimonial->profession) }}" required>
                            @error('profession')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Rating -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Star Rating (1 - 5) <span class="text-danger">*</span></label>
                            <select name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ 5 Stars</option>
                                <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ 4 Stars</option>
                                <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>⭐⭐⭐ 3 Stars</option>
                                <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>⭐⭐ 2 Stars</option>
                                <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>⭐ 1 Star</option>
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display Order -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Display Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $testimonial->order) }}">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Avatar Photo -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Parent Avatar / Photo</label>
                            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Leave empty to keep current photo.</small>
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($testimonial->avatar)
                            <div class="admin-img-preview-box d-flex align-items-center gap-3 mt-2">
                                <img src="{{ asset($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="admin-preview-thumb circle" style="width: 50px; height: 50px;">
                                <div>
                                    <span class="badge bg-primary-subtle text-primary admin-preview-badge mb-1"><i class="fa fa-user me-1"></i> Current Avatar</span>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Testimonial Content -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Review / Testimonial Quote <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="4" required>{{ old('content', $testimonial->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Active Toggle -->
                        <div class="col-12">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">Publish this Testimonial on the Website</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 pt-3 border-top mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                                <i class="fa fa-save me-1"></i> Update Review
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
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
