@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">TIRAMIS Report #{{ $report->report_number }}</h4>
        <small class="text-muted">Detailed view of claim submission to TIRA MIS</small>
    </div>
    <div>
        <a href="{{ route('admin.tiramis.reports') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Reports
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Report Details</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Report Number</div>
                    <div class="col-md-8 fw-semibold"><code>{{ $report->report_number }}</code></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Company Code</div>
                    <div class="col-md-8"><span class="badge bg-primary bg-opacity-10 text-primary">{{ $report->company_code ?? '—' }}</span></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Sales Code</div>
                    <div class="col-md-8"><span class="badge bg-info bg-opacity-10 text-info">{{ $report->sales_code ?? '—' }}</span></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Report Type</div>
                    <div class="col-md-8">{{ ucfirst($report->report_type) }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Status</div>
                    <div class="col-md-8">
                        @switch($report->status)
                            @case('sent') <span class="badge bg-success">Sent</span> @break
                            @case('failed') <span class="badge bg-danger">Failed</span> @break
                            @case('pending') <span class="badge bg-warning text-dark">Pending</span> @break
                            @case('simulated') <span class="badge bg-info">Simulated</span> @break
                            @default <span class="badge bg-secondary">{{ $report->status }}</span>
                        @endswitch
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Sent At</div>
                    <div class="col-md-8">{{ $report->sent_at?->format('d M Y H:i:s') ?? 'Not yet sent' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Response Code</div>
                    <div class="col-md-8"><code>{{ $report->response_code ?? '—' }}</code></div>
                </div>
                @if($report->response_message)
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Response Message</div>
                    <div class="col-md-8">{{ $report->response_message }}</div>
                </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-4 text-muted small">Created At</div>
                    <div class="col-md-8">{{ $report->created_at->format('d M Y H:i:s') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        @if($report->claim)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Related Claim</h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <small class="text-muted d-block">Claim #</small>
                    <span class="fw-semibold">{{ $report->claim->claim_number }}</span>
                </div>
                <div class="mb-2">
                    <small class="text-muted d-block">Policy #</small>
                    <span>{{ $report->claim->policy?->policy_number ?? 'N/A' }}</span>
                </div>
                <div class="mb-2">
                    <small class="text-muted d-block">Amount</small>
                    <span class="fw-bold">{{ number_format($report->claim->amount ?? 0, 2) }}</span>
                </div>
                <div class="mb-2">
                    <small class="text-muted d-block">Status</small>
                    <span class="badge bg-{{ $report->claim->status === 'approved' ? 'success' : ($report->claim->status === 'rejected' ? 'danger' : 'warning') }}">
                        {{ ucfirst($report->claim->status) }}
                    </span>
                </div>
            </div>
        </div>
        @endif

        @if(in_array($report->status, ['failed', 'pending']))
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <p class="small text-muted mb-2">Need to resubmit this report?</p>
                <form method="POST" action="{{ route('admin.tiramis.reports.retry', $report) }}">
                    @csrf
                    <button type="submit" class="btn btn-warning rounded-pill px-4 w-100">
                        <i class="bi bi-arrow-repeat me-1"></i> Retry Submission
                    </button>
                </form>
            </div>
        </div>
        @endif

        @if($report->status === 'sent')
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <p class="small text-muted mb-2">Check current status on TIRA MIS</p>
                <form method="POST" action="{{ route('admin.tiramis.reports.status-check', $report) }}">
                    @csrf
                    <button type="submit" class="btn btn-info text-white rounded-pill px-4 w-100">
                        <i class="bi bi-shield-check me-1"></i> Check Status
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
