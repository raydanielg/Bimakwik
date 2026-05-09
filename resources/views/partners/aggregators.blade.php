@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-info fw-bold text-uppercase letter-spacing-1 mb-3">Become a Bima Kwik Aggregator | Pata kwa Kulinganisha na Kutuma Wateja</h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">Earn by Referring Insurance | Pata kwa Kutuma Wateja wa Bima</h1>
                <p class="lead text-secondary mb-0">Do you have a website, mobile app, or social media following? Join the Bima Kwik Aggregator Program and earn money by helping people compare and buy insurance.</p>
                <p class="lead text-secondary">Je, una tovuti au wafuasi wengi kwenye mitandao ya kijamii? Jiunge na Programu ya Aggregator na upate pesa kwa kusaidia watu kulinganisha na kununua bima.</p>
            </div>
        </div>

        <div class="row align-items-center g-5 py-5 border-bottom mb-5">
            <div class="col-lg-6 order-lg-2 animate__animated animate__fadeInRight">
                <img src="{{ asset('hero/explain-black-man-laptop-office-meeting-ideas-project-with-teamwork-collaboration-employee-discussion-boardroom-with-research-partnership-strategy-as-lawyers_590464-394339.jpg') }}" class="img-fluid rounded-5 shadow-lg" alt="Aggregator Benefits">
            </div>
            <div class="col-lg-6 order-lg-1 animate__animated animate__fadeInLeft">
                <h2 class="fw-bold mb-4">Why Join Us?</h2>
                <ul class="list-unstyled">
                    <li class="mb-4 d-flex">
                        <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-patch-check text-info"></i></div>
                        <div><strong>No License Required:</strong> You refer, we handle the insurance details. / Huhitaji leseni ya broker.</div>
                    </li>
                    <li class="mb-4 d-flex">
                        <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-code-square text-info"></i></div>
                        <div><strong>Easy Integration:</strong> Use APIs, widgets, or direct links. / Unganishaji rahisi kupitia API au viungo.</div>
                    </li>
                    <li class="mb-4 d-flex">
                        <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3"><i class="bi bi-clock-history text-info"></i></div>
                        <div><strong>Real-Time Tracking:</strong> Monitor your clicks and earnings instantly. / Fuatilia tume zako kwa wakati halisi.</div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Referral Fees & Examples -->
        <div class="row g-4 mb-5">
            <div class="col-lg-5">
                <h4 class="fw-bold mb-4 text-info">Referral Fee Structure | Ada za Utume</h4>
                <div class="table-responsive">
                    <table class="table table-hover border rounded-4 overflow-hidden shadow-sm">
                        <thead class="bg-info text-white">
                            <tr><th>Product</th><th>Fee (% of premium)</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Motor Insurance</td><td>3% – 5%</td></tr>
                            <tr><td>Health Insurance</td><td>5% – 8%</td></tr>
                            <tr><td>Life Insurance</td><td>8% – 10%</td></tr>
                            <tr><td>General Insurance</td><td>4% – 6%</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-7">
                <h4 class="fw-bold mb-4 text-primary">Potential Earnings | Mfano wa Mapato</h4>
                <div class="table-responsive">
                    <table class="table table-striped border rounded-4 overflow-hidden shadow-sm">
                        <thead class="bg-dark text-white text-center">
                            <tr><th>Clicks</th><th>Conversion</th><th>Policies</th><th>Monthly Earnings</th></tr>
                        </thead>
                        <tbody class="text-center">
                            <tr><td>1,000</td><td>5%</td><td>50</td><td class="fw-bold text-success">TZS 500k – 800k</td></tr>
                            <tr><td>5,000</td><td>5%</td><td>250</td><td class="fw-bold text-success">TZS 2.5M – 4M</td></tr>
                            <tr><td>10,000</td><td>5%</td><td>500</td><td class="fw-bold text-success">TZS 5M – 8M</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- How it Works -->
        <div class="bg-light p-5 rounded-5 mb-5 text-center">
            <h3 class="fw-bold mb-5">How It Works | Jinsi Inavyofanya Kazi</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                        <div class="h2 text-info fw-bold mb-2">01</div>
                        <h6 class="fw-bold">Sign Up</h6>
                        <p class="small text-muted">Register and get your API keys or links.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                        <div class="h2 text-info fw-bold mb-2">02</div>
                        <h6 class="fw-bold">Share Link</h6>
                        <p class="small text-muted">Share products with your audience.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                        <div class="h2 text-info fw-bold mb-2">03</div>
                        <h6 class="fw-bold">Get Paid</h6>
                        <p class="small text-muted">Earn commission for every successful sale.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center py-4">
            <a href="{{ route('pages.contact') }}" class="btn btn-info text-white btn-lg px-5 rounded-pill fw-bold shadow hover-lift-sm">Become an Aggregator Today</a>
            <p class="mt-4 text-muted">Questions? Contact Aggregator Support: <strong>aggregators@bimakwik.com</strong></p>
        </div>
    </div>
</section>
@endsection
