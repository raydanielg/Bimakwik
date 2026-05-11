@extends('layouts.dashboard')

@section('dashboard_title', 'Insurer Dashboard - ' . (auth()->user()->company_name ?? 'Insurance Co'))

@section('dashboard_content')
<div class="row g-4 mb-4">
    <!-- Active Policies -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-shield-check fs-3"></i>
                </div>
                <div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Active Policies</h6>
                    <h3 class="fw-bold mb-0">3,450</h3>
                    <div class="mt-1 small text-success">
                        <i class="bi bi-arrow-up-right me-1"></i>8% increase
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Claims for Review -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-file-earmark-medical fs-3"></i>
                </div>
                <div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Claims for Review</h6>
                    <h3 class="fw-bold mb-0">28</h3>
                    <div class="mt-1 small text-danger">
                        <i class="bi bi-exclamation-circle me-1"></i>5 urgent cases
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Premium -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-cash-stack fs-3"></i>
                </div>
                <div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Monthly Premium</h6>
                    <h3 class="fw-bold mb-0">TZS 45.2M</h3>
                    <div class="mt-1 small text-success">
                        <i class="bi bi-graph-up-arrow me-1"></i>+12% growth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm p-4">
    <h5 class="fw-bold mb-4">Policy Performance</h5>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Policy Type</th>
                    <th>Subscribers</th>
                    <th>Premium (TZS)</th>
                    <th>Claims Ratio</th>
                    <th>Growth</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><i class="bi bi-car-front text-primary me-2"></i> Motor Insurance</td>
                    <td>1,200</td>
                    <td>15.4M</td>
                    <td>24%</td>
                    <td><span class="text-success">+12%</span></td>
                </tr>
                <tr>
                    <td><i class="bi bi-heart-pulse text-danger me-2"></i> Health Insurance</td>
                    <td>850</td>
                    <td>22.1M</td>
                    <td>65%</td>
                    <td><span class="text-success">+5%</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
