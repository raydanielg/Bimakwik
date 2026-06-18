@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Claim #{{ $claim->claim_number }}</h4>
        <small class="text-muted">Detailed claim view and management</small>
    </div>
    <div>
        <a href="{{ route('admin.operations.claims') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Claims
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-semibold mb-0">Claim Details</h6>
                <span class="badge bg-{{ $claim->status === 'approved' ? 'success' : ($claim->status === 'rejected' ? 'danger' : 'warning') }}">
                    {{ ucfirst($claim->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Claim Number</div>
                    <div class="col-md-8 fw-semibold">{{ $claim->claim_number }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Customer</div>
                    <div class="col-md-8">{{ $claim->customer?->full_name ?? 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Policy</div>
                    <div class="col-md-8">{{ $claim->policy?->policy_number ?? 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Claim Type</div>
                    <div class="col-md-8">{{ ucfirst($claim->claim_type) }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Accident Date</div>
                    <div class="col-md-8">{{ $claim->accident_date?->format('d M Y') ?? 'N/A' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Claimed Amount</div>
                    <div class="col-md-8 fw-bold">{{ number_format($claim->claimed_amount, 2) }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Approved Amount</div>
                    <div class="col-md-8">{{ $claim->approved_amount ? number_format($claim->approved_amount, 2) : '—' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Description</div>
                    <div class="col-md-8">{{ $claim->description }}</div>
                </div>
                @if($claim->rejection_reason)
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Rejection Reason</div>
                    <div class="col-md-8 text-danger">{{ $claim->rejection_reason }}</div>
                </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Created At</div>
                    <div class="col-md-8"><small class="text-muted">{{ $claim->created_at->format('d M Y H:i') }}</small></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Actions</h6>
            </div>
            <div class="card-body">
                @if(in_array($claim->status, ['submitted', 'pending', 'processing']))
                <form method="POST" action="{{ route('admin.operations.claims.approve', $claim->id) }}" class="mb-2">
                    @csrf
                    <button type="submit" class="btn btn-success w-100 rounded-pill">
                        <i class="bi bi-check-lg me-1"></i> Approve Claim
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.operations.claims.reject', $claim->id) }}" class="mb-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-pill">
                        <i class="bi bi-x-lg me-1"></i> Reject Claim
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.operations.claims.tiramis', $claim->id) }}" class="mb-2">
                    @csrf
                    <div class="mb-2">
                        <input type="text" name="company_code" class="form-control form-control-sm" placeholder="Company Code" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="sales_code" class="form-control form-control-sm" placeholder="Sales Code (optional)">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">
                        <i class="bi bi-send me-1"></i> Submit to TIRAMIS
                    </button>
                </form>
                @else
                <div class="alert alert-info border-0 mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    This claim has been {{ $claim->status }}.
                </div>
                @endif
            </div>
        </div>

        @if($claim->tiramisReports->count() > 0)
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">TIRAMIS Reports</h6>
            </div>
            <div class="card-body">
                @foreach($claim->tiramisReports as $report)
                <div class="mb-2 pb-2 border-bottom">
                    <small class="text-muted d-block">{{ $report->report_number }}</small>
                    <span class="badge bg-{{ $report->status === 'sent' ? 'success' : ($report->status === 'failed' ? 'danger' : 'warning') }}">
                        {{ ucfirst($report->status) }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
