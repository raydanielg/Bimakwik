@extends('layouts.dashboard')

@section('dashboard_title', __('broker.dashboard_title'))

@section('dashboard_content')
<!-- Broker Stats -->
<div class="row g-4 mb-4">
    <!-- Total Premiums Sold -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-cart-check fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold"><i class="bi bi-graph-up"></i> +15.5%</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('broker.total_premiums_sold') }}</h6>
                <h4 class="fw-bold mb-0">TZS 85.2M</h4>
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
                    <div class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> +8.2%</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('broker.commissions_earned') }}</h6>
                <h4 class="fw-bold mb-0">TZS 12.4M</h4>
            </div>
        </div>
    </div>

    <!-- Active Policies -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                    <div class="text-primary small fw-bold">+45 new</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('broker.active_policies') }}</h6>
                <h4 class="fw-bold mb-0">1,120</h4>
            </div>
        </div>
    </div>

    <!-- Pending Renewals -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <div class="text-warning small fw-bold">Next 7 days</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('broker.pending_renewals') }}</h6>
                <h4 class="fw-bold mb-0">28</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-info bg-opacity-10 text-info rounded-3 p-3 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-graph-up-arrow fs-3"></i>
                </div>
                <div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('broker.traffic_and_leads') }}</h6>
                    <h3 class="fw-bold mb-0">450 / 18</h3>
                    <div class="mt-1 small text-info">
                        <i class="bi bi-activity"></i> {{ __('broker.engagement') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <!-- Quick Actions -->
    <div class="col-lg-8">
        <div class="card p-4">
            <h6 class="fw-bold mb-4">{{ __('broker.recent_sales') }}</h6>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('broker.customer') }}</th>
                            <th>{{ __('broker.policy_type') }}</th>
                            <th>{{ __('broker.insurer') }}</th>
                            <th>{{ __('broker.premium') }}</th>
                            <th>{{ __('broker.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hamis Juma</td>
                            <td>Motor Comprehensive</td>
                            <td>Alliance Insurance</td>
                            <td>TZS 450,000</td>
                            <td><span class="badge bg-success-soft text-success">{{ __('broker.active') }}</span></td>
                        </tr>
                        <tr>
                            <td>Sarah Peter</td>
                            <td>Health Silver</td>
                            <td>Jubilee Insurance</td>
                            <td>TZS 850,000</td>
                            <td><span class="badge bg-success-soft text-success">{{ __('broker.active') }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Wallet Summary -->
    <div class="col-lg-4">
        <div class="card p-4 h-100 bg-primary text-white">
            <h6 class="fw-bold mb-4 opacity-75">{{ __('broker.my_wallet_balance') }}</h6>
            <div class="mb-4 text-center">
                <h2 class="fw-bold">TZS 4,250,000</h2>
                <span class="small opacity-75">{{ __('broker.available_for_cash_out') }}</span>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-light fw-bold py-2">{{ __('broker.request_cash_out') }}</button>
                <button class="btn btn-outline-light py-2">{{ __('broker.transaction_history') }}</button>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
</style>
@endsection
