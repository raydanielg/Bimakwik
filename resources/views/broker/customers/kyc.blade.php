@extends('layouts.dashboard')
@section('dashboard_title', 'KYC Status')
@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Customer KYC Status</h4>
        <p class="text-muted mb-0 small">Know Your Customer verification overview</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-patch-check fs-4"></i></div>
                <div>
                    <div class="text-muted small">Verified</div>
                    <div class="fw-bold fs-5">{{ $verifiedCount }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-clock fs-4"></i></div>
                <div>
                    <div class="text-muted small">Pending</div>
                    <div class="fw-bold fs-5">{{ $pendingCount }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;"><i class="bi bi-x-circle fs-4"></i></div>
                <div>
                    <div class="text-muted small">Rejected</div>
                    <div class="fw-bold fs-5">{{ $rejectedCount }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Customer</th>
                        <th>Email</th>
                        <th>Document Type</th>
                        <th>Status</th>
                        <th>Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kycList as $kyc)
                    <tr>
                        <td class="ps-4 fw-bold">{{ optional($kyc->user)->name ?? 'N/A' }}</td>
                        <td class="text-muted small">{{ optional($kyc->user)->email ?? '—' }}</td>
                        <td>{{ $kyc->document_type ?? '—' }}</td>
                        <td>
                            @if($kyc->status === 'verified')
                                <span class="badge bg-success-subtle text-success">Verified</span>
                            @elseif($kyc->status === 'pending')
                                <span class="badge bg-warning-subtle text-warning">Pending</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger">Rejected</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $kyc->created_at?->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-person-badge fs-2 d-block mb-2 opacity-25"></i>
                            No KYC submissions found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($kycList instanceof \Illuminate\Pagination\LengthAwarePaginator && $kycList->hasPages())
    <div class="card-footer bg-white border-0 py-3 px-4">{{ $kycList->links() }}</div>
    @endif
</div>
@endsection
