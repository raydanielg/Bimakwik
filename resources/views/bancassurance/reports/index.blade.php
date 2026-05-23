@extends('layouts.dashboard')

@section('dashboard_title', 'Compliance & Reports')

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
    
    /* PDF Preview Modal Styles */
    .pdf-preview-container {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 2rem;
        max-height: 500px;
        overflow-y: auto;
    }
    
    .pdf-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #0d6efd;
    }
    
    .pdf-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #0d6efd;
        margin-bottom: 0.5rem;
    }
    
    .pdf-subtitle {
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    .pdf-section {
        margin-bottom: 1.5rem;
    }
    
    .pdf-section-title {
        font-weight: bold;
        color: #343a40;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    
    .pdf-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }
    
    .pdf-table th,
    .pdf-table td {
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        text-align: left;
    }
    
    .pdf-table th {
        background: #e9ecef;
        font-weight: bold;
    }
    
    .pdf-footer {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #dee2e6;
        text-align: center;
        color: #6c757d;
        font-size: 0.85rem;
    }
</style>
@endpush

@section('dashboard_content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1"><i class="bi bi-file-earmark-bar-graph me-2"></i>Compliance & Reports</h5>
                <p class="text-muted small mb-0">Generate and manage compliance reports</p>
            </div>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#generateReportModal">
                <i class="bi bi-plus-lg me-2"></i>Generate Report
            </button>
        </div>
    </div>
</div>

<!-- Report Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Reports</small>
                        <h5 class="fw-bold mb-0">45</h5>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-file-earmark text-primary"></i>
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
                        <h5 class="fw-bold mb-0">12</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-calendar text-success"></i>
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
                        <small class="text-muted">Pending Review</small>
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
                        <small class="text-muted">Compliance Score</small>
                        <h5 class="fw-bold mb-0">96%</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-shield-check text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reports Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Recent Reports</h6>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-light" placeholder="Search reports...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>Report Type</th>
                        <th>Period</th>
                        <th>Generated By</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="fw-semibold text-primary">RPT-2024-001</span></td>
                        <td>Monthly Sales Report</td>
                        <td>May 2024</td>
                        <td>John Doe</td>
                        <td>Today</td>
                        <td>
                            <span class="badge bg-success d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-1"></i>Approved
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-report-btn" data-id="RPT-2024-001" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-success download-report-btn" data-id="RPT-2024-001" title="Download">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="fw-semibold text-primary">RPT-2024-002</span></td>
                        <td>Compliance Report</td>
                        <td>Q2 2024</td>
                        <td>Jane Smith</td>
                        <td>Yesterday</td>
                        <td>
                            <span class="badge bg-warning d-inline-flex align-items-center">
                                <i class="bi bi-clock-fill me-1"></i>Pending
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-report-btn" data-id="RPT-2024-002" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-success download-report-btn" data-id="RPT-2024-002" title="Download">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="fw-semibold text-primary">RPT-2024-003</span></td>
                        <td>Performance Report</td>
                        <td>May 2024</td>
                        <td>John Doe</td>
                        <td>2 days ago</td>
                        <td>
                            <span class="badge bg-success d-inline-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-1"></i>Approved
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary view-report-btn" data-id="RPT-2024-003" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-success download-report-btn" data-id="RPT-2024-003" title="Download">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
