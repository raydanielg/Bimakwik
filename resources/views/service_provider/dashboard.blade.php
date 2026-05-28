@extends('layouts.dashboard')

@section('dashboard_title', 'Service Provider Dashboard')

@section('dashboard_content')
<!-- Service Provider Header Stats -->
<div class="row g-4 mb-4">
    <!-- Claims/Bills Submitted -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-file-earmark-medical fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">+12%</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Bills Submitted</h6>
                <h4 class="fw-bold mb-0">{{ $totalPayments }}</h4>
                <div class="x-small text-muted mt-2">Total Payments</div>
            </div>
        </div>
    </div>

    <!-- Approved Amount -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">94% Rate</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Approved Amount</h6>
                <h4 class="fw-bold mb-0">{{ $pendingPayments }} Pending</h4>
                <div class="x-small text-muted mt-2">Verified & Ready</div>
            </div>
        </div>
    </div>

    <!-- Paid Amount -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-cash-stack fs-4"></i>
                    </div>
                    <div class="text-primary small fw-bold">Settled</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Total Paid</h6>
                <h4 class="fw-bold mb-0">TZS {{ number_format($paidAmount / 1000000, 1) }}M</h4>
                <div class="x-small text-muted mt-2">Paid this month</div>
            </div>
        </div>
    </div>

    <!-- Average Processing Time -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <div class="text-warning small fw-bold">Fast Track</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Avg. Processing</h6>
                <h4 class="fw-bold mb-0">2.4 Days</h4>
                <div class="x-small text-muted mt-2">SLA Compliance</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Customer Verification Section -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-person-badge me-2 text-primary"></i>Customer Verification</h6>
            </div>
            <form class="mb-4">
                <div class="input-group mb-3 shadow-sm">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control border-start-0 py-2" placeholder="Policy No, National ID or Phone Number...">
                    <button class="btn btn-primary px-4" type="button">Verify Coverage</button>
                </div>
            </form>
            
            <div class="p-3 bg-light rounded-3 mb-4">
                <div class="d-flex align-items-center justify-content-center py-4 text-muted">
                    <div class="text-center">
                        <i class="bi bi-qr-code-scan fs-1 d-block mb-2"></i>
                        <p class="mb-0">Or scan Customer Policy QR Code</p>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mb-3 small">Recent Verifications</h6>
            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>Customer</th>
                            <th>Policy No</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hamis Juma</td>
                            <td>BK-MOT-77821</td>
                            <td><span class="badge bg-success-soft text-success">Active</span></td>
                            <td><button class="btn btn-sm btn-outline-primary py-0">View Limits</button></td>
                        </tr>
                        <tr>
                            <td>Sarah Peter</td>
                            <td>BK-HLT-22314</td>
                            <td><span class="badge bg-success-soft text-success">Active</span></td>
                            <td><button class="btn btn-sm btn-outline-primary py-0">View Limits</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm p-4 mb-4">
            <h6 class="fw-bold mb-4">Provider Quick Actions</h6>
            <div class="d-grid gap-2">
                <button class="btn btn-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-file-earmark-plus me-2"></i> Submit New Bill/Claim
                </button>
                <button class="btn btn-outline-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-bank me-2"></i> Payment Reconciliation
                </button>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <h6 class="fw-bold mb-3">Recent Bill Status</h6>
            <div class="list-group list-group-flush small">
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold">Bill #BILL-9021</div>
                        <div class="x-small text-muted">Aga Khan Hospital - BK-HLT-001</div>
                    </div>
                    <span class="badge bg-success-soft text-success rounded-pill">Approved</span>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-bold">Bill #BILL-9022</div>
                        <div class="x-small text-muted">Aga Khan Hospital - BK-HLT-002</div>
                    </div>
                    <span class="badge bg-info-soft text-info rounded-pill">Processing</span>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center border-0">
                    <div>
                        <div class="fw-bold">Bill #BILL-9023</div>
                        <div class="x-small text-muted">Aga Khan Hospital - BK-HLT-003</div>
                    </div>
                    <span class="badge bg-warning-soft text-warning rounded-pill">Pending Docs</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-info-soft { background-color: rgba(13, 202, 240, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
    .x-small { font-size: 0.7rem; }
</style>
@endsection
