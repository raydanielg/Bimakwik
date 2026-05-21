@extends('layouts.dashboard')

@section('dashboard_title', __('sfe.dashboard_title'))

@section('dashboard_content')
@php
    $walletBalance = $wallet->balance ?? 0;
@endphp

<div class="card border-0 shadow-sm p-4 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
        <div>
            <p class="text-uppercase small text-muted mb-1">{{ __('sfe.sales_force_executive') }}</p>
            <h5 class="fw-bold mb-2">{{ $customer->customer_number ?? __('sfe.portfolio_overview') }}</h5>
            <p class="text-muted mb-0">{{ __('sfe.live_portfolio_summary') }}</p>
        </div>
        <div class="text-end">
            <div class="small text-muted">{{ __('sfe.wallet_balance') }}</div>
            <div class="fs-4 fw-bold">TZS {{ number_format($walletBalance, 2) }}</div>
        </div>
    </div>
</div>

<!-- SFE Performance Overview -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-graph-up-arrow fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">{{ __('sfe.live') }}</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('sfe.sales_achievement') }}</h6>
                <h4 class="fw-bold mb-0">TZS {{ number_format($totalPremiums, 2) }}</h4>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ min(100, max(10, $activePoliciesCount * 10)) }}%" aria-valuenow="{{ min(100, max(10, $activePoliciesCount * 10)) }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Commissions Earned -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-cash-coin fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> Live</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('sfe.total_commission') }}</h6>
                <h4 class="fw-bold mb-0">TZS {{ number_format($approvedClaimsTotal, 2) }}</h4>
            </div>
        </div>
    </div>

    <!-- Leaderboard Rank -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-trophy fs-4"></i>
                    </div>
                    <div class="badge bg-warning text-dark">{{ $activePoliciesCount }} active</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('sfe.leaderboard_rank') }}</h6>
                <h4 class="fw-bold mb-0">{{ $openClaimsCount }} claims</h4>
            </div>
        </div>
    </div>

    <!-- Active Customers -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div class="text-primary small fw-bold">{{ $recentPolicies->count() }} recent</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('sfe.active_customers') }}</h6>
                <h4 class="fw-bold mb-0">{{ $activePoliciesCount }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">{{ __('sfe.recent_policies') }}</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('sfe.policy_no') }}</th>
                            <th>{{ __('sfe.status') }}</th>
                            <th>{{ __('sfe.premium') }}</th>
                            <th>{{ __('sfe.ends') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPolicies as $policy)
                            <tr>
                                <td class="fw-semibold">{{ $policy->policy_number }}</td>
                                <td><span class="badge bg-success-soft text-success">{{ ucfirst($policy->status) }}</span></td>
                                <td>TZS {{ number_format($policy->premium_amount, 2) }}</td>
                                <td>{{ $policy->end_date }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">{{ __('sfe.no_policies_found_yet') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-4">{{ __('sfe.recent_claims') }}</h6>
            <div class="list-group list-group-flush small mb-4">
                @forelse($recentClaims as $claim)
                    <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold">{{ $claim->claim_number }}</div>
                            <div class="x-small text-muted">{{ ucfirst($claim->claim_type) }}</div>
                        </div>
                        <span class="badge bg-info-soft text-info">{{ ucfirst($claim->status) }}</span>
                    </div>
                @empty
                    <div class="text-muted small">{{ __('sfe.no_claims_recorded_yet') }}</div>
                @endforelse
            </div>
            <h6 class="fw-bold mb-3">{{ __('sfe.sfe_quick_actions') }}</h6>
            <div class="d-grid gap-3">
                <a href="{{ route('sfe.customers.create') }}" class="btn btn-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-plus-circle me-2"></i> {{ __('sfe.add_new_customer') }}
                </a>
                <a href="{{ route('sfe.policies.buy') }}" class="btn btn-outline-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-cart-plus me-2"></i> {{ __('sfe.buy_new_policy') }}
                </a>
                <a href="{{ route('sfe.claims.submit') }}" class="btn btn-outline-info d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-file-earmark-check me-2"></i> {{ __('sfe.submit_claim') }}
                </a>
                <a href="{{ route('sfe.commissions.index') }}" class="btn btn-outline-success d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-wallet2 me-2"></i> {{ __('sfe.request_commission') }}
                </a>
            </div>
            <div class="mt-4 p-3 bg-light rounded-3">
                <h6 class="small fw-bold mb-2">{{ __('sfe.latest_wallet_activity') }}</h6>
                <div class="d-flex justify-content-between mb-1">
                    <span class="small text-muted">{{ __('sfe.transactions') }}</span>
                    <span class="small fw-bold">{{ $recentTransactions->count() }}</span>
                </div>
                <div class="progress" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ min(100, $recentTransactions->count() * 20) }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
