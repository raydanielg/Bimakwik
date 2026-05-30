@extends('layouts.dashboard')

@section('content')
@php
    $renewals = isset($renewals) ? $renewals : collect($customerRenewals ?? []);
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
            <h4 class="fw-bold">{{ __('customer.renewals_title') }}</h4>
            <p class="text-muted small">{{ __('customer.renewals_subtitle') }}</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Policy</th>
                                    <th>Provider</th>
                                    <th>Expiry Date</th>
                                    <th>Premium</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($renewals as $renewal)
                                    @php
                                        $status = strtolower((string) $pick($renewal, ['status', 'renewal_status'], 'upcoming'));
                                        $expiryRaw = $pick($renewal, ['due_date', 'renewal_date', 'expiry_date'], null);
                                        $expiry = $expiryRaw;
                                        try {
                                            $expiry = $expiryRaw ? \Carbon\Carbon::parse($expiryRaw)->format('d M Y') : '-';
                                        } catch (\Throwable $e) {
                                            $expiry = $expiryRaw ?: '-';
                                        }
                                        $premium = (float) $pick($renewal, ['premium', 'renewal_amount', 'amount_due'], 0);
                                        $badgeClass = $status === 'due soon' || $status === 'pending' ? 'warning text-dark' : ($status === 'completed' ? 'success' : 'info text-dark');
                                    @endphp
                                    <tr>
                                        <td>{{ $pick($renewal, ['policy_name', 'name', 'product_name']) }}</td>
                                        <td>{{ $pick($renewal, ['provider_name', 'insurer_name', 'company_name']) }}</td>
                                        <td>{{ $expiry }}</td>
                                        <td>TZS {{ number_format($premium, 0) }}</td>
                                        <td><span class="badge bg-{{ $badgeClass }}">{{ ucfirst($status) }}</span></td>
                                        <td class="text-end">
                                            <a href="{{ route('customer.buy') }}" class="btn btn-sm btn-primary">{{ __('customer.renew_now') }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">{{ __('customer.no_renewals') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
