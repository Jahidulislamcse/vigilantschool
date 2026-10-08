@extends('layouts.admin')

@section('title', 'View Message - ' . $contact->name)
@section('page-title', 'Inquiry Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fa fa-envelope-open text-primary me-2 fs-5"></i>
                    <h6 class="mb-0 fw-bold">Message Details #{{ $contact->id }}</h6>
                </div>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fa fa-arrow-left me-1"></i> Back to Inbox
                </a>
            </div>

            <div class="card-body p-4">
                <div class="p-3 bg-light rounded-3 mb-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Sender Name:</small>
                            <h6 class="fw-bold mb-0 text-dark">{{ $contact->name }}</h6>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Sender Email:</small>
                            <a href="mailto:{{ $contact->email }}" class="text-primary fw-medium">{{ $contact->email }}</a>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Subject:</small>
                            <div class="fw-semibold text-dark">{{ $contact->subject ?? 'General Inquiry' }}</div>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Received On:</small>
                            <div class="text-muted">{{ $contact->created_at->format('l, F d, Y - h:i A') }}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold text-dark mb-2">Message Body:</h6>
                    <div class="p-4 bg-white border rounded-3 text-dark shadow-sm" style="white-space: pre-wrap; line-height: 1.6;">{{ $contact->message }}</div>
                </div>

                <!-- Admin Reply & Internal Notes -->
                <div class="p-3 border rounded-3 bg-light">
                    <h6 class="fw-bold text-dark mb-2"><i class="fa fa-reply me-1 text-primary"></i> Admin Reply & Internal Follow-up Notes</h6>
                    <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="admin_reply" class="form-control" rows="3" placeholder="Log details of call or email response sent to guardian...">{{ old('admin_reply', $contact->admin_reply) }}</textarea>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject ?? 'Your Inquiry at Vigilant International School') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                <i class="fa fa-paper-plane me-1"></i> Open Email App
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">
                                <i class="fa fa-save me-1"></i> Save Reply Notes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
