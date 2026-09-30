@extends('layouts.admin')

@section('title', 'Add Hero Slider')
@section('page-title', 'Create New Hero Slide')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-plus-circle text-primary me-2 fs-5"></i>
                    <h6 class="mb-0 fw-bold">Hero Slide Details</h6>
                </div>
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="fa fa-arrow-left me-1"></i> Back to Sliders
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-8">
                            <label class="form-label fw-bold small text-secondary">Slide Main Title / Headline *</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. The Best Kindergarten School For Your Child" value="{{ old('title') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold small text-secondary">Subtitle / Badge</label>
                            <input type="text" name="subtitle" class="form-control" placeholder="e.g. Welcome To Kider" value="{{ old('subtitle') }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary">Slide Description / Subtext</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Provide engaging summary text for the hero banner...">{{ old('description') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-secondary">Slide Background Image *</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                            <small class="text-muted">Recommended resolution: 1920x750 (JPG, PNG, WebP format).</small>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-secondary">Display Sort Order</label>
                            <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                            <small class="text-muted">Lower numbers appear first in the carousel.</small>
                        </div>

                        <div class="col-md-3 d-flex align-items-center">
                            <div class="form-check form-switch mt-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold small text-secondary" for="is_active">Active & Visible</label>
                            </div>
                        </div>

                        <div class="col-12"><hr class="my-2 text-muted"></div>

                        <!-- Button 1 -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-primary"><i class="fa fa-hand-pointer me-1"></i> Primary Button Text</label>
                            <input type="text" name="btn_text_1" class="form-control" placeholder="e.g. Learn More" value="{{ old('btn_text_1', 'Learn More') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-primary">Primary Button URL</label>
                            <input type="text" name="btn_url_1" class="form-control" placeholder="e.g. /about or https://..." value="{{ old('btn_url_1', '/about') }}">
                        </div>

                        <!-- Button 2 -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark"><i class="fa fa-hand-pointer me-1"></i> Secondary Button Text</label>
                            <input type="text" name="btn_text_2" class="form-control" placeholder="e.g. Our Classes" value="{{ old('btn_text_2', 'Our Classes') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">Secondary Button URL</label>
                            <input type="text" name="btn_url_2" class="form-control" placeholder="e.g. /classes or https://..." value="{{ old('btn_url_2', '/classes') }}">
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-light px-4 rounded-pill">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            <i class="fa fa-save me-1"></i> Save Hero Slide
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
