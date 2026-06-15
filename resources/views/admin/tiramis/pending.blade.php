@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Pending TIRAMIS Claims</h4>
        <small class="text-muted">Claims not yet submitted to TIRA MIS</small>
    </div>
    <div>
        <a href="{{ route('admin.tiramis.reports') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Reports
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Claim #</th>
                        <th>Policy #</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($claims as $claim)
                    <tr>
                        <td class="ps-3">{{ $claim->id }}</td>
                        <td class="fw-semibold"><code>{{ $claim->claim_number }}</code></td>
                        <td><code>{{ $claim->policy?->policy_number ?? 'N/A' }}</code></td>
                        <td>{{ $claim->customer?->full_name ?? 'N/A' }}</td>
                        <td class="fw-bold">{{ number_format($claim->amount ?? 0, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $claim->status === 'approved' ? 'success' : ($claim->status === 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($claim->status) }}
                            </span>
                        </td>
                        <td><small class="text-muted">{{ $claim->created_at->format('d M Y') }}</small></td>
                        <td class="pe-3">
                            <button class="btn btn-sm btn-primary rounded-pill" onclick="submitTiramis({{ $claim->id }})">
                                <i class="bi bi-send me-1"></i> Submit to TIRAMIS
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">All claims have been submitted to TIRAMIS</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($claims->hasPages())
    <div class="card-footer bg-white border-0">
        {{ $claims->links() }}
    </div>
    @endif
</div>

<!-- Submit Modal -->
<div class="modal fade" id="submitModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="submitForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Submit Claim to TIRAMIS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Company Code <span class="text-danger">*</span></label>
                        <input type="text" name="company_code" class="form-control" required placeholder="e.g. TZ-INS-001">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sales Code</label>
                        <input type="text" name="sales_code" class="form-control" placeholder="e.g. SL-AG-001">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit to TIRAMIS</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function submitTiramis(claimId) {
    document.getElementById('submitForm').action = '/admin/operations/claims/' + claimId + '/tiramis';
    new bootstrap.Modal(document.getElementById('submitModal')).show();
}
</script>
@endpush
@endsection
