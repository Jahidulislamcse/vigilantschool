@extends('layouts.admin')

@section('title', 'Events & Albums')
@section('page-title', 'School Events & Photo Albums')

@push('styles')
<style>
    .sortable-row {
        transition: background-color 0.2s ease;
    }
    .sortable-row:hover {
        background-color: #f8fafc;
    }
    .drag-handle {
        cursor: grab;
        padding: 6px 8px;
        border-radius: 6px;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    .drag-handle:hover {
        color: #0c4598 !important;
        background-color: #e8f0fe;
        transform: scale(1.1);
    }
    .drag-handle:active {
        cursor: grabbing !important;
    }
    .sortable-ghost {
        opacity: 0.45 !important;
        background-color: #e8f0fe !important;
        border: 2px dashed #0c4598 !important;
    }
    .sortable-chosen {
        background-color: #f0f7ff !important;
        box-shadow: 0 6px 16px rgba(12, 69, 152, 0.15) !important;
    }
    .order-badge {
        user-select: none;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header d-flex flex-wrap align-items-center justify-content-between bg-white py-3 gap-2">
                <div class="d-flex align-items-center">
                    <i class="fa fa-calendar-days text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">School Events & Photo Albums</h6>
                        <small class="text-muted">Manage school events, annual galas, sports days, and showcase photo albums</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="reorder-status" class="badge bg-light text-muted border px-3 py-2" style="font-size: 0.78rem;">
                        <i class="fa fa-arrows-up-down me-1 text-primary"></i> Drag handles <i class="fa fa-grip-vertical text-muted"></i> to reorder
                    </span>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary rounded-pill px-3">
                        <i class="fa fa-plus me-1"></i> Add New Event
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;" class="text-center">
                                    <i class="fa fa-grip-vertical text-muted me-1"></i> Index
                                </th>
                                <th style="width: 90px;">Cover</th>
                                <th>Event Title & Summary</th>
                                <th>Date & Venue</th>
                                <th>Album Photos</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 150px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="events-sortable">
                            @forelse($events as $event)
                            <tr class="sortable-row" data-id="{{ $event->id }}" data-order="{{ $event->order }}">
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="drag-handle" title="Click & Drag to reorder">
                                            <i class="fa fa-grip-vertical fs-5"></i>
                                        </span>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 order-badge fw-bold" style="min-width: 34px;">
                                            #{{ $event->order }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <img src="{{ asset($event->cover_image ?? 'kider/img/carousel-1.jpg') }}" alt="{{ $event->title }}" class="rounded shadow-sm border p-1" style="width: 65px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $event->title }}</div>
                                    <small class="text-muted">{{ Str::limit($event->summary, 60) }}</small>
                                    @if($event->is_featured)
                                        <span class="badge bg-warning text-dark ms-1" style="font-size: 0.68rem;"><i class="fa fa-star me-1"></i> Featured</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-dark small fw-semibold">
                                        <i class="fa fa-calendar-day text-primary me-1"></i> {{ $event->formatted_date }}
                                    </div>
                                    @if($event->location)
                                        <div class="text-muted" style="font-size: 0.75rem;">
                                            <i class="fa fa-location-dot text-danger me-1"></i> {{ $event->location }}
                                        </div>
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
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa fa-calendar-days fs-1 text-black-50 d-block mb-3"></i>
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
                    <i class="fa fa-info-circle me-1 text-primary"></i> Sequence is saved automatically to database when rows are dragged and dropped.
                </small>
                <small class="text-muted">
                    Total: <strong>{{ $events->count() }}</strong> Event Albums
                </small>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('events-sortable');
    const statusBadge = document.getElementById('reorder-status');

    if (!container) return;

    new Sortable(container, {
        animation: 200,
        handle: '.drag-handle',
        ghostClass: 'sortable-ghost',
        chosenClass: 'sortable-chosen',
        onEnd: function () {
            const rows = container.querySelectorAll('tr.sortable-row');
            const orders = [];

            rows.forEach((row, index) => {
                const newOrder = index + 1;
                const badge = row.querySelector('.order-badge');
                if (badge) badge.textContent = '#' + newOrder;
                row.setAttribute('data-order', newOrder);
                orders.push({
                    id: parseInt(row.getAttribute('data-id')),
                    order: newOrder
                });
            });

            if (statusBadge) {
                statusBadge.className = 'badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2';
                statusBadge.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> Saving sequence...';
            }

            fetch("{{ route('admin.events.reorder') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ orders: orders })
            })
            .then(res => res.json())
            .then(data => {
                if (statusBadge) {
                    statusBadge.className = 'badge bg-success-subtle text-success border border-success-subtle px-3 py-2';
                    statusBadge.innerHTML = '<i class="fa fa-circle-check me-1"></i> Sequence updated!';
                    setTimeout(() => {
                        statusBadge.className = 'badge bg-light text-muted border px-3 py-2';
                        statusBadge.innerHTML = '<i class="fa fa-arrows-up-down me-1 text-primary"></i> Drag handles <i class="fa fa-grip-vertical text-muted"></i> to reorder';
                    }, 3000);
                }
            })
            .catch(err => {
                console.error('Reorder error:', err);
                if (statusBadge) {
                    statusBadge.className = 'badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2';
                    statusBadge.innerHTML = '<i class="fa fa-circle-xmark me-1"></i> Failed to save sequence';
                }
            });
        }
    });
});
</script>
@endpush
