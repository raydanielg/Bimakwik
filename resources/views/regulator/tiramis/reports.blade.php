@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">TIRAMIS Reports</h4>
        <small class="text-muted">All claim reports submitted to TIRA MIS</small>
    </div>
    <div>
        <a href="{{ route('regulator.tiramis.dashboard') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Dashboard
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-2">
                <label class="form-label small">Company Code</label>
                <select name="company_code" class="form-select form-select-sm">
                    <option value="">All</option>
                    @foreach($companyCodes as $code)
                        <option value="{{ $code }}" @selected(request('company_code') == $code)>{{ $code }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">All</option>
                    <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                    <option value="sent" @selected(request('status') == 'sent')>Sent</option>
                    <option value="failed" @selected(request('status') == 'failed')>Failed</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Report Type</label>
                <select name="report_type" class="form-select form-select-sm">
                    <option value="">All</option>
                    <option value="claim" @selected(request('report_type') == 'claim')>Claim</option>
                    <option value="policy" @selected(request('report_type') == 'policy')>Policy</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">From</label>
                <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small">To</label>
                <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-2">
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
                                @default <span class="badge bg-secondary">{{ $report->status }}</span>
                            @endswitch
                        </td>
                        <td><small class="text-muted">{{ $report->sent_at?->format('d M Y H:i') ?? '—' }}</small></td>
                        <td><code>{{ $report->response_code ?? '—' }}</code></td>
                        <td class="pe-3">
                            <a href="{{ route('regulator.tiramis.reports.show', $report) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
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
