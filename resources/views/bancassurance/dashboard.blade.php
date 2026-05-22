@extends('layouts.dashboard')

@section('dashboard_title', 'Bancassurance Dashboard')

@section('dashboard_content')
<!-- Simple Clean Navigation Menu -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-bank me-2"></i>Bancassurance Portal</h5>
                <div class="row g-3">
                    <div class="col-md-6 col-lg-4">
                        <a href="/bancassurance/integration" class="text-decoration-none">
                            <div class="card border-0 bg-light h-100 hover-shadow transition-all">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-link-45deg text-primary fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">Bank Integration</h6>
                                        <small class="text-muted">Connect bank systems</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/bancassurance/customers" class="text-decoration-none">
                            <div class="card border-0 bg-light h-100 hover-shadow transition-all">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-people text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">Bank Customers</h6>
                                        <small class="text-muted">Manage customers</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/bancassurance/sales" class="text-decoration-none">
                            <div class="card border-0 bg-light h-100 hover-shadow transition-all">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-cart text-info fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">Insurance Sales</h6>
                                        <small class="text-muted">Track all sales</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/bancassurance/my-sales" class="text-decoration-none">
                            <div class="card border-0 bg-light h-100 hover-shadow transition-all">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-person-lines-fill text-warning fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">My Sales</h6>
                                        <small class="text-muted">My performance</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/bancassurance/products" class="text-decoration-none">
                            <div class="card border-0 bg-light h-100 hover-shadow transition-all">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-danger bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-box-seam text-danger fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">Bancassurance Products</h6>
                                        <small class="text-muted">Product catalog</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/bancassurance/reports" class="text-decoration-none">
                            <div class="card border-0 bg-light h-100 hover-shadow transition-all">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-secondary bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-file-earmark-bar-graph text-secondary fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">Compliance & Reports</h6>
                                        <small class="text-muted">Reports & compliance</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/bancassurance/compliance" class="text-decoration-none">
                            <div class="card border-0 bg-light h-100 hover-shadow transition-all">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-shield-check text-primary fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">Compliance</h6>
                                        <small class="text-muted">Compliance management</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="/bancassurance/performance" class="text-decoration-none">
                            <div class="card border-0 bg-light h-100 hover-shadow transition-all">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-graph-up text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">Performance</h6>
                                        <small class="text-muted">Analytics & metrics</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<style>
    .hover-shadow:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }
    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endsection
