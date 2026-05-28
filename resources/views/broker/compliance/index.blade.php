@extends('layouts.dashboard')
@section('dashboard_title', 'Compliance & Regulatory')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Regulatory Compliance</h4>
        <p class="text-muted mb-0 small">Licenses, filings, and compliance status</p>
    </div>
</div>

@if($broker)
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3 text-muted text-uppercase small">Broker Details</h6>
                <div class="mb-2"><span class="text-muted small">Name:</span><div class="fw-bold">{{ $broker->company_name ?? $broker->name ?? 'N/A' }}</div></div>
                <div class="mb-2"><span class="text-muted small">License No.:</span><div class="fw-bold">{{ $broker->license_number ?? '—' }}</div></div>
                <div class="mb-2"><span class="text-muted small">Status:</span>
                    <div>
                        @if(($broker->status ?? 'active') === 'active')
                            <span class="badge bg-success-subtle text-success">Active</span>
                        @else
                            <span class="badge bg-warning-subtle text-warning">{{ ucfirst($broker->status ?? 'Unknown') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0">Licenses & Certificates</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">License Type</th>
                                <th>License No.</th>
                                <th>Issued</th>
                                <th>Expiry</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($licenses as $license)
                            <tr>
                                <td class="ps-4 fw-bold">{{ $license->license_type ?? '—' }}</td>
                                <td><code class="small">{{ $license->license_number ?? '—' }}</code></td>
                                <td class="text-muted small">{{ $license->issued_at ? \Carbon\Carbon::parse($license->issued_at)->format('M d, Y') : '—' }}</td>
                                <td class="text-muted small">{{ $license->expires_at ? \Carbon\Carbon::parse($license->expires_at)->format('M d, Y') : '—' }}</td>
                                <td>
                                    @if(($license->status ?? 'active') === 'active')
                                        <span class="badge bg-success-subtle text-success">Active</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">{{ ucfirst($license->status ?? 'Unknown') }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-file-earmark-check fs-2 d-block mb-2 opacity-25"></i>
                                    No licenses on record.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="card border-0 shadow-sm">
    <div class="card-body text-center py-5 text-muted">
        <i class="bi bi-shield-lock fs-2 d-block mb-2 opacity-25"></i>
        Broker profile not found. Please contact support.
    </div>
</div>
@endif
@endsection
