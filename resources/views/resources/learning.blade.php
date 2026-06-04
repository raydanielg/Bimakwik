@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">
                    {{ app()->getLocale() == 'sw' ? 'Kituo cha Mafunzo' : 'Learning Center' }}
                </h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    {{ app()->getLocale() == 'sw' ? 'Elimu ya Bima kwa Kila Mtu' : 'Insurance Made Easy for Everyone' }}
                </h1>
                <p class="lead text-secondary mb-0">
                    @if(app()->getLocale() == 'sw')
                        Karibu kwenye Kituo cha Mafunzo cha Bima Kwik. Tunaamini kwamba bima inapaswa kuwa rahisi kuelewa. Fikia nyenzo zetu za bure za kielimu hapa.
                    @else
                        Welcome to the Bima Kwik Learning Center. We believe that insurance should be easy to understand. Access our free educational resources below.
                    @endif
                </p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <!-- Section 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 border rounded-5 h-100 hover-lift bg-light shadow-sm">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                        <i class="bi bi-book text-primary fs-3"></i>
                    </div>
                    <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Misingi ya Bima' : 'Insurance Basics' }}</h5>
                    <p class="small text-muted">
                        {{ app()->getLocale() == 'sw' ? 'Bima ni nini, jinsi inavyofanya kazi, na kwanini unaihitaji.' : 'What is insurance, how it works, and why you need it.' }}
                    </p>
                    <ul class="list-unstyled small mb-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ app()->getLocale() == 'sw' ? 'Aina za Bima' : 'Types of Insurance' }}</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ app()->getLocale() == 'sw' ? 'Kuelewa Malipo' : 'Understanding Premiums' }}</li>
                    </ul>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 border rounded-5 h-100 hover-lift bg-light shadow-sm">
                    <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                        <i class="bi bi-cart-check text-success fs-3"></i>
                    </div>
                    <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Kununua kwenye Bima Kwik' : 'Buying on Bima Kwik' }}</h5>
                    <p class="small text-muted">
                        {{ app()->getLocale() == 'sw' ? 'Mwongozo wa hatua kwa hatua wa kununua sera na kufanya malipo.' : 'Step-by-step guide to buying policies and making payments.' }}
                    </p>
                    <ul class="list-unstyled small mb-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ app()->getLocale() == 'sw' ? 'Jinsi ya Kusajili' : 'How to Register' }}</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ app()->getLocale() == 'sw' ? 'Njia za Malipo' : 'Payment Methods' }}</li>
                    </ul>
                </div>
            </div>

            <!-- Section 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 border rounded-5 h-100 hover-lift bg-light shadow-sm">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                        <i class="bi bi-shield-exclamation text-danger fs-3"></i>
                    </div>
                    <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Usimamizi wa Madai' : 'Claims Management' }}</h5>
                    <p class="small text-muted">
                        {{ app()->getLocale() == 'sw' ? 'Jinsi ya kuwasilisha madai na kufuatilia hali yake kwa wakati halisi.' : 'How to file claims and track status in real-time.' }}
                    </p>
                    <ul class="list-unstyled small mb-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ app()->getLocale() == 'sw' ? 'Kuwasilisha Dai' : 'How to File a Claim' }}</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i>{{ app()->getLocale() == 'sw' ? 'Nyaraka Muhimu' : 'Required Documents' }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Video Section -->
        <div class="bg-dark text-white p-5 rounded-5 shadow-lg mb-5">
            <h3 class="fw-bold mb-4">
                {{ app()->getLocale() == 'sw' ? 'Mafunzo ya Video' : 'Video Tutorials' }}
            </h3>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="ratio ratio-16x9 bg-secondary rounded-4 mb-2 overflow-hidden hover-lift border border-secondary border-opacity-25">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="bi bi-play-circle display-4 text-white"></i>
                        </div>
                    </div>
                    <p class="small fw-bold">
                        {{ app()->getLocale() == 'sw' ? 'Jinsi ya kununua bima ya gari' : 'How to buy motor insurance' }}
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="ratio ratio-16x9 bg-secondary rounded-4 mb-2 overflow-hidden hover-lift border border-secondary border-opacity-25">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="bi bi-play-circle display-4 text-white"></i>
                        </div>
                    </div>
                    <p class="small fw-bold">
                        {{ app()->getLocale() == 'sw' ? 'Jinsi ya kuwasilisha dai' : 'How to file a claim' }}
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="ratio ratio-16x9 bg-secondary rounded-4 mb-2 overflow-hidden hover-lift border border-secondary border-opacity-25">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="bi bi-play-circle display-4 text-white"></i>
                        </div>
                    </div>
                    <p class="small fw-bold">
                        {{ app()->getLocale() == 'sw' ? 'Mafunzo ya Portal ya Broker' : 'Broker Portal Training' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Webinar Section -->
        <div class="text-center">
            <h4 class="fw-bold mb-4">
                {{ app()->getLocale() == 'sw' ? 'Toamıza za Kila Mwezi' : 'Monthly Webinars' }}
            </h4>
            <div class="table-responsive shadow-sm rounded-4 overflow-hidden border">
                <table class="table table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>{{ app()->getLocale() == 'sw' ? 'Mada ya Toamıza' : 'Webinar' }}</th>
                            <th>{{ app()->getLocale() == 'sw' ? 'Watazamaji Lengwa' : 'Target Audience' }}</th>
                            <th>{{ app()->getLocale() == 'sw' ? 'Ratiba' : 'Schedule' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Insurance 101</td><td>{{ app()->getLocale() == 'sw' ? 'Wateja' : 'Customers' }}</td><td>1st Tuesday</td></tr>
                        <tr><td>Claims Made Easy</td><td>{{ app()->getLocale() == 'sw' ? 'Wateja' : 'Customers' }}</td><td>2nd Wednesday</td></tr>
                        <tr><td>Broker Success</td><td>Brokers/Agents</td><td>3rd Thursday</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <a href="{{ route('pages.contact') }}" class="btn btn-primary btn-lg px-5 rounded-pill fw-bold shadow hover-lift-sm">
                    {{ app()->getLocale() == 'sw' ? 'Jisajili kwa Toamıza Inayofuata' : 'Register for Next Webinar' }}
                </a>
            </div>
            <p class="mt-4 text-muted small">
                {{ app()->getLocale() == 'sw' ? 'Una maswali? Wasiliana nasi:' : 'Have questions? Contact us:' }} 
                <strong>learn@bimakwik.com</strong>
            </p>
        </div>
    </div>
</section>
@endsection
