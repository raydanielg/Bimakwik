@extends('layouts.dashboard')

@section('dashboard_title', 'Customer Management')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Customer Management</h4>
    <div class="btn-group">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add Customer
        </a>
        <button class="btn btn-outline-secondary">
            <i class="bi bi-download me-2"></i>Export
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-primary bg-opacity-10 text-primary">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $customers->total() }}</span>
                <span class="label">Total Customers</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-success bg-opacity-10 text-success">
                <i class="bi bi-person-check"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $customers->where('status', 'active')->count() }}</span>
                <span class="label">Active</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-warning bg-opacity-10 text-warning">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $customers->where('status', 'inactive')->count() }}</span>
                <span class="label">Inactive</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-info bg-opacity-10 text-info">
                <i class="bi bi-shield-check"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $customers->whereHas('customerProfile', function($q) { $q->where('kyc_status', 'verified'); })->count() }}</span>
                <span class="label">KYC Verified</span>
            </div>
        </div>
    </div>
</div>

<!-- Customers Table -->
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="mb-0">All Customers</h6>
            </div>
            <div class="col-auto">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" class="form-control" placeholder="Search customers..." id="searchInput">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>KYC Status</th>
                        <th>Policies</th>
                        <th>Registration Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="bi bi-person-fill text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $customer->name }}</h6>
                                        <small class="text-muted">ID: #CUST{{ str_pad($customer->id, 5, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone ?? 'N/A' }}</td>
                            <td>{{ $customer->customerProfile->location ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $kycStatus = $customer->customerProfile->kyc_status ?? 'pending';
                                @endphp
                                @if($kycStatus == 'verified')
                                    <span class="badge bg-success">Verified</span>
                                @elseif($kycStatus == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger">Not Started</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $customer->customerProfile->active_policies_count ?? 0 }}</span>
                            </td>
                            <td>{{ $customer->created_at->format('M d, Y') }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Profile</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-shield-check me-2"></i>KYC Details</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-file-text me-2"></i>View Policies</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                    No customers found
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($customers->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} results
                </div>
                {{ $customers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
// Search functionality
document.getElementById('searchInput')?.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});
</script>
@endpush
