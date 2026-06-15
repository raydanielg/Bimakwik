@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">TIRAMIS Reports</h4>
        <small class="text-muted">All claims sent to TIRA MIS portal</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.tiramis.logs') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-journal-text me-1"></i> Integration Logs
        </a>
        <a href="{{ route('admin.tiramis.reports.pending') }}" class="btn btn-warning btn-sm rounded-pill px-3">
            <i class="bi bi-clock-history me-1"></i> Pending Claims
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-primary mb-1">{{ $stats['total'] ?? 0 }}</h5>
                <small class="text-muted">Total Reports</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-success mb-1">{{ $stats['sent'] ?? 0 }}</h5>
                <small class="text-muted">Sent Successfully</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-danger bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-danger mb-1">{{ $stats['failed'] ?? 0 }}</h5>
                <small class="text-muted">Failed</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-warning mb-1">{{ $stats['pending'] ?? 0 }}</h5>
                <small class="text-muted">Pending / Simulated</small>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small">Company Code</label>
                <select name="company_code" class="form-select form-select-sm">
                    <option value="">All Companies</option>
                    @foreach($companyCodes as $code)
                        <option value="{{ $code }}" @selected(request('company_code') == $code)>{{ $code }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Statuses</option>
                    <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                    <option value="sent" @selected(request('status') == 'sent')>Sent</option>
                    <option value="failed" @selected(request('status') == 'failed')>Failed</option>
                    <option value="simulated" @selected(request('status') == 'simulated')>Simulated</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Report Type</label>
                <select name="report_type" class="form-select form-select-sm">
                    <option value="">All Types</option>
                    <option value="claim" @selected(request('report_type') == 'claim')>Claim</option>
                    <option value="policy" @selected(request('report_type') == 'policy')>Policy</option>
                    <option value="payment" @selected(request('report_type') == 'payment')>Payment</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-sm w-100 rounded-pill">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Report #</th>
                        <th>Company Code</th>
                        <th>Sales Code</th>
                        <th>Claim #</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Sent At</th>
                        <th>Response Code</th>
                        <th class="pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td class="ps-3 fw-semibold"><code>{{ $report->report_number }}</code></td>
                        <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $report->company_code ?? '—' }}</span></td>
                        <td><span class="badge bg-info bg-opacity-10 text-info">{{ $report->sales_code ?? '—' }}</span></td>
                        <td>{{ $report->claim?->claim_number ?? 'N/A' }}</td>
                        <td><span class="badge bg-light text-dark">{{ ucfirst($report->report_type) }}</span></td>
                        <td>
                            @switch($report->status)
                                @case('sent') <span class="badge bg-success">Sent</span> @break
                                @case('failed') <span class="badge bg-danger">Failed</span> @break
                                @case('pending') <span class="badge bg-warning text-dark">Pending</span> @break
                                @case('simulated') <span class="badge bg-info">Simulated</span> @break
                                @default <span class="badge bg-secondary">{{ $report->status }}</span>
                            @endswitch
                        </td>
                        <td><small class="text-muted">{{ $report->sent_at?->format('d M Y H:i') ?? '—' }}</small></td>
                        <td><code>{{ $report->response_code ?? '—' }}</code></td>
                        <td class="pe-3">
                            <a href="{{ route('admin.tiramis.reports.show', $report) }}" class="btn btn-sm btn-outline-primary" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if(in_array($report->status, ['failed', 'pending']))
                                <form method="POST" action="{{ route('admin.tiramis.reports.retry', $report) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-warning" title="Retry">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                </form>
                            @endif
                            @if($report->status === 'sent')
                                <form method="POST" action="{{ route('admin.tiramis.reports.status-check', $report) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-info" title="Check Status">
                                        <i class="bi bi-shield-check"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">No TIRAMIS reports found</td></tr>
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
