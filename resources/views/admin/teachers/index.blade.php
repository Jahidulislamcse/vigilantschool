@extends('layouts.admin')

@section('title', 'Teachers & Faculty')
@section('page-title', 'Educators & Academic Faculty')

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
    .sortable-drag {
        opacity: 0.95 !important;
        cursor: grabbing !important;
        background-color: #ffffff !important;
        box-shadow: 0 10px 25px rgba(10, 34, 64, 0.2) !important;
    }
    .order-badge {
        transition: all 0.2s ease;
        cursor: pointer;
        user-select: none;
    }
    .order-badge:hover {
        transform: scale(1.08);
        background-color: #0c4598 !important;
        color: #ffffff !important;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 w-100">
            <div class="card-header d-flex flex-wrap align-items-center justify-content-between bg-white py-3 gap-2">
                <div class="d-flex align-items-center">
                    <i class="fa fa-chalkboard-user text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Teachers & Faculty Roster</h6>
                        <small class="text-muted">Manage educators, ordering sequence, designations, and social media links</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="reorder-status" class="badge bg-light text-muted border px-3 py-2" style="font-size: 0.78rem;">
                        <i class="fa fa-arrows-up-down me-1 text-primary"></i> Drag handles <i class="fa fa-grip-vertical text-muted"></i> to reorder sequence
                    </span>
                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary rounded-pill px-3">
                        <i class="fa fa-plus me-1"></i> Add Educator
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 100px;" class="text-center">
                                    <i class="fa fa-grip-vertical text-muted me-1"></i> Index
                                </th>
                                <th style="width: 75px;">Photo</th>
                                <th>Educator Name</th>
                                <th>Designation / Role</th>
                                <th>Assigned Classes</th>
                                <th>Social Profiles</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 130px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="teachers-sortable">
                            @forelse($teachers as $index => $teacher)
                            <tr class="sortable-row" data-id="{{ $teacher->id }}" data-order="{{ $teacher->order }}" data-name="{{ $teacher->name }}">
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="drag-handle" title="Click & Drag to reorder">
                                            <i class="fa fa-grip-vertical fs-5"></i>
                                        </span>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 order-badge fw-bold" 
                                              style="min-width: 38px; font-size: 0.8rem;" 
                                              title="Click to manually update index"
                                              onclick="promptUpdateIndex({{ $teacher->id }}, '{{ addslashes($teacher->name) }}', {{ $teacher->order }})">
                                            #{{ $teacher->order }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <img src="{{ asset($teacher->photo ?? 'kider/img/team-1.jpg') }}" alt="{{ $teacher->name }}" class="rounded-circle shadow-sm border p-1" style="width: 48px; height: 48px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $teacher->name }}</div>
                                    <small class="text-muted">{{ Str::limit($teacher->bio, 45) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                        {{ $teacher->designation }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1">
                                        {{ $teacher->classes->count() }} Class(es)
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        @if($teacher->facebook_url)
                                            <a href="{{ $teacher->facebook_url }}" target="_blank" class="btn btn-sm btn-outline-primary p-1 rounded-circle" style="width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;" title="Facebook">
                                                <i class="fab fa-facebook-f fa-xs"></i>
                                            </a>
                                        @endif
                                        @if($teacher->twitter_url)
                                            <a href="{{ $teacher->twitter_url }}" target="_blank" class="btn btn-sm btn-outline-info p-1 rounded-circle" style="width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;" title="Twitter">
                                                <i class="fab fa-twitter fa-xs"></i>
                                            </a>
                                        @endif
                                        @if($teacher->instagram_url)
                                            <a href="{{ $teacher->instagram_url }}" target="_blank" class="btn btn-sm btn-outline-danger p-1 rounded-circle" style="width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;" title="Instagram">
                                                <i class="fab fa-instagram fa-xs"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($teacher->is_active)
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
                                        <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Teacher">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this teacher profile?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Teacher">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fa fa-chalkboard-user fs-1 text-black-50 d-block mb-3"></i>
                                    <h5>No Teachers or Faculty Profiles Found</h5>
                                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary rounded-pill px-4">
                                        <i class="fa fa-plus me-1"></i> Add First Educator Profile
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($teachers->count() > 0)
            <div class="card-footer bg-light d-flex align-items-center justify-content-between py-2 px-3">
                <small class="text-muted">
                    <i class="fa fa-info-circle me-1 text-primary"></i> Sequence is saved automatically to the database when rows are dropped.
                </small>
                <small class="text-muted">
                    Total: <strong>{{ $teachers->count() }}</strong> Educators
                </small>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- SortableJS library for smooth drag and drop row reordering -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sortableContainer = document.getElementById('teachers-sortable');
    const statusBadge = document.getElementById('reorder-status');

    if (!sortableContainer) return;

    // Initialize SortableJS
    new Sortable(sortableContainer, {
        animation: 200,
        handle: '.drag-handle',
        ghostClass: 'sortable-ghost',
        chosenClass: 'sortable-chosen',
        dragClass: 'sortable-drag',
        onEnd: function () {
            const rows = sortableContainer.querySelectorAll('tr.sortable-row');
            const orders = [];

            // Immediately update visual badge numbers
            rows.forEach((row, index) => {
                const newOrder = index + 1;
                const badge = row.querySelector('.order-badge');
                if (badge) {
                    badge.textContent = '#' + newOrder;
                }
                row.setAttribute('data-order', newOrder);
                orders.push({
                    id: parseInt(row.getAttribute('data-id')),
                    order: newOrder
                });
            });

            // Update status badge to loading
            if (statusBadge) {
                statusBadge.className = 'badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2';
                statusBadge.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> Saving new sequence...';
            }

            // Send AJAX POST request to save updated orders
            fetch("{{ route('admin.teachers.reorder') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ orders: orders })
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to update orders');
                return response.json();
            })
            .then(data => {
                if (statusBadge) {
                    statusBadge.className = 'badge bg-success-subtle text-success border border-success-subtle px-3 py-2';
                    statusBadge.innerHTML = '<i class="fa fa-circle-check me-1"></i> Index sequence saved!';
                    setTimeout(() => {
                        statusBadge.className = 'badge bg-light text-muted border px-3 py-2';
                        statusBadge.innerHTML = '<i class="fa fa-arrows-up-down me-1 text-primary"></i> Drag handles <i class="fa fa-grip-vertical text-muted"></i> to reorder sequence';
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Reorder error:', error);
                if (statusBadge) {
                    statusBadge.className = 'badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2';
                    statusBadge.innerHTML = '<i class="fa fa-circle-xmark me-1"></i> Failed to save sequence';
                }
            });
        }
    });

    // Helper function to allow manual index prompt update
    window.promptUpdateIndex = function (teacherId, teacherName, currentOrder) {
        const newOrder = prompt(`Enter new index/order number for "${teacherName}":`, currentOrder);
        if (newOrder === null || newOrder.trim() === '' || isNaN(newOrder)) {
            return;
        }

        const orderValue = parseInt(newOrder.trim());
        if (orderValue < 0) {
            alert('Index must be a non-negative number.');
            return;
        }

        const updateUrl = "{{ url('admin/teachers') }}/" + teacherId + "/update-order";

        if (statusBadge) {
            statusBadge.className = 'badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2';
            statusBadge.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> Updating index...';
        }

        fetch(updateUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ order: orderValue })
        })
        .then(response => {
            if (!response.ok) throw new Error('Failed to update index');
            return response.json();
        })
        .then(data => {
            // Reload page to reflect newly sorted rows
            window.location.reload();
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Could not update index. Please try again.');
            if (statusBadge) {
                statusBadge.className = 'badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2';
                statusBadge.innerHTML = '<i class="fa fa-circle-xmark me-1"></i> Failed to update index';
            }
        });
    };
});
</script>
@endpush
