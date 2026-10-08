@extends('layouts.admin')

@section('title', 'Parent Reviews & Testimonials')
@section('page-title', 'Parent Testimonials')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-comments text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Parent & Guardian Testimonials</h6>
                        <small class="text-muted">Manage client reviews, feedback quotes, star ratings, and avatars</small>
                    </div>
                </div>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary rounded-pill px-3">
                    <i class="fa fa-plus me-1"></i> Add Review
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70px;">Order</th>
                                <th style="width: 70px;">Avatar</th>
                                <th>Parent / Guardian</th>
                                <th>Profession / Relation</th>
                                <th>Review Quote</th>
                                <th>Rating</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 130px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($testimonials as $testimonial)
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1">#{{ $testimonial->order }}</span>
                                </td>
                                <td>
                                    <img src="{{ asset($testimonial->avatar ?? 'kider/img/user.jpg') }}" alt="{{ $testimonial->client_name }}" class="rounded-circle shadow-sm border p-1" style="width: 45px; height: 45px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $testimonial->client_name }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted border">{{ $testimonial->profession }}</span>
                                </td>
                                <td>
                                    <small class="text-muted text-truncate d-block" style="max-width: 320px;" title="{{ $testimonial->content }}">
                                        "{{ $testimonial->content }}"
                                    </small>
                                </td>
                                <td>
                                    <div class="text-warning small">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted opacity-25' }}"></i>
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    @if($testimonial->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            <i class="fa fa-circle-check me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                            <i class="fa fa-circle-xmark me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Review">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Review">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fa fa-comments fs-1 text-black-50 d-block mb-3"></i>
                                    <h5>No Testimonials Found</h5>
                                    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary rounded-pill px-4">
                                        <i class="fa fa-plus me-1"></i> Add First Review
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
