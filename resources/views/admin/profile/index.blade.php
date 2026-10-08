@extends('layouts.admin')

@section('title', 'Admin Profile & Security')
@section('page-title', 'My Profile & Security')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px; font-weight: 700; font-size: 1.1rem;">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">{{ $user->name }}</h6>
                        <small class="text-muted">Administrator Account Settings</small>
                    </div>
                </div>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                    <i class="fa fa-shield-check me-1"></i> Root Administrator
                </span>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Account Information Section -->
                    <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">
                        <i class="fa fa-user-gear text-primary me-2"></i>Account Details
                    </h6>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Administrator Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Login Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Change Section -->
                    <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">
                        <i class="fa fa-key text-primary me-2"></i>Change Password (Optional)
                    </h6>
                    <p class="small text-muted mb-3">Leave password fields blank if you do not want to change your current password.</p>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Current Password</label>
                            <div class="input-group">
                                <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter current password to verify">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePass('current_password')">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">New Password</label>
                            <div class="input-group">
                                <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Minimum 8 characters">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePass('new_password')">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Re-type new password">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePass('new_password_confirmation')">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-top mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">
                            <i class="fa fa-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function togglePass(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endpush
@endsection
