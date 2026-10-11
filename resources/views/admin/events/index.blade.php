@extends('layouts.admin')

@section('title', 'Events & Albums')
@section('page-title', 'School Events & Photo Albums')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 w-100">
            <div class="card-header d-flex flex-wrap align-items-center justify-content-between bg-white py-3 gap-2">
                <div class="d-flex align-items-center">
                    <i class="fa fa-images text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">School Events & Photo Albums</h6>
                        <small class="text-muted">Manage school events and showcase photo album galleries</small>
                    </div>
                </div>
                <div>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary rounded-pill px-3">
                        <i class="fa fa-plus me-1"></i> Add New Event
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 w-100">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;" class="text-center">#</th>
                                <th style="width: 100px;">Album Preview</th>
                                <th>Event Title & Summary</th>
                                <th style="width: 140px;">Album Photos</th>
                                <th style="width: 110px;">Status</th>
                                <th style="width: 140px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                            <tr>
                                <td class="text-center text-muted fw-bold">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <div class="position-relative d-inline-block rounded overflow-hidden shadow-sm border" style="width: 70px; height: 52px;">
                                        <img src="{{ $event->cover_photo }}" alt="{{ $event->title ?: 'Album Preview' }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @if($event->images->count() > 0)
                                        <span class="badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 end-0 m-1" style="font-size: 0.6rem;">
                                            {{ $event->images->count() }}
                                        </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">
                                        @if(!empty($event->title))
                                            {{ $event->title }}
                                        @else
                                            <span class="text-muted fst-italic">Untitled Album</span>
                                            <span class="badge bg-light text-muted border ms-1" style="font-size: 0.68rem;">No Title</span>
                                        @endif
                                        @if($event->is_featured)
                                            <span class="badge bg-warning text-dark ms-1" style="font-size: 0.68rem;"><i class="fa fa-star me-1"></i> Featured</span>
                                        @endif
                                    </div>
                                    @if($event->summary)
                                        <small class="text-muted d-block mt-1">{{ Str::limit($event->summary, 80) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                        <i class="fa fa-images me-1"></i> {{ $event->images->count() }} Photo(s)
                                    </span>
                                </td>
                                <td>
                                    @if($event->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            <i class="fa fa-circle-check me-1"></i> Published
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                            <i class="fa fa-circle-xmark me-1"></i> Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('events.show', $event->slug) }}" target="_blank" class="btn btn-sm btn-outline-info" title="View Public Album">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Event & Album Photos">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event and its photo album?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Event">
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
                                    <h5>No School Events Found</h5>
                                    <p class="small text-muted mb-3">Create your first event album to showcase sports days, exhibitions, and student activities.</p>
                                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary rounded-pill px-4">
                                        <i class="fa fa-plus me-1"></i> Add First Event
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($events->count() > 0)
            <div class="card-footer bg-light d-flex align-items-center justify-content-between py-2 px-3">
                <small class="text-muted">
                    Total: <strong>{{ $events->count() }}</strong> Event Album(s)
                </small>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
