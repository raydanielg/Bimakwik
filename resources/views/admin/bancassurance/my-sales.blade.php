@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">My Sales</h1>
            <p class="text-muted mb-0">Track your personal sales and commissions</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" onclick="exportMySales()">
                <i class="bi bi-download me-2"></i>Export
            </button>
            <button class="btn btn-primary" onclick="newSale()">
                <i class="bi bi-plus-lg me-2"></i>New Sale
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-receipt text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Sales</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($totalSales) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-cash-stack text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Paid Commission</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($totalCommission) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-clock text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Pending Commission</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($pendingCommission) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-check-circle text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Policies</h6>
                            <h4 class="mb-0 fw-bold">{{ $mySales->total() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Commission Summary -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="text-center p-3 bg-light rounded-3">
                        <h6 class="text-muted mb-1">This Month</h6>
                        <h4 class="mb-0 fw-bold text-success">TZS {{ number_format($totalCommission * 0.3) }}</h4>
                        <small class="text-muted">30% of total</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-3 bg-light rounded-3">
                        <h6 class="text-muted mb-1">This Quarter</h6>
                        <h4 class="mb-0 fw-bold text-primary">TZS {{ number_format($totalCommission * 0.8) }}</h4>
                        <small class="text-muted">80% of total</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-3 bg-light rounded-3">
                        <h6 class="text-muted mb-1">This Year</h6>
                        <h4 class="mb-0 fw-bold text-info">TZS {{ number_format($totalCommission) }}</h4>
                        <small class="text-muted">100% of total</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- My Sales Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">My Sales History</h5>
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search sales...">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 px-4">Policy Number</th>
                            <th class="border-0 py-3">Customer</th>
                            <th class="border-0 py-3">Product</th>
                            <th class="border-0 py-3">Premium</th>
                            <th class="border-0 py-3">Commission</th>
                            <th class="border-0 py-3">Status</th>
                            <th class="border-0 py-3">Date</th>
                            <th class="border-0 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mySales as $sale)
                        <tr>
                            <td class="py-3 px-4">
                                <span class="fw-semibold text-primary">{{ $sale['policy_number'] }}</span>
                            </td>
                            <td class="py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-secondary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-person text-secondary"></i>
                                    </div>
                                    <span>{{ $sale['customer'] }}</span>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $sale['product'] }}</span>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold">TZS {{ number_format($sale['premium']) }}</span>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold text-success">TZS {{ number_format($sale['commission']) }}</span>
                            </td>
                            <td class="py-3">
                                @if($sale['status'] == 'paid')
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-check-circle me-1"></i>Paid
                                    </span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-clock me-1"></i>Pending
                                    </span>
                                @endif
                            </td>
                            <td class="py-3">
                                <small class="text-muted">{{ $sale['date'] }}</small>
                            </td>
                            <td class="py-3 text-end">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="viewSale({{ $sale['id'] }})" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-success" onclick="downloadPolicy({{ $sale['id'] }})" title="Download Policy">
                                        <i class="bi bi-download"></i>
                                    </button>
                                    <button class="btn btn-outline-info" onclick="requestCommission({{ $sale['id'] }})" title="Request Commission">
                                        <i class="bi bi-cash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted mb-0">No sales found</p>
                                <small class="text-muted">Start selling to see your performance</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($mySales->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $mySales->firstItem() }} to {{ $mySales->lastItem() }} of {{ $mySales->total() }} sales</small>
                <div>
                    {{ $mySales->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function newSale() {
    Swal.fire({
        title: 'New Insurance Sale',
        html: `
            <div class="text-start">
                <div class="mb-3">
                    <label class="form-label">Customer Name</label>
                    <input type="text" id="customerName" class="form-control" placeholder="Enter customer name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Product</label>
                    <select id="product" class="form-select">
                        <option>Motor Insurance</option>
                        <option>Health Insurance</option>
                        <option>Life Insurance</option>
                        <option>General Insurance</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Premium Amount</label>
                    <input type="number" id="premium" class="form-control" placeholder="Enter premium amount">
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Create Sale',
        preConfirm: () => {
            return {
                customer: document.getElementById('customerName').value,
                product: document.getElementById('product').value,
                premium: document.getElementById('premium').value
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Success!', 'Sale created successfully', 'success');
        }
    });
}

function viewSale(id) {
    Swal.fire({
        title: 'Sale Details',
        text: 'Viewing sale details for ID: ' + id,
        icon: 'info'
    });
}

function downloadPolicy(id) {
    Swal.fire({
        title: 'Downloading...',
        html: '<div class="spinner-border text-primary" role="status"></div>',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            setTimeout(() => {
                Swal.fire('Success!', 'Policy downloaded successfully', 'success');
            }, 1500);
        }
    });
}

function requestCommission(id) {
    Swal.fire({
        title: 'Request Commission?',
        text: 'Request commission payout for this sale',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Request'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Success!', 'Commission request submitted', 'success');
        }
    });
}

function exportMySales() {
    Swal.fire({
        title: 'Exporting...',
        html: '<div class="spinner-border text-primary" role="status"></div>',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            setTimeout(() => {
                Swal.fire('Success!', 'Sales exported successfully', 'success');
            }, 1500);
        }
    });
}
</script>
@endpush
@endsection
