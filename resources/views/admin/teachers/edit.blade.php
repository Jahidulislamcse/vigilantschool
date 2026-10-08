@extends('layouts.admin')

@section('title', 'Edit Teacher / Faculty')
@section('page-title', 'Edit Educator: ' . $teacher->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fa fa-pen-to-square text-primary me-2 fs-5"></i>
                    <h6 class="mb-0 fw-bold">Edit Educator: {{ $teacher->name }}</h6>
                </div>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fa fa-arrow-left me-1"></i> Back to Teachers
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Educator Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Educator Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $teacher->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Designation / Role -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Designation / Specialization <span class="text-danger">*</span></label>
                            <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation', $teacher->designation) }}" required>
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display Order -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Display Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $teacher->order) }}">
                            <small class="text-muted">Lower number appears first on the faculty roster</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photo Upload & Existing Preview -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Profile Photo</label>
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*" onchange="previewImage(this, 'teacherPhotoPreview')">
                            <small class="text-muted">Leave empty to keep current photo. Max: 2MB</small>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2 d-flex align-items-center gap-3">
                                <div>
                                    <small class="text-muted d-block mb-1">Current Photo:</small>
                                    <img id="teacherPhotoPreview" src="{{ asset($teacher->photo ?? 'kider/img/team-1.jpg') }}" alt="{{ $teacher->name }}" class="rounded-circle shadow-sm border p-1" style="width: 80px; height: 80px; object-fit: cover;">
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Links -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold"><i class="fab fa-facebook text-primary me-1"></i> Facebook URL</label>
                            <input type="url" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" value="{{ old('facebook_url', $teacher->facebook_url) }}" placeholder="https://facebook.com/...">
                            @error('facebook_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold"><i class="fab fa-twitter text-info me-1"></i> Twitter / X URL</label>
                            <input type="url" name="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" value="{{ old('twitter_url', $teacher->twitter_url) }}" placeholder="https://twitter.com/...">
                            @error('twitter_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold"><i class="fab fa-instagram text-danger me-1"></i> Instagram URL</label>
                            <input type="url" name="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" value="{{ old('instagram_url', $teacher->instagram_url) }}" placeholder="https://instagram.com/...">
                            @error('instagram_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bio / Qualifications -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Bio / Qualifications & Experience</label>
                            <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="3">{{ old('bio', $teacher->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Active Toggle -->
                        <div class="col-12">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $teacher->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">Publish this Educator on the Website</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 pt-3 border-top mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.teachers.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                                <i class="fa fa-save me-1"></i> Update Educator Profile
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
