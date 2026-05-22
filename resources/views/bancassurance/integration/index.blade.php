@extends('layouts.dashboard')

@section('dashboard_title', 'Bank Integration')

@push('styles')
<style>
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }
    .modal-header {
        border-bottom: 1px solid #e9ecef;
        padding: 1.5rem;
    }
    .modal-body {
        padding: 1.5rem;
    }
    .modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 1.5rem;
    }
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        border-radius: 8px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }
</style>
@endpush

@section('dashboard_content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1"><i class="bi bi-link-45deg me-2"></i>Bank Integration</h5>
                <p class="text-muted small mb-0">Connect and manage bank system integrations</p>
            </div>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addIntegrationModal">
                <i class="bi bi-plus-lg me-2"></i>Add Integration
            </button>
        </div>
    </div>
</div>

<!-- Integration Status -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Active Integrations</small>
                        <h5 class="fw-bold mb-0">3</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-check-circle text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Pending Setup</small>
                        <h5 class="fw-bold mb-0">1</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-clock text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">API Calls Today</small>
                        <h5 class="fw-bold mb-0">1,245</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-activity text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bank Integrations List -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h6 class="fw-bold mb-3">Connected Banks</h6>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Bank Name</th>
                        <th>Integration Type</th>
                        <th>Status</th>
                        <th>Last Sync</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-bank text-primary"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">CRDB Bank</div>
                                    <small class="text-muted">Tanzania</small>
                                </div>
                            </div>
                        </td>
                        <td>API Integration</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>2 mins ago</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">Sync</button>
                            <button class="btn btn-sm btn-outline-secondary">Settings</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-bank text-success"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">NMB Bank</div>
                                    <small class="text-muted">Tanzania</small>
                                </div>
                            </div>
                        </td>
                        <td>API Integration</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>5 mins ago</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">Sync</button>
                            <button class="btn btn-sm btn-outline-secondary">Settings</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-bank text-warning"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">NBC Bank</div>
                                    <small class="text-muted">Tanzania</small>
                                </div>
                            </div>
                        </td>
                        <td>API Integration</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>Never</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary">Setup</button>
                            <button class="btn btn-sm btn-outline-secondary">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
