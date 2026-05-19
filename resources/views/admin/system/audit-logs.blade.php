@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1">Audit Logs</h2>
        <p class="text-muted small mb-0">Track system activities and user actions</p>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0 fw-bold">Recent Activities</h5>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search logs...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3">User</th>
                        <th class="border-0 py-3">Action</th>
                        <th class="border-0 py-3">Resource</th>
                        <th class="border-0 py-3">IP Address</th>
                        <th class="border-0 py-3">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse([
                        ['user' => 'Admin User', 'action' => 'Updated', 'resource' => 'Policy #12345', 'ip' => '192.168.1.1', 'time' => '2 min ago'],
                        ['user' => 'John Doe', 'action' => 'Created', 'resource' => 'Claim #67890', 'ip' => '192.168.1.2', 'time' => '15 min ago'],
                        ['user' => 'Sarah K', 'action' => 'Deleted', 'resource' => 'Document #456', 'ip' => '192.168.1.3', 'time' => '1 hour ago'],
                    ] as $log)
                    <tr>
                        <td class="py-3">{{ $log['user'] }}</td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary">{{ $log['action'] }}</span>
                        </td>
                        <td class="py-3">{{ $log['resource'] }}</td>
                        <td class="py-3"><small class="text-muted">{{ $log['ip'] }}</small></td>
                        <td class="py-3"><small class="text-muted">{{ $log['time'] }}</small></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted">No audit logs</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
