@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'Performance',
        'subtitle' => 'View performance metrics and analytics'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-file-earmark-text-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Bills Processed</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['bills_processed'] ?? 0 }}</h4>
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
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Approval Rate</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['approval_rate'] ?? 0 }}%</h4>
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
                            <i class="bi bi-clock-fill text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Avg Processing Time</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['avg_processing_time'] ?? 0 }} days</h4>
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
                            <i class="bi bi-star-fill text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Rating</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['rating'] ?? 0.0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">Performance Analytics</h5>
        </div>
        <div class="card-body">
            @if($stats['bills_processed'] > 0)
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Performance data is based on your claims processing history.
                </div>
            @else
                <div class="text-center py-5">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-graph-up-arrow text-muted fs-2"></i>
                    </div>
                    <h5 class="fw-bold mb-2">No Performance Data</h5>
                    <p class="text-muted mb-0">Performance analytics will appear here once you start processing bills.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
