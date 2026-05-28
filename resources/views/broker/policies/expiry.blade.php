@extends('layouts.dashboard')
@section('dashboard_title', 'Expiry Alerts')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Policy Expiry Alerts</h4>
        <p class="text-muted mb-0 small">Policies expiring within 30 days</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-hourglass-split fs-4"></i></div>
                <div>
                    <div class="text-muted small">Expiring Soon</div>
                    <div class="fw-bold fs-5">{{ $expiring->total() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-x-circle fs-4"></i></div>
                <div>
                    <div class="text-muted small">Already Expired</div>
                    <div class="fw-bold fs-5">{{ $expiredCount }}</div>
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
                        <th>Policy No.</th>
                        <th>Expiry Date</th>
                        <th>Days Left</th>
                        <th>Premium</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expiring as $policy)
                    @php $daysLeft = now()->diffInDays($policy->expiry_date, false); @endphp
                    <tr>
                        <td class="ps-4 fw-bold">{{ optional($policy->customer)->name ?? 'N/A' }}</td>
                        <td>{{ optional($policy->insuranceProduct)->name ?? 'N/A' }}</td>
                        <td><code class="small">{{ $policy->policy_number ?? '—' }}</code></td>
                        <td class="text-muted small">{{ $policy->expiry_date ? \Carbon\Carbon::parse($policy->expiry_date)->format('M d, Y') : '—' }}</td>
                        <td>
                            @if($daysLeft <= 7)
                                <span class="badge bg-danger-subtle text-danger">{{ $daysLeft }}d left</span>
                            @elseif($daysLeft <= 14)
                                <span class="badge bg-warning-subtle text-warning">{{ $daysLeft }}d left</span>
                            @else
                                <span class="badge bg-info-subtle text-info">{{ $daysLeft }}d left</span>
                            @endif
                        </td>
                        <td class="fw-bold">TZS {{ number_format($policy->premium ?? 0, 0) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-check-circle fs-2 d-block mb-2 opacity-25"></i>
                            No policies expiring within the next 30 days.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($expiring->hasPages())
    <div class="card-footer bg-white border-0 py-3 px-4">{{ $expiring->links() }}</div>
    @endif
</div>
@endsection
