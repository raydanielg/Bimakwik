@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('payment._partials.page-header', [
        'title' => 'Premium Financing',
        'subtitle' => 'Manage premium financing loans',
        'action' => '<a href="{{ route('payment.financing.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> New Loan</a>'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-bank text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Loans</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['total_loans'] ?? 0 }}</h4>
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
                            <i class="bi bi-clock text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Active Loans</h6>
                            <h4 class="mb-0 fw-bold">{{ $stats['active_loans'] ?? 0 }}</h4>
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
                            <i class="bi bi-cash-coin text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Total Amount</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($stats['total_amount'] ?? 0, 0) }}</h4>
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
                            <i class="bi bi-check-circle text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Repaid</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($stats['repaid_amount'] ?? 0, 0) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">Financing Requests</h5>
        </div>
        <div class="card-body">
            @if($financing->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Reference</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Interest Rate</th>
                                <th>Period</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($financing as $loan)
                                <tr>
                                    <td><span class="fw-bold">{{ $loan->reference ?? 'N/A' }}</span></td>
                                    <td>{{ $loan->user->name ?? 'N/A' }}</td>
                                    <td>TZS {{ number_format($loan->amount ?? 0, 0) }}</td>
                                    <td>{{ $loan->metadata['interest_rate'] ?? 0 }}%</td>
                                    <td>{{ $loan->metadata['repayment_period'] ?? 0 }} months</td>
                                    <td>
                                        @if($loan->status === 'completed')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($loan->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('payment.financing.show', $loan->id) }}" class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('payment.financing.schedule', $loan->id) }}" class="btn btn-outline-info"><i class="bi bi-calendar"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $financing->links() }}
            @else
                @include('payment._partials.empty-state', [
                    'icon' => 'bi-bank',
                    'title' => 'No Financing Requests',
                    'text' => 'No premium financing requests have been made yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection
