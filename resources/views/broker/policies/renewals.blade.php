@extends('layouts.dashboard')
@section('dashboard_title', 'Policy Renewals')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Policy Renewals</h4>
        <p class="text-muted mb-0 small">Track and manage policy renewal requests</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-arrow-repeat fs-4"></i></div>
                <div>
                    <div class="text-muted small">Pending Renewals</div>
                    <div class="fw-bold fs-5">{{ $pendingCount }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-exclamation-circle fs-4"></i></div>
                <div>
                    <div class="text-muted small">Overdue Renewals</div>
                    <div class="fw-bold fs-5">{{ $overdueCount }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Customer</th>
                        <th>Product</th>
                        <th>Renewal Date</th>
                        <th>Premium</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($renewals as $renewal)
                    <tr>
                        <td class="ps-4 fw-bold">{{ optional(optional($renewal->customerPolicy)->customer)->name ?? 'N/A' }}</td>
                        <td>{{ optional(optional($renewal->customerPolicy)->insuranceProduct)->name ?? 'N/A' }}</td>
                        <td class="text-muted small">{{ $renewal->renewal_date ? \Carbon\Carbon::parse($renewal->renewal_date)->format('M d, Y') : '—' }}</td>
                        <td class="fw-bold">TZS {{ number_format(optional($renewal->customerPolicy)->premium ?? 0, 0) }}</td>
                        <td>
                            @if($renewal->status === 'completed')
                                <span class="badge bg-success-subtle text-success">Completed</span>
                            @elseif($renewal->status === 'pending')
                                <span class="badge bg-warning-subtle text-warning">Pending</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">{{ ucfirst($renewal->status ?? 'Unknown') }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-arrow-repeat fs-2 d-block mb-2 opacity-25"></i>
                            No renewal records found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($renewals instanceof \Illuminate\Pagination\LengthAwarePaginator && $renewals->hasPages())
    <div class="card-footer bg-white border-0 py-3 px-4">{{ $renewals->links() }}</div>
    @endif
</div>
@endsection
