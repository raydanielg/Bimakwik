@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    @include('aggregator._partials.page-header', [
        'title' => 'Reports',
        'subtitle' => 'Marketplace performance reports',
        'icon' => 'bi-file-earmark-bar-graph'
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
                            <h6 class="mb-0 text-muted">Total Reports</h6>
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
                            <i class="bi bi-download-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Downloads</h6>
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
                            <i class="bi bi-clock-fill text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Scheduled</h6>
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
                            <h6 class="mb-0 text-muted">Last Generated</h6>
                            <h4 class="mb-0 fw-bold">-</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">Available Reports</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-2">
                                    <i class="bi bi-file-earmark-bar-graph text-primary fs-5"></i>
                                </div>
                                <h6 class="mb-0 fw-bold">Marketplace Overview</h6>
                            </div>
                            <p class="text-muted small mb-3">Summary of all marketplace activities and performance.</p>
                            <button class="btn btn-sm btn-primary w-100">
                                <i class="bi bi-download me-1"></i> Generate
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-2">
                                    <i class="bi bi-cash-coin text-success fs-5"></i>
                                </div>
                                <h6 class="mb-0 fw-bold">Commission Report</h6>
                            </div>
                            <p class="text-muted small mb-3">Detailed breakdown of all broker and agent commissions.</p>
                            <button class="btn btn-sm btn-primary w-100">
                                <i class="bi bi-download me-1"></i> Generate
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-2">
                                    <i class="bi bi-people-fill text-info fs-5"></i>
                                </div>
                                <h6 class="mb-0 fw-bold">Partner Performance</h6>
                            </div>
                            <p class="text-muted small mb-3">Performance metrics for all brokers and agents.</p>
                            <button class="btn btn-sm btn-primary w-100">
                                <i class="bi bi-download me-1"></i> Generate
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Generated Reports History</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export All</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($reports->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Report Name</th>
                                <th>Type</th>
                                <th>Period</th>
                                <th>Generated Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td class="fw-bold">{{ $report->name ?? 'N/A' }}</td>
                                    <td>{{ $report->type ?? 'N/A' }}</td>
                                    <td>{{ $report->period ?? 'N/A' }}</td>
                                    <td>{{ $report->generated_at?->format('M d, Y H:i') ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-download"></i></button>
                                            <button class="btn btn-outline-secondary"><i class="bi bi-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $reports->links() }}
            @else
                @include('aggregator._partials.empty-state', [
                    'icon' => 'bi-file-earmark-bar-graph',
                    'title' => 'No Reports Generated',
                    'text' => 'No reports have been generated yet. Select a report type above to generate one.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

