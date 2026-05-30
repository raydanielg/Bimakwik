@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'Claims',
        'subtitle' => 'Manage insurance claims'
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
                            <h6 class="mb-0 text-muted">Total Claims</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['total'] ?? 0 }}</h4>
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
                            <h6 class="mb-0 text-muted">Pending</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['pending'] ?? 0 }}</h4>
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
                            <h6 class="mb-0 text-muted">Approved</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['approved'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-x-circle-fill text-danger fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Rejected</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['rejected'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Claims</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($claims->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Claim ID</th>
                                <th>Customer</th>
                                <th>Policy</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($claims as $claim)
                                <tr>
                                    <td><span class="fw-bold">#{{ $claim->id ?? 'N/A' }}</span></td>
                                    <td>{{ $claim->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $claim->policy->policy_number ?? 'N/A' }}</td>
                                    <td>TZS {{ number_format($claim->amount ?? 0, 0) }}</td>
                                    <td>{{ $claim->claim_date?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td>
                                        @if(($claim->status ?? '') === 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif(($claim->status ?? '') === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif(($claim->status ?? '') === 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif(($claim->status ?? '') === 'processing')
                                            <span class="badge bg-info">Processing</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $claim->status ?? 'N/A' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('service-provider.claims.show', $claim->id ?? 0) }}" class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $claims->links() }}
            @else
                @include('service-provider._partials.empty-state', [
                    'icon' => 'bi-file-earmark-medical',
                    'title' => 'No Claims Found',
                    'text' => 'No claims have been submitted yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection
