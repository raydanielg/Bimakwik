@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">Commission Management</h2>
                <p class="text-muted small mb-0">Track broker, agent, and partner commissions</p>
            </div>
            <button class="btn btn-success rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#payCommissionsModal">
                <i class="bi bi-cash-coin me-2"></i>Process Payments
            </button>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Commissions</p>
                        <h3 class="fw-bold mb-0">TZS 18.4M</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-percent text-primary fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary">
                        This month
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Pending Payouts</p>
                        <h3 class="fw-bold mb-0">TZS 6.2M</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-hourglass-split text-warning fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-warning bg-opacity-10 text-warning">
                        124 partners waiting
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Paid This Month</p>
                        <h3 class="fw-bold mb-0">TZS 12.2M</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-success bg-opacity-10 text-success">
                        <i class="bi bi-arrow-up"></i> On schedule
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Avg. Commission Rate</p>
                        <h3 class="fw-bold mb-0">12.5%</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-graph-up text-info fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-info bg-opacity-10 text-info">
                        Across all partners
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Commissions Table -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <div class="row align-items-center">
            <div class="col-md-4">
                <h5 class="mb-0 fw-bold">Commission Records</h5>
            </div>
            <div class="col-md-4">
                <select class="form-select">
                    <option>All Partner Types</option>
                    <option>Brokers</option>
                    <option>Agents</option>
                    <option>Aggregators</option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search partner...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3">Partner</th>
                        <th class="border-0 py-3">Type</th>
                        <th class="border-0 py-3">Policy</th>
                        <th class="border-0 py-3">Premium</th>
                        <th class="border-0 py-3">Rate</th>
                        <th class="border-0 py-3">Commission</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse([
                        ['partner' => 'Broker Network Ltd', 'type' => 'Broker', 'policy' => 'POL-001234', 'premium' => '450,000', 'rate' => '15%', 'commission' => '67,500', 'status' => 'pending'],
                        ['partner' => 'Agent John Doe', 'type' => 'Agent', 'policy' => 'POL-001235', 'premium' => '280,000', 'rate' => '10%', 'commission' => '28,000', 'status' => 'paid'],
                        ['partner' => 'Aggregator Hub', 'type' => 'Aggregator', 'policy' => 'POL-001236', 'premium' => '120,000', 'rate' => '12%', 'commission' => '14,400', 'status' => 'pending'],
                        ['partner' => 'Broker Network Ltd', 'type' => 'Broker', 'policy' => 'POL-001237', 'premium' => '380,000', 'rate' => '15%', 'commission' => '57,000', 'status' => 'paid'],
                        ['partner' => 'Agent Sarah K', 'type' => 'Agent', 'policy' => 'POL-001238', 'premium' => '650,000', 'rate' => '10%', 'commission' => '65,000', 'status' => 'approved'],
                    ] as $commission)
                    <tr>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-person-badge text-primary"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $commission['partner'] }}</div>
                                    <small class="text-muted">ID: PTR-{{ rand(1000, 9999) }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-{{ $commission['type'] == 'Broker' ? 'primary' : ($commission['type'] == 'Agent' ? 'success' : 'info') }} bg-opacity-10 text-{{ $commission['type'] == 'Broker' ? 'primary' : ($commission['type'] == 'Agent' ? 'success' : 'info') }}">
                                {{ $commission['type'] }}
                            </span>
                        </td>
                        <td class="py-3">
                            <span class="text-primary fw-semibold">{{ $commission['policy'] }}</span>
                        </td>
                        <td class="py-3">TZS {{ $commission['premium'] }}</td>
                        <td class="py-3">
                            <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                {{ $commission['rate'] }}
                            </span>
                        </td>
                        <td class="py-3">
                            <span class="fw-bold text-success">TZS {{ $commission['commission'] }}</span>
                        </td>
                        <td class="py-3">
                            @if($commission['status'] == 'paid')
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-check-circle"></i> Paid
                                </span>
                            @elseif($commission['status'] == 'approved')
                                <span class="badge bg-info bg-opacity-10 text-info">
                                    <i class="bi bi-check2-circle"></i> Approved
                                </span>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-clock"></i> Pending
                                </span>
                            @endif
                        </td>
                        <td class="py-3 text-end">
                            @if($commission['status'] == 'pending')
                            <button class="btn btn-sm btn-success" onclick="confirmApprove('#', 'Approve commission payment?')">
                                <i class="bi bi-check-lg"></i>
                            </button>
                            @else
                            <button class="btn btn-sm btn-outline-primary" title="View Details">
                                <i class="bi bi-eye"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted">No commissions found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing 1 to 5 of 89 commissions</small>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Pay Commissions Modal -->
<div class="modal fade" id="payCommissionsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom bg-success bg-opacity-10">
                <h5 class="modal-title fw-bold text-success">
                    <i class="bi bi-cash-coin me-2"></i>Process Commission Payments
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info border-0">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>124 partners</strong> have pending commissions totaling <strong>TZS 6.2M</strong>
                </div>
                <form id="payCommissionsForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Payment Method</label>
                        <select class="form-select" required>
                            <option value="">Select method...</option>
                            <option value="bank">Bank Transfer (Bulk)</option>
                            <option value="mpesa">M-Pesa (Individual)</option>
                            <option value="wallet">Wallet Credit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Payment Date</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="confirmPayment" required>
                        <label class="form-check-label" for="confirmPayment">
                            I confirm that funds are available and ready to be disbursed
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="processCommissionPayments()">
                    <i class="bi bi-send me-2"></i>Process Payments
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function processCommissionPayments() {
    Swal.fire({
        title: 'Processing Payments...',
        text: 'Please wait while we process commission payments',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Payments Processed!',
            text: 'Commission payments have been queued successfully',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            $('#payCommissionsModal').modal('hide');
            location.reload();
        });
    }, 2000);
}
</script>
@endpush
@endsection
