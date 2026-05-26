@extends('layouts.dashboard')
@section('dashboard_content')
@include('insurer._partials.page-header', ['pageTitle' => 'Policy Endorsements', 'pageSubtitle' => 'Mid-term changes and amendments to active policies', 'pageIcon' => 'pencil-square'])
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        @if($endorsements->count() > 0)
        <div class="table-responsive"><table class="table table-hover mb-0"><thead class="table-light"><tr><th>Endorsement #</th><th>Policy</th><th>Type</th><th>Effective Date</th><th>Status</th></tr></thead><tbody>
            @foreach($endorsements as $end)
            <tr><td><code>END-{{ str_pad($end->id, 6, '0', STR_PAD_LEFT) }}</code></td><td>{{ $end->policy_id ?? '—' }}</td><td><span class="badge bg-info bg-opacity-10 text-info">{{ ucfirst($end->endorsement_type ?? 'Change') }}</span></td><td class="small">{{ $end->effective_date ?? '—' }}</td><td><span class="badge bg-success bg-opacity-10 text-success">{{ ucfirst($end->status ?? 'Approved') }}</span></td></tr>
            @endforeach
        </tbody></table></div>
        <div class="p-3">{{ $endorsements->links() }}</div>
        @else
        @include('insurer._partials.empty-state', ['emptyIcon' => 'pencil-square', 'emptyTitle' => 'No endorsements', 'emptyText' => 'Mid-term policy changes will appear here'])
        @endif
    </div>
</div>
@endsection
