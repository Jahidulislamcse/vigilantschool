@extends('layouts.admin')

@section('title', 'Create School Event & Album')
@section('page-title', 'Create New School Event')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 w-100">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="mb-0 fw-bold">New School Event & Photo Album</h6>
                    <small class="text-muted">Upload photo album images to showcase school events and activities</small>
                </div>
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fa fa-arrow-left me-1"></i> Back to Events
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <!-- Title (Optional) -->
                        <div class="col-12 col-md-8">
                            <label class="form-label fw-bold">Event Title <small class="text-muted fw-normal">(Optional)</small></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Annual Sports Day & Athletics Meet (Optional)">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">If left blank, an album identifier will be assigned automatically.</small>
                        </div>

                        <!-- Custom Slug (Optional) -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold">Custom URL Slug <small class="text-muted fw-normal">(Optional)</small></label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="auto-generated if blank">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Album Photos Multi-Upload -->
                        <div class="col-12">
                            <div class="p-4 bg-light rounded-4 border">
                                <label class="form-label fw-bold fs-6 d-flex align-items-center mb-1">
                                    <i class="fa fa-images text-primary me-2"></i> Album Photos <span class="badge bg-primary text-white ms-2 small">Select Multiple</span>
                                </label>
                                <p class="text-muted small mb-3">Choose photos to include in this album. The first photo will also automatically serve as the album's showcase preview.</p>
                                
                                <input type="file" name="album_images[]" id="albumImagesInput" class="form-control @error('album_images') is-invalid @enderror" multiple accept="image/*">
                                <small class="text-muted d-block mt-1">Supports JPG, PNG, WEBP (Max 5MB per photo)</small>
                                @error('album_images')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                <!-- Multi-image Preview Container -->
                                <div class="mt-3 pt-3 border-top" id="albumPreviewSection" style="display: none;">
                                    <label class="form-label fw-bold small text-muted mb-2">Selected Photos Preview (<span id="previewCount">0</span> selected):</label>
                                    <div class="d-flex flex-wrap gap-2 p-2 bg-white rounded-3 border" id="albumPreviewContainer"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Short Summary -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Short Summary / Teaser <small class="text-muted fw-normal">(Optional)</small></label>
                            <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" rows="2" placeholder="Brief 1-2 sentence overview shown on album cards...">{{ old('summary') }}</textarea>
                            @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Detailed Description -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Detailed Description & Story <small class="text-muted fw-normal">(Optional)</small></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Story, participant highlights, and memorable details...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Checkboxes -->
                        <div class="col-12">
                            <div class="d-flex gap-4 pt-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="isActiveCheck" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="isActiveCheck">Published / Active</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_featured" id="isFeaturedCheck" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="isFeaturedCheck">Feature on Homepage</label>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="col-12 pt-3 border-top d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                <i class="fa fa-check me-1"></i> Save Event & Album
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('albumImagesInput');
    const previewSection = document.getElementById('albumPreviewSection');
    const previewContainer = document.getElementById('albumPreviewContainer');
    const previewCount = document.getElementById('previewCount');

    if (input) {
        input.addEventListener('change', function() {
            previewContainer.innerHTML = '';
            if (this.files && this.files.length > 0) {
                previewSection.style.display = 'block';
                if (previewCount) previewCount.textContent = this.files.length;
                Array.from(this.files).forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const thumb = document.createElement('div');
                            thumb.className = 'position-relative border rounded shadow-sm overflow-hidden';
                            thumb.style.width = '95px';
                            thumb.style.height = '75px';
                            thumb.innerHTML = `
                                <img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">
                                <span class="badge ${index === 0 ? 'bg-primary' : 'bg-dark bg-opacity-75'} position-absolute bottom-0 start-0 m-1" style="font-size: 0.6rem;">
                                    ${index === 0 ? '★ Preview' : '#' + (index + 1)}
                                </span>
                            `;
                            previewContainer.appendChild(thumb);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                previewSection.style.display = 'none';
                if (previewCount) previewCount.textContent = '0';
            }
        });
    }
});
</script>
@endpush
