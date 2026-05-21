@extends('layouts.dashboard')

@section('dashboard_title', __('customer.dashboard_title_wallet_history'))

@section('dashboard_content')
@php
    $transactions = collect($walletTransactions ?? []);
    $pick = function ($row, $keys, $default = null) {
        foreach ($keys as $key) {
            if (isset($row[$key]) && $row[$key] !== null && $row[$key] !== '') {
                return $row[$key];
            }
        }
        return $default;
    };
@endphp
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-clock-history me-2"></i>
            {{ __('customer.wallet_history_title') }}
        </h2>
        <p class="text-muted">{{ __('customer.wallet_history_subtitle') }}</p>
    </div>
</div>

<!-- Filters -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <label class="fw-bold mb-2 small">{{ __('customer.by_type') }}</label>
                <select class="form-select form-select-sm" id="typeFilter">
                    <option value="">{{ __('customer.all') }}</option>
                    <option value="deposit">{{ __('customer.type_deposit') }}</option>
                    <option value="payment">{{ __('customer.type_payment') }}</option>
                    <option value="refund">{{ __('customer.type_refund') }}</option>
                    <option value="bonus">{{ __('customer.type_bonus') }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <label class="fw-bold mb-2 small">{{ __('customer.by_status') }}</label>
                <select class="form-select form-select-sm" id="statusFilter">
                    <option value="">{{ __('customer.all') }}</option>
                    <option value="completed">{{ __('customer.status_completed') }}</option>
                    <option value="pending">{{ __('customer.status_pending') }}</option>
                    <option value="failed">{{ __('customer.status_failed') }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <label class="fw-bold mb-2 small">{{ __('customer.filter_date') }}</label>
                <input type="date" class="form-control form-control-sm" id="dateFilter">
            </div>
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-bold py-3">{{ __('customer.date_time') }}</th>
                                <th class="fw-bold py-3">{{ __('customer.type') }}</th>
                                <th class="fw-bold py-3">{{ __('customer.description') }}</th>
                                <th class="fw-bold py-3">{{ __('customer.amount') }}</th>
                                <th class="fw-bold py-3">{{ __('customer.status') }}</th>
                                <th class="fw-bold py-3">{{ __('customer.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                @php
                                    $amount = (float) $pick($transaction, ['amount', 'transaction_amount', 'value'], 0);
                                    $type = strtolower((string) $pick($transaction, ['type', 'transaction_type'], 'transaction'));
                                    $status = strtolower((string) $pick($transaction, ['status', 'transaction_status'], 'completed'));
                                    $direction = strtolower((string) $pick($transaction, ['direction', 'entry_type'], ''));
                                    $isCredit = in_array($direction, ['credit', 'in'], true)
                                        || str_contains($type, 'deposit')
                                        || str_contains($type, 'refund')
                                        || str_contains($type, 'bonus')
                                        || str_contains($type, 'credit');
                                    $signed = ($isCredit ? '+' : '-') . 'TZS ' . number_format($amount, 0);
                                    $amountClass = $isCredit ? 'text-success' : 'text-danger';
                                    $statusClass = $status === 'completed' ? 'success' : ($status === 'pending' ? 'warning text-dark' : 'danger');
                                    $dateRaw = $pick($transaction, ['created_at', 'updated_at', 'transaction_date'], null);
                                    try {
                                        $dateMain = $dateRaw ? \Carbon\Carbon::parse($dateRaw)->format('d M Y') : '-';
                                        $dateTime = $dateRaw ? \Carbon\Carbon::parse($dateRaw)->format('H:i') : '-';
                                    } catch (\Throwable $e) {
                                        $dateMain = $dateRaw ?: '-';
                                        $dateTime = '-';
                                    }
                                @endphp
                                <tr class="transaction-row" data-type="{{ $type }}" data-status="{{ $status }}">
                                    <td class="py-3">
                                        <small class="fw-bold">{{ $dateMain }}</small>
                                        <br>
                                        <small class="text-muted">{{ $dateTime }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary text-capitalize">{{ str_replace('_', ' ', $type) }}</span>
                                    </td>
                                    <td>
                                        <small><strong>{{ $pick($transaction, ['description', 'narration', 'reference', 'title'], __('customer.wallet_transaction')) }}</strong></small>
                                        <br>
                                        <small class="text-muted">ID: {{ $pick($transaction, ['reference', 'transaction_reference', 'id'], '-') }}</small>
                                    </td>
                                    <td>
                                        <strong class="{{ $amountClass }}">{{ $signed }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $statusClass }} text-capitalize">{{ $status }}</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">{{ __('customer.view') }}</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">{{ __('customer.no_transactions') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Button -->
<div class="row mt-4">
    <div class="col-12">
        <a href="{{ route('customer.wallet.add-funds') }}" class="btn btn-primary">
            <i class="bi bi-wallet-plus me-2"></i> {{ __('customer.add_funds') }}
        </a>
        <a href="{{ route('customer.wallet.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i> {{ __('customer.back_to_wallet') }}
        </a>
    </div>
</div>

<style>
    .transaction-row {
        transition: background-color 0.2s ease;
    }

    .transaction-row:hover {
        background-color: #f8f9fa;
    }

    table tbody tr {
        border-bottom: 1px solid #dee2e6;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
    }
</style>

<script>
    // Filter transactions
    function filterTransactions() {
        const typeFilter = document.getElementById('typeFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;
        const rows = document.querySelectorAll('.transaction-row');

        rows.forEach(row => {
            let show = true;
            
            if (typeFilter && row.dataset.type !== typeFilter) {
                show = false;
            }
            
            if (statusFilter && row.dataset.status !== statusFilter) {
                show = false;
            }
            
            row.style.display = show ? '' : 'none';
        });
    }

    // Event listeners for filters
    document.getElementById('typeFilter').addEventListener('change', filterTransactions);
    document.getElementById('statusFilter').addEventListener('change', filterTransactions);
    document.getElementById('dateFilter').addEventListener('change', filterTransactions);
</script>
@endsection
