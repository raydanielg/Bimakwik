@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-info fw-bold text-uppercase letter-spacing-1 mb-3">Life Insurance | Bima ya Maisha</h6>
                <h1 class="display-4 fw-bold mb-4">Secure Your Family's Future</h1>
                <p class="lead text-secondary">Life is unpredictable, but your family's financial security shouldn't be. Explore our comprehensive life insurance plans.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm p-5 rounded-5 animate__animated animate__fadeInLeft">
                    <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-block mb-4">
                        <i class="bi bi-shield-heart text-info fs-2"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Whole Life Protection</h3>
                    <p class="text-muted mb-4">Lifelong coverage with a guaranteed death benefit. Build cash value over time while ensuring your heirs are protected.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check2 text-info me-2"></i> Permanent coverage</li>
                        <li class="mb-2"><i class="bi bi-check2 text-info me-2"></i> Savings component</li>
                        <li class="mb-2"><i class="bi bi-check2 text-info me-2"></i> Fixed premiums</li>
                    </ul>
                    <a href="{{ route('quote.request') }}" class="btn btn-info text-white rounded-pill px-4 mt-3">Learn More</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm p-5 rounded-5 animate__animated animate__fadeInRight">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mb-4">
                        <i class="bi bi-mortarboard-fill text-primary fs-2"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Education & Endowment Plans</h3>
                    <p class="text-muted mb-4">Save for your children's education or your own future goals with our targeted investment and life plans.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i> Guaranteed payouts</li>
                        <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i> Targeted maturity dates</li>
                        <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i> Bonus additions</li>
                    </ul>
                    <a href="{{ route('quote.request') }}" class="btn btn-primary rounded-pill px-4 mt-3">Start Saving</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
