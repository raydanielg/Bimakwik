@extends('layouts.dashboard')
@section('dashboard_title', 'Lead Generation')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Lead Generation</h4>
        <p class="text-muted mb-0 small">Referral-driven leads and conversion tracking</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-person-check fs-4"></i></div>
                <div>
                    <div class="text-muted small">Total Leads (Clicks)</div>
                    <div class="fw-bold fs-5">{{ number_format($totalLeads) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-cart-check fs-4"></i></div>
                <div>
                    <div class="text-muted small">Converted (Sales)</div>
                    <div class="fw-bold fs-5">{{ number_format($convertedLeads) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-percent fs-4"></i></div>
                <div>
                    <div class="text-muted small">Conversion Rate</div>
                    <div class="fw-bold fs-5">{{ $conversionRate }}%</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 py-3">
        <h6 class="fw-bold mb-0">Recent Conversions</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Sale Ref</th>
                        <th>Premium Amount</th>
                        <th>Commission</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentSales as $sale)
                    <tr>
                        <td class="ps-4"><code class="small">{{ $sale->reference ?? $sale->id }}</code></td>
                        <td class="fw-bold">TZS {{ number_format($sale->premium_amount ?? 0, 0) }}</td>
                        <td class="text-success fw-bold">TZS {{ number_format($sale->commission_amount ?? 0, 0) }}</td>
                        <td>
                            <span class="badge bg-success-subtle text-success">{{ ucfirst($sale->status ?? 'completed') }}</span>
                        </td>
                        <td class="text-muted small">{{ $sale->created_at?->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-person-check fs-2 d-block mb-2 opacity-25"></i>
                            No conversions yet. Keep sharing your referral links!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($recentSales instanceof \Illuminate\Pagination\LengthAwarePaginator && $recentSales->hasPages())
    <div class="card-footer bg-white border-0 py-3 px-4">{{ $recentSales->links() }}</div>
    @endif
</div>
@endsection
