@extends('layouts.dashboard')

@section('dashboard_content')
@php
    $policies = collect($customerPolicies ?? []);
    $pick = function ($row, $keys, $default = '-') {
        foreach ($keys as $key) {
            if (isset($row[$key]) && $row[$key] !== null && $row[$key] !== '') {
                return $row[$key];
            }
        }
        return $default;
    };
@endphp
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">{{ __('customer.policies_title') }}</h4>
            <p class="text-muted small">{{ __('customer.policies_subtitle') }}</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 border-0 small text-muted text-uppercase">Policy Name</th>
                                <th class="px-4 py-3 border-0 small text-muted text-uppercase">Provider</th>
                                <th class="px-4 py-3 border-0 small text-muted text-uppercase">Status</th>
                                <th class="px-4 py-3 border-0 small text-muted text-uppercase">Expiry Date</th>
                                <th class="px-4 py-3 border-0 small text-muted text-uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($policies as $policy)
                                @php
                                    $status = strtolower((string) $pick($policy, ['status', 'policy_status'], 'active'));
                                    $expiryRaw = $pick($policy, ['expiry_date', 'end_date', 'valid_to'], null);
                                    $expiry = $expiryRaw;
                                    try {
                                        $expiry = $expiryRaw ? \Carbon\Carbon::parse($expiryRaw)->format('d M Y') : '-';
                                    } catch (\Throwable $e) {
                                        $expiry = $expiryRaw ?: '-';
                                    }
                                    $badgeClass = $status === 'active' ? 'success' : ($status === 'expired' ? 'danger' : 'warning');
                                @endphp
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-shield-check text-success"></i>
                                            </div>
                                            <span class="fw-bold">{{ $pick($policy, ['policy_name', 'name', 'title', 'product_name']) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">{{ $pick($policy, ['provider_name', 'insurer_name', 'company_name']) }}</td>
                                    <td class="px-4 py-3"><span class="badge bg-{{ $badgeClass }} bg-opacity-10 text-{{ $badgeClass }} rounded-pill px-3">{{ ucfirst($status) }}</span></td>
                                    <td class="px-4 py-3">{{ $expiry }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('customer.policies.documents') }}" class="btn btn-sm btn-light rounded-pill px-3">{{ __('customer.view_details') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                        <td colspan="5" class="px-4 py-4 text-center text-muted">{{ __('customer.no_policies') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
