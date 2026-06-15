@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">TIRAMIS Integration Logs</h4>
        <small class="text-muted">Detailed audit of all TIRA MIS API interactions</small>
    </div>
    <div>
        <a href="{{ route('admin.tiramis.reports') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Reports
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small">Action</label>
                <select name="action" class="form-select form-select-sm">
                    <option value="">All Actions</option>
                    @foreach($actions as $action)
                        <option value="{{ $action }}" @selected(request('action') == $action)>{{ ucfirst($action) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">All</option>
                    <option value="success" @selected(request('status') == 'success')>Success</option>
                    <option value="failed" @selected(request('status') == 'failed')>Failed</option>
                    <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-sm w-100 rounded-pill">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Action</th>
                        <th>Company Code</th>
                        <th>Report #</th>
                        <th>Status</th>
                        <th>Request URL</th>
                        <th>Response Code</th>
                        <th>Duration</th>
                        <th class="pe-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td class="ps-3">{{ $log->id }}</td>
                        <td><span class="badge bg-light text-dark">{{ ucfirst(str_replace('_', ' ', $log->action)) }}</span></td>
                        <td><code>{{ $log->company_code ?? '—' }}</code></td>
                        <td><code>{{ $log->report_number ?? '—' }}</code></td>
                        <td>
                            @if($log->status === 'success')
                                <span class="badge bg-success">Success</span>
                            @elseif($log->status === 'failed')
                                <span class="badge bg-danger">Failed</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ ucfirst($log->status) }}</span>
                            @endif
                        </td>
                        <td><small class="text-muted">{{ Str::limit($log->request_url ?? '—', 40) }}</small></td>
                        <td><code>{{ $log->response_code ?? '—' }}</code></td>
                        <td><small>{{ $log->duration_ms ? $log->duration_ms . 'ms' : '—' }}</small></td>
                        <td class="pe-3"><small class="text-muted">{{ $log->created_at->format('d M H:i') }}</small></td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">No integration logs found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($logs->hasPages())
    <div class="card-footer bg-white border-0">
        {{ $logs->links() }}
    </div>
    @endif
</div>
@endsection
