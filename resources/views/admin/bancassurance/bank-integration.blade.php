@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Bank Integration</h1>
            <p class="text-muted mb-0">Manage bank partnerships and API connections</p>
        </div>
        <button class="btn btn-primary" onclick="addBank()">
            <i class="bi bi-plus-lg me-2"></i>Add Bank
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-bank text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Banks</h6>
                            <h4 class="mb-0 fw-bold">{{ $banks->total() }}</h4>
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
                            <h4 class="mb-0 fw-bold">{{ $banks->where('status', 'active')->count() }}</h4>
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
                            <h4 class="mb-0 fw-bold">{{ $banks->where('status', 'pending')->count() }}</h4>
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
                                <i class="bi bi-people text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Customers</h6>
                            <h4 class="mb-0 fw-bold">{{ number_format($banks->sum('customers')) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Banks Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Connected Banks</h5>
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search banks...">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 px-4">Bank Name</th>
                            <th class="border-0 py-3">Status</th>
                            <th class="border-0 py-3">Customers</th>
                            <th class="border-0 py-3">Transactions</th>
                            <th class="border-0 py-3">Last Sync</th>
                            <th class="border-0 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banks as $bank)
                        <tr>
                            <td class="py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-bank text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $bank['name'] }}</div>
                                        <small class="text-muted">ID: #{{ $bank['id'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                @if($bank['status'] == 'active')
                                    <span class="badge bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-check-circle me-1"></i>Active
                                    </span>
                                @elseif($bank['status'] == 'pending')
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
                                <span class="fw-semibold">{{ number_format($bank['customers']) }}</span>
                            </td>
                            <td class="py-3">
                                <span class="fw-semibold">{{ number_format($bank['transactions']) }}</span>
                            </td>
                            <td class="py-3">
                                <small class="text-muted">{{ $bank['last_sync'] }}</small>
                            </td>
                            <td class="py-3 text-end">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="viewBank({{ $bank['id'] }})" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-outline-success" onclick="syncBank({{ $bank['id'] }})" title="Sync Now">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" onclick="editBank({{ $bank['id'] }})" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted mb-0">No banks connected yet</p>
                                <small class="text-muted">Add your first bank to get started</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($banks->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Showing {{ $banks->firstItem() }} to {{ $banks->lastItem() }} of {{ $banks->total() }} banks</small>
                <div>
                    {{ $banks->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function addBank() {
    Swal.fire({
        title: 'Add New Bank',
        html: `
            <div class="text-start">
                <div class="mb-3">
                    <label class="form-label">Bank Name</label>
                    <input type="text" id="bankName" class="form-control" placeholder="Enter bank name">
                </div>
                <div class="mb-3">
                    <label class="form-label">API Key</label>
                    <input type="password" id="apiKey" class="form-control" placeholder="Enter API key">
                </div>
                <div class="mb-3">
                    <label class="form-label">API Endpoint</label>
                    <input type="url" id="apiEndpoint" class="form-control" placeholder="https://api.bank.com">
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Add Bank',
        preConfirm: () => {
            return {
                name: document.getElementById('bankName').value,
                apiKey: document.getElementById('apiKey').value,
                apiEndpoint: document.getElementById('apiEndpoint').value
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire('Success!', 'Bank added successfully', 'success');
        }
    });
}

function viewBank(id) {
    Swal.fire({
        title: 'Bank Details',
        text: 'Viewing bank details for ID: ' + id,
        icon: 'info'
    });
}

function syncBank(id) {
    Swal.fire({
        title: 'Syncing...',
        html: '<div class="spinner-border text-primary" role="status"></div>',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            setTimeout(() => {
                Swal.fire('Success!', 'Bank synced successfully', 'success');
            }, 1500);
        }
    });
}

function editBank(id) {
    Swal.fire({
        title: 'Edit Bank',
        text: 'Edit bank configuration for ID: ' + id,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Save Changes'
    });
}
</script>
@endpush
@endsection
