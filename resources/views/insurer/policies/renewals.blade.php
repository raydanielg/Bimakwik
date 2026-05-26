@extends('layouts.dashboard')
@section('dashboard_content')
@include('insurer._partials.page-header', ['pageTitle' => 'Policy Renewals', 'pageSubtitle' => 'Upcoming and processed policy renewals', 'pageIcon' => 'arrow-repeat'])
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($renewals->count() > 0)
        <div class="table-responsive"><table class="table table-hover mb-0"><thead class="table-light"><tr><th>Policy</th><th>Customer</th><th>Renewal Date</th><th>New Premium</th><th>Status</th></tr></thead><tbody>
            @foreach($renewals as $r)
            <tr><td>{{ $r->policy_id }}</td><td>{{ $r->customer_name ?? '—' }}</td><td class="small">{{ $r->renewal_date ?? '—' }}</td><td class="fw-semibold">TZS {{ number_format($r->new_premium ?? 0) }}</td><td><span class="badge bg-{{ ($r->status ?? '') == 'completed' ? 'success' : 'warning' }} bg-opacity-10 text-{{ ($r->status ?? '') == 'completed' ? 'success' : 'warning' }}">{{ ucfirst($r->status ?? 'Pending') }}</span></td></tr>
            @endforeach
        </tbody></table></div>
        <div class="p-3">{{ $renewals->links() }}</div>
        @else
        @include('insurer._partials.empty-state', ['emptyIcon' => 'arrow-repeat', 'emptyTitle' => 'No renewals', 'emptyText' => 'Upcoming renewals will appear here'])
        @endif
    </div>
</div>
@endsection
