@extends('layouts.admin')

@section('title', 'Edit School Event & Album')
@section('page-title', 'Edit School Event')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 mb-4 w-100">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="mb-0 fw-bold">Edit Event: {{ $event->display_title }}</h6>
                    <small class="text-muted">Update event information and add photos to this album</small>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('events.show', $event->slug) }}" target="_blank" class="btn btn-outline-info btn-sm rounded-pill px-3">
                        <i class="fa fa-eye me-1"></i> View Public Album
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="fa fa-arrow-left me-1"></i> Back to Events
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <!-- Title (Optional) -->
                        <div class="col-12 col-md-8">
                            <label class="form-label fw-bold">Event Title <small class="text-muted fw-normal">(Optional)</small></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $event->title) }}" placeholder="e.g. Annual Sports Day (Optional)">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Slug (Optional) -->
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold">Custom URL Slug <small class="text-muted fw-normal">(Optional)</small></label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $event->slug) }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Add More Album Photos -->
                        <div class="col-12">
                            <div class="p-4 bg-light rounded-4 border">
                                <label class="form-label fw-bold fs-6 d-flex align-items-center mb-1">
                                    <i class="fa fa-cloud-arrow-up text-success me-2"></i> Add More Album Photos
                                </label>
                                <p class="text-muted small mb-3">Upload additional photos to this album. You can manage and delete existing photos below.</p>
                                
                                <input type="file" name="album_images[]" id="albumImagesInput" class="form-control @error('album_images') is-invalid @enderror" multiple accept="image/*">
                                <small class="text-muted d-block mt-1">Supports JPG, PNG, WEBP (Max 5MB per photo)</small>
                                @error('album_images')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                <!-- New Selected Photos Preview -->
                                <div class="mt-3 pt-3 border-top" id="albumPreviewSection" style="display: none;">
                                    <label class="form-label fw-bold small text-muted mb-2">Newly Selected Photos (<span id="previewCount">0</span> selected):</label>
                                    <div class="d-flex flex-wrap gap-2 p-2 bg-white rounded-3 border" id="albumPreviewContainer"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Short Summary -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Short Summary / Teaser <small class="text-muted fw-normal">(Optional)</small></label>
                            <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" rows="2">{{ old('summary', $event->summary) }}</textarea>
                            @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Detailed Description -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Detailed Description & Story <small class="text-muted fw-normal">(Optional)</small></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Checkboxes -->
                        <div class="col-12">
                            <div class="d-flex gap-4 pt-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="isActiveCheck" value="1" {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="isActiveCheck">Published / Active</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_featured" id="isFeaturedCheck" value="1" {{ old('is_featured', $event->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="isFeaturedCheck">Feature on Homepage</label>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="col-12 pt-3 border-top d-flex align-items-center justify-content-end gap-2">
                            <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                <i class="fa fa-check me-1"></i> Update Event & Album
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Existing Album Photos Gallery Management -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="mb-0 fw-bold">Current Album Photos ({{ $event->images->count() }})</h6>
                    <small class="text-muted">Click the trash icon on any photo to remove it from the album</small>
                </div>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2">
                    <i class="fa fa-images me-1"></i> Album Gallery
                </span>
            </div>
            <div class="card-body p-4">
                @if($event->images->count() > 0)
                <div class="row g-3" id="existingAlbumGrid">
                    @foreach($event->images as $index => $img)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2" id="photo-card-{{ $img->id }}">
                        <div class="card h-100 border shadow-sm position-relative overflow-hidden group-photo-card">
                            <img src="{{ asset($img->image) }}" alt="Album Photo" style="height: 110px; object-fit: cover;" class="card-img-top">
                            <div class="p-2 bg-light d-flex align-items-center justify-content-between">
                                <span class="badge {{ $index === 0 ? 'bg-primary' : 'bg-secondary' }}" style="font-size: 0.65rem;">
                                    {{ $index === 0 ? 'Preview' : '#' . ($index + 1) }}
                                </span>
                                <button type="button" 
                                        class="btn btn-sm btn-outline-danger p-0 d-inline-flex align-items-center justify-content-center" 
                                        style="width: 24px; height: 24px; border-radius: 50%;" 
                                        title="Delete photo from album"
                                        onclick="deleteAlbumPhoto({{ $img->id }})">
                                    <i class="fa fa-trash fa-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4 text-muted">
                    <i class="fa fa-images fs-2 text-black-50 mb-2 d-block"></i>
                    <p class="mb-0">No photos in this album yet. Upload photos using the form above.</p>
                </div>
                @endif
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
                                <span class="badge bg-success position-absolute bottom-0 start-0 m-1" style="font-size: 0.6rem;">+ New #${index + 1}</span>
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

    // Delete single photo from album via AJAX
    window.deleteAlbumPhoto = function(photoId) {
        if (!confirm('Are you sure you want to remove this photo from the album?')) return;

        const url = "{{ url('admin/events/images') }}/" + photoId;

        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            const card = document.getElementById('photo-card-' + photoId);
            if (card) {
                card.style.transition = 'all 0.3s ease';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.8)';
                setTimeout(() => card.remove(), 300);
            }
        })
        .catch(err => {
            console.error('Delete error:', err);
            alert('Failed to delete photo. Please try again.');
        });
    };
});
</script>
@endpush
