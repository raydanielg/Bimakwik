@extends('layouts.dashboard')

@section('dashboard_title', 'Insurer Dashboard - ' . (auth()->user()->company_name ?? 'Insurance Co'))

@section('dashboard_content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 border-start border-4 border-primary">
            <h6 class="text-uppercase small fw-bold text-muted">Active Policies</h6>
            <h3 class="fw-bold mb-0">3,450</h3>
            <div class="mt-2 small text-success"><i class="bi bi-arrow-up"></i> 8% this month</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 border-start border-4 border-danger">
            <h6 class="text-uppercase small fw-bold text-muted">Claims for Review</h6>
            <h3 class="fw-bold mb-0">28</h3>
            <div class="mt-2 small text-danger"><i class="bi bi-exclamation-triangle"></i> 5 urgent</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 border-start border-4 border-success">
            <h6 class="text-uppercase small fw-bold text-muted">Monthly Premium</h6>
            <h3 class="fw-bold mb-0">TZS 45.2M</h3>
            <div class="mt-2 small text-success"><i class="bi bi-wallet2"></i> +12% growth</div>
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
