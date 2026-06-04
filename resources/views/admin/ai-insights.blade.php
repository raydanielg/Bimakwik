@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1">AI Insights</h2>
        <p class="text-muted small mb-0">Artificial intelligence powered business insights</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Fraud Detection</p>
                        <h3 class="fw-bold mb-0">{{ $fraudDetections }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-shield-exclamation text-danger fs-4"></i>
                    </div>
                </div>
                <small class="text-danger">Live flagged/rejected claims</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Risk Score</p>
                        <h3 class="fw-bold mb-0">{{ $riskScoreLabel }}</h3>
                    </div>
                    <div class="bg-{{ $riskScoreClass }} bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-graph-down text-{{ $riskScoreClass }} fs-4"></i>
                    </div>
                </div>
                <small class="text-{{ $riskScoreClass }}">Derived from claim queue and outcomes</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Churn Prediction</p>
                        <h3 class="fw-bold mb-0">{{ $churnRate }}%</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-person-dash text-warning fs-4"></i>
                    </div>
                </div>
                <small class="text-warning">{{ $atRiskCustomers }} customers at risk</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Revenue Forecast</p>
                        <h3 class="fw-bold mb-0">{{ $revenueForecast >= 0 ? '+' : '' }}{{ $revenueForecast }}%</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-graph-up-arrow text-primary fs-4"></i>
                    </div>
                </div>
                <small class="text-primary">Compared to previous 30 days</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-robot text-primary me-2"></i>AI Recommendations
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($recommendations as $recommendation)
                    <div class="list-group-item border-0 px-0 py-3">
                        <div class="d-flex">
                            <div class="bg-{{ $recommendation['color'] }} bg-opacity-10 rounded-circle p-2 me-3" style="height: fit-content;">
                                <i class="bi bi-{{ $recommendation['icon'] }} text-{{ $recommendation['color'] }} fs-5"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-bold">{{ $recommendation['title'] }}</h6>
                                <p class="text-muted small mb-0">{{ $recommendation['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item border-0 px-0 py-3 text-muted">No recommendations available.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-exclamation-triangle text-warning me-2"></i>Alerts & Anomalies
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($alerts as $alert)
                    <div class="list-group-item border-0 px-0 py-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="d-flex align-items-center mb-1">
                                    <span class="badge bg-{{ $alert['severity'] == 'high' ? 'danger' : ($alert['severity'] == 'medium' ? 'warning' : 'info') }} bg-opacity-10 text-{{ $alert['severity'] == 'high' ? 'danger' : ($alert['severity'] == 'medium' ? 'warning' : 'info') }} me-2">
                                        {{ ucfirst($alert['severity']) }}
                                    </span>
                                    <h6 class="mb-0">{{ $alert['title'] }}</h6>
                                </div>
                                <p class="text-muted small mb-1">{{ $alert['desc'] }}</p>
                                <small class="text-muted">{{ $alert['time'] }}</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item border-0 px-0 py-3 text-muted">No alerts detected.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
