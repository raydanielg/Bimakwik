@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">TIRAMIS Oversight Dashboard</h4>
        <small class="text-muted">Regulatory monitoring of TIRA MIS integration across the market</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('regulator.tiramis.market') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
            <i class="bi bi-graph-up me-1"></i> Market Overview
        </a>
        <a href="{{ route('regulator.tiramis.companies') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-building me-1"></i> Companies
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-primary mb-1">{{ $stats['total_companies'] ?? 0 }}</h5>
                <small class="text-muted">Active Companies (TIRAMIS)</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-success mb-1">{{ $stats['total_reports'] ?? 0 }}</h5>
                <small class="text-muted">Total Reports</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-info bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-info mb-1">{{ $stats['total_logs'] ?? 0 }}</h5>
                <small class="text-muted">Integration Calls</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
            <div class="card-body text-center">
                <h5 class="fw-bold text-warning mb-1">{{ $stats['failed_reports'] ?? 0 }}</h5>
                <small class="text-muted">Failed Reports</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-semibold mb-0">Recent Reports</h6>
                <a href="{{ route('regulator.tiramis.reports') }}" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Report #</th>
                                <th>Company</th>
                                <th>Claim #</th>
                                <th>Status</th>
                                <th>Sent At</th>
                                <th class="pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReports as $report)
                            <tr>
                                <td class="ps-3"><code>{{ $report->report_number }}</code></td>
                                <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $report->company_code ?? '—' }}</span></td>
                                <td>{{ $report->claim?->claim_number ?? 'N/A' }}</td>
                                <td>
                                    @switch($report->status)
                                        @case('sent') <span class="badge bg-success">Sent</span> @break
                                        @case('failed') <span class="badge bg-danger">Failed</span> @break
                                        @case('pending') <span class="badge bg-warning text-dark">Pending</span> @break
                                        @default <span class="badge bg-secondary">{{ $report->status }}</span>
                                    @endswitch
                                </td>
                                <td><small class="text-muted">{{ $report->sent_at?->diffForHumans() ?? '—' }}</small></td>
                                <td class="pe-3">
                                    <a href="{{ route('regulator.tiramis.reports.show', $report) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No reports yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Company Activity</h6>
            </div>
            <div class="card-body">
                @forelse($companyCodes as $cc)
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <span class="badge bg-primary bg-opacity-10 text-primary">{{ $cc->company_code }}</span>
                    <span class="fw-bold">{{ $cc->total }} reports</span>
                </div>
                @empty
                <small class="text-muted">No company activity data</small>
                @endforelse
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h6 class="fw-semibold mb-0">Recent Logs</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($recentLogs as $log)
                    <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                        <div>
                            <small class="d-block">{{ ucfirst(str_replace('_', ' ', $log->action)) }}</small>
                            <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                        </div>
                        <span class="badge bg-{{ $log->status === 'success' ? 'success' : ($log->status === 'failed' ? 'danger' : 'secondary') }}">
                            {{ $log->status }}
                        </span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted text-center py-3">No logs</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
