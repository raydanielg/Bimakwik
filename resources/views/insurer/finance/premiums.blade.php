@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'Premiums Report',
        'subtitle' => 'Track premium collections and payments',
        'icon' => 'bi-cash-stack'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-currency-dollar text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Collected</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($totalAmount ?? 0, 0) }}</h4>
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
                            <h6 class="mb-0 text-muted">This Month</h6>
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
                            <i class="bi bi-receipt-fill text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Transactions</h6>
                            <h4 class="mb-0 fw-bold">{{ $premiums->total() ?? 0 }}</h4>
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
                            <i class="bi bi-percent text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Growth</h6>
                            <h4 class="mb-0 fw-bold">0%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Premium Transactions</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($premiums->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Transaction ID</th>
                                <th>Policy</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($premiums as $premium)
                                <tr>
                                    <td><span class="fw-bold">#{{ $premium->id ?? '-' }}</span></td>
                                    <td>{{ $premium->policy_number ?? 'N/A' }}</td>
                                    <td>{{ $premium->customer_name ?? 'N/A' }}</td>
                                    <td class="fw-bold">TZS {{ number_format($premium->amount ?? 0, 0) }}</td>
                                    <td>{{ $premium->payment_method ?? 'N/A' }}</td>
                                    <td>{{ $premium->created_at?->format('M d, Y H:i') ?? 'N/A' }}</td>
                                    <td>
                                        @if($premium->status === 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($premium->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($premium->status === 'failed')
                                            <span class="badge bg-danger">Failed</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $premium->status ?? 'Unknown' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-secondary"><i class="bi bi-receipt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $premiums->links() }}
            @else
                @include('insurer._partials.empty-state', [
                    'icon' => 'bi-cash-stack',
                    'title' => 'No Premium Transactions',
                    'text' => 'No premium transactions have been recorded yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection
