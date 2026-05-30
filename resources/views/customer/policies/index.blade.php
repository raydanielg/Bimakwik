@extends('layouts.dashboard')

@section('content')
@php
    $policies = isset($policies) ? $policies : collect($customerPolicies ?? []);
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
                                    // Handle both array (from PortalController) and object (from CustomerPolicyController)
                                    $policyArray = is_array($policy) ? $policy : (method_exists($policy, 'toArray') ? $policy->toArray() : get_object_vars($policy));
                                    
                                    $status = $policyArray['status'] ?? 'active';
                                    $expiryRaw = $policyArray['end_date'] ?? null;
                                    $expiry = $expiryRaw;
                                    try {
                                        $expiry = $expiryRaw ? \Carbon\Carbon::parse($expiryRaw)->format('d M Y') : '-';
                                    } catch (\Throwable $e) {
                                        $expiry = $expiryRaw ?: '-';
                                    }
                                    $badgeClass = $status === 'active' ? 'success' : ($status === 'expired' ? 'danger' : 'warning');
                                    
                                    // Get policy name from product relationship or policy_number
                                    $policyName = $policyArray['policy_number'] ?? 'Unknown Policy';
                                    if (isset($policyArray['product']) && is_array($policyArray['product'])) {
                                        $policyName = $policyArray['product']['product_name'] ?? $policyName;
                                    } elseif (isset($policyArray['product']) && is_object($policyArray['product'])) {
                                        $policyName = $policyArray['product']->product_name ?? $policyName;
                                    }
                                    
                                    // Get provider name from insurer relationship
                                    $providerName = 'Unknown Provider';
                                    if (isset($policyArray['insurer']) && is_array($policyArray['insurer'])) {
                                        $providerName = $policyArray['insurer']['insurer_name'] ?? $providerName;
                                    } elseif (isset($policyArray['insurer']) && is_object($policyArray['insurer'])) {
                                        $providerName = $policyArray['insurer']->insurer_name ?? $providerName;
                                    }
                                @endphp
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-shield-check text-success"></i>
                                            </div>
                                            <span class="fw-bold">{{ $policyName }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">{{ $providerName }}</td>
                                    <td class="px-4 py-3"><span class="badge bg-{{ $badgeClass }} bg-opacity-10 text-{{ $badgeClass }} rounded-pill px-3">{{ ucfirst($status) }}</span></td>
                                    <td class="px-4 py-3">{{ $expiry }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('customer.policies.show', $policyArray['id'] ?? $policy->id) }}" class="btn btn-sm btn-light rounded-pill px-3">{{ __('customer.view_details') }}</a>
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
