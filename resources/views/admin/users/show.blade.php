@extends('layouts.dashboard')

@section('dashboard_title', 'User Details')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">User Details</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
            <i class="bi bi-pencil me-2"></i>Edit User
        </a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row g-4 align-items-center mb-3">
            <div class="col-md-2 text-center text-md-start">
                @if($user->logo)
                    <img src="{{ asset('storage/' . $user->logo) }}" alt="User Logo" class="rounded" style="width: 96px; height: 96px; object-fit: cover;">
                @else
                    <div class="d-inline-flex rounded-circle bg-primary bg-opacity-10 align-items-center justify-content-center" style="width: 96px; height: 96px;">
                        <i class="bi bi-person-fill text-primary fs-2"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-10">
                <h5 class="mb-1">{{ $user->name }}</h5>
                <p class="text-muted mb-0">{{ $user->email }}</p>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label text-muted small mb-1">Company ID</label>
                <div>{{ $user->company_id ?? 'N/A' }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small mb-1">Sales ID</label>
                <div>{{ $user->sales_id ?? 'N/A' }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small mb-1">Phone</label>
                <div>{{ $user->phone ?? 'N/A' }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small mb-1">Status</label>
                <div>
                    <span class="badge bg-{{ $user->status === 'active' ? 'success' : ($user->status === 'inactive' ? 'warning' : 'danger') }}">
                        {{ ucfirst($user->status ?? 'unknown') }}
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small mb-1">Roles</label>
                <div>
                    @forelse($user->roles as $role)
                        <span class="badge bg-secondary me-1">{{ $role->display_name ?? $role->name }}</span>
                    @empty
                        <span>N/A</span>
                    @endforelse
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small mb-1">Created</label>
                <div>{{ optional($user->created_at)->format('M d, Y H:i') ?? 'N/A' }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small mb-1">Preferred Language</label>
                <div>{{ $user->preferred_language === 'sw' ? 'Kiswahili' : 'English' }}</div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small mb-1">Change Language</label>
                <form method="POST" action="{{ route('admin.users.language.update', $user) }}" class="d-flex gap-2">
                    @csrf
                    <select name="preferred_language" class="form-select form-select-sm" style="max-width: 180px;">
                        <option value="en" @selected(($user->preferred_language ?? 'en') === 'en')>English</option>
                        <option value="sw" @selected(($user->preferred_language ?? 'en') === 'sw')>Kiswahili</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-translate me-1"></i>Change Language
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
