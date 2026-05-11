@extends('layouts.dashboard')

@section('dashboard_title', 'Broker Dashboard')

@section('dashboard_content')
<!-- Broker Stats -->
<div class="row g-4 mb-4">
    <!-- Total Premiums Sold -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-cart-check fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold"><i class="bi bi-graph-up"></i> +15.5%</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Total Premiums Sold</h6>
                <h4 class="fw-bold mb-0">TZS 85.2M</h4>
            </div>
        </div>
    </div>

    <!-- Commissions Earned -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-cash-coin fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> +8.2%</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Commissions Earned</h6>
                <h4 class="fw-bold mb-0">TZS 12.4M</h4>
            </div>
        </div>
    </div>

    <!-- Active Policies -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                    <div class="text-primary small fw-bold">+45 new</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Active Policies</h6>
                <h4 class="fw-bold mb-0">1,120</h4>
            </div>
        </div>
    </div>

    <!-- Pending Renewals -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <div class="text-warning small fw-bold">Next 7 days</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Pending Renewals</h6>
                <h4 class="fw-bold mb-0">28</h4>
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
