@extends('layouts.dashboard')

@section('dashboard_title', 'RBAC Settings')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Role-Based Access Control (RBAC)</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
        <i class="bi bi-plus-circle me-2"></i>Create New Role
    </button>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-primary bg-opacity-10 text-primary">
                <i class="bi bi-shield-fill"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $roles->count() }}</span>
                <span class="label">Total Roles</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-success bg-opacity-10 text-success">
                <i class="bi bi-key"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $roles->sum(function($role) { return $role->permissions->count(); }) }}</span>
                <span class="label">Total Permissions</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-warning bg-opacity-10 text-warning">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $roles->sum(function($role) { return $role->users->count(); }) }}</span>
                <span class="label">Users Assigned</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="stat-icon-box bg-info bg-opacity-10 text-info">
                <i class="bi bi-gear"></i>
            </div>
            <div class="stat-info">
                <span class="value">{{ $roles->where('is_system', true)->count() }}</span>
                <span class="label">System Roles</span>
            </div>
        </div>
    </div>
</div>

<!-- Roles and Permissions -->
<div class="row">
    @foreach($roles as $role)
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">{{ ucfirst($role->name) }} Role</h6>
                            <small class="text-muted">{{ $role->users->count() }} users assigned</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit Role</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-people me-2"></i>Assign Users</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-key me-2"></i>Manage Permissions</a></li>
                                @if(!$role->is_system)
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete Role</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted d-block mb-2">Description:</small>
                        <p class="mb-0">{{ $role->description ?? 'No description available' }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block mb-2">Permissions ({{ $role->permissions->count() }}):</small>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($role->permissions->take(10) as $permission)
                                <span class="badge bg-light text-dark">{{ $permission->name }}</span>
                            @endforeach
                            @if($role->permissions->count() > 10)
                                <span class="badge bg-secondary">+{{ $role->permissions->count() - 10 }} more</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block mb-2">Recent Users:</small>
                        <div class="d-flex align-items-center">
                            @foreach($role->users->take(5) as $user)
                                <div class="avatar-xs bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" title="{{ $user->name }}">
                                    <span class="text-primary fw-bold">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            @endforeach
                            @if($role->users->count() > 5)
                                <small class="text-muted">+{{ $role->users->count() - 5 }} more</small>
                            @endif
                        </div>
                    </div>
                    
                    @if($role->is_system)
                        <div class="alert alert-info small">
                            <i class="bi bi-info-circle me-2"></i>
                            This is a system role and cannot be deleted.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Create Role Modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="roleName" placeholder="e.g., content_manager">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="roleDisplayName" class="form-label">Display Name</label>
                            <input type="text" class="form-control" id="roleDisplayName" placeholder="e.g., Content Manager">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="roleDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="roleDescription" rows="3" placeholder="Describe the role's responsibilities..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="small text-muted mb-2">User Management</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_users_view">
                                    <label class="form-check-label" for="perm_users_view">View Users</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_users_create">
                                    <label class="form-check-label" for="perm_users_create">Create Users</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_users_edit">
                                    <label class="form-check-label" for="perm_users_edit">Edit Users</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_users_delete">
                                    <label class="form-check-label" for="perm_users_delete">Delete Users</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="small text-muted mb-2">Content Management</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_content_view">
                                    <label class="form-check-label" for="perm_content_view">View Content</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_content_create">
                                    <label class="form-check-label" for="perm_content_create">Create Content</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_content_edit">
                                    <label class="form-check-label" for="perm_content_edit">Edit Content</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_content_publish">
                                    <label class="form-check-label" for="perm_content_publish">Publish Content</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="small text-muted mb-2">System Settings</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_settings_view">
                                    <label class="form-check-label" for="perm_settings_view">View Settings</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_settings_edit">
                                    <label class="form-check-label" for="perm_settings_edit">Edit Settings</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_reports_view">
                                    <label class="form-check-label" for="perm_reports_view">View Reports</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perm_audit_view">
                                    <label class="form-check-label" for="perm_audit_view">View Audit Logs</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Create Role</button>
            </div>
        </div>
    </div>
</div>
@endsection
