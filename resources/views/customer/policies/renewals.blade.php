@extends('layouts.dashboard')

@section('content')
@php
    $renewals = isset($renewals) ? $renewals : collect($customerRenewals ?? []);
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
                                        $r = is_array($renewal) ? $renewal : $renewal->toArray();
                                        $status = $r['status'] ?? 'active';
                                        $endDate = $r['end_date'] ?? null;
                                        try {
                                            $expiry = $endDate ? \Carbon\Carbon::parse($endDate)->format('d M Y') : '-';
                                        } catch (\Throwable $e) {
                                            $expiry = $endDate ?: '-';
                                        }
                                        $premium = (float) ($r['premium_amount'] ?? 0);
                                        $daysLeft = $endDate ? \Carbon\Carbon::parse($endDate)->diffInDays(now(), false) : null;
                                        $badgeClass = ($daysLeft !== null && $daysLeft >= 0) ? 'danger' : 'warning text-dark';
                                        $productName = isset($r['product']) ? ($r['product']['product_name'] ?? 'Policy') : 'Insurance Policy';
                                        $insurerName = isset($r['insurer']) ? ($r['insurer']['insurer_name'] ?? 'Provider') : 'Provider';
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="fw-bold small">{{ $productName }}</div>
                                            <div class="x-small text-muted">{{ $r['policy_number'] ?? '' }}</div>
                                        </td>
                                        <td>{{ $insurerName }}</td>
                                        <td class="fw-bold text-danger">{{ $expiry }}</td>
                                        <td>TZS {{ number_format($premium, 0) }}</td>
                                        <td><span class="badge bg-{{ $badgeClass }}">{{ ucfirst($status) }}</span></td>
                                        <td class="text-end">
                                            <a href="{{ route('customer.buy') }}" class="btn btn-sm btn-primary">Renew Now</a>
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
