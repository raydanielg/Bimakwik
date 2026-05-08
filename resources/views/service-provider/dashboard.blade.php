@extends('layouts.dashboard')

@section('dashboard_title', 'Service Provider Dashboard')

@section('dashboard_content')
<!-- Provider Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-primary">
            <div class="card-body">
                <div class="stat-label">Bills Submitted</div>
                <div class="stat-value">145</div>
                <div class="stat-trend text-primary"><i class="bi bi-file-earmark-text"></i> Total this month</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-warning">
            <div class="card-body">
                <div class="stat-label">Pending Approval</div>
                <div class="stat-value">12</div>
                <div class="stat-trend text-warning"><i class="bi bi-clock"></i> Needs Review</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-success">
            <div class="card-body">
                <div class="stat-label">Paid Amount</div>
                <div class="stat-value">TZS 12.5M</div>
                <div class="stat-trend text-success"><i class="bi bi-check-circle"></i> Successfully paid</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-danger">
            <div class="card-body">
                <div class="stat-label">Rejected Bills</div>
                <div class="stat-value">3</div>
                <div class="stat-trend text-danger"><i class="bi bi-x-octagon"></i> View reasons</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Verification Quick Search -->
    <div class="col-lg-6">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-4"><i class="bi bi-person-vcard me-2 text-primary"></i> Quick Customer Verification</h6>
            <form>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Policy Number / ID / Phone</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter details to verify...">
                        <button class="btn btn-primary" type="button">Verify</button>
                    </div>
                </div>
                <div class="p-3 bg-light rounded-3 border border-dashed text-center small text-muted">
                    Verification results will appear here after searching.
                </div>
            </form>
        </div>
    </div>
    
    <!-- Recent Bills Status -->
    <div class="col-lg-6">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Recent Bill Submissions</h6>
                <a href="#" class="btn btn-sm btn-link text-decoration-none">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead>
                        <tr>
                            <th>Patient/Moter</th>
                            <th>Bill No.</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Juma Bakari</td>
                            <td>#INV-9901</td>
                            <td>45,000</td>
                            <td><span class="badge bg-warning-soft text-warning">Pending</span></td>
                        </tr>
                        <tr>
                            <td>Anna Peter</td>
                            <td>#INV-9850</td>
                            <td>120,000</td>
                            <td><span class="badge bg-success-soft text-success">Approved</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
</style>
@endsection
