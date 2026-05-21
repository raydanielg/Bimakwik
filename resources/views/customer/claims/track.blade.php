@extends('layouts.dashboard')

@section('dashboard_title', __('customer.dashboard_title_track_claims'))

@section('dashboard_content')
@php
    $claims = collect($customerClaims ?? []);
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
            <i class="bi bi-search me-2"></i>
            {{ __('customer.claims_track_title') }}
        </h2>
        <p class="text-muted">{{ __('customer.claims_track_subtitle') }}</p>
    </div>
</div>

<!-- Search Section -->
<div class="row mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form id="searchForm">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" id="claimSearch" placeholder="{{ __('customer.claims_search_placeholder') }}" aria-label="Search claims">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search me-2"></i> {{ __('customer.search') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Status Filter -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <label class="fw-bold mb-3">{{ __('customer.by_status') }}</label>
                <select class="form-select" id="statusFilter">
                    <option value="">{{ __('customer.all') }}</option>
                    <option value="pending">{{ __('customer.status_pending') }}</option>
                    <option value="approved">{{ __('customer.status_approved') }}</option>
                    <option value="rejected">{{ __('customer.status_rejected') }}</option>
                    <option value="paid">{{ __('customer.status_paid') }}</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Claims List -->
<div class="row">
    <div class="col-12">
        @if($claims->isEmpty())
            <div id="noClaims" class="alert alert-info" role="alert">
                <i class="bi bi-info-circle me-2"></i>
                {{ __('customer.no_claims_long') }}
            </div>
        @endif

        <div id="claimsContainer">
            @foreach($claims as $claim)
                @php
                    $status = strtolower((string) $pick($claim, ['status', 'claim_status'], 'pending'));
                    $dateRaw = $pick($claim, ['created_at', 'incident_date', 'claim_date'], null);
                    try {
                        $date = $dateRaw ? \Carbon\Carbon::parse($dateRaw)->format('d M Y') : '-';
                    } catch (\Throwable $e) {
                        $date = $dateRaw ?: '-';
                    }
                    $amount = (float) $pick($claim, ['claim_amount', 'amount', 'estimated_amount'], 0);
                    $badgeClass = $status === 'approved' ? 'success' : ($status === 'paid' ? 'info' : ($status === 'rejected' ? 'danger' : 'warning text-dark'));
                    $progress = $status === 'paid' ? 100 : ($status === 'approved' ? 75 : ($status === 'rejected' ? 25 : 50));
                @endphp
                <div class="card border-0 shadow-sm mb-3 claim-card" data-status="{{ $status }}">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="fw-bold mb-1">
                                    {{ __('customer.claim_number_label') }}: <span class="text-primary">{{ $pick($claim, ['claim_number', 'reference', 'id'], '-') }}</span>
                                </h5>
                                <p class="text-muted mb-2"><i class="bi bi-calendar me-2"></i>{{ __('customer.claim_date') }}: <strong>{{ $date }}</strong></p>
                                <p class="text-muted mb-0"><i class="bi bi-briefcase me-2"></i>{{ __('customer.claim_type') }}: <strong>{{ $pick($claim, ['claim_type', 'type', 'category'], __('customer.generic_claim')) }}</strong></p>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <div class="mb-2"><span class="badge bg-{{ $badgeClass }} text-capitalize">{{ $status }}</span></div>
                                <p class="mb-0"><small class="text-muted">{{ __('customer.claim_amount') }}:</small><br><strong class="fs-5">TZS {{ number_format($amount, 0) }}</strong></p>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="fw-bold">{{ __('customer.public_progress') }}:</small>
                                <small class="text-muted">{{ $progress }}%</small>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Action Button -->
<div class="row mt-4">
    <div class="col-12 text-center">
        <a href="{{ route('customer.claims.create') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle me-2"></i> {{ __('customer.submit_new_claim') }}
        </a>
    </div>
</div>

<style>
    .claim-card {
        transition: all 0.3s ease;
        border-left: 4px solid #dee2e6;
    }

    .claim-card:hover {
        box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.1) !important;
        transform: translateX(4px);
    }

    .claim-card[data-status="pending"] {
        border-left-color: #ffc107;
    }

    .claim-card[data-status="approved"] {
        border-left-color: #28a745;
    }

    .claim-card[data-status="paid"] {
        border-left-color: #17a2b8;
    }

    .claim-card[data-status="rejected"] {
        border-left-color: #dc3545;
    }
</style>

<script>
    // Filter claims by status
    document.getElementById('statusFilter').addEventListener('change', function() {
        const selectedStatus = this.value;
        const claims = document.querySelectorAll('.claim-card');

        claims.forEach(claim => {
            if (selectedStatus === '' || claim.dataset.status === selectedStatus) {
                claim.style.display = 'block';
            } else {
                claim.style.display = 'none';
            }
        });
    });

    // Search functionality
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const searchTerm = document.getElementById('claimSearch').value.toLowerCase();
        const claims = document.querySelectorAll('.claim-card');

        claims.forEach(claim => {
            const claimNumber = claim.querySelector('.text-primary').textContent.toLowerCase();
            if (searchTerm === '' || claimNumber.includes(searchTerm)) {
                claim.style.display = 'block';
            } else {
                claim.style.display = 'none';
            }
        });
    });
</script>
@endsection
