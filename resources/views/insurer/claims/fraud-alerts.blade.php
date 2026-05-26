@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'Fraud Alerts',
        'subtitle' => 'Monitor and investigate potential fraud cases',
        'icon' => 'bi-shield-exclamation'
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
                            <h6 class="mb-0 text-muted">Total Alerts</h6>
                            <h4 class="mb-0 fw-bold">{{ $alerts->total() ?? 0 }}</h4>
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
                            <h6 class="mb-0 text-muted">Confirmed Fraud</h6>
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
                            <i class="bi bi-x-circle-fill text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">False Positive</h6>
                            <h4 class="mb-0 fw-bold">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Fraud Alerts</h5>
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
                                <th>Claim ID</th>
                                <th>Risk Score</th>
                                <th>Alert Type</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alerts as $alert)
                                <tr>
                                    <td><span class="fw-bold">#{{ $alert->id ?? '-' }}</span></td>
                                    <td>{{ $alert->claim_id ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                <div class="progress-bar {{ $alert->risk_score > 70 ? 'bg-danger' : ($alert->risk_score > 40 ? 'bg-warning' : 'bg-success') }}" 
                                                     style="width: {{ $alert->risk_score ?? 0 }}%"></div>
                                            </div>
                                            <small>{{ $alert->risk_score ?? 0 }}%</small>
                                        </div>
                                    </td>
                                    <td>{{ $alert->alert_type ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($alert->description ?? 'N/A', 50) }}</td>
                                    <td>
                                        @if($alert->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($alert->status === 'confirmed')
                                            <span class="badge bg-danger">Confirmed</span>
                                        @elseif($alert->status === 'false_positive')
                                            <span class="badge bg-success">False Positive</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $alert->status ?? 'Unknown' }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $alert->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-success"><i class="bi bi-check"></i></button>
                                            <button class="btn btn-outline-danger"><i class="bi bi-x"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $alerts->links() }}
            @else
                @include('insurer._partials.empty-state', [
                    'icon' => 'bi-shield-exclamation',
                    'title' => 'No Fraud Alerts',
                    'text' => 'No fraud alerts have been detected yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection
