@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1">Claims Center</h2>
        <p class="text-muted small mb-0">Manage and process insurance claims</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Claims</p>
                        <h3 class="fw-bold mb-0">{{ number_format($totalClaims) }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-exclamation-octagon text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Pending Review</p>
                        <h3 class="fw-bold mb-0">{{ number_format($pendingClaims) }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-clock-history text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Approved</p>
                        <h3 class="fw-bold mb-0">{{ number_format($approvedClaims) }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Rejected</p>
                        <h3 class="fw-bold mb-0">{{ number_format($rejectedClaims) }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-x-circle text-danger fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0 fw-bold">Recent Claims</h5>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search claims...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3">Claim ID</th>
                        <th class="border-0 py-3">Policy Holder</th>
                        <th class="border-0 py-3">Type</th>
                        <th class="border-0 py-3">Amount</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 py-3">Date</th>
                        <th class="border-0 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($claims as $claim)
                    @php
                        $status = strtolower((string) ($claim->status ?? 'pending'));
                        $isActionable = in_array($status, ['submitted', 'pending', 'processing'], true);
                        $claimCode = $claim->claim_number ?? ('CLM-' . str_pad((string) $claim->id, 6, '0', STR_PAD_LEFT));
                        $claimType = $claim->claim_type ?? 'General';
                        $holder = $claim->customer->name ?? ('Customer #' . ($claim->customer_id ?? 'N/A'));
                        $amount = (float) ($claim->claimed_amount ?? 0);
                    @endphp
                    <tr>
                        <td class="py-3"><span class="fw-semibold text-primary">{{ $claimCode }}</span></td>
                        <td class="py-3">{{ $holder }}</td>
                        <td class="py-3">
                            <span class="badge bg-info bg-opacity-10 text-info">{{ $claimType }}</span>
                        </td>
                        <td class="py-3"><span class="fw-bold">TZS {{ number_format($amount, 2) }}</span></td>
                        <td class="py-3">
                            @if($status === 'approved')
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-check-circle"></i> Approved
                                </span>
                            @elseif($status === 'rejected')
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    <i class="bi bi-x-circle"></i> Rejected
                                </span>
                            @elseif($status === 'processing')
                                <span class="badge bg-info bg-opacity-10 text-info">
                                    <i class="bi bi-arrow-repeat"></i> Processing
                                </span>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-clock"></i> Pending
                                </span>
                            @endif
                        </td>
                        <td class="py-3"><small class="text-muted">{{ optional($claim->created_at)->diffForHumans() ?? '-' }}</small></td>
                        <td class="py-3 text-end">
                            @if($isActionable)
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-success" onclick="confirmApprove('{{ route('admin.operations.claims.approve', $claim->id) }}', 'Approve this claim?')">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                                <button class="btn btn-danger" onclick="confirmReject('{{ route('admin.operations.claims.reject', $claim->id) }}', 'Reject this claim?')">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                <a href="{{ route('admin.operations.claims.show', $claim->id) }}" class="btn btn-outline-primary" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                            @else
                            <a href="{{ route('admin.operations.claims.show', $claim->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted">No claims found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
