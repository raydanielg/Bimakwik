@extends('layouts.dashboard')

@section('dashboard_title', 'Agent Management')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Agent Management (SFE/Bancassurance)</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Agent
    </a>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-primary bg-opacity-10 text-primary">
                <i class="bi bi-person-workspace"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $agents->total() }}</span>
                <span class="label">Total Agents</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-success bg-opacity-10 text-success">
                <i class="bi bi-bank"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $agents->whereHas('roles', function($q) { $q->where('name', 'bancassurance'); })->count() }}</span>
                <span class="label">Bancassurance</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-info bg-opacity-10 text-info">
                <i class="bi bi-briefcase"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $agents->whereHas('roles', function($q) { $q->where('name', 'sfe'); })->count() }}</span>
                <span class="label">SFE Agents</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-warning bg-opacity-10 text-warning">
                <i class="bi bi-graph-up"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $agents->sum(function($agent) { return $agent->agentProfile?->monthly_sales ?? 0; }) }}</span>
                <span class="label">Monthly Sales</span>
            </div>
        </div>
    </div>
</div>

<!-- Agents Table -->
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="mb-0">All Sales Agents</h6>
            </div>
            <div class="col-auto">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" class="form-control" placeholder="Search agents..." id="searchInput">
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
                        <th>Agent Name</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Branch/Bank</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="bi bi-person-workspace text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $agent->name }}</h6>
                                        <small class="text-muted">ID: #AGT{{ str_pad($agent->id, 5, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @foreach($agent->roles as $role)
                                    <span class="badge bg-{{ $role->name == 'sfe' ? 'info' : 'success' }} me-1">
                                        {{ $role->name == 'sfe' ? 'SFE' : 'Bancassurance' }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $agent->email }}</td>
                            <td>{{ $agent->phone ?? 'N/A' }}</td>
                            <td>{{ $agent->agentProfile->branch_name ?? $agent->agentProfile->bank_name ?? 'N/A' }}</td>
                            <td>
                                @if($agent->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($agent->status == 'inactive')
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
                                    No agents found
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($agents->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing {{ $agents->firstItem() }} to {{ $agents->lastItem() }} of {{ $agents->total() }} results
                </div>
                {{ $agents->links() }}
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
