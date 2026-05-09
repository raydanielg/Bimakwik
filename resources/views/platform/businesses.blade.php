@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">
                    {{ app()->getLocale() == 'sw' ? 'Upanuzi wa Kimataifa' : 'Global Expansion' }}
                </h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    {{ app()->getLocale() == 'sw' ? 'Jukwaa Linaloweza Kukua Popote' : 'Scalable Platform for Every Market' }}
                </h1>
                <p class="lead text-secondary mb-0">
                    {{ app()->getLocale() == 'sw' ? 'Bima Kwik imeundwa kukua zaidi ya mipaka. Teknolojia yetu inaweza kuanzishwa katika nchi yoyote kwa urahisi.' : 'Bima Kwik is built to scale beyond borders. Our technology can be deployed in any country with ease and speed.' }}
                </p>
            </div>
        </div>

        <div class="row g-5 align-items-center py-5">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <div class="bg-light p-5 rounded-5 shadow-sm border-start border-5 border-primary">
                    <h2 class="fw-bold mb-4">{{ app()->getLocale() == 'sw' ? 'Nchi Nyingi, Jukwaa Moja' : 'Multi-Country Instances' }}</h2>
                    <p class="text-muted lh-lg">
                        {{ app()->getLocale() == 'sw' ? 'Mfumo wetu unaruhusu kuanzisha nakala (instances) za jukwaa kwa nchi tofauti, huku kukiwa na uwezo wa kusimamia sarafu tofauti na kanuni za nchi husika.' : 'Our architecture allows for the deployment of dedicated platform instances for different countries, supporting multiple currencies and localized regulatory requirements.' }}
                    </p>
                    <div class="mt-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i>
                            <span>{{ app()->getLocale() == 'sw' ? 'Usimamizi wa Sarafu Nyingi' : 'Multi-Currency Support' }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i>
                            <span>{{ app()->getLocale() == 'sw' ? 'Lugha Nyingi' : 'Multi-Language Capabilities' }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i>
                            <span>{{ app()->getLocale() == 'sw' ? 'Uzingativu wa Kanuni za Ndani' : 'Local Regulatory Compliance' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight text-center">
                <i class="bi bi-globe-africa display-1 text-primary opacity-25"></i>
            </div>
        </div>

        <!-- TIRAMIS Section -->
        <div class="bg-dark text-white p-5 rounded-5 shadow-lg mt-5 overflow-hidden">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h2 class="fw-bold mb-4 text-warning">{{ app()->getLocale() == 'sw' ? 'Teknolojia ya TIRAMIS' : 'TIRAMIS Replicability' }}</h2>
                    <p class="lead opacity-75 mb-0">
                        {{ app()->getLocale() == 'sw' ? 'Muundo wetu wa kuripoti kwa mdhibiti (TIRAMIS) unaweza kuigwa na kutumika na mamlaka za bima katika nchi yoyote barani Afrika.' : 'Our regulatory reporting framework (TIRAMIS) is highly replicable and can be adopted by insurance regulators across Africa to enhance market transparency.' }}
                    </p>
                </div>
                <div class="col-lg-5 mt-5 mt-lg-0 text-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-4 d-inline-block">
                        <i class="bi bi-shield-check text-warning display-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('pages.contact') }}" class="btn btn-primary btn-lg px-5 rounded-pill fw-bold shadow hover-lift-sm">
                {{ app()->getLocale() == 'sw' ? 'Wasiliana na Timu ya Upanuzi' : 'Contact Expansion Team' }}
            </a>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container text-center py-5">
        <h2 class="fw-bold mb-5">{{ app()->getLocale() == 'sw' ? 'Mpango wa Upanuzi wa Bima Kwik' : 'The Bima Kwik Roadmap' }}</h2>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="p-4 bg-white rounded-4 shadow-sm mb-4">
                    <h5 class="fw-bold text-primary">{{ app()->getLocale() == 'sw' ? 'Hatua ya 1' : 'Stage 1' }}</h5>
                    <p class="small text-muted">{{ app()->getLocale() == 'sw' ? 'Msingi wa Tanzania (Uunganisho wa TIRA)' : 'Tanzania Foundation (TIRA Integration)' }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded-4 shadow-sm mb-4">
                    <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Hatua ya 2' : 'Stage 2' }}</h5>
                    <p class="small text-muted">{{ app()->getLocale() == 'sw' ? 'Kupanuka kwa Afrika Mashariki (Kenya, Uganda, Rwanda)' : 'East Africa Expansion (Kenya, Uganda, Rwanda)' }}</p>
                    <p class="small text-muted">East Africa Expansion (Kenya, Uganda, Rwanda)</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white rounded-4 shadow-sm mb-4">
                    <h5 class="fw-bold">Stage 3</h5>
                    <p class="small text-muted">Pan-African Scaling (West & Central Africa)</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
