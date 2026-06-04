@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1">Payout Requests</h2>
        <p class="text-muted small mb-0">Review and approve partner payout requests</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Pending Requests</p>
                        <h3 class="fw-bold mb-0">TZS {{ number_format($pendingPayouts, 2) }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-clock-history text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Approved Today</p>
                        <h3 class="fw-bold mb-0">TZS {{ number_format($approvedToday, 2) }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total This Month</p>
                        <h3 class="fw-bold mb-0">TZS {{ number_format($totalThisMonth, 2) }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-bank text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <h5 class="mb-0 fw-bold">Payout Requests</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3">Request ID</th>
                        <th class="border-0 py-3">Partner</th>
                        <th class="border-0 py-3">Amount</th>
                        <th class="border-0 py-3">Bank Details</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 py-3">Date</th>
                        <th class="border-0 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payouts as $payout)
                    @php
                        $source = strtolower((string) ($payout->_source ?? 'wallet'));
                        $status = strtolower((string) ($payout->status ?? 'pending'));
                        $isPending = $status === 'pending';
                        $amount = (float) ($payout->amount ?? 0);
                        $requestCode = strtoupper(substr($source, 0, 3)) . '-' . str_pad((string) $payout->id, 6, '0', STR_PAD_LEFT);
                        if ($source === 'broker') {
                            $partner = 'Broker #' . ($payout->broker_id ?? 'N/A');
                        } elseif ($source === 'agent') {
                            $partner = 'Agent #' . ($payout->agent_id ?? 'N/A');
                        } elseif ($source === 'aggregator') {
                            $partner = 'Aggregator #' . ($payout->aggregator_id ?? 'N/A');
                        } else {
                            $partner = 'Wallet #' . ($payout->wallet_id ?? 'N/A');
                        }
                        $bankDetails = trim((string) ($payout->withdrawal_method ?? ''));
                        if (!empty($payout->destination)) {
                            $bankDetails = trim($bankDetails . ' - ' . $payout->destination, ' -');
                        }
                    @endphp
                    <tr>
                        <td class="py-3"><span class="fw-semibold text-primary">{{ $requestCode }}</span></td>
                        <td class="py-3">{{ $partner }}</td>
                        <td class="py-3"><span class="fw-bold text-success">TZS {{ number_format($amount, 2) }}</span></td>
                        <td class="py-3"><small class="text-muted">{{ $bankDetails ?: '-' }}</small></td>
                        <td class="py-3">
                            @if($isPending)
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-clock"></i> Pending
                                </span>
                            @elseif($status === 'rejected')
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    <i class="bi bi-x-circle"></i> Rejected
                                </span>
                            @else
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-check-circle"></i> Approved
                                </span>
                            @endif
                        </td>
                        <td class="py-3"><small class="text-muted">{{ optional($payout->created_at)->diffForHumans() ?? '-' }}</small></td>
                        <td class="py-3 text-end">
                            @if($isPending)
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-success" onclick="confirmApprove('{{ route('admin.finance.payouts.approve', ['id' => $payout->id, 'type' => $source]) }}', 'Approve this payout?')">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                                <button class="btn btn-danger" onclick="confirmReject('{{ route('admin.finance.payouts.reject', ['id' => $payout->id, 'type' => $source]) }}', 'Reject this payout?')">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            @else
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted">No payout requests</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
