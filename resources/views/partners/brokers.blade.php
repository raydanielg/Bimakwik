@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Become a Bima Kwik Broker | Kuwa Broker wa Bima Kwik</h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">Grow Your Insurance Business | Kuaisha Biashara Yako ya Bima</h1>
                <p class="lead text-secondary mb-0">Are you an insurance broker looking to expand your reach? Bima Kwik gives you a powerful digital platform to sell and manage insurance from multiple insurers – all in one place.</p>
                <p class="lead text-secondary">Je, wewe ni broker unayetaka kupanua wigo wako? Bima Kwik inakupa jukwaa lenye nguvu la kidijitali la kuuza na kusimamia bima kutoka makampuni mbalimbali mahali pamoja.</p>
            </div>
        </div>

        <div class="row g-5 align-items-center mb-5 py-4">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <div class="position-relative">
                    <img src="{{ asset('hero/passionate-about-what-he-does-manager-sitting-having-discussion-with-employee_590464-14320.jpg') }}" class="img-fluid rounded-5 shadow-lg" alt="Become a Broker">
                    <div class="position-absolute bottom-0 end-0 bg-primary text-white p-4 rounded-4 shadow-lg m-4 d-none d-md-block">
                        <h4 class="fw-bold mb-0">24/7</h4>
                        <small>Access anywhere, anytime</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5 animate__animated animate__fadeInRight">
                <h2 class="fw-bold mb-4">Why Become a Bima Kwik Broker?</h2>
                <div class="row g-4">
                    <div class="col-12 d-flex align-items-start">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                            <i class="bi bi-layers-half text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Multiple Insurers | Makampuni Mengi</h5>
                            <p class="text-muted small mb-0">Sell products from all top insurers on a single platform. / Uza bidhaa kutoka makampuni yote makubwa kupitia jukwaa moja.</p>
                        </div>
                    </div>
                    <div class="col-12 d-flex align-items-start">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                            <i class="bi bi-wallet2 text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Transparent Commissions | Tume za Uwazi</h5>
                            <p class="text-muted small mb-0">Commissions calculated automatically and paid directly to your wallet. / Tume huhesabiwa kiotomatiki na kulipwa kwenye pochi yako.</p>
                        </div>
                    </div>
                    <div class="col-12 d-flex align-items-start">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                            <i class="bi bi-robot text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">AI-Powered Tools | Zana za AI</h5>
                            <p class="text-muted small mb-0">Get renewal alerts and sales insights powered by intelligence. / Pata tahadhari za upya na maarifa ya mauzo kupitia akili bandia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Requirements & Commissions -->
        <div class="row g-4 mb-5 py-5 bg-light rounded-5 px-4 mx-1">
            <div class="col-lg-6">
                <h4 class="fw-bold mb-4 text-primary">Requirements | Mahitaji</h4>
                <div class="table-responsive">
                    <table class="table table-borderless bg-white rounded-4 shadow-sm mb-0">
                        <thead class="bg-primary text-white">
                            <tr><th class="p-3">Requirement</th><th class="p-3">Details</th></tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom"><td class="p-3 fw-bold">Valid Broker License</td><td class="p-3">Issued by TIRA Tanzania</td></tr>
                            <tr class="border-bottom"><td class="p-3 fw-bold">Registered Business</td><td class="p-3">TIN, License, Registration</td></tr>
                            <tr class="border-bottom"><td class="p-3 fw-bold">Experience</td><td class="p-3">Min. 2 years in brokerage</td></tr>
                            <tr><td class="p-3 fw-bold">Digital Readiness</td><td class="p-3">Willingness to use platform</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0">
                <h4 class="fw-bold mb-4 text-success">Commission Structure | Tume</h4>
                <div class="table-responsive">
                    <table class="table table-borderless bg-white rounded-4 shadow-sm mb-0">
                        <thead class="bg-success text-white">
                            <tr><th class="p-3">Product Type</th><th class="p-3">Commission Rate</th></tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom"><td class="p-3 fw-bold">Motor Insurance</td><td class="p-3">Up to 10%</td></tr>
                            <tr class="border-bottom"><td class="p-3 fw-bold">Health Insurance</td><td class="p-3">Up to 15%</td></tr>
                            <tr class="border-bottom"><td class="p-3 fw-bold">Life Insurance</td><td class="p-3">Up to 20% (1st Yr)</td></tr>
                            <tr><td class="p-3 fw-bold">General Insurance</td><td class="p-3">Up to 15%</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Application Steps -->
        <div class="row py-5">
            <div class="col-12 text-center mb-5">
                <h3 class="fw-bold">How to Apply | Jinsi ya Kutuma Maombi</h3>
            </div>
            <div class="col-md-3 col-6 text-center mb-4">
                <div class="step-num mx-auto mb-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 50px; height: 50px;">1</div>
                <h6 class="fw-bold mb-1">Apply Online</h6>
                <p class="small text-muted">Complete the form</p>
            </div>
            <div class="col-md-3 col-6 text-center mb-4">
                <div class="step-num mx-auto mb-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 50px; height: 50px;">2</div>
                <h6 class="fw-bold mb-1">Upload Docs</h6>
                <p class="small text-muted">License, TIN, ID</p>
            </div>
            <div class="col-md-3 col-6 text-center mb-4">
                <div class="step-num mx-auto mb-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 50px; height: 50px;">3</div>
                <h6 class="fw-bold mb-1">Verification</h6>
                <p class="small text-muted">3-5 Business Days</p>
            </div>
            <div class="col-md-3 col-6 text-center mb-4">
                <div class="step-num mx-auto mb-3 bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 50px; height: 50px;">4</div>
                <h6 class="fw-bold mb-1">Start Selling</h6>
                <p class="small text-muted">Account Activated</p>
            </div>
        </div>

        <!-- Testimonial & CTA -->
        <div class="bg-dark text-white p-5 rounded-5 shadow-lg position-relative overflow-hidden mb-5">
            <div class="row align-items-center position-relative z-index-1">
                <div class="col-lg-8">
                    <p class="fst-italic opacity-75 mb-3">"Bima Kwik changed my business. I now manage over 500 clients from my phone. Commissions are paid instantly. I will never go back to paper."</p>
                    <h5 class="fw-bold mb-0">James M., Broker Dar es Salaam</h5>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('register.broker') }}" class="btn btn-primary btn-lg px-5 rounded-pill fw-bold hover-lift-sm">Apply to Become a Broker</a>
                </div>
            </div>
            <div class="position-absolute top-0 end-0 p-5 opacity-10"><i class="bi bi-quote display-1"></i></div>
        </div>

        <div class="text-center mt-5">
            <p class="text-muted">Questions? Contact Broker Relations: <strong>brokers@bimakwik.com</strong> | +255 XXX XXX XXX</p>
        </div>
    </div>
</section>
@endsection
