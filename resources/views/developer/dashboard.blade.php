@extends('layouts.dashboard')

@section('dashboard_title', 'Developer & API Portal')

@section('dashboard_content')
<!-- Developer Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-primary">
            <div class="card-body">
                <div class="stat-label">API Requests (24h)</div>
                <div class="stat-value">45,670</div>
                <div class="stat-trend text-success"><i class="bi bi-graph-up"></i> +12%</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-success">
            <div class="card-body">
                <div class="stat-label">Avg Latency</div>
                <div class="stat-value">124ms</div>
                <div class="stat-trend text-success"><i class="bi bi-check-circle"></i> Stable</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-info">
            <div class="card-body">
                <div class="stat-label">Error Rate</div>
                <div class="stat-value">0.02%</div>
                <div class="stat-trend text-success"><i class="bi bi-shield-check"></i> Healthy</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-warning">
            <div class="card-body">
                <div class="stat-label">Active Keys</div>
                <div class="stat-value">3</div>
                <div class="stat-trend text-primary"><i class="bi bi-key"></i> Operational</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- API Integration Quick Start -->
    <div class="col-lg-7">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-4"><i class="bi bi-code-slash me-2 text-primary"></i> API Integration Status</h6>
            <div class="bg-dark rounded-3 p-3 mb-4 font-monospace small text-success">
                <div><span class="text-secondary">// Current Authentication Method</span></div>
                <div>Bearer <span class="text-warning">bk_live_51P2u8R...</span></div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle small">
                    <thead class="table-light">
                        <tr>
                            <th>Endpoint</th>
                            <th>Method</th>
                            <th>Avg Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>/api/v1/policies/calculate</code></td>
                            <td><span class="badge bg-primary">POST</span></td>
                            <td>150ms</td>
                            <td><span class="badge bg-success-soft text-success">200 OK</span></td>
                        </tr>
                        <tr>
                            <td><code>/api/v1/claims/notify</code></td>
                            <td><span class="badge bg-primary">POST</span></td>
                            <td>210ms</td>
                            <td><span class="badge bg-success-soft text-success">200 OK</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- AI Integration Status -->
    <div class="col-lg-5">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-4"><i class="bi bi-robot me-2 text-primary"></i> AI Model Performance</h6>
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small fw-bold">Fraud Detection (V2)</span>
                    <span class="small text-success">98.5% Acc</span>
                </div>
                <div class="progress" style="height: 8px; border-radius: 10px;">
                    <div class="progress-bar bg-success" style="width: 98.5%"></div>
                </div>
            </div>
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small fw-bold">Risk Prediction (V1)</span>
                    <span class="small text-primary">94.2% Acc</span>
                </div>
                <div class="progress" style="height: 8px; border-radius: 10px;">
                    <div class="progress-bar bg-primary" style="width: 94.2%"></div>
                </div>
            </div>
            <div class="p-3 bg-light rounded-3 border">
                <div class="small fw-bold mb-2">Recent AI Predictions</div>
                <div class="d-flex justify-content-between small text-muted">
                    <span>Claim #9901 Fraud Risk:</span>
                    <span class="text-success">LOW (0.02)</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
</style>
@endsection
