@extends('layouts.admin')

@section('title', 'Photo Gallery')
@section('page-title', 'Campus Gallery & Media')

@section('content')
<div class="row g-4">
    <!-- Upload Form -->
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="fa fa-cloud-arrow-up text-primary me-2"></i>Upload Photo</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Photo Title / Caption</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Science Lab Experiment">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category / Event Tag</label>
                        <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', 'Campus Life') }}" placeholder="e.g. Sports, Classroom, Annual Day">
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Display Order</label>
                        <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 1) }}">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Image File <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                        <small class="text-muted">High resolution JPG/PNG (Max 3MB)</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">
                        <i class="fa fa-upload me-1"></i> Upload to Gallery
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <h6 class="mb-0 fw-bold"><i class="fa fa-photo-film text-primary me-2"></i>Campus Photos ({{ $galleries->count() }})</h6>
                <small class="text-muted">Displayed in footer and gallery widgets</small>
            </div>
            <div class="card-body p-3">
                <div class="row g-3">
                    @forelse($galleries as $gallery)
                    <div class="col-6 col-md-4">
                        <div class="card h-100 border shadow-none position-relative overflow-hidden group">
                            <img src="{{ asset($gallery->image) }}" class="card-img-top" alt="{{ $gallery->title }}" style="height: 140px; object-fit: cover;">
                            <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                <div class="text-truncate me-2">
                                    <small class="fw-bold d-block text-truncate">{{ $gallery->title ?? 'Campus Photo' }}</small>
                                    <span class="badge bg-secondary-subtle text-muted" style="font-size: 0.65rem;">{{ $gallery->category }}</span>
                                </div>
                                <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this photo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger p-1 rounded-circle" style="width: 26px; height: 26px; display: inline-flex; align-items: center; justify-content: center;" title="Delete Photo">
                                        <i class="fa fa-trash fa-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <i class="fa fa-images fs-1 text-black-50 d-block mb-3"></i>
                        <h5>No Gallery Photos Uploaded</h5>
                        <p class="small">Upload campus photos from the left form.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
