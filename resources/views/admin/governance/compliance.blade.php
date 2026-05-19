@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1">Compliance (TIRA)</h2>
        <p class="text-muted small mb-0">Regulatory compliance and TIRA reporting</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Compliance Score</p>
                        <h3 class="fw-bold mb-0">96%</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-shield-check text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Pending Reports</p>
                        <h3 class="fw-bold mb-0">3</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-file-earmark-text text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Submitted This Month</p>
                        <h3 class="fw-bold mb-0">12</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-send text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Next Deadline</p>
                        <h3 class="fw-bold mb-0">5 Days</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-calendar-event text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">Required Reports</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach([
                        ['name' => 'Monthly Premium Report', 'due' => '5 days', 'status' => 'pending'],
                        ['name' => 'Claims Statistics', 'due' => '12 days', 'status' => 'draft'],
                        ['name' => 'Solvency Report', 'due' => '20 days', 'status' => 'not_started'],
                    ] as $report)
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $report['name'] }}</h6>
                                <small class="text-muted">Due in {{ $report['due'] }}</small>
                            </div>
                            <span class="badge bg-{{ $report['status'] == 'pending' ? 'warning' : ($report['status'] == 'draft' ? 'info' : 'secondary') }} bg-opacity-10 text-{{ $report['status'] == 'pending' ? 'warning' : ($report['status'] == 'draft' ? 'info' : 'secondary') }}">
                                {{ ucfirst(str_replace('_', ' ', $report['status'])) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">Recent Submissions</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach([
                        ['name' => 'Quarterly Financial Report', 'date' => '2 days ago', 'status' => 'approved'],
                        ['name' => 'Policy Register Update', 'date' => '1 week ago', 'status' => 'approved'],
                        ['name' => 'Claims Report Q1', 'date' => '2 weeks ago', 'status' => 'approved'],
                    ] as $submission)
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $submission['name'] }}</h6>
                                <small class="text-muted">{{ $submission['date'] }}</small>
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="bi bi-check-circle"></i> {{ ucfirst($submission['status']) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
