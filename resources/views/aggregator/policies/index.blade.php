@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    @include('aggregator._partials.page-header', [
        'title' => 'Policies',
        'subtitle' => 'View all policies across the marketplace',
        'icon' => 'bi-shield-check'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-shield-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Policies</h6>
                            <h4 class="mb-0 fw-bold">{{ $totalCount }}</h4>
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
                            <h6 class="mb-0 text-muted">Active</h6>
                            <h4 class="mb-0 fw-bold">{{ $activeCount }}</h4>
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
                            <h6 class="mb-0 text-muted">Expired</h6>
                            <h4 class="mb-0 fw-bold">{{ $expiredCount }}</h4>
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
                            <i class="bi bi-currency-dollar text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Premium</h6>
                            <h4 class="mb-0 fw-bold">TZS 0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Policies</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($policies->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Policy Number</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Broker/Agent</th>
                                <th>Premium</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($policies as $policy)
                                <tr>
                                    <td><span class="fw-bold">{{ $policy->policy_number ?? 'POL-' . $policy->id }}</span></td>
                                    <td>{{ $policy->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $policy->product->name ?? 'N/A' }}</td>
                                    <td>{{ $policy->broker_name ?? 'N/A' }}</td>
                                    <td class="fw-bold">TZS {{ number_format($policy->premium ?? 0, 0) }}</td>
                                    <td>
                                        @if($policy->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($policy->status === 'expired')
                                            <span class="badge bg-danger">Expired</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $policy->status ?? 'Unknown' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $policies->links() }}
            @else
                @include('aggregator._partials.empty-state', [
                    'icon' => 'bi-shield-check',
                    'title' => 'No Policies Found',
                    'text' => 'There are no policies recorded yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

