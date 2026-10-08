@extends('layouts.admin')

@section('title', 'Newsletter Subscribers')
@section('page-title', 'Email Newsletter Subscribers')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-newspaper text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Newsletter Email Subscribers</h6>
                        <small class="text-muted">Subscribers registered via website footer subscription bar</small>
                    </div>
                </div>
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    Total: {{ $subscribers->total() }}
                </span>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70px;">#ID</th>
                                <th>Subscriber Email Address</th>
                                <th>Subscribed At</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 100px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscribers as $subscriber)
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border">#{{ $subscriber->id }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">
                                        <i class="fa fa-envelope text-primary me-2"></i>
                                        <a href="mailto:{{ $subscriber->email }}" class="text-dark text-decoration-none">{{ $subscriber->email }}</a>
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $subscriber->created_at->format('M d, Y h:i A') }}</small>
                                </td>
                                <td>
                                    @if($subscriber->is_active)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Active</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">Unsubscribed</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('admin.newsletters.destroy', $subscriber->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this subscriber?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove Subscriber">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fa fa-envelope-circle-check fs-1 text-black-50 d-block mb-3"></i>
                                    <h5>No Subscribers Registered Yet</h5>
                                    <p class="small">Emails entered in the website footer will appear here.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($subscribers->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $subscribers->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
