@extends('layouts.dashboard')

@section('dashboard_title', 'Insurance Sales')

@section('dashboard_content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1"><i class="bi bi-cart me-2"></i>Insurance Sales</h5>
                <p class="text-muted small mb-0">Track all insurance sales across branches</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-download me-2"></i>Export
                </button>
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-2"></i>New Sale
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Sales Stats -->
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
                        <small class="text-muted">Policies Sold</small>
                        <h5 class="fw-bold mb-0">156</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-file-earmark-text text-success"></i>
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
                        <small class="text-muted">This Month</small>
                        <h5 class="fw-bold mb-0">TZS 12.3M</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-calendar text-info"></i>
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
                        <small class="text-muted">Target</small>
                        <h5 class="fw-bold mb-0">92%</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-graph-up text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sales Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Recent Sales</h6>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-light" placeholder="Search sales...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Policy No</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Premium</th>
                        <th>Branch</th>
                        <th>Sold By</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="fw-semibold text-primary">POL-2024-001234</span></td>
                        <td>Hamis Juma</td>
                        <td>Motor Insurance</td>
                        <td>TZS 450,000</td>
                        <td>Branch A</td>
                        <td>John Doe</td>
                        <td>Today</td>
                        <td><span class="badge bg-success">Active</span></td>
                    </tr>
                    <tr>
                        <td><span class="fw-semibold text-primary">POL-2024-001235</span></td>
                        <td>Sarah Peter</td>
                        <td>Life Insurance</td>
                        <td>TZS 280,000</td>
                        <td>Branch B</td>
                        <td>Jane Smith</td>
                        <td>Yesterday</td>
                        <td><span class="badge bg-success">Active</span></td>
                    </tr>
                    <tr>
                        <td><span class="fw-semibold text-primary">POL-2024-001236</span></td>
                        <td>David Omondi</td>
                        <td>Health Insurance</td>
                        <td>TZS 120,000</td>
                        <td>Branch A</td>
                        <td>John Doe</td>
                        <td>2 days ago</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
