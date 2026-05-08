@extends('layouts.dashboard')

@section('dashboard_title', 'Super Admin Dashboard')

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4 bg-primary text-white">
            <h6 class="text-uppercase small fw-bold opacity-75">Total Revenue</h6>
            <h3 class="fw-bold mb-0">TZS 125.4M</h3>
            <div class="mt-3 small"><i class="bi bi-arrow-up"></i> 12% from last month</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4 bg-success text-white">
            <h6 class="text-uppercase small fw-bold opacity-75">Active Policies</h6>
            <h3 class="fw-bold mb-0">12,450</h3>
            <div class="mt-3 small"><i class="bi bi-arrow-up"></i> 5% growth</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4 bg-warning text-dark">
            <h6 class="text-uppercase small fw-bold opacity-75">Pending Claims</h6>
            <h3 class="fw-bold mb-0">145</h3>
            <div class="mt-3 small"><i class="bi bi-clock"></i> 12 needs attention</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-4 bg-info text-white">
            <h6 class="text-uppercase small fw-bold opacity-75">Total Users</h6>
            <h3 class="fw-bold mb-0">45,600</h3>
            <div class="mt-3 small"><i class="bi bi-people"></i> 320 new today</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Recent Activities</h5>
                <button class="btn btn-sm btn-outline-primary">View All</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="https://ui-avatars.com/api/?name=John+Doe" class="rounded-circle me-2" width="30"> John Doe</td>
                            <td>Purchased Life Cover</td>
                            <td><span class="badge bg-success-soft text-success">Completed</span></td>
                            <td class="small text-muted">2 mins ago</td>
                        </tr>
                        <tr>
                            <td><img src="https://ui-avatars.com/api/?name=Sara+M" class="rounded-circle me-2" width="30"> Sara M</td>
                            <td>Filed Motor Claim</td>
                            <td><span class="badge bg-warning-soft text-warning">Pending</span></td>
                            <td class="small text-muted">1 hour ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h5 class="fw-bold mb-4">System Health</h5>
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small fw-bold">API Connectivity</span>
                    <span class="small text-success">99.9%</span>
                </div>
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-success" style="width: 99.9%"></div>
                </div>
            </div>
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small fw-bold">Database Load</span>
                    <span class="small text-warning">45%</span>
                </div>
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-warning" style="width: 45%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
</style>
@endsection
