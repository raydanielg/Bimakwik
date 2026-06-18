@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">TIRAMIS KYC & Verification</h4>
        <small class="text-muted">NIDA verification, customer lookup, and vehicle registration lookup</small>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-flex mb-3">
                    <i class="bi bi-shield-check fs-3 text-primary"></i>
                </div>
                <h6 class="fw-semibold">NIDA Verification</h6>
                <p class="text-muted small mb-3">Verify customer identity via NIDA number</p>
                <a href="{{ route('admin.tiramis.kyc.nida.form') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    Verify Now
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 d-inline-flex mb-3">
                    <i class="bi bi-person-badge fs-3 text-success"></i>
                </div>
                <h6 class="fw-semibold">Customer Lookup</h6>
                <p class="text-muted small mb-3">Lookup customer KYC by identity type</p>
                <a href="{{ route('admin.tiramis.kyc.customer.form') }}" class="btn btn-success btn-sm rounded-pill px-3">
                    Lookup
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body">
                <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-inline-flex mb-3">
                    <i class="bi bi-truck fs-3 text-warning"></i>
                </div>
                <h6 class="fw-semibold">Vehicle Lookup</h6>
                <p class="text-muted small mb-3">Lookup vehicle by registration number</p>
                <a href="{{ route('admin.tiramis.kyc.vehicle.form') }}" class="btn btn-warning btn-sm rounded-pill px-3">
                    Lookup
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body">
                <div class="rounded-circle bg-info bg-opacity-10 p-3 d-inline-flex mb-3">
                    <i class="bi bi-hdd-stack fs-3 text-info"></i>
                </div>
                <h6 class="fw-semibold">System Health</h6>
                <p class="text-muted small mb-3">Check TIRAMIS connectivity status</p>
                <button class="btn btn-info btn-sm rounded-pill px-3" onclick="checkHealth()">
                    Check
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
        <h6 class="fw-semibold mb-0">Connection Status</h6>
        <span class="badge bg-{{ ($health['connectivity'] ?? false) ? 'success' : 'danger' }} rounded-pill">
            {{ ($health['connectivity'] ?? false) ? 'Connected' : 'Disconnected' }}
        </span>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <small class="text-muted">TIRAMIS Status</small>
                <div class="fw-semibold">{{ ($health['tiramis_enabled'] ?? false) ? 'Enabled' : 'Disabled' }}</div>
            </div>
            <div class="col-md-3">
                <small class="text-muted">KYC Status</small>
                <div class="fw-semibold">{{ ($health['kyc_enabled'] ?? false) ? 'Enabled' : 'Disabled' }}</div>
            </div>
            <div class="col-md-3">
                <small class="text-muted">Vehicle Lookup</small>
                <div class="fw-semibold">{{ ($health['vehicle_enabled'] ?? false) ? 'Enabled' : 'Disabled' }}</div>
            </div>
            <div class="col-md-3">
                <small class="text-muted">Tunnel</small>
                <div class="fw-semibold">{{ ($health['tunnel_enabled'] ?? false) ? 'Enabled' : 'Disabled' }}</div>
            </div>
            <div class="col-md-6">
                <small class="text-muted">Base URL</small>
                <div class="fw-semibold small">{{ $health['base_url'] ?? 'N/A' }}</div>
            </div>
            <div class="col-md-3">
                <small class="text-muted">Latency</small>
                <div class="fw-semibold">{{ ($health['latency_ms'] ?? 0) }}ms</div>
            </div>
            <div class="col-md-3">
                <small class="text-muted">Error</small>
                <div class="text-danger small">{{ $health['error'] ?? 'None' }}</div>
            </div>
        </div>
    </div>
</div>

<script>
async function checkHealth() {
    try {
        const res = await fetch('{{ route("admin.tiramis.kyc.health") }}');
        const data = await res.json();
        alert(JSON.stringify(data, null, 2));
    } catch(e) {
        alert('Health check failed: ' + e.message);
    }
}
</script>
@endsection
