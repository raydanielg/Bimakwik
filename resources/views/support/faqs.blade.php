@extends('layouts.landing')

@section('content')
<!-- FAQ Header -->
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">
                    {{ app()->getLocale() == 'sw' ? 'Maswali Yanayoulizwa Mara kwa Mara' : 'Frequently Asked Questions' }}
                </h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    {{ app()->getLocale() == 'sw' ? 'Una Maswali? Tuna Majibu.' : 'Have Questions? We Have Answers.' }}
                </h1>
                <p class="lead text-secondary mb-0">
                    {{ app()->getLocale() == 'sw' ? 'Pata majibu kwa maswali ya kawaida kuhusu Bima Kwik. Yamepangwa kwa kategoria kwa urahisi wako.' : 'Find answers to the most common questions about Bima Kwik. Organized by category for your convenience.' }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">{{ app()->getLocale() == 'sw' ? 'Kategoria' : 'Categories' }}</h5>
                        <div class="nav flex-column nav-pills" id="faq-tabs" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active mb-2 text-start p-3 fw-bold" data-bs-toggle="pill" data-bs-target="#general" type="button">
                                <i class="bi bi-info-circle me-2"></i> {{ app()->getLocale() == 'sw' ? 'Habari za Jumla' : 'General Information' }}
                            </button>
                            <button class="nav-link mb-2 text-start p-3 fw-bold" data-bs-toggle="pill" data-bs-target="#customers" type="button">
                                <i class="bi bi-person me-2"></i> {{ app()->getLocale() == 'sw' ? 'Kwa Wateja' : 'For Customers' }}
                            </button>
                            <button class="nav-link mb-2 text-start p-3 fw-bold" data-bs-toggle="pill" data-bs-target="#partners" type="button">
                                <i class="bi bi-briefcase me-2"></i> {{ app()->getLocale() == 'sw' ? 'Kwa Washirika' : 'For Partners' }}
                            </button>
                            <button class="nav-link mb-2 text-start p-3 fw-bold" data-bs-toggle="pill" data-bs-target="#technical" type="button">
                                <i class="bi bi-cpu me-2"></i> {{ app()->getLocale() == 'sw' ? 'Kiufundi na Msaada' : 'Technical & Support' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 ps-lg-5">
                <div class="tab-content" id="faq-tabContent">
                    <!-- General -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <h4 class="fw-bold mb-4 text-primary">{{ app()->getLocale() == 'sw' ? 'Habari za Jumla' : 'General Information' }}</h4>
                        <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden border" id="accordionGeneral">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#g1">
                                        {{ app()->getLocale() == 'sw' ? 'Bima Kwik ni nini?' : 'What is Bima Kwik?' }}
                                    </button>
                                </h2>
                                <div id="g1" class="accordion-collapse collapse show" data-bs-parent="#accordionGeneral">
                                    <div class="accordion-body text-muted lh-lg">
                                        {{ app()->getLocale() == 'sw' ? 'Bima Kwik ni jukwaa la bima la kidijitali linalotoa mlango mmoja wa kufikia bidhaa za bima. Wateja wanaweza kununua, kufanya upya, na kudai bima mtandaoni.' : 'Bima Kwik is a digital insurance platform that provides a single point of access for insurance products. Customers can buy, renew, and claim insurance online.' }}
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#g2">
                                        {{ app()->getLocale() == 'sw' ? 'Je, Bima Kwik ina leseni?' : 'Is Bima Kwik licensed?' }}
                                    </button>
                                </h2>
                                <div id="g2" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                                    <div class="accordion-body text-muted lh-lg">
                                        {{ app()->getLocale() == 'sw' ? 'Ndiyo. Bima Kwik inafanya kazi chini ya leseni kutoka kwa Mamlaka ya Bima Tanzania (TIRA) na inafuata Sheria ya Ulinzi wa Data Binafsi.' : 'Yes. Bima Kwik operates under a license from the Insurance Regulator of Tanzania (TIRA) and complies with the Personal Data Protection Act.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customers -->
                    <div class="tab-pane fade" id="customers" role="tabpanel">
                        <h4 class="fw-bold mb-4 text-primary">{{ app()->getLocale() == 'sw' ? 'Kwa Wateja' : 'For Customers' }}</h4>
                        <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden border" id="accordionCustomers">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#c1">
                                        {{ app()->getLocale() == 'sw' ? 'Je, ninanunua seraje?' : 'How do I buy a policy?' }}
                                    </button>
                                </h2>
                                <div id="c1" class="accordion-collapse collapse show" data-bs-parent="#accordionCustomers">
                                    <div class="accordion-body text-muted lh-lg">
                                        {{ app()->getLocale() == 'sw' ? 'Ingia, nenda kwenye "Bidhaa," vinjari au linganisha sera, chagua moja, toa taarifa zinazohitajika, fanya malipo, na pakua sera yako papo hapo.' : 'Log in, go to "Products," browse or compare policies, select one, provide required information, make payment, and download your policy instantly.' }}
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#c2">
                                        {{ app()->getLocale() == 'sw' ? 'Njia gani za malipo zinakubaliwa?' : 'What payment methods are accepted?' }}
                                    </button>
                                </h2>
                                <div id="c2" class="accordion-collapse collapse" data-bs-parent="#accordionCustomers">
                                    <div class="accordion-body text-muted lh-lg">
                                        {{ app()->getLocale() == 'sw' ? 'Pesa za simu (M-Pesa, Tigo Pesa, Airtel Money), kadi za benki (Visa, Mastercard), uhamisho wa benki, na pochi ya Bima Kwik.' : 'Mobile money (M-Pesa, Tigo Pesa, Airtel Money), bank cards (Visa, Mastercard), bank transfer, and Bima Kwik wallet.' }}
                                    </div>
                                </div>
                            </div>
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#tech3">
                                        How does the claims notification work?
                                    </button>
                                </h2>
                                <div id="tech3" class="accordion-collapse collapse" data-bs-parent="#accordionTechnical">
                                    <div class="accordion-body text-muted lh-lg">
                                        Bima Kwik facilitates end-to-end claims notifications. Customers or referrers can initiate a claim notification directly through the mobile app or web portal, which is then instantly communicated to the relevant insurance company for processing.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Inclusion -->
                    <div class="tab-pane fade" id="inclusion" role="tabpanel">
                        <h3 class="fw-bold mb-4">Financial Inclusion</h3>
                        <div class="accordion shadow-sm" id="accordionInclusion">
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#inc1">
                                        How does Bima Kwik promote financial inclusion?
                                    </button>
                                </h2>
                                <div id="inc1" class="accordion-collapse collapse show" data-bs-parent="#accordionInclusion">
                                    <div class="accordion-body text-muted lh-lg">
                                        We provide social protection through customized insurance products for community groups, individuals, and businesses that were previously excluded. We use a revenue-sharing model that empowers women, youth, SMEs, and disabled individuals by allowing them to earn commissions as referrers.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#inc2">
                                        What is the Africa Situation addressed by Bima Kwik?
                                    </button>
                                </h2>
                                <div id="inc2" class="accordion-collapse collapse" data-bs-parent="#accordionInclusion">
                                    <div class="accordion-body text-muted lh-lg">
                                        Insurance penetration in Africa is currently less than 3%. Bima Kwik aims to solve this by changing the perception of insurance from an "expense" to an "investment" or "business opportunity," leveraging a salesforce of SMEs to increase adoption.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Models -->
                    <div class="tab-pane fade" id="business" role="tabpanel">
                        <h3 class="fw-bold mb-4">Business Models</h3>
                        <div class="accordion shadow-sm" id="accordionBusiness">
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#biz1">
                                        What are the options for purchasing Bima Kwik?
                                    </button>
                                </h2>
                                <div id="biz1" class="accordion-collapse collapse show" data-bs-parent="#accordionBusiness">
                                    <div class="accordion-body text-muted lh-lg">
                                        We offer three main sales options:
                                        <ul class="mt-3">
                                            <li><strong>Outright Purchase:</strong> Full purchase of the Bima Kwik core system.</li>
                                            <li><strong>White Labeling:</strong> Using our platform with your branding on a commission basis.</li>
                                            <li><strong>Bima Kwik Brand:</strong> Access to the system as it is under the Bima Kwik brand.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#biz2">
                                        How does Bima Kwik generate revenue?
                                    </button>
                                </h2>
                                <div id="biz2" class="accordion-collapse collapse" data-bs-parent="#accordionBusiness">
                                    <div class="accordion-body text-muted lh-lg">
                                        Our revenue channels include:
                                        <ul class="mt-3">
                                            <li>Commissions on insurance premiums.</li>
                                            <li>One-time fees for white-label platform deployments.</li>
                                            <li>Annual platform support and maintenance fees.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="mt-5 p-4 bg-white rounded-3 shadow-sm text-center">
                    <h5 class="fw-bold mb-3">Still have questions?</h5>
                    <p class="text-muted mb-4">Can't find the answer you're looking for? Please chat with our friendly team.</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('pages.contact') }}" class="btn btn-primary px-4">Contact Us</a>
                        <a href="mailto:info@bimakwik.com" class="btn btn-outline-primary px-4">Email Support</a>
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
