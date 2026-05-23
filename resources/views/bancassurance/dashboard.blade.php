@extends('layouts.dashboard')

@section('dashboard_title', 'Bancassurance Dashboard')

@section('dashboard_content')
<!-- Quick Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Sales</small>
                        <h5 class="fw-bold mb-0">TZS 45.8M</h5>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-cash-stack text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">My Commission</small>
                        <h5 class="fw-bold mb-0">TZS 3.2M</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-wallet text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Policies Sold</small>
                        <h5 class="fw-bold mb-0">156</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-file-earmark-text text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Pending Renewals</small>
                        <h5 class="fw-bold mb-0">18</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-clock-history text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Recent Activity</h6>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Motor Insurance Sale</td>
                                <td>Hamis Juma</td>
                                <td>TZS 450,000</td>
                                <td>Today, 09:15 AM</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Life Insurance Sale</td>
                                <td>Sarah Peter</td>
                                <td>TZS 280,000</td>
                                <td>Yesterday</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                            <tr>
                                <td>Health Insurance Sale</td>
                                <td>David Omondi</td>
                                <td>TZS 120,000</td>
                                <td>2 days ago</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
