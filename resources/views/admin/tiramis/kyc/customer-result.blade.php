@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Customer Lookup Result</h4>
        <small class="text-muted">{{ $identity_type }}: {{ $identity_number }}</small>
    </div>
    <div>
        <a href="{{ route('admin.tiramis.kyc.customer.form') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> New Lookup
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Customer KYC Data</h6>
            </div>
            <div class="card-body">
                @php $d = $result['data'] ?? []; @endphp
                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-muted">Full Name</small>
                        <div class="fw-semibold">{{ $d['full_name'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Gender</small>
                        <div>{{ ($d['gender'] ?? '') === 'M' ? 'Male' : (($d['gender'] ?? '') === 'F' ? 'Female' : ($d['gender'] ?? 'N/A')) }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Date of Birth</small>
                        <div>{{ $d['date_of_birth'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Nationality</small>
                        <div>{{ $d['nationality'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Phone</small>
                        <div>{{ $d['phone'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Email</small>
                        <div>{{ $d['email'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Region</small>
                        <div>{{ $d['region'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">District</small>
                        <div>{{ $d['district'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Ward</small>
                        <div>{{ $d['ward'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-12">
                        <small class="text-muted">Address</small>
                        <div>{{ $d['address'] ?? 'N/A' }}</div>
                    </div>
                </div>
                @if($result['simulated'] ?? false)
                <div class="mt-3"><span class="badge bg-warning">Simulated Data</span></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Actions</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.tiramis.kyc.customer.form') }}" class="btn btn-outline-primary w-100 rounded-pill mb-2">
                    <i class="bi bi-search me-1"></i> New Lookup
                </a>
                <a href="{{ route('admin.tiramis.kyc.index') }}" class="btn btn-outline-secondary w-100 rounded-pill">
                    <i class="bi bi-grid me-1"></i> KYC Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
