@extends('layouts.dashboard')
@section('dashboard_content')
@include('insurer._partials.page-header', ['pageTitle' => 'Claims Processing', 'pageSubtitle' => 'Claims currently under review', 'pageIcon' => 'gear'])
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($processing->count() > 0)
        <div class="table-responsive"><table class="table table-hover mb-0"><thead class="table-light"><tr><th>Claim #</th><th>Customer</th><th>Type</th><th>Stage</th><th>Assigned To</th><th>Action</th></tr></thead><tbody>
            @foreach($processing as $c)
            <tr><td><code>CLM-{{ str_pad($c->id, 6, '0', STR_PAD_LEFT) }}</code></td><td>{{ optional($c->customer)->name ?? '—' }}</td><td><span class="badge bg-info bg-opacity-10 text-info">{{ ucfirst($c->type ?? 'General') }}</span></td><td><span class="badge bg-warning bg-opacity-10 text-warning">{{ ucfirst($c->status ?? 'Processing') }}</span></td><td class="small">{{ $c->assigned_to ?? 'Unassigned' }}</td><td><button class="btn btn-sm btn-primary"><i class="bi bi-arrow-right"></i> Review</button></td></tr>
            @endforeach
        </tbody></table></div>
        <div class="p-3">{{ $processing->links() }}</div>
        @else
        @include('insurer._partials.empty-state', ['emptyIcon' => 'gear', 'emptyTitle' => 'No claims in processing', 'emptyText' => 'All claims are either resolved or pending'])
        @endif
    </div>
</div>
@endsection
