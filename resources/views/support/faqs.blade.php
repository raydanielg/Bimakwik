@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-5 mt-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h6 class="text-primary fw-bold text-uppercase mb-3">Support</h6>
            <h2 class="display-5 fw-bold">Frequently Asked Questions</h2>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Find quick answers to common questions about our insurance services.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-flush rounded-4 overflow-hidden shadow-sm" id="faqAccordion">
                    <!-- FAQ 1 -->
                    <div class="accordion-item border-0 mb-3 rounded-4">
                        <h2 class="accordion-header">
                            <button class="accordion-button rounded-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How do I get an insurance quote?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                You can get a quote by clicking the "Request a Quote" button on our homepage. Fill in your details, and our system or advisor will provide you with a customized quote instantly or within 24 hours.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="accordion-item border-0 mb-3 rounded-4">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                How long does it take to process a claim?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                Most digital claims are initiated instantly. The full processing time depends on the type of insurance and documentation provided, but we aim to resolve all claims as quickly as possible, usually within a few business days.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="accordion-item border-0 mb-3 rounded-4">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Can I manage multiple policies in one account?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                Yes! Our digital platform allows you to view and manage all your active policies, renewals, and history in one convenient dashboard.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="accordion-item border-0 mb-3 rounded-4">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Is BimaKwik an insurance company?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                BimaKwik is a digital insurance platform (IDP) that partners with leading verified insurance brands in Tanzania to bring you the best coverage and convenience in one place.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .accordion-button:not(.collapsed) {
        background-color: rgba(0, 86, 179, 0.05);
        color: #0056b3;
    }
    .accordion-item {
        background-color: white;
    }
</style>
@endsection
