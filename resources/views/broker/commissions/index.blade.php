@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    @include('broker._partials.page-header', [
        'title' => 'Commissions',
        'subtitle' => 'Track earned and pending commissions',
        'icon' => 'bi-cash-coin'
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
                            <h6 class="mb-0 text-muted">Total Earned</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($totalEarned, 0) }}</h4>
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
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($pendingAmount, 0) }}</h4>
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
                            <i class="bi bi-graph-up-arrow text-info fs-4"></i>
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
                @include('broker._partials.empty-state', [
                    'icon' => 'bi-cash-coin',
                    'title' => 'No Commissions Found',
                    'text' => 'No commissions have been recorded yet.'
                ])
            @endif
        </div>
    </div>
</div>
@endsection

