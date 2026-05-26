@extends('layouts.dashboard')
@section('dashboard_content')
@include('insurer._partials.page-header', ['pageTitle' => 'Policy Cancellations', 'pageSubtitle' => 'Cancelled policies & refund tracking', 'pageIcon' => 'x-circle'])
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($cancellations->count() > 0)
        <div class="table-responsive"><table class="table table-hover mb-0"><thead class="table-light"><tr><th>Policy</th><th>Reason</th><th>Cancellation Date</th><th>Refund Amount</th><th>Status</th></tr></thead><tbody>
            @foreach($cancellations as $c)
            <tr><td>{{ $c->policy_id }}</td><td class="small text-muted">{{ Str::limit($c->reason ?? '-', 40) }}</td><td class="small">{{ $c->cancelled_at ?? '—' }}</td><td class="fw-semibold">TZS {{ number_format($c->refund_amount ?? 0) }}</td><td><span class="badge bg-secondary bg-opacity-10 text-secondary">{{ ucfirst($c->status ?? 'Processed') }}</span></td></tr>
            @endforeach
        </tbody></table></div>
        <div class="p-3">{{ $cancellations->links() }}</div>
        @else
        @include('insurer._partials.empty-state', ['emptyIcon' => 'x-circle', 'emptyTitle' => 'No cancellations', 'emptyText' => 'Cancelled policies will appear here'])
        @endif
    </div>
</div>
@endsection
