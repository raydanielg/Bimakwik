@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 translate-middle bg-primary opacity-5 rounded-circle" style="width: 400px; height: 400px;"></div>
    
    <div class="container py-5 mt-5 position-relative">
        <nav aria-label="breadcrumb" class="mb-4 animate__animated animate__fadeInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-primary">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('resources.guidelines') }}" class="text-decoration-none text-secondary">Guidelines</a></li>
                <li class="breadcrumb-item active fw-bold" aria-current="page">Claim Process Guide</li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 animate__animated animate__fadeInLeft">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                            <i class="bi bi-file-earmark-text text-primary fs-3"></i>
                        </div>
                        <h2 class="fw-bold mb-0">Claim Process Guide</h2>
                    </div>

                    <div class="content text-secondary">
                        <p class="lead text-dark mb-4">Hapa utajifunza hatua kwa hatua jinsi ya kufanya madai yako ya bima kwa urahisi kupitia mfumo wetu wa kidijitali.</p>
                        
                        <div class="step-item mb-4 pb-4 border-bottom">
                            <h5 class="fw-bold text-dark d-flex align-items-center">
                                <span class="badge bg-primary rounded-circle me-3">1</span>
                                Ripoti Tukio (Report Incident)
                            </h5>
                            <p class="ms-5">Ingia kwenye dashboard yako na uchague sehemu ya 'Claims'. Jaza fomu fupi kuelezea tukio lilivyotokea na tarehe ya tukio.</p>
                        </div>

                        <div class="step-item mb-4 pb-4 border-bottom">
                            <h5 class="fw-bold text-dark d-flex align-items-center">
                                <span class="badge bg-primary rounded-circle me-3">2</span>
                                Pakia Nyaraka (Upload Documents)
                            </h5>
                            <p class="ms-5">Chukua picha au scan nyaraka muhimu kama Ripoti ya Polisi, picha za uharibifu, na risiti za matibabu ikiwa ni lazima.</p>
                        </div>

                        <div class="step-item mb-4 pb-4 border-bottom">
                            <h5 class="fw-bold text-dark d-flex align-items-center">
                                <span class="badge bg-primary rounded-circle me-3">3</span>
                                Uhakiki na Malipo (Verification & Payment)
                            </h5>
                            <p class="ms-5">Timu yetu itahakiki madai yako ndani ya saa 24-48. Ukishaidhinishwa, malipo yatatumwa moja kwa moja kwenye akaunti yako au simu yako.</p>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 rounded-4 d-flex align-items-center mt-4">
                        <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                        <div>
                            <strong>Je, unahitaji msaada zaidi?</strong> Piga simu namba +255 762 883 065 kwa msaada wa haraka.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top animate__animated animate__fadeInRight" style="top: 100px;">
                    <h5 class="fw-bold mb-4">Miongozo Mingine</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <a href="{{ route('guidelines.policy-management') }}" class="text-decoration-none d-flex align-items-center p-3 rounded-3 bg-light hover-bg-primary transition">
                                <i class="bi bi-shield-check me-3 fs-5"></i>
                                <span class="text-dark">Policy Management</span>
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('guidelines.kyc-verification') }}" class="text-decoration-none d-flex align-items-center p-3 rounded-3 bg-light hover-bg-primary transition">
                                <i class="bi bi-person-lock me-3 fs-5"></i>
                                <span class="text-dark">KYC & Verification</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .transition { transition: all 0.3s ease; }
    .hover-bg-primary:hover { background-color: rgba(13, 110, 253, 0.1) !important; }
    .hover-bg-primary:hover i, .hover-bg-primary:hover span { color: #0d6efd !important; }
    .breadcrumb-item + .breadcrumb-item::before {
        content: "\F138";
        font-family: "bootstrap-icons";
        font-size: 0.75rem;
        color: #6c757d;
    }
</style>
@endsection
