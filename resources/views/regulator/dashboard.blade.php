@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Regulator Dashboard</h2>
            <p class="text-muted mb-0">Market oversight and compliance monitoring</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 bg-primary text-white">
                <div class="card-body p-4 text-center">
                    <i class="bi bi-bank fs-1 mb-2 opacity-75"></i>
                    <h6 class="text-uppercase small fw-bold opacity-75 mb-1">Total Premiums Written</h6>
                    <h3 class="fw-bold mb-0">TZS {{ number_format($totalPremiums ?? 0, 0) }}</h3>
                    <div class="mt-2 small"><i class="bi bi-graph-up"></i> Market Total</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-shield-check fs-3"></i>
                    </div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Active Policies</h6>
                    <h3 class="fw-bold mb-0">{{ $activePolicies ?? 0 }}</h3>
                    <div class="mt-1 small text-success">Market Wide</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-exclamation-triangle fs-3"></i>
                    </div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Compliance Alerts</h6>
                    <h3 class="fw-bold mb-0">{{ $complianceAlerts ?? 0 }}</h3>
                    <div class="mt-1 small text-danger">Action Required</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 mx-auto mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-search fs-3"></i>
                    </div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">Fraud Investigations</h6>
                    <h3 class="fw-bold mb-0">{{ $fraudCases ?? 0 }}</h3>
                    <div class="mt-1 small text-warning">Under Review</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold mb-0">Market Share by Insurer</h6>
                    <button class="btn btn-sm btn-outline-primary">Market Intelligence</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light small">
                            <tr>
                                <th>Insurer Name</th>
                                <th>Policies</th>
                                <th>Market Share</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            @if(($marketShare ?? collect())->count() > 0)
                                @foreach($marketShare as $insurer)
                                    <tr>
                                        <td>{{ $insurer->name ?? 'N/A' }}</td>
                                        <td>{{ $insurer->policies_count ?? 0 }}</td>
                                        <td>
                                            <div class="progress" style="height: 5px; width: 100px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ min(($insurer->policies_count ?? 0) / ($activePolicies ?? 1) * 100, 100) }}%"></div>
                                            </div>
                                            <span class="x-small">{{ number_format(($insurer->policies_count ?? 0) / ($activePolicies ?? 1) * 100, 1) }}%</span>
                                        </td>
                                        <td><span class="badge bg-success">Compliant</span></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center py-4">No insurer data available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-4">Regulatory Oversight</h6>
                <div class="list-group list-group-flush small">
                    <a href="{{ route('regulator.insurers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="bi bi-building me-2 text-primary"></i> Registered Insurers</span>
                        <span class="badge bg-primary rounded-pill">{{ $totalInsurers ?? 0 }}</span>
                    </a>
                    <a href="{{ route('regulator.brokers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="bi bi-briefcase me-2 text-primary"></i> Registered Brokers</span>
                        <span class="badge bg-primary rounded-pill">{{ $totalBrokers ?? 0 }}</span>
                    </a>
                    <a href="{{ route('regulator.agents') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <span><i class="bi bi-people me-2 text-primary"></i> Registered Agents</span>
                        <span class="badge bg-primary rounded-pill">{{ $totalAgents ?? 0 }}</span>
                    </a>
                </div>
                
                <div class="mt-4">
                    <h6 class="fw-bold mb-3 small">System Integrity</h6>
                    <div class="d-flex align-items-center p-3 bg-success bg-opacity-10 rounded-3">
                        <i class="bi bi-hdd-network text-success fs-4 me-3"></i>
                        <div>
                            <div class="small fw-bold text-success">Sync Active</div>
                            <div class="x-small text-muted">Last synced: {{ now()->format('H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
