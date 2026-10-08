@extends('layouts.admin')

@section('title', 'Contact Inquiries')
@section('page-title', 'Parent & Visitor Messages')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-envelope text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Visitor & Parent Inquiries Inbox</h6>
                        <small class="text-muted">Messages submitted from the website contact page</small>
                    </div>
                </div>
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    Total: {{ $contacts->total() }}
                </span>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px;">Status</th>
                                <th>Sender Name & Email</th>
                                <th>Subject</th>
                                <th>Message Snippet</th>
                                <th>Date & Time</th>
                                <th style="width: 130px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contacts as $contact)
                            <tr class="{{ !$contact->is_read ? 'table-primary bg-opacity-25 fw-semibold' : '' }}">
                                <td>
                                    @if(!$contact->is_read)
                                        <span class="badge bg-danger rounded-pill px-2 py-1">New</span>
                                    @else
                                        <span class="badge bg-light text-muted border px-2 py-1">Read</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-dark">{{ $contact->name }}</div>
                                    <small class="text-muted"><i class="fa fa-envelope me-1"></i>{{ $contact->email }}</small>
                                </td>
                                <td>
                                    <span class="text-dark">{{ $contact->subject ?? 'General Inquiry' }}</span>
                                </td>
                                <td>
                                    <small class="text-muted text-truncate d-block" style="max-width: 280px;" title="{{ $contact->message }}">
                                        {{ $contact->message }}
                                    </small>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $contact->created_at->format('M d, Y h:i A') }}</small>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-outline-primary" title="View Message">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Inquiry">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fa fa-inbox fs-1 text-black-50 d-block mb-3"></i>
                                    <h5>No Contact Messages Yet</h5>
                                    <p class="small">Inquiries submitted on the website will appear here in real-time.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($contacts->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $contacts->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
