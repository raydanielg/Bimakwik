@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">
                    {{ app()->getLocale() == 'sw' ? 'Upakuaji' : 'Downloads' }}
                </h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    {{ app()->getLocale() == 'sw' ? 'Nyenzo kwa Kila Mtu' : 'Resources for Everyone' }}
                </h1>
                <p class="lead text-secondary mb-0">
                    {{ app()->getLocale() == 'sw' ? 'Pata nyaraka zote, miongozo, fomu, na zana unazohitaji – zinapatikana kwa upakuaji wa bure katika muundo wa PDF.' : 'Find all documents, guides, forms, and tools you need – available for free download in PDF format.' }}
                </p>
            </div>
        </div>

        <div class="row g-4">
            <!-- For Customers -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-5 h-100 bg-light">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-people-fill text-primary fs-3"></i>
                            </div>
                            <h4 class="fw-bold mb-0">{{ app()->getLocale() == 'sw' ? 'Kwa Wateja' : 'For Customers' }}</h4>
                        </div>
                        <div class="list-group list-group-flush bg-transparent">
                            <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <h6 class="fw-bold mb-0">{{ app()->getLocale() == 'sw' ? 'Mwongozo wa Mtumiaji' : 'Customer User Guide' }}</h6>
                                    <small class="text-muted">PDF • 2.5 MB</small>
                                </div>
                                <a href="{{ route('guidelines.claim-process') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="bi bi-download me-1"></i> {{ app()->getLocale() == 'sw' ? 'Pakua' : 'Download' }}</a>
                            </div>
                            <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <h6 class="fw-bold mb-0">{{ app()->getLocale() == 'sw' ? 'Orodha ya Kukagua Madai' : 'Claims Checklist' }}</h6>
                                    <small class="text-muted">PDF • 0.9 MB</small>
                                </div>
                                <a href="{{ route('guidelines.claim-process') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="bi bi-download me-1"></i> {{ app()->getLocale() == 'sw' ? 'Pakua' : 'Download' }}</a>
                            </div>
                            <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center py-3 border-0">
                                <div>
                                    <h6 class="fw-bold mb-0">{{ app()->getLocale() == 'sw' ? 'Mwongozo wa Upya' : 'Renewal Guide' }}</h6>
                                    <small class="text-muted">PDF • 1.0 MB</small>
                                </div>
                                <a href="{{ route('guidelines.policy-management') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="bi bi-download me-1"></i> {{ app()->getLocale() == 'sw' ? 'Pakua' : 'Download' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- For Partners -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-5 h-100 bg-light">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-briefcase-fill text-success fs-3"></i>
                            </div>
                            <h4 class="fw-bold mb-0">{{ app()->getLocale() == 'sw' ? 'Kwa Washirika' : 'For Partners' }}</h4>
                        </div>
                        <div class="list-group list-group-flush bg-transparent">
                            <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <h6 class="fw-bold mb-0">{{ app()->getLocale() == 'sw' ? 'Mwongozo wa Kujiunga' : 'Broker Onboarding Guide' }}</h6>
                                    <small class="text-muted">PDF • 3.2 MB</small>
                                </div>
                                <a href="{{ route('guidelines.policy-management') }}" class="btn btn-outline-success btn-sm rounded-pill px-3"><i class="bi bi-download me-1"></i> {{ app()->getLocale() == 'sw' ? 'Pakua' : 'Download' }}</a>
                            </div>
                            <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <h6 class="fw-bold mb-0">{{ app()->getLocale() == 'sw' ? 'Vifaa vya Masoko' : 'Marketing Materials Kit' }}</h6>
                                    <small class="text-muted">ZIP • 15 MB</small>
                                </div>
                                <a href="{{ route('guidelines.kyc-verification') }}" class="btn btn-outline-success btn-sm rounded-pill px-3"><i class="bi bi-download me-1"></i> {{ app()->getLocale() == 'sw' ? 'Pakua' : 'Download' }}</a>
                            </div>
                            <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center py-3 border-0">
                                <div>
                                    <h6 class="fw-bold mb-0">{{ app()->getLocale() == 'sw' ? 'Nyaraka za API' : 'API Documentation' }}</h6>
                                    <small class="text-muted">PDF • 4.5 MB</small>
                                </div>
                                <a href="{{ route('guidelines.kyc-verification') }}" class="btn btn-outline-success btn-sm rounded-pill px-3"><i class="bi bi-download me-1"></i> {{ app()->getLocale() == 'sw' ? 'Pakua' : 'Download' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Legal & Compliance -->
        <div class="mt-5 bg-dark text-white p-5 rounded-5 shadow-lg">
            <h3 class="fw-bold mb-4">{{ app()->getLocale() == 'sw' ? 'Sheria na Uzingativu' : 'Legal & Compliance' }}</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-3 border border-secondary rounded-4 h-100">
                        <h6 class="fw-bold mb-2">{{ app()->getLocale() == 'sw' ? 'Sheria na Masharti' : 'Terms of Service' }}</h6>
                        <p class="small opacity-75">{{ app()->getLocale() == 'sw' ? 'Ilirekebishwa: Jan 2026' : 'Last updated: Jan 2026' }}</p>
                        <a href="{{ route('legal.terms') }}" class="btn btn-link text-warning p-0 text-decoration-none fw-bold small">{{ app()->getLocale() == 'sw' ? 'Pakua PDF' : 'Download PDF' }} <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border border-secondary rounded-4 h-100">
                        <h6 class="fw-bold mb-2">{{ app()->getLocale() == 'sw' ? 'Sera ya Faragha' : 'Privacy Policy' }}</h6>
                        <p class="small opacity-75">{{ app()->getLocale() == 'sw' ? 'Ilirekebishwa: Jan 2026' : 'Last updated: Jan 2026' }}</p>
                        <a href="{{ route('legal.privacy') }}" class="btn btn-link text-warning p-0 text-decoration-none fw-bold small">{{ app()->getLocale() == 'sw' ? 'Pakua PDF' : 'Download PDF' }} <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border border-secondary rounded-4 h-100">
                        <h6 class="fw-bold mb-2">{{ app()->getLocale() == 'sw' ? 'Utaratibu wa Malalamiko' : 'Complaints Procedure' }}</h6>
                        <p class="small opacity-75">{{ app()->getLocale() == 'sw' ? 'Ilirekebishwa: Jan 2026' : 'Last updated: Jan 2026' }}</p>
                        <a href="{{ route('support.help') }}" class="btn btn-link text-warning p-0 text-decoration-none fw-bold small">{{ app()->getLocale() == 'sw' ? 'Pakua PDF' : 'Download PDF' }} <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
