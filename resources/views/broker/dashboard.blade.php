@extends('layouts.dashboard')

@section('dashboard_title', 'Broker Dashboard')

@section('dashboard_content')
<!-- Broker Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-primary">
            <div class="card-body">
                <div class="stat-label">Total Premiums Sold</div>
                <div class="stat-value">TZS 85.2M</div>
                <div class="stat-trend text-success"><i class="bi bi-graph-up"></i> +15.5%</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-success">
            <div class="card-body">
                <div class="stat-label">Commissions Earned</div>
                <div class="stat-value">TZS 12.4M</div>
                <div class="stat-trend text-success"><i class="bi bi-arrow-up"></i> +8.2%</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-info">
            <div class="card-body">
                <div class="stat-label">Active Policies</div>
                <div class="stat-value">1,120</div>
                <div class="stat-trend text-primary"><i class="bi bi-shield-check"></i> +45 new</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-warning">
            <div class="card-body">
                <div class="stat-label">Pending Renewals</div>
                <div class="stat-value">28</div>
                <div class="stat-trend text-warning"><i class="bi bi-clock-history"></i> Next 7 days</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Quick Actions -->
    <div class="col-lg-8">
        <div class="card p-4">
            <h6 class="fw-bold mb-4">Recent Sales</h6>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Customer</th>
                            <th>Policy Type</th>
                            <th>Insurer</th>
                            <th>Premium</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hamis Juma</td>
                            <td>Motor Comprehensive</td>
                            <td>Alliance Insurance</td>
                            <td>TZS 450,000</td>
                            <td><span class="badge bg-success-soft text-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>Sarah Peter</td>
                            <td>Health Silver</td>
                            <td>Jubilee Insurance</td>
                            <td>TZS 850,000</td>
                            <td><span class="badge bg-success-soft text-success">Active</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Wallet Summary -->
    <div class="col-lg-4">
        <div class="card p-4 h-100 bg-primary text-white">
            <h6 class="fw-bold mb-4 opacity-75">My Wallet Balance</h6>
            <div class="mb-4 text-center">
                <h2 class="fw-bold">TZS 4,250,000</h2>
                <span class="small opacity-75">Available for Cash-out</span>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-light fw-bold py-2">Request Cash-out</button>
                <button class="btn btn-outline-light py-2">Transaction History</button>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
</style>
@endsection
