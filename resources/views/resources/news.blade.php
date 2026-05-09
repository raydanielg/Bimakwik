@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">
                    {{ app()->getLocale() == 'sw' ? 'Blogu na Habari' : 'Blog & News' }}
                </h6>
                <h1 class="display-4 fw-bold mb-4 text-dark">
                    {{ app()->getLocale() == 'sw' ? 'Taarifa za Hivi Punde kutoka Bima Kwik' : 'Latest Updates from Bima Kwik' }}
                </h1>
                <p class="lead text-secondary mb-0">
                    {{ app()->getLocale() == 'sw' ? 'Jitambulishe kuhusu bima Tanzania, mabadiliko ya jukwaa, na vidokezo kwa wateja.' : 'Stay informed about the insurance industry in Tanzania, platform updates, and customer tips.' }}
                </p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <!-- Featured Post -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-5 overflow-hidden h-100">
                    <div class="bg-primary bg-opacity-10 p-5 d-flex align-items-center justify-content-center" style="height: 300px;">
                        <i class="bi bi-cpu display-1 text-primary"></i>
                    </div>
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary px-3 rounded-pill me-3">{{ app()->getLocale() == 'sw' ? 'Sasisho za Jukwaa' : 'Platform Updates' }}</span>
                            <small class="text-muted">May 1, 2026</small>
                        </div>
                        <h2 class="fw-bold mb-3">
                            {{ app()->getLocale() == 'sw' ? 'Kipengele Kipya – Msaidizi wa Madai wa AI Sasa Amefanya Kazi' : 'New Feature – AI-Powered Claims Assistant Now Live' }}
                        </h2>
                        <p class="text-muted mb-4">
                            {{ app()->getLocale() == 'sw' ? 'Tunafurahi kutangaza kwamba Msaidizi wa Madai wa AI sasa anapatikana. Chombo hiki kinakusaidia kuwasilisha madai ndani ya dakika 3.' : 'We are excited to announce that the Bima Kwik AI Claims Assistant is now available to all customers. This smart tool helps you file claims in under 3 minutes.' }}
                        </p>
                        <a href="#" class="btn btn-outline-primary rounded-pill px-4">{{ app()->getLocale() == 'sw' ? 'Soma Zaidi' : 'Read More' }} →</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="bg-light p-4 rounded-5 shadow-sm h-100">
                    <h4 class="fw-bold mb-4">{{ app()->getLocale() == 'sw' ? 'Kategoria' : 'Categories' }}</h4>
                    <div class="list-group list-group-flush bg-transparent">
                        <a href="#" class="list-group-item list-group-item-action bg-transparent border-bottom d-flex justify-content-between align-items-center">
                            {{ app()->getLocale() == 'sw' ? 'Sasisho za Jukwaa' : 'Platform Updates' }} <span class="badge bg-white text-primary border">12</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-transparent border-bottom d-flex justify-content-between align-items-center">
                            {{ app()->getLocale() == 'sw' ? 'Habari za Bima' : 'Insurance News' }} <span class="badge bg-white text-primary border">24</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-transparent border-bottom d-flex justify-content-between align-items-center">
                            {{ app()->getLocale() == 'sw' ? 'Vidokezo kwa Wateja' : 'Customer Tips' }} <span class="badge bg-white text-primary border">18</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-transparent border-bottom d-flex justify-content-between align-items-center">
                            {{ app()->getLocale() == 'sw' ? 'Mafanikio ya Washirika' : 'Partner Success' }} <span class="badge bg-white text-primary border">9</span>
                        </a>
                    </div>

                    <div class="mt-5 p-4 bg-primary text-white rounded-4 shadow">
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'sw' ? 'Jarida Letu' : 'Newsletter' }}</h5>
                        <p class="small opacity-75 mb-4">{{ app()->getLocale() == 'sw' ? 'Pokea habari mpya kwenye barua pepe yako kila wiki.' : 'Get the latest news delivered to your inbox every week.' }}</p>
                        <div class="input-group mb-0">
                            <input type="email" class="form-control rounded-start-pill border-0" placeholder="Email">
                            <button class="btn btn-warning rounded-end-pill px-3">{{ app()->getLocale() == 'sw' ? 'Jiunge' : 'Join' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden hover-lift h-100">
                    <div class="p-4">
                        <small class="text-primary fw-bold text-uppercase">{{ app()->getLocale() == 'sw' ? 'Habari za Bima' : 'Insurance News' }}</small>
                        <h5 class="fw-bold mt-2 mb-3">{{ app()->getLocale() == 'sw' ? 'Urekebishaji wa Malipo ya Bima ya Gari' : 'Motor Insurance Premiums Adjustment' }}</h5>
                        <p class="small text-muted mb-4">{{ app()->getLocale() == 'sw' ? 'Mamlaka ya Bima imetangaza urekebishaji wa asilimia 5–8 ya malipo ya bima.' : 'The Insurance Regulator of Tanzania has announced a 5–8% adjustment in premiums.' }}</p>
                        <a href="#" class="text-primary fw-bold text-decoration-none">{{ app()->getLocale() == 'sw' ? 'Soma Makala Kamili' : 'Read Full Post' }} <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden hover-lift h-100">
                    <div class="p-4">
                        <small class="text-primary fw-bold text-uppercase">{{ app()->getLocale() == 'sw' ? 'Mafanikio ya Washirika' : 'Partner Success' }}</small>
                        <h5 class="fw-bold mt-2 mb-3">{{ app()->getLocale() == 'sw' ? 'Jinsi Broker Mmoja Alivyokuza Biashara kwa 300%' : 'How One Broker Grew His Business by 300%' }}</h5>
                        <p class="small text-muted mb-4">{{ app()->getLocale() == 'sw' ? 'James Mwita, broker wa Dar es Salaam, alikuza biashara yake akitumia zana za AI.' : 'James Mwita, a broker in Dar es Salaam, grew his base using Bima Kwik AI tools.' }}</p>
                        <a href="#" class="text-primary fw-bold text-decoration-none">{{ app()->getLocale() == 'sw' ? 'Soma Makala Kamili' : 'Read Full Post' }} <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden hover-lift h-100">
                    <div class="p-4">
                        <small class="text-primary fw-bold text-uppercase">{{ app()->getLocale() == 'sw' ? 'Vidokezo kwa Wateja' : 'Customer Tips' }}</small>
                        <h5 class="fw-bold mt-2 mb-3">{{ app()->getLocale() == 'sw' ? 'Makosa 5 ya Kawaida Unapowasilisha Dai' : '5 Common Mistakes When Filing a Claim' }}</h5>
                        <p class="small text-muted mb-4">{{ app()->getLocale() == 'sw' ? 'Epuka makosa rahisi yanayoweza kuchelewesha malipo yako ya bima.' : 'Avoid simple mistakes that delay your insurance claim payments.' }}</p>
                        <a href="#" class="text-primary fw-bold text-decoration-none">{{ app()->getLocale() == 'sw' ? 'Soma Makala Kamili' : 'Read Full Post' }} <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }
</style>
@endsection
