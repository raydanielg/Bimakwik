@extends('layouts.dashboard')

@section('dashboard_title', 'Developer Portal')

@section('dashboard_content')
<!-- Developer Portal Header Stats -->
<div class="row g-4 mb-4">
    <!-- API Requests -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-activity fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">99.9% Success</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">API Requests</h6>
                <h4 class="fw-bold mb-0">854.2K</h4>
                <div class="x-small text-muted mt-2">Past 24 Hours</div>
            </div>
        </div>
    </div>

    <!-- Active API Keys -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-key fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">Active</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Active Keys</h6>
                <h4 class="fw-bold mb-0">12</h4>
                <div class="x-small text-muted mt-2">Across 3 Apps</div>
            </div>
        </div>
    </div>

    <!-- Avg Response Time -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-lightning-charge fs-4"></i>
                    </div>
                    <div class="text-primary small fw-bold">Optimal</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Avg Latency</h6>
                <h4 class="fw-bold mb-0">124ms</h4>
                <div class="x-small text-muted mt-2">P95 Response Time</div>
            </div>
        </div>
    </div>

    <!-- System Uptime -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-hdd-network fs-4"></i>
                    </div>
                    <div class="text-warning small fw-bold">v2.1 Stable</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">System Health</h6>
                <h4 class="fw-bold mb-0">99.98%</h4>
                <div class="x-small text-muted mt-2">Operational</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Documentation & Endpoints -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-book me-2 text-primary"></i>Quick Documentation</h6>
                <a href="#" class="btn btn-sm btn-outline-primary">View Full API Docs</a>
            </div>
            
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-3 border rounded-3 text-center">
                        <i class="bi bi-shield-lock fs-3 text-primary d-block mb-2"></i>
                        <span class="small fw-bold">Authentication</span>
                    </div>
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
