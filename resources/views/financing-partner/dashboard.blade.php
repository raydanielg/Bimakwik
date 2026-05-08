@extends('layouts.dashboard')

@section('dashboard_title', 'Premium Financing Dashboard')

@section('dashboard_content')
<!-- Financing Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-primary">
            <div class="card-body">
                <div class="stat-label">Pending Requests</div>
                <div class="stat-value">24</div>
                <div class="stat-trend text-primary"><i class="bi bi-inboxes"></i> Needs Review</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-success">
            <div class="card-body">
                <div class="stat-label">Total Disbursed</div>
                <div class="stat-value">TZS 145.8M</div>
                <div class="stat-trend text-success"><i class="bi bi-cash-stack"></i> Active Portfolio</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-info">
            <div class="card-body">
                <div class="stat-label">Repayments (MTD)</div>
                <div class="stat-value">TZS 42.5M</div>
                <div class="stat-trend text-success"><i class="bi bi-arrow-repeat"></i> On track</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-danger">
            <div class="card-body">
                <div class="stat-label">Default Rate</div>
                <div class="stat-value">1.2%</div>
                <div class="stat-trend text-danger"><i class="bi bi-exclamation-triangle"></i> Watch list</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Active Financing Requests -->
    <div class="col-lg-8">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Recent Financing Requests</h6>
                <a href="#" class="btn btn-sm btn-link text-decoration-none">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>Customer</th>
                            <th>Insurer</th>
                            <th>Premium Amount</th>
                            <th>Loan Term</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bakari Mwinyi</td>
                            <td>Alliance Insurance</td>
                            <td>TZS 1,200,000</td>
                            <td>6 Months</td>
                            <td>
                                <button class="btn btn-sm btn-outline-success">Approve</button>
                                <button class="btn btn-sm btn-outline-danger">Reject</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Zainab Salum</td>
                            <td>Jubilee Insurance</td>
                            <td>TZS 850,000</td>
                            <td>3 Months</td>
                            <td>
                                <button class="btn btn-sm btn-outline-success">Approve</button>
                                <button class="btn btn-sm btn-outline-danger">Reject</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Repayment Performance -->
    <div class="col-lg-4">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-4">Repayment Performance</h6>
            <div class="mb-4 text-center">
                <div style="width: 140px; height: 140px; margin: 0 auto; border: 12px solid #f1f5f9; border-top: 12px solid #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <div class="text-center">
                        <span class="d-block fw-bold fs-4">98%</span>
                        <span class="small text-muted">Recovery</span>
                    </div>
                </div>
            </div>
            <div class="list-group list-group-flush small">
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <span>Paid on Time</span>
                    <span class="fw-bold text-success">92%</span>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <span>Grace Period</span>
                    <span class="fw-bold text-warning">6%</span>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <span>Overdue</span>
                    <span class="fw-bold text-danger">2%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
</style>
@endsection
