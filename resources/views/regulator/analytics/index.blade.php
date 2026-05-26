@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('regulator._partials.page-header', [
        'title' => 'Market Analytics',
        'subtitle' => 'Advanced market intelligence and predictive analytics',
        'icon' => 'bi-graph-up-arrow'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-graph-up-arrow text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Market Growth</h6>
                            <h4 class="mb-0 fw-bold">0%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-cash-coin text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Premium</h6>
                            <h4 class="mb-0 fw-bold">TZS 0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-people text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">New Customers</h6>
                            <h4 class="mb-0 fw-bold">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-shield-check text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Claims Ratio</h6>
                            <h4 class="mb-0 fw-bold">0%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">Market Analytics Dashboard</h5>
        </div>
        <div class="card-body">
            <div class="text-center py-5">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-graph-up-arrow text-muted fs-2"></i>
                </div>
                <h5 class="fw-bold mb-2">No Analytics Data</h5>
                <p class="text-muted mb-0">Market analytics will appear here once data is collected.</p>
            </div>
        </div>
    </div>
</div>
@endsection
