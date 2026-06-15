@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('agent._partials.page-header', [
        'title' => 'Commissions',
        'subtitle' => 'Track your earned commissions',
        'icon' => 'bi-cash-coin'
    ])

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Commission History</h5>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary"><i class="bi bi-download me-1"></i> Export</button>
                    <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($commissions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Commission ID</th>
                                <th>Policy</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Rate</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commissions as $commission)
                                <tr>
                                    <td><span class="fw-bold">#{{ $commission->id ?? '-' }}</span></td>
                                    <td>{{ $commission->policy_number ?? 'N/A' }}</td>
                                    <td>{{ $commission->customer_name ?? 'N/A' }}</td>
                                    <td class="fw-bold">TZS {{ number_format($commission->amount ?? 0, 0) }}</td>
                                    <td>{{ $commission->rate ?? 0 }}%</td>
                                    <td>{{ $commission->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td>
                                        @if($commission->status === 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @elseif($commission->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $commission->status ?? 'Unknown' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-secondary"><i class="bi bi-download"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $commissions->links() }}
            @else
                @include('agent._partials.empty-state', [
                    'icon' => 'bi-cash-coin',
                    'title' => 'No Commissions Found',
                    'text' => 'No commissions have been recorded yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection
