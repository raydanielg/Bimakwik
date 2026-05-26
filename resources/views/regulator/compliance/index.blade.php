@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('regulator._partials.page-header', [
        'title' => 'Compliance Monitoring',
        'subtitle' => 'Track and manage compliance alerts and violations',
        'icon' => 'bi-shield-check'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Critical Alerts</h6>
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
                            <h6 class="mb-0 text-muted">Pending Review</h6>
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
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Resolved</h6>
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
                            <i class="bi bi-info-circle-fill text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Alerts</h6>
                            <h4 class="mb-0 fw-bold">{{ $alerts->total() ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Compliance Alerts</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($alerts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Alert ID</th>
                                <th>Type</th>
                                <th>Entity</th>
                                <th>Severity</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alerts as $alert)
                                <tr>
                                    <td><span class="fw-bold">#{{ $alert->id ?? '-' }}</span></td>
                                    <td>{{ $alert->type ?? 'N/A' }}</td>
                                    <td>{{ $alert->entity ?? 'N/A' }}</td>
                                    <td>
                                        @if($alert->severity === 'critical')
                                            <span class="badge bg-danger">Critical</span>
                                        @elseif($alert->severity === 'high')
                                            <span class="badge bg-warning">High</span>
                                        @else
                                            <span class="badge bg-info">Low</span>
                                        @endif
                                    </td>
                                    <td>{{ $alert->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td>
                                        @if($alert->status === 'resolved')
                                            <span class="badge bg-success">Resolved</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-success"><i class="bi bi-check"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $alerts->links() }}
            @else
                @include('regulator._partials.empty-state', [
                    'icon' => 'bi-shield-check',
                    'title' => 'No Compliance Alerts',
                    'text' => 'No compliance alerts have been recorded yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection
