@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1"><i class="bi bi-shield-lock me-2"></i>Audit Logs</h2>
        <p class="text-muted small mb-0">Comprehensive system activity tracking and security monitoring</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Logs</p>
                        <h3 class="fw-bold mb-0">{{ number_format($totalLogs) }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-file-text text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Today's Activity</p>
                        <h3 class="fw-bold mb-0">{{ number_format($todayLogs) }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-calendar-check text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Active Users</p>
                        <h3 class="fw-bold mb-0">{{ number_format($uniqueUsers) }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-people text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Critical Actions</p>
                        <h3 class="fw-bold mb-0">{{ number_format($criticalActions) }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-exclamation-triangle text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Breakdown & Critical Activities -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-bar-chart me-2"></i>Top Actions</h5>
            </div>
            <div class="card-body">
                @forelse($actionStats as $stat)
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-semibold text-capitalize">{{ $stat->action }}</span>
                        <span class="text-muted">{{ number_format($stat->count) }}</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: {{ ($stat->count / $totalLogs) * 100 }}%"></div>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center py-3">No action data available</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-exclamation-octagon me-2"></i>Recent Critical Activities</h5>
            </div>
            <div class="card-body">
                @forelse($criticalLogs as $log)
                <div class="d-flex align-items-start mb-3 pb-3 border-bottom">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                        <i class="bi bi-shield-exclamation text-danger"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold small">{{ $log->action ?? 'Action' }}</div>
                        <small class="text-muted">{{ $log->description ?? 'No description' }}</small>
                        <div class="mt-1">
                            <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $log->created_at ? $log->created_at->diffForHumans() : 'Unknown' }}</small>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center py-3">No critical activities</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Filters & Search -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.system.audit-logs') }}">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-0 bg-light" placeholder="Search logs..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="action" class="form-select border-0 bg-light">
                        <option value="">All Actions</option>
                        <option value="create" {{ request('action') == 'create' ? 'selected' : '' }}>Create</option>
                        <option value="update" {{ request('action') == 'update' ? 'selected' : '' }}>Update</option>
                        <option value="delete" {{ request('action') == 'delete' ? 'selected' : '' }}>Delete</option>
                        <option value="approve" {{ request('action') == 'approve' ? 'selected' : '' }}>Approve</option>
                        <option value="reject" {{ request('action') == 'reject' ? 'selected' : '' }}>Reject</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel me-2"></i>Filter
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.system.audit-logs') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-circle me-2"></i>Clear
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Audit Logs Table -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold"><i class="bi bi-list-ul me-2"></i>All Activity Logs</h5>
            <span class="badge bg-primary bg-opacity-10 text-primary">{{ $logs->total() }} Records</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3 px-4">ID</th>
                        <th class="border-0 py-3">User</th>
                        <th class="border-0 py-3">Action</th>
                        <th class="border-0 py-3">Description</th>
                        <th class="border-0 py-3">IP Address</th>
                        <th class="border-0 py-3">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td class="py-3 px-4">
                            <span class="badge bg-secondary bg-opacity-10 text-secondary">#{{ $log->id }}</span>
                        </td>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                    <i class="bi bi-person text-primary small"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold small">{{ $log->user->name ?? 'System' }}</div>
                                    <small class="text-muted">{{ $log->user->email ?? 'N/A' }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="py-3">
                            @php
                                $actionColors = [
                                    'create' => 'success',
                                    'update' => 'primary',
                                    'delete' => 'danger',
                                    'approve' => 'info',
                                    'reject' => 'warning',
                                    'login' => 'secondary',
                                    'logout' => 'secondary',
                                ];
                                $color = $actionColors[strtolower($log->action ?? 'default')] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} text-capitalize">
                                <i class="bi bi-{{ $log->action == 'create' ? 'plus-circle' : ($log->action == 'update' ? 'pencil' : ($log->action == 'delete' ? 'trash' : 'dot')) }} me-1"></i>
                                {{ $log->action ?? 'Unknown' }}
                            </span>
                        </td>
                        <td class="py-3">
                            <div class="small">{{ Str::limit($log->description ?? 'No description', 50) }}</div>
                        </td>
                        <td class="py-3">
                            <small class="text-muted font-monospace">{{ $log->ip_address ?? 'N/A' }}</small>
                        </td>
                        <td class="py-3">
                            <div class="small">
                                <i class="bi bi-clock me-1"></i>
                                {{ $log->created_at ? $log->created_at->format('M d, Y H:i') : 'N/A' }}
                            </div>
                            <small class="text-muted">{{ $log->created_at ? $log->created_at->diffForHumans() : '' }}</small>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted mb-0">No audit logs found</p>
                            <small class="text-muted">Activity logs will appear here</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($logs->hasPages())
    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} logs
            </div>
            <div>
                {{ $logs->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
