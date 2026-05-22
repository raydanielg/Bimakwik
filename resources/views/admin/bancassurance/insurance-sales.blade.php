@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Insurance Sales</h1>
            <p class="text-muted mb-0">Track all insurance sales through bank channels</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" onclick="exportSales()">
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
                            <h4 class="mb-0 fw-bold">{{ $sales->total() }}</h4>
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
                                <i class="bi bi-check-circle text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Active Policies</h6>
                            <h4 class="mb-0 fw-bold">{{ $sales->where('status', 'active')->count() }}</h4>
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
                            <h6 class="text-muted mb-1">Pending</h6>
                            <h4 class="mb-0 fw-bold">{{ $sales->where('status', 'pending')->count() }}</h4>
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
                                <i class="bi bi-cash-stack text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Revenue</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($sales->sum('premium')) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Bank</label>
                    <select class="form-select">
                        <option>All Banks</option>
                        <option>CRDB Bank</option>
                        <option>NMB Bank</option>
                        <option>TCB</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Product</label>
                    <select class="form-select">
                        <option>All Products</option>
                        <option>Motor Insurance</option>
                        <option>Health Insurance</option>
                        <option>Life Insurance</option>
                        <option>General Insurance</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Status</label>
                    <select class="form-select">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Pending</option>
                        <option>Expired</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">&nbsp;</label>
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-funnel me-2"></i>Apply Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Sales Transactions</h5>
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
                            <th class="border-0 py-3">Bank</th>
                            <th class="border-0 py-3">Agent</th>
                            <th class="border-0 py-3">Status</th>
                            <th class="border-0 py-3">Date</th>
                            <th class="border-0 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
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
                                <span class="badge bg-info bg-opacity-10 text-info">{{ $sale['bank'] }}</span>
                            </td>
                            <td class="py-3">
                                <small class="text-muted">{{ $sale['agent'] }}</small>
                            </td>
                            <td class="py-3">
                                @if($sale['status'] == 'active')
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-check-circle me-1"></i>Active
                                    </span>
                                @elseif($sale['status'] == 'pending')
                                    <span class="badge bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-clock me-1"></i>Pending
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger">
                                        <i class="bi bi-x-circle me-1"></i>Expired
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
                                    <button class="btn btn-outline-secondary" onclick="editSale({{ $sale['id'] }})" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted mb-0">No sales found</p>
                                <small class="text-muted">Create your first sale to get started</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($sales->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $sales->firstItem() }} to {{ $sales->lastItem() }} of {{ $sales->total() }} sales</small>
                <div>
                    {{ $sales->links() }}
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

function editSale(id) {
    Swal.fire({
        title: 'Edit Sale',
        text: 'Edit sale details for ID: ' + id,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Save Changes'
    });
}

function exportSales() {
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
