@extends('layouts.dashboard')

@section('dashboard_title', 'Insurer Dashboard - ' . (auth()->user()->company_name ?? 'Insurance Co'))

@section('dashboard_content')
<!-- Insurer Dashboard Summary Stats -->
<div class="row g-3 mb-4">
    <!-- Premium Collected -->
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary me-2">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <span class="x-small fw-bold text-muted">Total Premiums</span>
                </div>
                <h4 class="fw-bold mb-0">TZS <span class="stat-count">{{ number_format($totalPremiums / 1000000, 1) }}M</h4>
                <p class="x-small text-success mb-0 mt-1"><i class="bi bi-arrow-up"></i> {{ number_format($premiumGrowth, 1) }}%</p>
            </div>
        </div>
    </div>
    <!-- Policies Issued -->
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-success bg-opacity-10 p-2 rounded-3 text-success me-2">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <span class="x-small fw-bold text-muted">Active Policies</span>
                </div>
                <h4 class="fw-bold mb-0"><span class="stat-count">{{ number_format($activePolicies) }}</span></h4>
                <p class="x-small text-success mb-0 mt-1"><i class="bi bi-arrow-up"></i> {{ number_format($policiesGrowth, 1) }}%</p>
            </div>
        </div>
    </div>
    <!-- Claims Pending -->
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-warning bg-opacity-10 p-2 rounded-3 text-warning me-2">
                        <i class="bi bi-exclamation-octagon"></i>
                    </div>
                    <span class="x-small fw-bold text-muted">Pending Claims</span>
                </div>
                <h4 class="fw-bold mb-0"><span class="stat-count">{{ number_format($pendingClaims) }}</span></h4>
                <p class="x-small text-danger mb-0 mt-1"><i class="bi bi-clock"></i> {{ $pendingClaims > 0 ? 'Action Needed' : 'All Clear' }}</p>
            </div>
        </div>
    </div>
    <!-- Settlement Ratio -->
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-info bg-opacity-10 p-2 rounded-3 text-info me-2">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <span class="x-small fw-bold text-muted">Settlement Ratio</span>
                </div>
                <h4 class="fw-bold mb-0"><span class="stat-count">{{ $settlementRatio }}%</h4>
                <p class="x-small text-primary mb-0 mt-1">{{ $settlementRatio >= 90 ? 'Excellent' : ($settlementRatio >= 75 ? 'Good' : 'Needs Improvement') }}</p>
            </div>
        </div>
    </div>
    <!-- Traffic & Leads -->
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-secondary bg-opacity-10 p-2 rounded-3 text-secondary me-2">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <span class="x-small fw-bold text-muted">Traffic & Leads</span>
                </div>
                <h4 class="fw-bold mb-0"><span class="stat-count">{{ number_format($totalCustomers) }} / {{ number_format($newCustomersMonth) }}</h4>
                <p class="x-small text-success mb-0 mt-1"><i class="bi bi-arrow-up"></i> {{ $newCustomersMonth }} new this month</p>
            </div>
        </div>
    </div>
</div>

<!-- Performance Charts & Insights -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Revenue & Policy Growth</h5>
                <div class="dropdown">
                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">Last 6 Months</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('insurer.dashboard') }}?period=30">Last 30 Days</a></li>
                        <li><a class="dropdown-item" href="{{ route('insurer.dashboard') }}?period=year">This Year</a></li>
                    </ul>
                </div>
            </div>
            <div style="height: 300px; background: #f8fafc; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                <p class="text-muted small italic">[Revenue Chart Integration Placeholder]</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <!-- AI Market Insights -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; background: #f0f9ff;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-white rounded-circle shadow-sm p-2 me-3">
                        <i class="bi bi-robot fs-4 text-primary"></i>
                    </div>
                    <h6 class="fw-bold mb-0 text-primary">AI Market Insights</h6>
                </div>
                <div class="list-group list-group-flush bg-transparent">
                    <div class="list-group-item bg-transparent px-0 py-2 border-0">
                        <p class="x-small mb-1 text-dark fw-bold"><i class="bi bi-lightning-fill text-warning me-1"></i> Trend Alert</p>
                        <p class="x-small text-muted mb-0">Demand for Micro-insurance in Agriculture has increased by 15% this month.</p>
                    </div>
                    <div class="list-group-item bg-transparent px-0 py-2 border-0">
                        <p class="x-small mb-1 text-dark fw-bold"><i class="bi bi-shield-check text-success me-1"></i> Risk Analysis</p>
                        <p class="x-small text-muted mb-0">Motor insurance loss ratio is improving in the Northern region.</p>
                    </div>
                </div>
                <button class="btn btn-sm btn-primary w-100 rounded-pill mt-3 py-2 small">Full Analysis</button>
            </div>
        </div>

        <!-- Commission Summary -->
        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Commission Summary</h6>
                <div class="d-flex justify-content-between mb-2">
                    <span class="small text-muted">Payable Summary</span>
                    <span class="small fw-bold">TZS {{ number_format($pendingCommissions / 1000000, 1) }}M</span>
                </div>
                <div class="progress mb-3" style="height: 6px;">
                    <div class="progress-bar bg-primary" style="width: 75%;"></div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="small text-muted">Paid Summary</span>
                    <span class="small fw-bold">TZS {{ number_format($paidCommissions / 1000000, 1) }}M</span>
                </div>
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-success" style="width: 90%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Top Selling Products & Recent Activity -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 p-4 pb-0">
                <h5 class="fw-bold mb-0">Top Selling Products</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4 py-3 small text-muted text-uppercase">Product</th>
                                <th class="border-0 py-3 small text-muted text-uppercase">Policies</th>
                                <th class="border-0 py-3 small text-muted text-uppercase">Revenue</th>
                                <th class="border-0 py-3 small text-muted text-uppercase">Growth</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-3 border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary me-3">
                                            <i class="bi bi-car-front fs-5"></i>
                                        </div>
                                        <span class="fw-bold small">Comprehensive Motor</span>
                                    </div>
                                </td>
                                <td class="py-3 border-0 small">1,240</td>
                                <td class="py-3 border-0 small fw-bold">TZS 450M</td>
                                <td class="py-3 border-0"><span class="badge bg-success-subtle text-success">+18%</span></td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 p-2 rounded-3 text-info me-3">
                                            <i class="bi bi-heart-pulse fs-5"></i>
                                        </div>
                                        <span class="fw-bold small">Family Health Cover</span>
                                    </div>
                                </td>
                                <td class="py-3 border-0 small">950</td>
                                <td class="py-3 border-0 small fw-bold">TZS 380M</td>
                                <td class="py-3 border-0"><span class="badge bg-success-subtle text-success">+12%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity & Notifications -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4">Recent Activity Feed</h6>
                <div class="timeline-small">
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle text-primary">
                                <i class="bi bi-plus-circle small"></i>
                            </div>
                        </div>
                        <div>
                            <p class="x-small mb-0 fw-bold">New Customer Acquired</p>
                            <p class="x-small text-muted mb-0">John Doe purchased Motor Insurance</p>
                            <span class="x-small text-muted" style="font-size: 0.6rem;">2 mins ago</span>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <div class="bg-warning bg-opacity-10 p-2 rounded-circle text-warning">
                                <i class="bi bi-file-earmark-text small"></i>
                            </div>
                        </div>
                        <div>
                            <p class="x-small mb-0 fw-bold">Claim Submitted</p>
                            <p class="x-small text-muted mb-0">Accident claim reported for BK-294</p>
                            <span class="x-small text-muted" style="font-size: 0.6rem;">15 mins ago</span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-sm btn-light w-100 rounded-pill py-2 x-small mt-2">View All Alerts</button>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
</style>
@endsection
