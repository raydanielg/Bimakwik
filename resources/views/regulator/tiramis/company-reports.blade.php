@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Company Reports: <code>{{ $companyCode }}</code></h4>
        <small class="text-muted">TIRAMIS reports for this company</small>
    </div>
    <div>
        <a href="{{ route('regulator.tiramis.companies') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Companies
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-primary mb-1">{{ $stats['total'] ?? 0 }}</h5>
                <small class="text-muted">Total Reports</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-success bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-success mb-1">{{ $stats['sent'] ?? 0 }}</h5>
                <small class="text-muted">Sent</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-danger bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-danger mb-1">{{ $stats['failed'] ?? 0 }}</h5>
                <small class="text-muted">Failed</small>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Report #</th>
                        <th>Sales Code</th>
                        <th>Claim #</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Sent At</th>
                        <th class="pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td class="ps-3 fw-semibold"><code>{{ $report->report_number }}</code></td>
                        <td><span class="badge bg-info bg-opacity-10 text-info">{{ $report->sales_code ?? '—' }}</span></td>
                        <td>{{ $report->claim?->claim_number ?? 'N/A' }}</td>
                        <td><span class="badge bg-light text-dark">{{ ucfirst($report->report_type) }}</span></td>
                        <td>
                            @switch($report->status)
                                @case('sent') <span class="badge bg-success">Sent</span> @break
                                @case('failed') <span class="badge bg-danger">Failed</span> @break
                                @case('pending') <span class="badge bg-warning text-dark">Pending</span> @break
                                @default <span class="badge bg-secondary">{{ $report->status }}</span>
                            @endswitch
                        </td>
                        <td><small class="text-muted">{{ $report->sent_at?->format('d M Y H:i') ?? '—' }}</small></td>
                        <td class="pe-3">
                            <a href="{{ route('regulator.tiramis.reports.show', $report) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No reports for this company</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($reports->hasPages())
    <div class="card-footer bg-white border-0">
        {{ $reports->links() }}
    </div>
    @endif
</div>
@endsection
