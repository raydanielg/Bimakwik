@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'Predictive Analytics',
        'subtitle' => 'AI-powered insights and predictive models',
        'icon' => 'bi-cpu-fill'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-brain-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Active Models</h6>
                            <h4 class="mb-0 fw-bold">{{ $reports->total() ?? 0 }}</h4>
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
                            <i class="bi bi-graph-up-arrow text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Accuracy Rate</h6>
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
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-lightning-fill text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Predictions Today</h6>
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
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-calendar-check-fill text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Last Trained</h6>
                            <h4 class="mb-0 fw-bold">-</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Churn Prediction Model</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-people-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Customer Churn Risk</h6>
                            <small class="text-muted">Predicts customers likely to cancel policies</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Model Accuracy</small>
                            <small>85%</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-primary flex-grow-1" onclick="comingSoonPredictive('Run Churn Prediction')">
                            <i class="bi bi-play-fill me-1"></i> Run Prediction
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="comingSoonPredictive('View Churn Results')">
                            <i class="bi bi-graph-up"></i> View Results
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Claims Prediction Model</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-file-earmark-medical text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Claim Frequency & Severity</h6>
                            <small class="text-muted">Predicts future claim patterns</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Model Accuracy</small>
                            <small>78%</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" style="width: 78%"></div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-primary flex-grow-1" onclick="comingSoonPredictive('Run Claims Prediction')">
                            <i class="bi bi-play-fill me-1"></i> Run Prediction
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="comingSoonPredictive('View Claims Results')">
                            <i class="bi bi-graph-up"></i> View Results
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Fraud Detection Model</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-shield-exclamation text-danger fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Fraud Risk Assessment</h6>
                            <small class="text-muted">Identifies potentially fraudulent claims</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Model Accuracy</small>
                            <small>92%</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-danger" style="width: 92%"></div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-primary flex-grow-1" onclick="comingSoonPredictive('Run Fraud Prediction')">
                            <i class="bi bi-play-fill me-1"></i> Run Prediction
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="comingSoonPredictive('View Fraud Results')">
                            <i class="bi bi-graph-up"></i> View Results
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Premium Optimization Model</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-currency-dollar text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Dynamic Pricing</h6>
                            <small class="text-muted">Optimizes premium pricing strategies</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Model Accuracy</small>
                            <small>81%</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: 81%"></div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-primary flex-grow-1" onclick="comingSoonPredictive('Run Premium Optimization')">
                            <i class="bi bi-play-fill me-1"></i> Run Prediction
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="comingSoonPredictive('View Premium Optimization Results')">
                            <i class="bi bi-graph-up"></i> View Results
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Prediction History</h5>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-primary" onclick="comingSoonPredictive('Export Prediction History')"><i class="bi bi-download me-1"></i> Export</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($reports->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Model</th>
                                <th>Prediction Type</th>
                                <th>Run Date</th>
                                <th>Records Processed</th>
                                <th>Accuracy</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td class="fw-bold">{{ $report->model_name ?? 'N/A' }}</td>
                                    <td>{{ $report->prediction_type ?? 'N/A' }}</td>
                                    <td>{{ $report->run_at?->format('M d, Y H:i') ?? 'N/A' }}</td>
                                    <td>{{ $report->records_processed ?? 0 }}</td>
                                    <td>{{ $report->accuracy ?? 0 }}%</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-outline-primary" onclick="comingSoonPredictive('View Prediction Details')"><i class="bi bi-eye"></i></button>
                                            <button type="button" class="btn btn-outline-secondary" onclick="comingSoonPredictive('Download Prediction Output')"><i class="bi bi-download"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $reports->links() }}
            @else
                @include('insurer._partials.empty-state', [
                    'icon' => 'bi-cpu-fill',
                    'title' => 'No Predictions Run',
                    'text' => 'No predictive analytics have been run yet. Select a model above to start.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function comingSoonPredictive(action) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'info',
            title: action,
            text: 'This predictive analytics action is not yet implemented.',
            confirmButtonText: 'OK'
        });
        return;
    }
    alert(action + ': This predictive analytics action is not yet implemented.');
}
</script>
@endpush
