@extends('layouts.dashboard')

@section('dashboard_title', 'Compliance')

@section('dashboard_content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1"><i class="bi bi-shield-check me-2"></i>Compliance</h5>
                <p class="text-muted small mb-0">Manage regulatory compliance and requirements</p>
            </div>
            <button class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-2"></i>Add Check
            </button>
        </div>
    </div>
</div>

<!-- Compliance Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Compliance Score</small>
                        <h5 class="fw-bold mb-0">96%</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-shield-check text-success"></i>
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
                        <small class="text-muted">Pending Checks</small>
                        <h5 class="fw-bold mb-0">3</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-clock text-warning"></i>
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
                        <small class="text-muted">Completed</small>
                        <h5 class="fw-bold mb-0">42</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-check-circle text-info"></i>
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
                        <small class="text-muted">Next Audit</small>
                        <h5 class="fw-bold mb-0">5 Days</h5>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-calendar text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Compliance Checklist -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Compliance Checklist</h6>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-light" placeholder="Search checks...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Check Item</th>
                        <th>Category</th>
                        <th>Due Date</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AML/KYC Verification</td>
                        <td>Regulatory</td>
                        <td>May 25, 2024</td>
                        <td>John Doe</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Data Protection Audit</td>
                        <td>Privacy</td>
                        <td>May 28, 2024</td>
                        <td>Jane Smith</td>
                        <td><span class="badge bg-warning">In Progress</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td>TIRA Compliance Report</td>
                        <td>Regulatory</td>
                        <td>May 30, 2024</td>
                        <td>John Doe</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
