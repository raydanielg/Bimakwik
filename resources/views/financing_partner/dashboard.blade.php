@extends('layouts.dashboard')

@section('dashboard_title', __('financing_partner.dashboard_title'))

@section('dashboard_content')
<!-- Financing Overview Stats -->
<div class="row g-4 mb-4">
    <!-- Active Loans -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-wallet2 fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">{{ __('financing_partner.active') }}</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('financing_partner.active_loans') }}</h6>
                <h4 class="fw-bold mb-0"><span class="stat-count">{{ $activeLoans }}</span></h4>
                <div class="progress mt-2" style="height: 4px;">
                    <div class="progress-bar bg-primary" style="width: {{ $totalLoans > 0 ? round(($activeLoans/$totalLoans)*100) : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Disbursed -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-cash-stack fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">+15% mo</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('financing_partner.total_disbursed') }}</h6>
                <h4 class="fw-bold mb-0">TZS <span class="stat-count">{{ number_format($totalDisbursed / 1000000, 1) }}M</h4>
            </div>
        </div>
    </div>

    <!-- Pending Approvals -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <div class="badge bg-warning text-dark">{{ $pendingRequests }} {{ __('financing_partner.new_short') }}</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('financing_partner.pending_approvals') }}</h6>
                <h4 class="fw-bold mb-0"><span class="stat-count">{{ $pendingRequests }}</span></h4>
            </div>
        </div>
    </div>

    <!-- Outstanding Balance -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-exclamation-triangle fs-4"></i>
                    </div>
                    <div class="text-danger small fw-bold">{{ $defaultRate }}% PAR</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('financing_partner.outstanding') }}</h6>
                <h4 class="fw-bold mb-0">TZS <span class="stat-count">{{ number_format($repaymentsThisMonth / 1000000, 1) }}M</h4>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Loan Requests & Risk Analytics -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">{{ __('financing_partner.recent_requests') }}</h6>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-primary">{{ __('financing_partner.manual_entry') }}</button>
                    <button class="btn btn-outline-primary">{{ __('financing_partner.view_all') }}</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('financing_partner.customer') }}</th>
                            <th>{{ __('financing_partner.policy_type') }}</th>
                            <th>{{ __('financing_partner.amount') }}</th>
                            <th>{{ __('financing_partner.risk_score') }}</th>
                            <th>{{ __('financing_partner.status') }}</th>
                            <th>{{ __('financing_partner.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRequests as $req)
                        <tr>
                            <td>{{ optional(optional(optional($req->customer)->user)->name) ?? 'N/A' }}</td>
                            <td>{{ optional(optional($req->customerPolicy)->insuranceProduct)->product_name ?? '-' }}</td>
                            <td>TZS {{ number_format($req->financing_amount) }}</td>
                            <td><span class="text-muted fw-bold">-</span></td>
                            <td>
                                @php
                                    $sc = match($req->status) { 'approved'=>'bg-success', 'pending'=>'bg-warning-soft text-warning', 'rejected'=>'bg-danger', default=>'bg-secondary' };
                                @endphp
                                <span class="badge {{ $sc }}">{{ ucfirst($req->status) }}</span>
                            </td>
                            <td><button class="btn btn-sm btn-primary py-0">{{ __('financing_partner.review') }}</button></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">No requests found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Collections & Reminders -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 mb-4">
            <h6 class="fw-bold mb-3">{{ __('financing_partner.collection_reminders') }}</h6>
            <div class="list-group list-group-flush small">
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold text-danger">{{ __('financing_partner.overdue') }}: BK-L-1022</div>
                        <div class="x-small text-muted">John Doe - 5 {{ __('financing_partner.days') }}</div>
                    </div>
                    <button class="btn btn-sm btn-outline-danger py-0">{{ __('financing_partner.remind') }}</button>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold">{{ __('financing_partner.due_today') }}: BK-L-1025</div>
                        <div class="x-small text-muted">Jane Smith</div>
                    </div>
                    <span class="badge bg-success-soft text-success">{{ __('financing_partner.auto_debit') }}</span>
                </div>
            </div>
        </div>

        <!-- AI Risk Forecast -->
        <div class="card border-0 shadow-sm p-4 bg-light">
            <div class="d-flex align-items-center mb-2">
                <i class="bi bi-robot text-primary fs-4 me-2"></i>
                <h6 class="fw-bold mb-0 small">{{ __('financing_partner.ai_risk_forecast') }}</h6>
            </div>
            <p class="x-small text-muted mb-3">{{ __('financing_partner.ai_forecast_body') }}</p>
            <div class="d-grid">
                <button class="btn btn-sm btn-outline-primary">{{ __('financing_partner.view_risk_analytics') }}</button>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-info-soft { background-color: rgba(13, 202, 240, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .x-small { font-size: 0.7rem; }
</style>
@endsection
