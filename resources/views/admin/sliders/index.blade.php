@extends('layouts.admin')

@section('title', 'Hero Sliders')
@section('page-title', 'Hero Carousel Sliders')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-images text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Homepage Hero Carousel Sliders</h6>
                        <small class="text-muted">Manage the prominent animated hero slides featured on the visitor homepage</small>
                    </div>
                </div>
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary rounded-pill px-3">
                    <i class="fa fa-plus me-1"></i> Add New Slide
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">Order</th>
                                <th style="width: 140px;">Slide Preview</th>
                                <th>Headline & Subtitle</th>
                                <th>Call-to-Action Buttons</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 140px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sliders as $slider)
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1">#{{ $slider->order }}</span>
                                </td>
                                <td>
                                    <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}" class="rounded shadow-sm" style="width: 120px; height: 65px; object-fit: cover;">
                                </td>
                                <td>
                                    @if($slider->subtitle)
                                        <div class="badge bg-primary-subtle text-primary mb-1">{{ $slider->subtitle }}</div>
                                    @endif
                                    <div class="fw-bold text-dark">{{ $slider->title }}</div>
                                    <small class="text-muted text-truncate d-block" style="max-width: 320px;">{{ $slider->description }}</small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1 small">
                                        @if($slider->btn_text_1)
                                            <div><span class="badge bg-primary">{{ $slider->btn_text_1 }}</span> &rarr; <code class="text-muted">{{ $slider->btn_url_1 ?: '#' }}</code></div>
                                        @endif
                                        @if($slider->btn_text_2)
                                            <div><span class="badge bg-dark">{{ $slider->btn_text_2 }}</span> &rarr; <code class="text-muted">{{ $slider->btn_url_2 ?: '#' }}</code></div>
                                        @endif
                                        @if(!$slider->btn_text_1 && !$slider->btn_text_2)
                                            <span class="text-muted italic">No buttons</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($slider->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            <i class="fa fa-circle-check me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                            <i class="fa fa-circle-xmark me-1"></i> Disabled
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Slide">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this hero slider?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Slide">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa fa-images fs-1 text-black-50 d-block mb-3"></i>
                                    <h5>No Hero Sliders Found</h5>
                                    <p class="small text-muted mb-3">Click below to create your first dynamic homepage slider.</p>
                                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary rounded-pill px-4">
                                        <i class="fa fa-plus me-1"></i> Add Hero Slide
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
