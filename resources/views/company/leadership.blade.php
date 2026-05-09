@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Our Leadership | Timu ya Uongozi</h6>
                <h1 class="display-4 fw-bold mb-4">The Minds Behind Bima Kwik</h1>
                <p class="lead text-secondary">A diverse team of visionaries, technology experts, and insurance veterans dedicated to revolutionizing the industry in Africa.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <!-- CEO -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4 hover-lift">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mx-auto mb-3" style="width: 100px; height: 100px;">
                            <i class="bi bi-person-fill text-primary display-5"></i>
                        </div>
                        <h4 class="fw-bold mb-1">Dr. John Mwakipesile</h4>
                        <p class="text-primary small fw-bold text-uppercase">Founder & Group CEO</p>
                    </div>
                    <div class="bio-content small text-muted">
                        <p><strong>EN:</strong> Over 15 years in digital finance and insurance tech. Holds a PhD in AI from UDSM.</p>
                        <p><strong>SW:</strong> Zaidi ya miaka 15 katika fedha za kidijitali. Ana PhD katika Akili Bandia kutoka UDSM.</p>
                        <hr>
                        <p class="fst-italic text-dark">"Insurance should be a right, not a privilege."</p>
                    </div>
                </div>
            </div>

            <!-- COO -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4 hover-lift">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mx-auto mb-3" style="width: 100px; height: 100px;">
                            <i class="bi bi-person-badge-fill text-primary display-5"></i>
                        </div>
                        <h4 class="fw-bold mb-1">Sarah Ndengele</h4>
                        <p class="text-primary small fw-bold text-uppercase">Chief Operating Officer</p>
                    </div>
                    <div class="bio-content small text-muted">
                        <p><strong>EN:</strong> 12 years in insurance operations. Specialist in streamlining claims and customer experience.</p>
                        <p><strong>SW:</strong> Miaka 12 katika shughuli za bima. Mtaalamu wa kurahisisha madai na uzoefu wa wateja.</p>
                    </div>
                </div>
            </div>

            <!-- CTO -->
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4 hover-lift">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mx-auto mb-3" style="width: 100px; height: 100px;">
                            <i class="bi bi-cpu-fill text-primary display-5"></i>
                        </div>
                        <h4 class="fw-bold mb-1">Ali Hassan</h4>
                        <p class="text-primary small fw-bold text-uppercase">Chief Technology Officer</p>
                    </div>
                    <div class="bio-content small text-muted">
                        <p><strong>EN:</strong> Software architect and AI specialist. MIT graduate with a decade of fintech experience.</p>
                        <p><strong>SW:</strong> Mbunifu wa programu na mtaalamu wa AI. Mhitimu wa MIT mwenye uzoefu wa miaka 10.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <!-- CCO -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4 hover-lift">
                    <h5 class="fw-bold">Grace Mwakyembe</h5>
                    <p class="text-primary small fw-bold">CCO</p>
                    <p class="text-muted small"><strong>EN:</strong> Specialist in distribution networks and broker management.</p>
                    <p class="text-muted small"><strong>SW:</strong> Mtaalamu wa mitandao ya usambazaji na usimamizi wa brokers.</p>
                </div>
            </div>
            <!-- Compliance -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4 hover-lift">
                    <h5 class="fw-bold">Isaya Mtemi</h5>
                    <p class="text-primary small fw-bold">Head of Compliance</p>
                    <p class="text-muted small"><strong>EN:</strong> Former regulator ensuring data protection and anti-fraud measures.</p>
                    <p class="text-muted small"><strong>SW:</strong> Mdhibiti wa zamani anayehakikisha ulinzi wa data na kuzuia ulaghai.</p>
                </div>
            </div>
            <!-- AI -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4 hover-lift">
                    <h5 class="fw-bold">Dr. Rehema Kipanya</h5>
                    <p class="text-primary small fw-bold">Head of AI</p>
                    <p class="text-muted small"><strong>EN:</strong> Machine learning researcher with a PhD from Cape Town University.</p>
                    <p class="text-muted small"><strong>SW:</strong> Mtafiti wa machine learning mwenye PhD kutoka Chuo Kikuu cha Cape Town.</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-5 shadow-sm border">
            <h3 class="fw-bold text-center mb-5">Board of Advisors | Bodi ya Washauri</h3>
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <h6 class="fw-bold mb-1">Hon. Mary Nagu</h6>
                    <p class="small text-muted">Regulatory Strategy</p>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-1">James Mwangi</h6>
                    <p class="small text-muted">Financial Inclusion</p>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-1">Prof. Linus Etongo</h6>
                    <p class="small text-muted">Market Expansion</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
