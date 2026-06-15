@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">TIRAMIS Market Overview</h4>
        <small class="text-muted">Cross-company comparison of TIRA MIS integration activity</small>
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
                        <th>Total Reports</th>
                        <th>Sent</th>
                        <th>Failed</th>
                        <th>Success Rate</th>
                        <th class="pe-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companyStats as $company)
                    <tr>
                        <td class="ps-3">{{ $company->id }}</td>
                        <td class="fw-semibold">{{ $company->insurer_name }}</td>
                        <td><code>{{ $company->company_code ?? '—' }}</code></td>
                        <td><span class="badge bg-light text-dark">{{ $company->products_count ?? 0 }}</span></td>
                        <td class="fw-bold">{{ $company->total_reports }}</td>
                        <td class="text-success fw-bold">{{ $company->sent_reports }}</td>
                        <td class="text-danger fw-bold">{{ $company->failed_reports }}</td>
                        <td>
                            @php
                                $rate = $company->total_reports > 0 ? round(($company->sent_reports / $company->total_reports) * 100) : 0;
                            @endphp
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar bg-{{ $rate >= 90 ? 'success' : ($rate >= 50 ? 'warning' : 'danger') }}"
                                        style="width: {{ $rate }}%"></div>
                                </div>
                                <small class="fw-semibold">{{ $rate }}%</small>
                            </div>
                        </td>
                        <td class="pe-3">
                            @if($company->tiramis_enabled)
                                <span class="badge bg-success bg-opacity-10 text-success">Enabled</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary">Disabled</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">No TIRAMIS-enabled companies found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
