@extends('layouts.dashboard')
@section('dashboard_title', 'Fraud Alerts')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Fraud Alerts</h4>
        <p class="text-muted mb-0 small">Flagged claims requiring investigation</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-shield-exclamation fs-4"></i></div>
                <div>
                    <div class="text-muted small">High Risk Alerts</div>
                    <div class="fw-bold fs-5">{{ $highRiskCount }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-exclamation-triangle fs-4"></i></div>
                <div>
                    <div class="text-muted small">Total Alerts</div>
                    <div class="fw-bold fs-5">{{ $fraudAlerts->total() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Claim Ref</th>
                        <th>Customer</th>
                        <th>Risk Level</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fraudAlerts as $alert)
                    <tr>
                        <td class="ps-4"><code class="small">{{ optional($alert->claim)->claim_number ?? '-' }}</code></td>
                        <td class="fw-bold">{{ optional(optional($alert->claim)->customer)->name ?? 'N/A' }}</td>
                        <td>
                            @if($alert->risk_level === 'high')
                                <span class="badge bg-danger">High</span>
                            @elseif($alert->risk_level === 'medium')
                                <span class="badge bg-warning text-dark">Medium</span>
                            @else
                                <span class="badge bg-info">Low</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ Str::limit($alert->reason ?? $alert->description ?? '—', 60) }}</td>
                        <td>
                            @if($alert->status === 'resolved')
                                <span class="badge bg-success-subtle text-success">Resolved</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger">Open</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $alert->created_at?->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-shield-check fs-2 d-block mb-2 opacity-25"></i>
                            No fraud alerts found. All looks good!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($fraudAlerts instanceof \Illuminate\Pagination\LengthAwarePaginator && $fraudAlerts->hasPages())
    <div class="card-footer bg-white border-0 py-3 px-4">{{ $fraudAlerts->links() }}</div>
    @endif
</div>
@endsection
