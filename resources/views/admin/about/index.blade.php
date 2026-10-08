@extends('layouts.admin')

@section('title', 'About Us & Mission')
@section('page-title', 'About Us & Mission Configuration')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-circle-info text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">About School, Mission & CTA Banner</h6>
                        <small class="text-muted">Manage the official mission narrative, advisory leadership profile, collage imagery, and call-to-action banner</small>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">1. Mission & About Story</h5>
                    <div class="row g-4 mb-4">
                        <div class="col-md-8">
                            <label class="form-label fw-bold small text-secondary">Section Headline *</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $about->title) }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary">Section Tagline</label>
                            <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $about->tagline) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary">Primary Mission Statement *</label>
                            <textarea name="description_1" class="form-control" rows="4" required>{{ old('description_1', $about->description_1) }}</textarea>
                            <small class="text-muted">Core child potential and global citizen philosophy.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary">Academic & Session Structure *</label>
                            <textarea name="description_2" class="form-control" rows="4">{{ old('description_2', $about->description_2) }}</textarea>
                            <small class="text-muted">Details regarding British Council, Edexcel, and semester systems.</small>
                        </div>
                    </div>

                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">2. Leadership / Academic Advisory Council</h5>
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary">Leader / Authority Name</label>
                            <input type="text" name="founder_name" class="form-control" value="{{ old('founder_name', $about->founder_name) }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary">Designation / Role</label>
                            <input type="text" name="founder_role" class="form-control" value="{{ old('founder_role', $about->founder_role) }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary">Leader Photo</label>
                            <input type="file" name="founder_photo" class="form-control" accept="image/*">
                            @if($about->founder_photo)
                                <div class="admin-img-preview-box d-flex align-items-center gap-3 mt-2">
                                    <img src="{{ asset($about->founder_photo) }}" alt="Leader Photo" class="admin-preview-thumb circle" style="width: 50px; height: 50px;">
                                    <div>
                                        <span class="badge bg-primary-subtle text-primary admin-preview-badge mb-1"><i class="fa fa-user me-1"></i> Current Photo</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">3. About Section 3-Circle Collage Images</h5>
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary">Collage Top Image</label>
                            <input type="file" name="image_1" class="form-control" accept="image/*">
                            @if($about->image_1)
                                <div class="admin-img-preview-box d-flex align-items-center gap-3 mt-2">
                                    <img src="{{ asset($about->image_1) }}" alt="Image 1" class="admin-preview-thumb" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div>
                                        <span class="badge bg-primary-subtle text-primary admin-preview-badge mb-1">Top Image</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary">Collage Left Image</label>
                            <input type="file" name="image_2" class="form-control" accept="image/*">
                            @if($about->image_2)
                                <div class="admin-img-preview-box d-flex align-items-center gap-3 mt-2">
                                    <img src="{{ asset($about->image_2) }}" alt="Image 2" class="admin-preview-thumb" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div>
                                        <span class="badge bg-primary-subtle text-primary admin-preview-badge mb-1">Left Image</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary">Collage Right Image</label>
                            <input type="file" name="image_3" class="form-control" accept="image/*">
                            @if($about->image_3)
                                <div class="admin-img-preview-box d-flex align-items-center gap-3 mt-2">
                                    <img src="{{ asset($about->image_3) }}" alt="Image 3" class="admin-preview-thumb" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div>
                                        <span class="badge bg-primary-subtle text-primary admin-preview-badge mb-1">Right Image</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">4. Call To Action (CTA) Banner</h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary">CTA Headline</label>
                            <input type="text" name="cta_title" class="form-control" value="{{ old('cta_title', $about->cta_title) }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-secondary">Button Label</label>
                            <input type="text" name="cta_button_text" class="form-control" value="{{ old('cta_button_text', $about->cta_button_text) }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-secondary">Button Target Link</label>
                            <input type="text" name="cta_button_url" class="form-control" value="{{ old('cta_button_url', $about->cta_button_url) }}">
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-bold small text-secondary">CTA Description</label>
                            <textarea name="cta_description" class="form-control" rows="2">{{ old('cta_description', $about->cta_description) }}</textarea>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary">CTA Background Image</label>
                            <input type="file" name="cta_image" class="form-control" accept="image/*">
                            @if($about->cta_image)
                                <div class="admin-img-preview-box d-flex align-items-center gap-3 mt-2">
                                    <img src="{{ asset($about->cta_image) }}" alt="CTA Image" class="admin-preview-thumb banner" style="width: 90px; height: 50px;">
                                    <div>
                                        <span class="badge bg-secondary-subtle text-dark admin-preview-badge mb-1">Current CTA</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                            <i class="fa fa-floppy-disk me-2"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
