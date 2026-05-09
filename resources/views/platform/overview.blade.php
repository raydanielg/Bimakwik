@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">
                    {{ app()->getLocale() == 'sw' ? 'Muhtasari wa Jukwaa' : 'Platform Overview' }}
                </h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    {{ app()->getLocale() == 'sw' ? 'Mapinduzi ya Kidijitali ya Bima' : 'The Digital Insurance Revolution' }}
                </h1>
                <p class="lead text-secondary mb-0">
                    {{ app()->getLocale() == 'sw' ? 'Bima Kwik ni jukwaa la kisasa linalounganisha wateja, makampuni ya bima, na mawakala mahali pamoja kupitia teknolojia ya OMNI CHANNEL.' : 'Bima Kwik is a modern platform connecting customers, insurers, and agents in one place through OMNI CHANNEL technology.' }}
                </p>
            </div>
        </div>

        <div class="row g-5 align-items-center py-5">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <img src="{{ asset('hero/portrait-of-business-woman-standing-in-front-of-office_126277-542.jpg') }}" class="img-fluid rounded-5 shadow-lg" alt="Bima Kwik Platform">
            </div>
            <div class="col-lg-6 ps-lg-5 animate__animated animate__fadeInRight">
                <h2 class="fw-bold mb-4">{{ app()->getLocale() == 'sw' ? 'Kwanini Bima Kwik?' : 'Why Bima Kwik?' }}</h2>
                <div class="row g-4">
                    <div class="col-12 d-flex align-items-start">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                            <i class="bi bi-lightning-charge text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">{{ app()->getLocale() == 'sw' ? 'Haraka na Rahisi' : 'Fast & Easy' }}</h5>
                            <p class="text-muted small mb-0">
                                {{ app()->getLocale() == 'sw' ? 'Pata bima yako ndani ya dakika chache bila karatasi.' : 'Get your insurance in minutes with zero paperwork.' }}
                            </p>
                        </div>
                    </div>
                    <div class="col-12 d-flex align-items-start">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                            <i class="bi bi-shield-check text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">{{ app()->getLocale() == 'sw' ? 'Usalama wa Hali ya Juu' : 'Secure & Trusted' }}</h5>
                            <p class="text-muted small mb-0">
                                {{ app()->getLocale() == 'sw' ? 'Data zako zinalindwa kwa teknolojia ya kisasa ya usimbaji.' : 'Your data is protected with state-of-the-art encryption technology.' }}
                            </p>
                        </div>
                    </div>
                    <div class="col-12 d-flex align-items-start">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                            <i class="bi bi-graph-up text-primary fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">{{ app()->getLocale() == 'sw' ? 'Usimamizi wa Madai' : 'Real-time Claims' }}</h5>
                            <p class="text-muted small mb-0">
                                {{ app()->getLocale() == 'sw' ? 'Fuatilia hali ya madai yako kwa wakati halisi kupitia simu yako.' : 'Track your claim status in real-time through your mobile device.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ecosystem Section -->
        <div class="bg-light p-5 rounded-5 shadow-sm mt-5">
            <div class="text-center mb-5">
                <h3 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Mfumo Wetu' : 'Our Ecosystem' }}</h3>
                <p class="text-muted">{{ app()->getLocale() == 'sw' ? 'Tunaunganisha wadau wote muhimu kwenye sekta ya bima.' : 'We connect all key stakeholders in the insurance sector.' }}</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <i class="bi bi-people text-primary fs-1 mb-3 d-block"></i>
                        <h6 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Wateja' : 'Customers' }}</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <i class="bi bi-building text-primary fs-1 mb-3 d-block"></i>
                        <h6 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Kampuni za Bima' : 'Insurers' }}</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <i class="bi bi-briefcase text-primary fs-1 mb-3 d-block"></i>
                        <h6 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Mawakala/Brokers' : 'Agents/Brokers' }}</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <i class="bi bi-hospital text-primary fs-1 mb-3 d-block"></i>
                        <h6 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Watoa Huduma' : 'Service Providers' }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 rounded-pill fw-bold shadow hover-lift-sm">
                {{ app()->getLocale() == 'sw' ? 'Anza Sasa' : 'Get Started' }}
            </a>
        </div>
    </div>
</section>
@endsection
