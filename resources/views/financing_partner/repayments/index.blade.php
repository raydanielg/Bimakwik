@extends('layouts.dashboard')

@section('dashboard_title', __('financing_partner.repayments_title'))

@section('dashboard_content')
<div class="card border-0 shadow-sm p-4 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
        <div>
            <h5 class="fw-bold mb-2">{{ __('financing_partner.repayments_header') }}</h5>
            <p class="text-muted mb-0">{{ __('financing_partner.repayments_subtitle') }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary btn-sm" type="button">{{ __('financing_partner.create_new') }}</button>
            <button class="btn btn-outline-secondary btn-sm" type="button">{{ __('financing_partner.export') }}</button>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-3">{{ __('financing_partner.overview') }}</h6>
            <p class="text-muted mb-0">{{ __('financing_partner.overview_body') }}</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h6 class="fw-bold mb-3">{{ __('financing_partner.next_steps') }}</h6>
            <ul class="mb-0 ps-3 text-muted">
                <li>{{ __('financing_partner.wire_models') }}</li>
                <li>{{ __('financing_partner.add_validation') }}</li>
                <li>{{ __('financing_partner.attach_permissions') }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
