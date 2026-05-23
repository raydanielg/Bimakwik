@extends('layouts.dashboard')

@section('dashboard_title', 'Performance')

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
    
    /* Chart Containers */
    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 1rem;
    }
    
    /* Progress Bar Styles */
    .progress {
        height: 25px;
        border-radius: 12px;
        background-color: #e9ecef;
    }
    
    .progress-bar {
        font-weight: 600;
        font-size: 0.85rem;
        line-height: 25px;
    }
    
    /* Card Hover Effects */
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('dashboard_content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1"><i class="bi bi-graph-up me-2"></i>Performance</h5>
                <p class="text-muted small mb-0">Track performance metrics and analytics</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm" onclick="exportData()">
                    <i class="bi bi-download me-2"></i>Export
                </button>
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-calendar me-2"></i><span id="currentPeriod">This Month</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('This Month')">This Month</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('Last Month')">Last Month</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('Last 3 Months')">Last 3 Months</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('Last 6 Months')">Last 6 Months</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('This Year')">This Year</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" onclick="changePeriod('Custom Range')">Custom Range</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Performance Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted">Total Revenue</small>
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
                        <small class="text-muted">Growth</small>
                        <h5 class="fw-bold mb-0">+18.2%</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-arrow-up text-success"></i>
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
                        <small class="text-muted">Conversion Rate</small>
                        <h5 class="fw-bold mb-0">68.7%</h5>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-graph-up text-info"></i>
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
                        <small class="text-muted">Target Achievement</small>
                        <h5 class="fw-bold mb-0">92%</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                        <i class="bi bi-trophy text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Performance Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Branch Performance</h6>
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-light" placeholder="Search branches...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Branch</th>
                        <th>Sales</th>
                        <th>Policies</th>
                        <th>Commission</th>
                        <th>Conversion</th>
                        <th>Target</th>
                        <th>Rank</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Branch A</strong></td>
                        <td>TZS 18.5M</td>
                        <td>62</td>
                        <td>TZS 1.85M</td>
                        <td>72.3%</td>
                        <td><span class="badge bg-success">95%</span></td>
                        <td><span class="badge bg-primary">#1</span></td>
                    </tr>
                    <tr>
                        <td><strong>Branch B</strong></td>
                        <td>TZS 15.2M</td>
                        <td>48</td>
                        <td>TZS 1.52M</td>
                        <td>68.5%</td>
                        <td><span class="badge bg-success">90%</span></td>
                        <td><span class="badge bg-secondary">#2</span></td>
                    </tr>
                    <tr>
                        <td><strong>Branch C</strong></td>
                        <td>TZS 12.1M</td>
                        <td>46</td>
                        <td>TZS 1.21M</td>
                        <td>65.2%</td>
                        <td><span class="badge bg-warning">88%</span></td>
                        <td><span class="badge bg-secondary">#3</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
