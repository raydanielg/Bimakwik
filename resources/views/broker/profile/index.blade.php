@extends('layouts.dashboard')
@section('dashboard_title', 'Profile & Bank Details')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Profile & Bank Details</h4>
        <p class="text-muted mb-0 small">Manage your profile and payment information</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show"><i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">Broker Profile</h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('broker.profile.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Company / Full Name</label>
                        <input type="text" class="form-control bg-light" value="{{ $broker->company_name ?? $broker->name ?? 'N/A' }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $broker->email ?? '') }}">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Phone</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $broker->phone ?? '') }}">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small">Address</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', $broker->address ?? '') }}</textarea>
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">Bank Details</h6>
            </div>
            <div class="card-body p-4">
                @if($bankDetail)
                <div class="mb-3">
                    <div class="text-muted small mb-1">Bank Name</div>
                    <div class="fw-bold">{{ $bankDetail->bank_name ?? '—' }}</div>
                </div>
                <div class="mb-3">
                    <div class="text-muted small mb-1">Account Name</div>
                    <div class="fw-bold">{{ $bankDetail->account_name ?? '—' }}</div>
                </div>
                <div class="mb-3">
                    <div class="text-muted small mb-1">Account Number</div>
                    <div class="fw-bold"><code>{{ $bankDetail->account_number ?? '—' }}</code></div>
                </div>
                <div class="mb-3">
                    <div class="text-muted small mb-1">Branch</div>
                    <div class="fw-bold">{{ $bankDetail->branch ?? '—' }}</div>
                </div>
                @else
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-bank fs-2 d-block mb-2 opacity-25"></i>
                    No bank details on record.<br>
                    <small>Contact support to update your bank details.</small>
                </div>
                @endif
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">Account Status</h6>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                    <div>
                        <div class="fw-bold">Status: <span class="text-success">{{ ucfirst($broker->status ?? 'Active') }}</span></div>
                        <div class="small text-muted">License: {{ $broker->license_number ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
