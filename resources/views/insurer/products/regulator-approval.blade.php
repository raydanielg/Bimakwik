@extends('layouts.dashboard')
@section('dashboard_content')
@include('insurer._partials.page-header', ['pageTitle' => 'Regulator Approval (TIRA)', 'pageSubtitle' => 'Products awaiting TIRA approval', 'pageIcon' => 'patch-check'])
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($pending->count() > 0)
        <div class="table-responsive"><table class="table table-hover mb-0"><thead class="table-light"><tr><th>Product</th><th>Submitted</th><th>Status</th><th>Action</th></tr></thead><tbody>
            @foreach($pending as $product)
            <tr><td class="fw-semibold">{{ $product->name }}</td><td class="small text-muted">{{ $product->created_at->diffForHumans() }}</td><td><span class="badge bg-warning bg-opacity-10 text-warning">Pending TIRA</span></td><td><button class="btn btn-sm btn-outline-info"><i class="bi bi-arrow-right"></i> Resubmit</button></td></tr>
            @endforeach
        </tbody></table></div>
        <div class="p-3">{{ $pending->links() }}</div>
        @else
        @include('insurer._partials.empty-state', ['emptyIcon' => 'patch-check', 'emptyTitle' => 'No pending approvals', 'emptyText' => 'All products are approved or in draft state'])
        @endif
    </div>
</div>
@endsection
