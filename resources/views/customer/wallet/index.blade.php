@extends('layouts.dashboard')

@section('content')
@php
    $wallet = $wallet ?? null;
    $transactions = isset($transactions) ? $transactions : collect($walletTransactions ?? []);
    $balance = $wallet ? $wallet->balance : 0;
    
    if ($balance == 0 && $transactions->count() > 0) {
        $pick = function ($row, $keys, $default = null) {
            foreach ($keys as $key) {
                if (isset($row[$key]) && $row[$key] !== null && $row[$key] !== '') {
                    return $row[$key];
                }
            }
            return $default;
        };

        $balance = $transactions->reduce(function ($carry, $item) use ($pick) {
            $amount = (float) $pick($item, ['amount', 'transaction_amount', 'value'], 0);
            $type = strtolower((string) $pick($item, ['type', 'transaction_type'], ''));
            $direction = strtolower((string) $pick($item, ['direction', 'entry_type'], ''));

            $isCredit = in_array($direction, ['credit', 'in'], true)
                || str_contains($type, 'deposit')
                || str_contains($type, 'refund')
                || str_contains($type, 'bonus')
                || str_contains($type, 'credit');

            return $isCredit ? $carry + $amount : $carry - $amount;
        }, 0);
    }

    $recentTransactions = $transactions->take(5);
@endphp
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">{{ __('customer.wallet_title') }}</h4>
            <p class="text-muted small">{{ __('customer.wallet_subtitle') }}</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-primary text-white h-100">
                <h6 class="small text-uppercase opacity-75 mb-3">{{ __('customer.available_balance') }}</h6>
                <h2 class="fw-bold mb-4">TZS {{ number_format($balance, 0) }}</h2>
                <div class="d-grid gap-2">
                    <a href="{{ route('customer.wallet.add-funds') }}" class="btn btn-light rounded-pill fw-bold">{{ __('customer.add_funds') }}</a>
                    <button class="btn btn-outline-light rounded-pill">{{ __('customer.withdraw') }}</button>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h6 class="fw-bold mb-4">{{ __('customer.recent_transactions') }}</h6>
                <div class="list-group list-group-flush">
                    @forelse($recentTransactions as $transaction)
                        @php
                            $amount = (float) $pick($transaction, ['amount', 'transaction_amount', 'value'], 0);
                            $type = strtolower((string) $pick($transaction, ['type', 'transaction_type'], 'transaction'));
                            $direction = strtolower((string) $pick($transaction, ['direction', 'entry_type'], ''));
                            $isCredit = in_array($direction, ['credit', 'in'], true)
                                || str_contains($type, 'deposit')
                                || str_contains($type, 'refund')
                                || str_contains($type, 'bonus')
                                || str_contains($type, 'credit');
                            $icon = $isCredit ? 'bi-arrow-down-left text-success' : 'bi-arrow-up-right text-danger';
                            $bg = $isCredit ? 'bg-success' : 'bg-danger';
                            $textColor = $isCredit ? 'text-success' : 'text-danger';
                            $signedAmount = ($isCredit ? '+' : '-') . 'TZS ' . number_format($amount, 0);
                            $dateRaw = $pick($transaction, ['created_at', 'updated_at', 'transaction_date'], null);
                            try {
                                $dateLabel = $dateRaw ? \Carbon\Carbon::parse($dateRaw)->format('d M Y • h:i A') : '-';
                            } catch (\Throwable $e) {
                                $dateLabel = $dateRaw ?: '-';
                            }
                        @endphp
                        <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center bg-transparent">
                            <div class="d-flex align-items-center">
                                <div class="{{ $bg }} bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi {{ $icon }}"></i>
                                </div>
                                <div>
                                    @php
                                        $localizedType = match ($type) {
                                            'deposit' => __('customer.type_deposit'),
                                            'payment' => __('customer.type_payment'),
                                            'refund' => __('customer.type_refund'),
                                            'bonus' => __('customer.type_bonus'),
                                            default => str_replace('_', ' ', $type),
                                        };
                                    @endphp
                                    <h6 class="fw-bold mb-0 text-capitalize">{{ $localizedType }}</h6>
                                    <small class="text-muted">{{ $dateLabel }}</small>
                                </div>
                            </div>
                            <span class="fw-bold {{ $textColor }}">{{ $signedAmount }}</span>
                        </div>
                    @empty
                        <div class="text-muted small">{{ __('customer.no_transactions') }}</div>
                    @endforelse
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('customer.wallet.history') }}" class="btn btn-light rounded-pill px-4 btn-sm">{{ __('customer.view_full_history') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
