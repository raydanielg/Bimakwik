@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('payment._partials.page-header', [
        'title' => 'Offline Payments',
        'subtitle' => 'Manage offline payment approvals',
        'action' => '<a href="{{ route('payment.offline.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Record Payment</a>'
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">Offline Payments</h5>
        </div>
        <div class="card-body">
            @if($payments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Reference</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td><span class="fw-bold">{{ $payment->reference ?? 'N/A' }}</span></td>
                                    <td>{{ $payment->user->name ?? 'N/A' }}</td>
                                    <td>{{ $payment->currency ?? 'TZS' }} {{ number_format($payment->amount ?? 0, 2) }}</td>
                                    <td>
                                        @if($payment->status === 'completed')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($payment->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>{{ $payment->payment_date?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('payment.offline.show', $payment->id) }}" class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                                            @if($payment->status === 'pending')
                                                <a href="{{ route('payment.offline.approve', $payment->id) }}" class="btn btn-outline-success"><i class="bi bi-check"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $payments->links() }}
            @else
                @include('payment._partials.empty-state', [
                    'icon' => 'bi-cash',
                    'title' => 'No Offline Payments',
                    'text' => 'No offline payments have been recorded yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection
