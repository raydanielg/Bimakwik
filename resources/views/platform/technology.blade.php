@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">
                    {{ app()->getLocale() == 'sw' ? 'Teknolojia Yetu' : 'Our Technology' }}
                </h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    {{ app()->getLocale() == 'sw' ? 'Nguvu ya Akili Bandia na OMNI CHANNEL' : 'AI-Powered OMNI CHANNEL Infrastructure' }}
                </h1>
                <p class="lead text-secondary mb-0">
                    {{ app()->getLocale() == 'sw' ? 'Tunatumia teknolojia ya kisasa kuhakikisha huduma za bima zinapatikana kwa urahisi, haraka, na salama kupitia njia zote za kidijitali.' : 'We leverage cutting-edge technology to ensure insurance services are accessible, fast, and secure across all digital touchpoints.' }}
                </p>
            </div>
        </div>

        <div class="row g-4 py-5">
            <!-- Tech Card 1 -->
            <div class="col-md-4">
                <div class="p-5 border rounded-5 h-100 hover-lift bg-light shadow-sm">
                    <div class="bg-primary bg-opacity-10 rounded-4 p-3 d-inline-block mb-4">
                        <i class="bi bi-diagram-3 text-primary fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ app()->getLocale() == 'sw' ? 'OMNI CHANNEL' : 'OMNI CHANNEL' }}</h4>
                    <p class="text-muted mb-0">
                        {{ app()->getLocale() == 'sw' ? 'Unganisha mawakala, wateja, na makampuni ya bima kupitia mfumo mmoja unaozungumza lugha moja.' : 'Connect agents, customers, and insurers through a unified ecosystem that speaks one language.' }}
                    </p>
                </div>
            </div>

            <!-- Tech Card 2 -->
            <div class="col-md-4">
                <div class="p-5 border rounded-5 h-100 hover-lift bg-light shadow-sm">
                    <div class="bg-info bg-opacity-10 rounded-4 p-3 d-inline-block mb-4">
                        <i class="bi bi-robot text-info fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ app()->getLocale() == 'sw' ? 'Akili Bandia (AI)' : 'Artificial Intelligence' }}</h4>
                    <p class="text-muted mb-0">
                        {{ app()->getLocale() == 'sw' ? 'Mifumo yetu ya AI inasaidia katika kukadiria hatari, kuzuia ulaghai, na kuharakisha malipo ya madai.' : 'Our AI models assist in risk assessment, fraud detection, and accelerating claims settlement.' }}
                    </p>
                </div>
            </div>

            <!-- Tech Card 3 -->
            <div class="col-md-4">
                <div class="p-5 border rounded-5 h-100 hover-lift bg-light shadow-sm">
                    <div class="bg-success bg-opacity-10 rounded-4 p-3 d-inline-block mb-4">
                        <i class="bi bi-code-square text-success fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ app()->getLocale() == 'sw' ? 'API na Low-Code' : 'API & Low-Code' }}</h4>
                    <p class="text-muted mb-0">
                        {{ app()->getLocale() == 'sw' ? 'Unganisha bidhaa zako kwa haraka ukitumia API zetu rahisi na zana za ujenzi wa bidhaa za Low-Code.' : 'Integrate your products rapidly using our simple APIs and Low-Code product builder tools.' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Security Section -->
        <div class="bg-dark text-white p-5 rounded-5 shadow-lg mt-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4 text-warning">{{ app()->getLocale() == 'sw' ? 'Usalama na Ufaragha' : 'Security & Privacy' }}</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-warning me-3"></i>
                            {{ app()->getLocale() == 'sw' ? 'Usimbaji wa Data wa 256-bit AES' : '256-bit AES Data Encryption' }}
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-warning me-3"></i>
                            {{ app()->getLocale() == 'sw' ? 'Uzingativu wa Sheria ya Ulinzi wa Data' : 'Data Protection Act Compliance' }}
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-warning me-3"></i>
                            {{ app()->getLocale() == 'sw' ? 'Mifumo ya Kugundua Ulaghai ya AI' : 'AI Fraud Detection Systems' }}
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="bi bi-shield-lock display-1 text-primary"></i>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
