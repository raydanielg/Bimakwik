@extends('layouts.dashboard')

@section('dashboard_title', 'Broker Management')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Broker Management</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Broker
    </a>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-primary bg-opacity-10 text-primary">
                <i class="bi bi-person-badge"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $brokers->total() }}</span>
                <span class="label">Total Brokers</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-success bg-opacity-10 text-success">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $brokers->where('status', 'active')->count() }}</span>
                <span class="label">Active</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-warning bg-opacity-10 text-warning">
                <i class="bi bi-clock"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $brokers->where('status', 'inactive')->count() }}</span>
                <span class="label">Inactive</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-info bg-opacity-10 text-info">
                <i class="bi bi-graph-up"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $brokers->sum(function($broker) { return $broker->brokerProfile?->total_sales ?? 0; }) }}</span>
                <span class="label">Total Sales</span>
            </div>
        </div>
    </div>
</div>

<!-- Brokers Table -->
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="mb-0">All Insurance Brokers</h6>
            </div>
            <div class="col-auto">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" class="form-control" placeholder="Search brokers..." id="searchInput">
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
                        <th>Broker Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>License</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($brokers as $broker)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="bi bi-person-badge text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $broker->name }}</h6>
                                        <small class="text-muted">ID: #BRK{{ str_pad($broker->id, 5, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $broker->brokerProfile->company_name ?? 'Individual' }}</td>
                            <td>{{ $broker->email }}</td>
                            <td>{{ $broker->phone ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-info">{{ $broker->brokerProfile->license_number ?? 'N/A' }}</span>
                            </td>
                            <td>
                                @if($broker->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($broker->status == 'inactive')
                                    <span class="badge bg-warning">Inactive</span>
                                @else
                                    <span class="badge bg-danger">Suspended</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Details</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-graph-up me-2"></i>Performance</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-wallet2 me-2"></i>Commissions</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                    No brokers found
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($brokers->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing {{ $brokers->firstItem() }} to {{ $brokers->lastItem() }} of {{ $brokers->total() }} results
                </div>
                {{ $brokers->links() }}
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
