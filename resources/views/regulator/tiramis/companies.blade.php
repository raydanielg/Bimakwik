@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">TIRAMIS-Enabled Companies</h4>
        <small class="text-muted">Insurers registered for TIRA MIS integration</small>
    </div>
    <div>
        <a href="{{ route('regulator.tiramis.dashboard') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Dashboard
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Insurer</th>
                        <th>Company Code</th>
                        <th>Products</th>
                        <th>TIRAMIS Status</th>
                        <th>Last Sync</th>
                        <th class="pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                    <tr>
                        <td class="ps-3">{{ $company->id }}</td>
                        <td class="fw-semibold">{{ $company->insurer_name }}</td>
                        <td><code>{{ $company->company_code ?? '—' }}</code></td>
                        <td><span class="badge bg-light text-dark">{{ $company->products_count ?? 0 }}</span></td>
                        <td>
                            @if($company->tiramis_enabled)
                                <span class="badge bg-success">Enabled</span>
                            @else
                                <span class="badge bg-secondary">Disabled</span>
                            @endif
                        </td>
                        <td><small class="text-muted">{{ $company->tiramis_last_sync_at?->diffForHumans() ?? 'Never' }}</small></td>
                        <td class="pe-3">
                            <a href="{{ route('regulator.tiramis.company-reports', $company->company_code ?? 'unknown') }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-file-earmark-text me-1"></i> Reports
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No TIRAMIS-enabled companies found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($companies->hasPages())
    <div class="card-footer bg-white border-0">
        {{ $companies->links() }}
    </div>
    @endif
</div>
@endsection
