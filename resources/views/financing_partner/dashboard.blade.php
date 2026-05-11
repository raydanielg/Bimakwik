@extends('layouts.dashboard')

@section('dashboard_title', 'Premium Financing Dashboard')

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
                    <div class="text-success small fw-bold">Active</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Active Loans</h6>
                <h4 class="fw-bold mb-0">1,245</h4>
                <div class="progress mt-2" style="height: 4px;">
                    <div class="progress-bar bg-primary" style="width: 75%"></div>
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
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Total Disbursed</h6>
                <h4 class="fw-bold mb-0">TZS 85.4M</h4>
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
                    <div class="badge bg-warning text-dark">28 New</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Pending Approvals</h6>
                <h4 class="fw-bold mb-0">28</h4>
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
                    <div class="text-danger small fw-bold">8.2% PAR</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Outstanding</h6>
                <h4 class="fw-bold mb-0">TZS 12.8M</h4>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Loan Requests & Risk Analytics -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Recent Financing Requests</h6>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-primary">Manual Entry</button>
                    <button class="btn btn-outline-primary">View All</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>Customer</th>
                            <th>Policy Type</th>
                            <th>Amount</th>
                            <th>Risk Score</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hamis Juma</td>
                            <td>Motor Comprehensive</td>
                            <td>TZS 850K</td>
                            <td><span class="text-success fw-bold">840 (A)</span></td>
                            <td><span class="badge bg-info-soft text-info">Verifying</span></td>
                            <td><button class="btn btn-sm btn-primary py-0">Review</button></td>
                        </tr>
                        <tr>
                            <td>Sarah Peter</td>
                            <td>Health Silver</td>
                            <td>TZS 1.2M</td>
                            <td><span class="text-warning fw-bold">620 (C)</span></td>
                            <td><span class="badge bg-warning-soft text-warning">Pending</span></td>
                            <td><button class="btn btn-sm btn-primary py-0">Review</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Collections & Reminders -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 mb-4">
            <h6 class="fw-bold mb-3">Collection Reminders</h6>
            <div class="list-group list-group-flush small">
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold text-danger">Overdue: BK-L-1022</div>
                        <div class="x-small text-muted">John Doe - 5 Days</div>
                    </div>
                    <button class="btn btn-sm btn-outline-danger py-0">Remind</button>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold">Due Today: BK-L-1025</div>
                        <div class="x-small text-muted">Jane Smith</div>
                    </div>
                    <span class="badge bg-success-soft text-success">Auto-Debit</span>
                </div>
            </div>
        </div>

        <!-- AI Risk Forecast -->
        <div class="card border-0 shadow-sm p-4 bg-light">
            <div class="d-flex align-items-center mb-2">
                <i class="bi bi-robot text-primary fs-4 me-2"></i>
                <h6 class="fw-bold mb-0 small">AI Risk Forecast</h6>
            </div>
            <p class="x-small text-muted mb-3">Predicted default rate for next month is stable at 4.2%. Recommend increasing limit for Grade A customers.</p>
            <div class="d-grid">
                <button class="btn btn-sm btn-outline-primary">View Risk Analytics</button>
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
