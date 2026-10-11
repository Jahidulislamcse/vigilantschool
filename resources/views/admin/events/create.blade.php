@extends('layouts.admin')

@section('title', 'Create School Event & Album')
@section('page-title', 'Create New School Event')

@section('content')
<div class="row">
    <div class="col-12 col-xl-10 mx-auto">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="mb-0 fw-bold">New School Event & Photo Album</h6>
                    <small class="text-muted">Fill out event details and select photo album images to showcase</small>
                </div>
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fa fa-arrow-left me-1"></i> Back to Events
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <!-- Title -->
                        <div class="col-12 col-md-8">
                            <label class="form-label fw-bold">Event Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Annual Sports Day & Athletics Meet 2026" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Date -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold">Event Date</label>
                            <input type="date" name="event_date" class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date', date('Y-m-d')) }}">
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold">Venue / Location</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa fa-location-dot text-danger"></i></span>
                                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" placeholder="e.g. Main Campus Auditorium / Sports Ground">
                            </div>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display Order -->
                        <div class="col-12 col-md-3">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Custom Slug (Optional) -->
                        <div class="col-12 col-md-3">
                            <label class="form-label fw-bold">Custom Slug <small class="text-muted">(Optional)</small></label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="auto-generated if blank">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Short Summary -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Short Summary / Teaser</label>
                            <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" rows="2" placeholder="Brief 1-2 sentence overview shown on event cards...">{{ old('summary') }}</textarea>
                            @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Detailed Description -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Detailed Event Story & Highlights</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Full story, schedule, participant achievements, and memorable moments...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Cover Image -->
                        <div class="col-12 col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <label class="form-label fw-bold d-flex align-items-center">
                                    <i class="fa fa-image text-primary me-2"></i> Event Cover Image <span class="text-danger ms-1">*</span>
                                </label>
                                <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" accept="image/*" required>
                                <small class="text-muted d-block mt-1">Recommended: 1200x800px landscape photo for cover banner (Max: 3MB)</small>
                                @error('cover_image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Album Photos Multi-Upload -->
                        <div class="col-12 col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <label class="form-label fw-bold d-flex align-items-center">
                                    <i class="fa fa-images text-success me-2"></i> Album Photos <small class="text-muted ms-1">(Select Multiple)</small>
                                </label>
                                <input type="file" name="album_images[]" id="albumImagesInput" class="form-control @error('album_images') is-invalid @enderror" multiple accept="image/*">
                                <small class="text-muted d-block mt-1">Select one or more photos to showcase in this event's album</small>
                                @error('album_images')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Multi-image Preview Container -->
                        <div class="col-12" id="albumPreviewSection" style="display: none;">
                            <label class="form-label fw-bold small text-muted">Selected Album Photos Preview:</label>
                            <div class="d-flex flex-wrap gap-2 p-3 bg-white rounded border" id="albumPreviewContainer"></div>
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

    if (input) {
        input.addEventListener('change', function() {
            previewContainer.innerHTML = '';
            if (this.files && this.files.length > 0) {
                previewSection.style.display = 'block';
                Array.from(this.files).forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const thumb = document.createElement('div');
                            thumb.className = 'position-relative border rounded shadow-sm overflow-hidden';
                            thumb.style.width = '90px';
                            thumb.style.height = '70px';
                            thumb.innerHTML = `
                                <img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">
                                <span class="badge bg-dark bg-opacity-75 position-absolute bottom-0 start-0 m-1" style="font-size: 0.6rem;">#${index + 1}</span>
                            `;
                            previewContainer.appendChild(thumb);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                previewSection.style.display = 'none';
            }
        });
    }
});
</script>
@endpush
