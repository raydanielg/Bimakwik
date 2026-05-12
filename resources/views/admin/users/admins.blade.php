@extends('layouts.dashboard')

@section('dashboard_title', 'Admin & Staff Management')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Admin & Staff Management</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Admin
    </a>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-danger bg-opacity-10 text-danger">
                <i class="bi bi-shield-fill"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $admins->whereHas('roles', function($q) { $q->where('name', 'super_admin'); })->count() }}</span>
                <span class="label">Super Admins</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-primary bg-opacity-10 text-primary">
                <i class="bi bi-person-badge"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $admins->whereHas('roles', function($q) { $q->where('name', 'admin'); })->count() }}</span>
                <span class="label">Admins</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-info bg-opacity-10 text-info">
                <i class="bi bi-person-workspace"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $admins->whereHas('roles', function($q) { $q->where('name', 'sub_admin'); })->count() }}</span>
                <span class="label">Sub Admins</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-success bg-opacity-10 text-success">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $admins->where('status', 'active')->count() }}</span>
                <span class="label">Active Staff</span>
            </div>
        </div>
    </div>
</div>

<!-- Admins Table -->
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="mb-0">All Admin & Staff Members</h6>
            </div>
            <div class="col-auto">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" class="form-control" placeholder="Search admins..." id="searchInput">
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="bi bi-person-fill text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $admin->name }}</h6>
                                        <small class="text-muted">ID: #ADM{{ str_pad($admin->id, 5, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                @foreach($admin->roles as $role)
                                    <span class="badge bg-{{ $role->name == 'super_admin' ? 'danger' : ($role->name == 'admin' ? 'primary' : 'info') }} me-1">
                                        {{ ucfirst($role->name) }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $admin->phone ?? 'N/A' }}</td>
                            <td>
                                @if($admin->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($admin->status == 'inactive')
                                    <span class="badge bg-warning">Inactive</span>
                                @else
                                    <span class="badge bg-danger">Suspended</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $admin->last_login_at ? $admin->last_login_at->diffForHumans() : 'Never' }}</small>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.users.edit', $admin) }}"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-key me-2"></i>Reset Password</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-shield-exclamation me-2"></i>Permissions</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('admin.users.destroy', $admin) }}" onsubmit="return confirm('Are you sure you want to delete this admin?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bi bi-trash me-2"></i>Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                    No admin staff found
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($admins->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing {{ $admins->firstItem() }} to {{ $admins->lastItem() }} of {{ $admins->total() }} results
                </div>
                {{ $admins->links() }}
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
