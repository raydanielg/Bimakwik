@extends('layouts.dashboard')
@section('dashboard_content')
@include('insurer._partials.page-header', ['pageTitle' => 'Claims Center', 'pageSubtitle' => 'All claims across your policies', 'pageIcon' => 'exclamation-octagon'])

<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Total Claims</p><h3 class="fw-bold mb-0">{{ number_format($stats['total']) }}</h3></div></div></div>
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Pending</p><h3 class="fw-bold mb-0 text-warning">{{ number_format($stats['pending']) }}</h3></div></div></div>
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Approved</p><h3 class="fw-bold mb-0 text-success">{{ number_format($stats['approved']) }}</h3></div></div></div>
    <div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><p class="text-muted small mb-1">Rejected</p><h3 class="fw-bold mb-0 text-danger">{{ number_format($stats['rejected']) }}</h3></div></div></div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($claims->count() > 0)
        <div class="table-responsive"><table class="table table-hover mb-0"><thead class="table-light"><tr><th>Claim #</th><th>Customer</th><th>Type</th><th>Amount</th><th>Status</th><th>Filed</th><th>Action</th></tr></thead><tbody>
            @foreach($claims as $claim)
            <tr><td><code>CLM-{{ str_pad($claim->id, 6, '0', STR_PAD_LEFT) }}</code></td><td>{{ optional($claim->customer)->name ?? '—' }}</td><td><span class="badge bg-info bg-opacity-10 text-info">{{ ucfirst($claim->type ?? 'General') }}</span></td><td class="fw-semibold">TZS {{ number_format($claim->amount ?? 0) }}</td><td><span class="badge bg-{{ ($claim->status ?? 'pending') == 'approved' ? 'success' : (($claim->status ?? '') == 'rejected' ? 'danger' : 'warning') }} bg-opacity-10 text-{{ ($claim->status ?? 'pending') == 'approved' ? 'success' : (($claim->status ?? '') == 'rejected' ? 'danger' : 'warning') }}">{{ ucfirst($claim->status ?? 'pending') }}</span></td><td class="small text-muted">{{ optional($claim->created_at)->diffForHumans() ?? '—' }}</td><td><button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button></td></tr>
            @endforeach
        </tbody></table></div>
        <div class="p-3">{{ $claims->links() }}</div>
        @else
        @include('insurer._partials.empty-state', ['emptyIcon' => 'exclamation-octagon', 'emptyTitle' => 'No claims yet', 'emptyText' => 'All claims will be listed here'])
        @endif
    </div>
</div>
@endsection
