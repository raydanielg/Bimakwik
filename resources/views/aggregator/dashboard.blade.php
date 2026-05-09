@extends('layouts.dashboard')

@section('dashboard_title', 'Aggregator Dashboard')

@section('dashboard_content')
<!-- Aggregator Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-primary">
            <div class="card-body">
                <div class="stat-label">Total Quotes Generated</div>
                <div class="stat-value">4,250</div>
                <div class="stat-trend text-success"><i class="bi bi-graph-up"></i> +24.5%</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-success">
            <div class="card-body">
                <div class="stat-label">Leads Converted</div>
                <div class="stat-value">1,120</div>
                <div class="stat-trend text-success"><i class="bi bi-check-circle"></i> 26.3% Rate</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-info">
            <div class="card-body">
                <div class="stat-label">Referral Fees Earned</div>
                <div class="stat-value">TZS 8.4M</div>
                <div class="stat-trend text-primary"><i class="bi bi-wallet2"></i> +12% MTD</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card border-start border-4 border-warning">
            <div class="card-body">
                <div class="stat-label">Click-Through Rate</div>
                <div class="stat-value">15.8%</div>
                <div class="stat-trend text-warning"><i class="bi bi-mouse2"></i> High traffic</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Traffic Analytics -->
    <div class="col-lg-8">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Comparison Traffic Matrix</h6>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-light">Daily</button>
                    <button class="btn btn-primary">Weekly</button>
                </div>
            </div>
            <div style="height: 250px; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px dashed #cbd5e1;">
                <span class="text-muted small">Traffic Analytics Graph Placeholder</span>
            </div>
        </div>
    </div>
    
    <!-- Top Insurers for Leads -->
    <div class="col-lg-4">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-4">Lead Distribution</h6>
            <div class="list-group list-group-flush small">
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <span>Alliance Insurance</span>
                    <span class="badge bg-primary rounded-pill">450 leads</span>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <span>Jubilee Insurance</span>
                    <span class="badge bg-primary rounded-pill">380 leads</span>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <span>Heritage Insurance</span>
                    <span class="badge bg-primary rounded-pill">290 leads</span>
                </div>
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                    <span>Sanlam Life</span>
                    <span class="badge bg-primary rounded-pill">120 leads</span>
                </div>
            </div>
            <div class="mt-4 p-3 bg-light rounded-3 text-center">
                <div class="small fw-bold text-primary">AI Insight</div>
                <div class="x-small text-muted">Motor insurance has 40% more conversion this week.</div>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
</style>
@endsection
