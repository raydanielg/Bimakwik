@extends('layouts.landing')

@section('content')
<!-- FAQ Header -->
<section class="py-5 bg-primary text-white text-center" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); margin-top: 80px;">
    <div class="container py-4">
        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">How can we help you?</h1>
        <p class="lead mb-0 animate__animated animate__fadeInUp">Find answers to common questions about Bima Kwik's digital insurance platform.</p>
    </div>
</section>

<!-- FAQ Content -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Categories</h5>
                        <div class="nav flex-column nav-pills" id="faq-tabs" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active mb-2 text-start p-3" data-bs-toggle="pill" data-bs-target="#general" type="button">
                                <i class="bi bi-info-circle me-2"></i> General Information
                            </button>
                            <button class="nav-link mb-2 text-start p-3" data-bs-toggle="pill" data-bs-target="#technical" type="button">
                                <i class="bi bi-cpu me-2"></i> Technical & Integration
                </div>
            </div>
            <div class="col-lg-9 ps-lg-5 mt-4 mt-lg-0">
                <div class="tab-content">
                    <!-- General -->
                    <div class="tab-pane fade show active" id="general">
                        <h4 class="fw-bold mb-4">General Questions</h4>
                        <div class="accordion accordion-flush" id="accGeneral">
                            <div class="accordion-item border rounded-4 mb-3 overflow-hidden shadow-sm">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#g1">
                                        What is Bima Kwik?
                                    </button>
                                </h2>
                                <div id="g1" class="accordion-collapse collapse show" data-bs-parent="#accGeneral">
                                    <div class="accordion-body text-muted">
                                        Bima Kwik is a digital insurance platform that provides a single point of access for insurance products. Customers can buy, renew, and claim insurance online.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border rounded-4 mb-3 overflow-hidden shadow-sm">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#g2">
                                        Is Bima Kwik licensed?
                                    </button>
                                </h2>
                                <div id="g2" class="accordion-collapse collapse" data-bs-parent="#accGeneral">
                                    <div class="accordion-body text-muted">
                                        Yes. Bima Kwik operates under a license from the Insurance Regulator of Tanzania (TIRA) and complies with the Personal Data Protection Act.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customers -->
                    <div class="tab-pane fade" id="customers">
                        <h4 class="fw-bold mb-4">For Customers</h4>
                        <div class="accordion accordion-flush" id="accCustomers">
                            <div class="accordion-item border rounded-4 mb-3 overflow-hidden shadow-sm">
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#tech1">
                                        What is the OMNI CHANNEL approach?
                                    </button>
                                </h2>
                                <div id="tech1" class="accordion-collapse collapse show" data-bs-parent="#accordionTechnical">
                                    <div class="accordion-body text-muted lh-lg">
                                        Our OMNI CHANNEL platform allows seamless communication across multiple touchpoints, including mobile applications for referrers/customers, web portals for administrators, and API integrations for other digital platforms, payment aggregators, and utility billers.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#tech2">
                                        Can Bima Kwik integrate with our existing systems?
                                    </button>
                                </h2>
                                <div id="tech2" class="accordion-collapse collapse" data-bs-parent="#accordionTechnical">
                                    <div class="accordion-body text-muted lh-lg">
                                        Absolutely. Bima Kwik provides robust APIs for integration with insurance company core systems, regulators, payment aggregators, and other digital ecosystems. This ensures a synchronized flow of data and transactions.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 mb-3">
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
