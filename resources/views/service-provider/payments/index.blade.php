@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('service-provider._partials.page-header', [
        'title' => 'Payments',
        'subtitle' => 'View payment history and status'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-check-circle-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Paid</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($stats['total_paid'] ?? 0, 0) }}</h4>
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
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($stats['pending'] ?? 0, 0) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-receipt-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">This Month</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($stats['this_month'] ?? 0, 0) }}</h4>
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
                            <i class="bi bi-graph-up-arrow text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Growth</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['growth'] ?? 0 }}%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Payment History</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($payments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Reference</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td><span class="fw-bold">{{ $payment->reference ?? 'N/A' }}</span></td>
                                    <td>{{ $payment->currency ?? 'TZS' }} {{ number_format($payment->amount ?? 0, 2) }}</td>
                                    <td>{{ $payment->payment_date?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td>
                                        @if(($payment->status ?? '') === 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif(($payment->status ?? '') === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif(($payment->status ?? '') === 'failed')
                                            <span class="badge bg-danger">Failed</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $payment->status ?? 'N/A' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('service-provider.payments.show', $payment->id ?? 0) }}" class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $payments->links() }}
            @else
                @include('service-provider._partials.empty-state', [
                    'icon' => 'bi-cash-coin',
                    'title' => 'No Payments Found',
                    'text' => 'No payments have been recorded yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection
