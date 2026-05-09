@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">
                    {{ app()->getLocale() == 'sw' ? 'Kwa Wateja' : 'For Customers' }}
                </h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    {{ app()->getLocale() == 'sw' ? 'Bima Kiganjani Mwako' : 'Insurance in Your Pocket' }}
                </h1>
                <p class="lead text-secondary mb-0">
                    {{ app()->getLocale() == 'sw' ? 'Furahia urahisi wa kununua, kusimamia, na kudai bima yako popote ulipo kupitia simu yako ya mkononi au kompyuta.' : 'Experience the ease of buying, managing, and claiming your insurance wherever you are through your mobile phone or computer.' }}
                </p>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="row g-4 py-5">
            <div class="col-md-6 col-lg-3">
                <div class="p-4 border rounded-5 h-100 hover-lift bg-light shadow-sm text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-cart-plus text-primary fs-2"></i>
                    </div>
                    <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Kununua Haraka' : 'Easy Purchase' }}</h5>
                    <p class="small text-muted mb-0">
                        {{ app()->getLocale() == 'sw' ? 'Linganisha nukuu za bei na ununue bima ndani ya dakika tano.' : 'Compare quotes and buy your insurance policy in under five minutes.' }}
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="p-4 border rounded-5 h-100 hover-lift bg-light shadow-sm text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-shield-check text-success fs-2"></i>
                    </div>
                    <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Usimamizi Rahisi' : 'Manage Policy' }}</h5>
                    <p class="small text-muted mb-0">
                        {{ app()->getLocale() == 'sw' ? 'Pakua hati zako za bima na fanya upya bima yako kidijitali.' : 'Download your policy documents and renew your cover digitally.' }}
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="p-4 border rounded-5 h-100 hover-lift bg-light shadow-sm text-center">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-exclamation-triangle text-danger fs-2"></i>
                    </div>
                    <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Madai ya Haraka' : 'Fast Claims' }}</h5>
                    <p class="small text-muted mb-0">
                        {{ app()->getLocale() == 'sw' ? 'Toa taarifa za ajali au dharura papo hapo kupitia jukwaa letu.' : 'Report accidents or emergencies instantly through our platform.' }}
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="p-4 border rounded-5 h-100 hover-lift bg-light shadow-sm text-center">
                    <div class="bg-info bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                        <i class="bi bi-geo-alt text-info fs-2"></i>
                    </div>
                    <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Tafuta Huduma' : 'Find Providers' }}</h5>
                    <p class="small text-muted mb-0">
                        {{ app()->getLocale() == 'sw' ? 'Tafuta hospitali, gereji, au maduka ya dawa yaliyo karibu nawe.' : 'Locate hospitals, garages, or pharmacies near your location.' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- App Showcase -->
        <div class="bg-dark text-white p-5 rounded-5 shadow-lg mt-5 overflow-hidden position-relative">
            <div class="row align-items-center position-relative z-index-1">
                <div class="col-lg-7 animate__animated animate__fadeInLeft">
                    <h2 class="display-5 fw-bold mb-4">{{ app()->getLocale() == 'sw' ? 'Pakua Programu ya Bima Kwik' : 'Download the Bima Kwik App' }}</h2>
                    <p class="lead opacity-75 mb-5">
                        {{ app()->getLocale() == 'sw' ? 'Pata huduma zote za bima moja kwa moja kwenye simu yako. Rahisi, Salama, na Haraka.' : 'Get all insurance services directly on your phone. Simple, Secure, and Fast.' }}
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#" class="btn btn-light btn-lg px-4 rounded-pill fw-bold">
                            <i class="bi bi-apple me-2"></i> App Store
                        </a>
                        <a href="#" class="btn btn-outline-light btn-lg px-4 rounded-pill fw-bold">
                            <i class="bi bi-google-play me-2"></i> Google Play
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 mt-5 mt-lg-0 text-center animate__animated animate__fadeInRight">
                    <i class="bi bi-phone display-1 text-primary opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
