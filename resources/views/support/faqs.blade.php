@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">
                    {{ __('site.faq_hero_eyebrow') }}
                </h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    {{ __('site.faq_hero_title') }}
                </h1>
                <p class="lead text-secondary mb-0">
                    {{ __('site.faq_hero_subtitle') }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">{{ __('site.categories') }}</h5>
                        <div class="nav flex-column nav-pills" id="faq-tabs" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active mb-2 text-start p-3 fw-bold" data-bs-toggle="pill" data-bs-target="#general" type="button">
                                <i class="bi bi-info-circle me-2"></i> {{ __('site.general_information') }}
                            </button>
                            <button class="nav-link mb-2 text-start p-3 fw-bold" data-bs-toggle="pill" data-bs-target="#customers" type="button">
                                <i class="bi bi-person me-2"></i> {{ __('site.for_customers') }}
                            </button>
                            <button class="nav-link mb-2 text-start p-3 fw-bold" data-bs-toggle="pill" data-bs-target="#partners" type="button">
                                <i class="bi bi-briefcase me-2"></i> {{ __('site.for_partners') }}
                            </button>
                            <button class="nav-link mb-2 text-start p-3 fw-bold" data-bs-toggle="pill" data-bs-target="#technical" type="button">
                                <i class="bi bi-cpu me-2"></i> {{ __('site.technical_support') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 ps-lg-5">
                <div class="tab-content" id="faq-tabContent">
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <h4 class="fw-bold mb-4 text-primary">{{ __('site.general_information') }}</h4>
                        <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden border" id="accordionGeneral">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#g1">
                                        {{ __('site.what_is_bimakwik_q') }}
                                    </button>
                                </h2>
                                <div id="g1" class="accordion-collapse collapse show" data-bs-parent="#accordionGeneral">
                                    <div class="accordion-body text-muted lh-lg">{{ __('site.what_is_bimakwik_a') }}</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#g2">
                                        {{ __('site.is_bimakwik_licensed_q') }}
                                    </button>
                                </h2>
                                <div id="g2" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                                    <div class="accordion-body text-muted lh-lg">{{ __('site.is_bimakwik_licensed_a') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="customers" role="tabpanel">
                        <h4 class="fw-bold mb-4 text-primary">{{ __('site.for_customers') }}</h4>
                        <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden border" id="accordionCustomers">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
                                        {{ __('site.how_buy_policy_q') }}
                                    </button>
                                </h2>
                                <div id="c1" class="accordion-collapse collapse show" data-bs-parent="#accordionCustomers">
                                    <div class="accordion-body text-muted lh-lg">{{ __('site.how_buy_policy_a') }}</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#c2">
                                        {{ __('site.payments_accepted_q') }}
                                    </button>
                                </h2>
                                <div id="c2" class="accordion-collapse collapse" data-bs-parent="#accordionCustomers">
                                    <div class="accordion-body text-muted lh-lg">{{ __('site.payments_accepted_a') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="partners" role="tabpanel">
                        <h4 class="fw-bold mb-4 text-primary">{{ __('site.for_partners') }}</h4>
                        <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden border" id="accordionPartners">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#p1">
                                        {{ __('site.partner_join_q') }}
                                    </button>
                                </h2>
                                <div id="p1" class="accordion-collapse collapse show" data-bs-parent="#accordionPartners">
                                    <div class="accordion-body text-muted lh-lg">{{ __('site.partner_join_a') }}</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#p2">
                                        {{ __('site.partner_benefit_q') }}
                                    </button>
                                </h2>
                                <div id="p2" class="accordion-collapse collapse" data-bs-parent="#accordionPartners">
                                    <div class="accordion-body text-muted lh-lg">{{ __('site.partner_benefit_a') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="technical" role="tabpanel">
                        <h4 class="fw-bold mb-4 text-primary">{{ __('site.technical_support') }}</h4>
                        <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden border" id="accordionTechnical">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#t1">
                                        {{ __('site.reset_password_q') }}
                                    </button>
                                </h2>
                                <div id="t1" class="accordion-collapse collapse show" data-bs-parent="#accordionTechnical">
                                    <div class="accordion-body text-muted lh-lg">{{ __('site.reset_password_a') }}</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#t2">
                                        {{ __('site.support_response_q') }}
                                    </button>
                                </h2>
                                <div id="t2" class="accordion-collapse collapse" data-bs-parent="#accordionTechnical">
                                    <div class="accordion-body text-muted lh-lg">{{ __('site.support_response_a') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 p-4 bg-white rounded-3 shadow-sm text-center">
                    <h5 class="fw-bold mb-3">{{ __('site.still_have_questions') }}</h5>
                    <p class="text-muted mb-4">{{ __('site.faq_contact_prompt') }}</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('pages.contact') }}" class="btn btn-primary px-4">{{ __('site.contact_us') }}</a>
                        <a href="mailto:info@bimakwik.com" class="btn btn-outline-primary px-4">{{ __('site.email_support') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .nav-pills .nav-link {
        color: #495057;
        background: #fff;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    .nav-pills .nav-link:hover {
        background: #f8f9fa;
        border-color: #dee2e6;
    }
    .nav-pills .nav-link.active {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }
    .accordion-item {
        border-radius: 8px !important;
        overflow: hidden;
    }
    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #0d6efd;
        box-shadow: none;
    }
    .accordion-button:focus {
        box-shadow: none;
    }
</style>
@endsection
