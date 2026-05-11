@extends('layouts.dashboard')

@section('dashboard_title', 'Regulator Dashboard (TIRA Oversight)')

@section('dashboard_content')
<!-- Regulator Market Overview Stats -->
<div class="row g-4 mb-4">
    <!-- Total Premiums Written (Market) -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 bg-primary text-white">
            <div class="card-body p-4 text-center">
                <i class="bi bi-bank fs-1 mb-2 opacity-75"></i>
                <h6 class="text-uppercase small fw-bold opacity-75 mb-1">Total Premiums Written</h6>
                <h3 class="fw-bold mb-0">TZS 1.2B</h3>
                <div class="mt-2 x-small"><i class="bi bi-graph-up"></i> +14% Market Growth</div>
            </div>
        </div>
    </div>

    <!-- Total Active Policies -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 text-center">
                <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-shield-check fs-3"></i>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Active Policies</h6>
                <h3 class="fw-bold mb-0">845,230</h3>
                <div class="mt-1 small text-success">Market-wide</div>
            </div>
        </div>
    </div>

    <!-- Compliance Alerts -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 text-center">
                <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-exclamation-triangle fs-3"></i>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Compliance Alerts</h6>
                <h3 class="fw-bold mb-0">12</h3>
                <div class="mt-1 small text-danger">Action Required</div>
            </div>
        </div>
    </div>

    <!-- Fraud Cases -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 text-center">
                <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-search fs-3"></i>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Fraud Investigations</h6>
                <h3 class="fw-bold mb-0">5</h3>
                <div class="mt-1 small text-warning">Under Review</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Market Share Analytics -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Market Share by Insurer (Top 5)</h6>
                <button class="btn btn-sm btn-outline-primary">Market Intelligence</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light small">
                        <tr>
                            <th>Insurer Name</th>
                            <th>Policies</th>
                            <th>Premium (TZS)</th>
                            <th>Market Share</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <tr>
                            <td>Alliance Insurance</td>
                            <td>120,450</td>
                            <td>345M</td>
                            <td>
                                <div class="progress" style="height: 5px; width: 100px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 28%"></div>
                                </div>
                                <span class="x-small">28.5%</span>
                            </td>
                            <td><span class="badge bg-success-soft text-success">Compliant</span></td>
                        </tr>
                        <tr>
                            <td>Jubilee Insurance</td>
                            <td>98,210</td>
                            <td>290M</td>
                            <td>
                                <div class="progress" style="height: 5px; width: 100px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 22%"></div>
                                </div>
                                <span class="x-small">22.1%</span>
                            </td>
                            <td><span class="badge bg-success-soft text-success">Compliant</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Oversight Quick Access -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-4">Regulatory Oversight</h6>
            <div class="list-group list-group-flush small">
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                    <span><i class="bi bi-building me-2 text-primary"></i> Registered Insurers</span>
                    <span class="badge bg-primary rounded-pill">24</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                    <span><i class="bi bi-briefcase me-2 text-primary"></i> Registered Brokers</span>
                    <span class="badge bg-primary rounded-pill">85</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                    <span><i class="bi bi-people me-2 text-primary"></i> Registered Agents</span>
                    <span class="badge bg-primary rounded-pill">1,240</span>
                </a>
            </div>
            
            <div class="mt-4">
                <h6 class="fw-bold mb-3 small">System Integrity (TIRAMIS)</h6>
                <div class="d-flex align-items-center p-3 bg-success bg-opacity-10 rounded-3">
                    <i class="bi bi-hdd-network text-success fs-4 me-3"></i>
                    <div>
                        <div class="small fw-bold text-success">Sync Active</div>
                        <div class="x-small text-muted">Last synced: 2 mins ago</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .x-small { font-size: 0.7rem; }
</style>
@endsection
