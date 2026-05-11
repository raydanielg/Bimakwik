@extends('layouts.dashboard')

@section('dashboard_title', 'SFE Dashboard - Sales Force Executive')

@section('dashboard_content')
<!-- SFE Performance Overview -->
<div class="row g-4 mb-4">
    <!-- Total Sales Achievement -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-graph-up-arrow fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">85% Target</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Sales Achievement</h6>
                <h4 class="fw-bold mb-0">TZS 12.5M</h4>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
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
                    <div class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> +12.5%</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Total Commission</h6>
                <h4 class="fw-bold mb-0">TZS 1.8M</h4>
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
                    <div class="badge bg-warning text-dark">Top 10%</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Leaderboard Rank</h6>
                <h4 class="fw-bold mb-0">#12</h4>
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
                    <div class="text-primary small fw-bold">+5 this wk</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Active Customers</h6>
                <h4 class="fw-bold mb-0">142</h4>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- My Daily Activities -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Daily Sales Activity</h6>
                <a href="#" class="btn btn-sm btn-outline-primary">View Calendar</a>
            </div>
            <div class="timeline-small">
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 text-center me-3" style="width: 50px;">
                        <div class="small fw-bold text-muted">09:00</div>
                        <div class="small text-muted">AM</div>
                    </div>
                    <div class="flex-grow-1 border-start ps-3 pb-3 border-primary border-2">
                        <h6 class="mb-1 fw-bold">Customer Meeting - Hamis Juma</h6>
                        <p class="small text-muted mb-0">Discussion on Motor Comprehensive renewal</p>
                    </div>
                </div>
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 text-center me-3" style="width: 50px;">
                        <div class="small fw-bold text-muted">11:30</div>
                        <div class="small text-muted">AM</div>
                    </div>
                    <div class="flex-grow-1 border-start ps-3 pb-3 border-info border-2">
                        <h6 class="mb-1 fw-bold">KYC Verification</h6>
                        <p class="small text-muted mb-0">Process KYC for 3 new health insurance leads</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="flex-shrink-0 text-center me-3" style="width: 50px;">
                        <div class="small fw-bold text-muted">02:00</div>
                        <div class="small text-muted">PM</div>
                    </div>
                    <div class="flex-grow-1 border-start ps-3 border-success border-2">
                        <h6 class="mb-1 fw-bold">Training Session</h6>
                        <p class="small text-muted mb-0">New Life Insurance product module</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-4">SFE Quick Actions</h6>
            <div class="d-grid gap-3">
                <a href="#" class="btn btn-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-plus-circle me-2"></i> Add New Customer
                </a>
                <a href="#" class="btn btn-outline-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-cart-plus me-2"></i> Buy New Policy
                </a>
                <a href="#" class="btn btn-outline-info d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-file-earmark-check me-2"></i> Submit Claim
                </a>
                <a href="#" class="btn btn-outline-success d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-wallet2 me-2"></i> Request Commission
                </a>
            </div>
            <div class="mt-4 p-3 bg-light rounded-3">
                <h6 class="small fw-bold mb-2">My Target Achievement</h6>
                <div class="d-flex justify-content-between mb-1">
                    <span class="small text-muted">Current Sales</span>
                    <span class="small fw-bold">12.5M / 15M</span>
                </div>
                <div class="progress" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 83%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
