@extends('layouts.dashboard')

@section('dashboard_content')
@include('insurer._partials.page-header', ['pageTitle' => 'All Policies', 'pageSubtitle' => 'Active and historical insurance policies', 'pageIcon' => 'shield-check'])

<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Total Policies</p><h3 class="fw-bold mb-0">{{ number_format($totalCount) }}</h3></div></div></div>
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Active</p><h3 class="fw-bold mb-0 text-success">{{ number_format($activeCount) }}</h3></div></div></div>
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Expired</p><h3 class="fw-bold mb-0 text-secondary">{{ number_format($expiredCount) }}</h3></div></div></div>
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Renewal Due</p><h3 class="fw-bold mb-0 text-warning">—</h3></div></div></div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($policies->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th>Policy #</th><th>Customer</th><th>Product</th><th>Premium</th><th>Status</th><th>Expiry</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @foreach($policies as $policy)
                    <tr>
                        <td><code class="small">{{ $policy->policy_number ?? 'POL-'.str_pad($policy->id, 6, '0', STR_PAD_LEFT) }}</code></td>
                        <td>{{ optional($policy->customer)->name ?? '—' }}</td>
                        <td>{{ optional($policy->product)->name ?? '—' }}</td>
                        <td>TZS {{ number_format($policy->premium_amount ?? 0) }}</td>
                        <td><span class="badge bg-success bg-opacity-10 text-success">{{ ucfirst($policy->status ?? 'active') }}</span></td>
                        <td class="small text-muted">{{ $policy->expires_at ?? '—' }}</td>
                        <td><button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $policies->links() }}</div>
        @else
        @include('insurer._partials.empty-state', ['emptyIcon' => 'shield', 'emptyTitle' => 'No policies yet', 'emptyText' => 'Customer policies will appear here'])
        @endif
    </div>
</div>
@endsection
