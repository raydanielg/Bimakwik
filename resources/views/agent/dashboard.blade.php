@extends('layouts.dashboard')

@section('dashboard_title', 'Agent Dashboard')

@section('dashboard_content')
<!-- Agent Performance Overview -->
<div class="row g-4 mb-4">
    <!-- Sales Target vs Achievement -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-graph-up-arrow fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">78% Target</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Sales Target</h6>
                <h4 class="fw-bold mb-0">TZS 15.2M</h4>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Commission Earned -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-cash-coin fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> +5.2%</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Commission Earned</h6>
                <h4 class="fw-bold mb-0">TZS 2.4M</h4>
            </div>
        </div>
    </div>

    <!-- Upcoming Renewals -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <div class="badge bg-warning text-dark">12 Pending</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Upcoming Renewals</h6>
                <h4 class="fw-bold mb-0">12</h4>
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
                    <div class="text-primary small fw-bold">+8 this mo</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Active Customers</h6>
                <h4 class="fw-bold mb-0">210</h4>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- My Daily Activity -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Daily Sales Activity</h6>
                <a href="#" class="btn btn-sm btn-outline-primary">View Calendar</a>
            </div>
            <div class="timeline-small">
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 text-center me-3" style="width: 50px;">
                        <div class="small fw-bold text-muted">08:30</div>
                        <div class="small text-muted">AM</div>
                    </div>
                    <div class="flex-grow-1 border-start ps-3 pb-3 border-primary border-2">
                        <h6 class="mb-1 fw-bold">Follow up: Sarah Peter</h6>
                        <p class="small text-muted mb-0">Renewal reminder for Health Insurance</p>
                    </div>
                </div>
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0 text-center me-3" style="width: 50px;">
                        <div class="small fw-bold text-muted">10:00</div>
                        <div class="small text-muted">AM</div>
                    </div>
                    <div class="flex-grow-1 border-start ps-3 pb-3 border-success border-2">
                        <h6 class="mb-1 fw-bold">Quote Generation</h6>
                        <p class="small text-muted mb-0">Bulk quote for Corporate Motor fleet</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="flex-shrink-0 text-center me-3" style="width: 50px;">
                        <div class="small fw-bold text-muted">03:30</div>
                        <div class="small text-muted">PM</div>
                    </div>
                    <div class="flex-grow-1 border-start ps-3 border-warning border-2">
                        <h6 class="mb-1 fw-bold">Claim Document Verification</h6>
                        <p class="small text-muted mb-0">Reviewing docs for Hamis Juma's claim</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Pending Claims -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 mb-4">
            <h6 class="fw-bold mb-3">Quick Sales Actions</h6>
            <div class="d-grid gap-2">
                <button class="btn btn-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-cart-plus me-2"></i> Buy New Policy
                </button>
                <button class="btn btn-outline-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-file-earmark-plus me-2"></i> Generate Quote
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <h6 class="fw-bold mb-3">Pending Claims Status</h6>
            <div class="list-group list-group-flush small">
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold">CLM-10293</div>
                        <div class="x-small text-muted">Hamis Juma</div>
                    </div>
                    <span class="badge bg-info-soft text-info rounded-pill">In Review</span>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold">CLM-10294</div>
                        <div class="x-small text-muted">Sarah Peter</div>
                    </div>
                    <span class="badge bg-warning-soft text-warning rounded-pill">Pending Docs</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-info-soft { background-color: rgba(13, 202, 240, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
    .x-small { font-size: 0.75rem; }
</style>
@endsection
