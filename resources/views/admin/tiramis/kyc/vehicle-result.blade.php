@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Vehicle Lookup Result</h4>
        <small class="text-muted">Registration: {{ $registration_number }}</small>
    </div>
    <div>
        <a href="{{ route('admin.tiramis.kyc.vehicle.form') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> New Lookup
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-semibold mb-0">Vehicle Details</h6>
                @php $d = $result['data'] ?? []; @endphp
                <span class="badge bg-{{ ($d['insurance_status'] ?? '') === 'insured' ? 'success' : 'warning' }} rounded-pill">
                    {{ ucfirst($d['insurance_status'] ?? 'Unknown') }}
                </span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-muted">Registration Number</small>
                        <div class="fw-bold fs-5">{{ $d['registration_number'] ?? $registration_number }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Sticker Number</small>
                        <div>{{ $d['sticker_number'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Make</small>
                        <div class="fw-semibold">{{ $d['make'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Model</small>
                        <div>{{ $d['model'] ?? 'N/A' }} ({{ $d['model_number'] ?? '' }})</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Body Type</small>
                        <div>{{ $d['body_type'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Color</small>
                        <div>{{ $d['color'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Year</small>
                        <div>{{ $d['year_of_manufacture'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Engine Capacity</small>
                        <div>{{ $d['engine_capacity'] ?? 'N/A' }} cc</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Fuel Type</small>
                        <div>{{ $d['fuel_type'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Sitting Capacity</small>
                        <div>{{ $d['sitting_capacity'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-12"><hr></div>
                    <div class="col-md-6">
                        <small class="text-muted">Chassis Number</small>
                        <div><code>{{ $d['chassis_number'] ?? 'N/A' }}</code></div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Engine Number</small>
                        <div><code>{{ $d['engine_number'] ?? 'N/A' }}</code></div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Axles</small>
                        <div>{{ $d['number_of_axles'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Tare Weight</small>
                        <div>{{ $d['tare_weight'] ?? 'N/A' }} kg</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Gross Weight</small>
                        <div>{{ $d['gross_weight'] ?? 'N/A' }} kg</div>
                    </div>
                    <div class="col-12"><hr></div>
                    <div class="col-md-6">
                        <small class="text-muted">Owner Name</small>
                        <div class="fw-semibold">{{ $d['owner_name'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Owner Address</small>
                        <div>{{ $d['owner_address'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Motor Category</small>
                        <div>{{ $d['motor_category'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Motor Type</small>
                        <div>{{ $d['motor_type'] ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Usage</small>
                        <div>{{ $d['motor_usage'] ?? 'N/A' }}</div>
                    </div>
                </div>
                @if($result['simulated'] ?? false)
                <div class="mt-3"><span class="badge bg-warning">Simulated Data</span></div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Actions</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.tiramis.kyc.vehicle.form') }}" class="btn btn-outline-warning w-100 rounded-pill mb-2">
                    <i class="bi bi-search me-1"></i> Lookup Another Vehicle
                </a>
                <a href="{{ route('admin.tiramis.kyc.index') }}" class="btn btn-outline-secondary w-100 rounded-pill">
                    <i class="bi bi-grid me-1"></i> KYC Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
