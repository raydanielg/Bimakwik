@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Aggregator Dashboard</h2>
            <p class="text-muted mb-0">Overview of your insurance marketplace</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-shield-check fs-4"></i>
                        </div>
                        <div class="text-success small fw-bold"><i class="bi bi-graph-up"></i> +12%</div>
                    </div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Total Policies</h6>
                    <h4 class="fw-bold mb-0"><span class="stat-count">{{ $totalPolicies }}</span></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-cash-coin fs-4"></i>
                        </div>
                        <div class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> +8%</div>
                    </div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Total Commission</h6>
                    <h4 class="fw-bold mb-0">TZS <span class="stat-count">{{ number_format($totalCommission, 0) }}</span></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-info bg-opacity-10 text-info rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                        <div class="text-primary small fw-bold">{{ $totalBrokers }} Brokers</div>
                    </div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Total Partners</h6>
                    <h4 class="fw-bold mb-0"><span class="stat-count">{{ $totalBrokers + $totalAgents }}</span></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>
                        <div class="text-warning small fw-bold">Pending</div>
                    </div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Pending Commission</h6>
                    <h4 class="fw-bold mb-0">TZS <span class="stat-count">{{ number_format($pendingCommission, 0) }}</span></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Recent Policies</h6>
                </div>
                <div class="card-body">
                    @if($recentPolicies->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Customer</th>
                                        <th>Policy</th>
                                        <th>Premium</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentPolicies as $policy)
                                        <tr>
                                            <td>{{ $policy->customer->name ?? 'N/A' }}</td>
                                            <td>{{ $policy->product->product_name ?? 'N/A' }}</td>
                                            <td class="fw-bold">TZS {{ number_format($policy->premium_amount ?? 0, 0) }}</td>
                                            <td>
                                                @if($policy->status === 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $policy->status ?? 'Unknown' }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $policy->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox text-muted fs-1"></i>
                            <p class="text-muted mb-0">No recent policies found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Top Brokers</h6>
                </div>
                <div class="card-body">
                    @if($topBrokers->count() > 0)
                        @foreach($topBrokers as $broker)
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="bi bi-person-fill text-muted"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ $broker->name ?? 'N/A' }}</div>
                                    <small class="text-muted">{{ $broker->brokerProfile->company_name ?? 'Individual' }}</small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox text-muted fs-1"></i>
                            <p class="text-muted mb-0">No brokers found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Partner Summary</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <h3 class="fw-bold text-primary stat-count">{{ $totalBrokers }}</h3>
                            <small class="text-muted">Brokers</small>
                        </div>
                        <div class="col-6 mb-3">
                            <h3 class="fw-bold text-info stat-count">{{ $totalAgents }}</h3>
                            <small class="text-muted">Agents</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0">Claims Overview</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <h3 class="fw-bold text-warning stat-count">{{ $totalClaims }}</h3>
                            <small class="text-muted">Total Claims</small>
                        </div>
                        <div class="col-6 mb-3">
                            <h3 class="fw-bold text-success stat-count">{{ $activePolicies }}</h3>
                            <small class="text-muted">Active Policies</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

