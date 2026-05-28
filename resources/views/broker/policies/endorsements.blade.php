@extends('layouts.dashboard')
@section('dashboard_title', 'Policy Endorsements')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Policy Endorsements</h4>
        <p class="text-muted mb-0 small">Amendments and modifications to existing policies</p>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Ref #</th>
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($endorsements as $endorsement)
                    <tr>
                        <td class="ps-4"><code class="small">{{ $endorsement->reference ?? '-' }}</code></td>
                        <td class="fw-bold">{{ optional(optional($endorsement->customerPolicy)->customer)->name ?? 'N/A' }}</td>
                        <td>{{ $endorsement->endorsement_type ?? $endorsement->type ?? '—' }}</td>
                        <td class="text-muted small">{{ Str::limit($endorsement->description ?? '—', 60) }}</td>
                        <td>
                            @php $status = $endorsement->status ?? 'pending'; @endphp
                            @if($status === 'approved')
                                <span class="badge bg-success-subtle text-success">Approved</span>
                            @elseif($status === 'pending')
                                <span class="badge bg-warning-subtle text-warning">Pending</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">{{ ucfirst($status) }}</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $endorsement->created_at?->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-file-earmark-text fs-2 d-block mb-2 opacity-25"></i>
                            No endorsements found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($endorsements instanceof \Illuminate\Pagination\LengthAwarePaginator && $endorsements->hasPages())
    <div class="card-footer bg-white border-0 py-3 px-4">{{ $endorsements->links() }}</div>
    @endif
</div>
@endsection
