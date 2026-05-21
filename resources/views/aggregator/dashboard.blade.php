@extends('layouts.dashboard')

@section('dashboard_title', __('aggregator.dashboard_title'))

@section('dashboard_content')
<!-- Aggregator Stats -->
<div class="row g-4 mb-4">
    <!-- Total Quotes Generated -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3" style="width: 54px; height: 54px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-file-earmark-text fs-4"></i>
                </div>
                <div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('aggregator.total_quotes') }}</h6>
                    <h4 class="fw-bold mb-0">4,250</h4>
                    <div class="text-success small fw-bold mt-1"><i class="bi bi-graph-up"></i> +24.5%</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leads Converted -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 me-3" style="width: 54px; height: 54px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-person-check fs-4"></i>
                </div>
                <div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('aggregator.leads_converted') }}</h6>
                    <h4 class="fw-bold mb-0">1,120</h4>
                    <div class="text-success small fw-bold mt-1"><i class="bi bi-check-circle"></i> 26.3% Rate</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Referral Fees Earned -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-info bg-opacity-10 text-info rounded-3 p-3 me-3" style="width: 54px; height: 54px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-wallet2 fs-4"></i>
                </div>
                <div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('aggregator.referral_fees') }}</h6>
                    <h4 class="fw-bold mb-0">TZS 8.4M</h4>
                    <div class="text-primary small fw-bold mt-1">+12% MTD</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Click-Through Rate -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3 me-3" style="width: 54px; height: 54px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-mouse2 fs-4"></i>
                </div>
                <div>
                    <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('aggregator.ctr_rate') }}</h6>
                    <h4 class="fw-bold mb-0">15.8%</h4>
                    <div class="text-warning small fw-bold mt-1">High traffic</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Traffic Analytics -->
    <div class="col-lg-8">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">{{ __('aggregator.comparison_traffic_matrix') }}</h6>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-light">{{ __('aggregator.daily') }}</button>
                    <button class="btn btn-primary">{{ __('aggregator.weekly') }}</button>
                </div>
            </div>
            <div style="height: 250px; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px dashed #cbd5e1;">
                <span class="text-muted small">{{ __('aggregator.traffic_analytics_graph_placeholder') }}</span>
            </div>
        </div>
    </div>
    
    <!-- Top Insurers for Leads -->
    <div class="col-lg-4">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-4">{{ __('aggregator.lead_distribution') }}</h6>
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
                <div class="small fw-bold text-primary">{{ __('aggregator.ai_insight') }}</div>
                <div class="x-small text-muted">{{ __('aggregator.motor_insurance_conversion') }}</div>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
</style>
@endsection
