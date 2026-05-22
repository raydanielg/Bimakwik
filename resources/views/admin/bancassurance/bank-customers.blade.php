@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Bank Customers</h1>
            <p class="text-muted mb-0">View and manage customers from partner banks</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" onclick="exportCustomers()">
                <i class="bi bi-download me-2"></i>Export
            </button>
            <button class="btn btn-primary" onclick="addCustomer()">
                <i class="bi bi-plus-lg me-2"></i>Add Customer
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
                                <i class="bi bi-people text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Customers</h6>
                            <h4 class="mb-0 fw-bold">{{ $customers->total() }}</h4>
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
                            <h6 class="text-muted mb-1">Active</h6>
                            <h4 class="mb-0 fw-bold">{{ $customers->where('status', 'active')->count() }}</h4>
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
                                <i class="bi bi-shield-check text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Insured</h6>
                            <h4 class="mb-0 fw-bold">{{ $customers->where('products', '>', 0)->count() }}</h4>
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
                                <i class="bi bi-cash-stack text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Premium</h6>
                            <h4 class="mb-0 fw-bold">TZS {{ number_format($customers->sum('total_premium')) }}</h4>
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
                    <label class="form-label small fw-semibold">Status</label>
                    <select class="form-select">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Pending</option>
                        <option>Inactive</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Date Range</label>
                    <select class="form-select">
                        <option>All Time</option>
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last 3 months</option>
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

    <!-- Customers Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Customer List</h5>
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search customers...">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 px-4">Customer</th>
                            <th class="border-0 py-3">Account Number</th>
                            <th class="border-0 py-3">Bank</th>
                            <th class="border-0 py-3">Products</th>
                            <th class="border-0 py-3">Total Premium</th>
                            <th class="border-0 py-3">Status</th>
                            <th class="border-0 py-3">Joined</th>
                            <th class="border-0 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td class="py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-secondary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-person text-secondary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $customer['name'] }}</div>
                                        <small class="text-muted">ID: #{{ $customer['id'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <code class="bg-light px-2 py-1 rounded">{{ $customer['account_number'] }}</code>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $customer['bank'] }}</span>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold">{{ $customer['products'] }}</span>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold">TZS {{ number_format($customer['total_premium']) }}</span>
                            </td>
                            <td class="py-3">
                                @if($customer['status'] == 'active')
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-check-circle me-1"></i>Active
                                    </span>
                                @elseif($customer['status'] == 'pending')
                                    <span class="badge bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-clock me-1"></i>Pending
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                        <i class="bi bi-x-circle me-1"></i>Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="py-3">
                                <small class="text-muted">{{ $customer['joined'] }}</small>
                            </td>
                            <td class="py-3 text-end">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="viewCustomer({{ $customer['id'] }})" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-success" onclick="viewPolicies({{ $customer['id'] }})" title="View Policies">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" onclick="editCustomer({{ $customer['id'] }})" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted mb-0">No customers found</p>
                                <small class="text-muted">Add your first customer to get started</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($customers->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} customers</small>
                <div>
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function addCustomer() {
    Swal.fire({
        title: 'Add New Customer',
        html: `
            <div class="text-start">
                <div class="mb-3">
                    <label class="form-label">Customer Name</label>
                    <input type="text" id="customerName" class="form-control" placeholder="Enter customer name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Account Number</label>
                    <input type="text" id="accountNumber" class="form-control" placeholder="Enter account number">
                </div>
                <div class="mb-3">
                    <label class="form-label">Bank</label>
                    <select id="bank" class="form-select">
                        <option>CRDB Bank</option>
                        <option>NMB Bank</option>
                        <option>TCB</option>
                    </select>
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Add Customer',
        preConfirm: () => {
            return {
                name: document.getElementById('customerName').value,
                accountNumber: document.getElementById('accountNumber').value,
                bank: document.getElementById('bank').value
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Success!', 'Customer added successfully', 'success');
        }
    });
}

function viewCustomer(id) {
    Swal.fire({
        title: 'Customer Details',
        text: 'Viewing customer details for ID: ' + id,
        icon: 'info'
    });
}

function viewPolicies(id) {
    Swal.fire({
        title: 'Customer Policies',
        text: 'Viewing policies for customer ID: ' + id,
        icon: 'info'
    });
}

function editCustomer(id) {
    Swal.fire({
        title: 'Edit Customer',
        text: 'Edit customer details for ID: ' + id,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Save Changes'
    });
}

function exportCustomers() {
    Swal.fire({
        title: 'Exporting...',
        html: '<div class="spinner-border text-primary" role="status"></div>',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            setTimeout(() => {
                Swal.fire('Success!', 'Customers exported successfully', 'success');
            }, 1500);
        }
    });
}
</script>
@endpush
@endsection
