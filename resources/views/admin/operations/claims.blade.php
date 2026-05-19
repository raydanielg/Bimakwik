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
                        <h3 class="fw-bold mb-0">342</h3>
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
                        <h3 class="fw-bold mb-0">45</h3>
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
                        <h3 class="fw-bold mb-0">278</h3>
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
                        <h3 class="fw-bold mb-0">19</h3>
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
                    @forelse([
                        ['id' => 'CLM-2024-001', 'holder' => 'John Mwangi', 'type' => 'Motor Accident', 'amount' => '1,200,000', 'status' => 'pending', 'date' => '2 hours ago'],
                        ['id' => 'CLM-2024-002', 'holder' => 'Sarah Kimani', 'type' => 'Health', 'amount' => '450,000', 'status' => 'approved', 'date' => '5 hours ago'],
                        ['id' => 'CLM-2024-003', 'holder' => 'David Omondi', 'type' => 'Property Damage', 'amount' => '2,800,000', 'status' => 'pending', 'date' => '1 day ago'],
                    ] as $claim)
                    <tr>
                        <td class="py-3"><span class="fw-semibold text-primary">{{ $claim['id'] }}</span></td>
                        <td class="py-3">{{ $claim['holder'] }}</td>
                        <td class="py-3">
                            <span class="badge bg-info bg-opacity-10 text-info">{{ $claim['type'] }}</span>
                        </td>
                        <td class="py-3"><span class="fw-bold">TZS {{ $claim['amount'] }}</span></td>
                        <td class="py-3">
                            @if($claim['status'] == 'pending')
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-clock"></i> Pending
                                </span>
                            @else
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-check-circle"></i> Approved
                                </span>
                            @endif
                        </td>
                        <td class="py-3"><small class="text-muted">{{ $claim['date'] }}</small></td>
                        <td class="py-3 text-end">
                            @if($claim['status'] == 'pending')
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-success" onclick="confirmApprove('#', 'Approve this claim?')">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                                <button class="btn btn-danger" onclick="confirmReject('#', 'Reject this claim?')">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                <button class="btn btn-outline-primary" title="View Details">
                                    <i class="bi bi-eye"></i>
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
