@extends('layouts.dashboard')

@section('dashboard_title', 'User Management')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">User Management</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add User
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse($user->roles as $role)
                                    <span class="badge bg-secondary me-1">{{ $role->display_name ?? $role->name }}</span>
                                @empty
                                    <span class="text-muted">No role</span>
                                @endforelse
                            </td>
                            <td>{{ $user->phone ?? 'N/A' }}</td>
                            <td><span class="badge bg-{{ $user->status === 'active' ? 'success' : ($user->status === 'inactive' ? 'warning' : 'danger') }}">{{ ucfirst($user->status ?? 'unknown') }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-light">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="mt-4">{{ $users->links() }}</div>
        @endif
    </div>
</div>
@endsection
