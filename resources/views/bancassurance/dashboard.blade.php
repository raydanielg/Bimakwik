@extends('layouts.dashboard')

@section('dashboard_title', __('bancassurance.dashboard_title'))

@section('dashboard_content')
<!-- Bancassurance Header Stats -->
<div class="row g-4 mb-4">
    <!-- Branch Sales Achievement -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-bank fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold">92% Target</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('bancassurance.branch_achievement') }}</h6>
                <h4 class="fw-bold mb-0">TZS 45.8M</h4>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 92%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Personal Commission -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-cash-stack fs-4"></i>
                    </div>
                    <div class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> +15%</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('bancassurance.my_commission') }}</h6>
                <h4 class="fw-bold mb-0">TZS 3.2M</h4>
            </div>
        </div>
    </div>

    <!-- Upcoming Renewals -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-calendar-check fs-4"></i>
                    </div>
                    <div class="badge bg-warning text-dark">18 Pending</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('bancassurance.bank_renewals') }}</h6>
                <h4 class="fw-bold mb-0">18</h4>
            </div>
        </div>
    </div>

    <!-- Leaderboard Rank -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-trophy fs-4"></i>
                    </div>
                    <div class="text-primary small fw-bold">Top 3</div>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">{{ __('bancassurance.branch_rank') }}</h6>
                <h4 class="fw-bold mb-0">#2</h4>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Bank Referrals -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">{{ __('bancassurance.bank_customer_referrals') }}</h6>
                <a href="#" class="btn btn-sm btn-outline-primary">{{ __('bancassurance.view_all') }}</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('bancassurance.customer_account') }}</th>
                            <th>{{ __('bancassurance.referral_date') }}</th>
                            <th>{{ __('bancassurance.interest') }}</th>
                            <th>{{ __('bancassurance.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hamis Juma (A/C ...8821)</td>
                            <td>Today, 09:15 AM</td>
                            <td>Motor Insurance</td>
                            <td><span class="badge bg-warning-soft text-warning">{{ __('bancassurance.pending_contact') }}</span></td>
                        </tr>
                        <tr>
                            <td>Sarah Peter (A/C ...4432)</td>
                            <td>Yesterday</td>
                            <td>Life Insurance</td>
                            <td><span class="badge bg-info-soft text-info">{{ __('bancassurance.in_discussion') }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bank Quick Integration -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-4">{{ __('bancassurance.bank_systems_integration') }}</h6>
            <div class="d-grid gap-3">
                <button class="btn btn-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-search me-2"></i> {{ __('bancassurance.verify_bank_account') }}
                </button>
                <button class="btn btn-outline-primary d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-credit-card me-2"></i> {{ __('bancassurance.setup_direct_debit') }}
                </button>
                <button class="btn btn-outline-info d-flex align-items-center justify-content-center py-2">
                    <i class="bi bi-file-earmark-spreadsheet me-2"></i> {{ __('bancassurance.import_lead_list') }}
                </button>
            </div>
            <div class="mt-4 p-3 bg-light rounded-3">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-shield-check text-success me-2"></i>
                    <span class="small fw-bold">{{ __('bancassurance.compliance_status') }}</span>
                </div>
                <div class="progress" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                </div>
                <div class="x-small text-muted mt-1 text-center">{{ __('bancassurance.aml_kyc_certified') }}</div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
    .bg-info-soft { background-color: rgba(13, 202, 240, 0.1); }
    .x-small { font-size: 0.7rem; }
</style>
@endsection
