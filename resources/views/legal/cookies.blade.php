@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 translate-middle bg-primary opacity-5 rounded-circle" style="width: 400px; height: 400px;"></div>
    
    <div class="container py-5 mt-5 position-relative">
        <nav aria-label="breadcrumb" class="mb-4 animate__animated animate__fadeInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-primary">{{ __('site.home') }}</a></li>
                <li class="breadcrumb-item active fw-bold" aria-current="page">{{ __('site.cookie_policy_full') }}</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 animate__animated animate__fadeInUp">
                    <div class="text-center mb-5">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-4">
                            <i class="bi bi-cookie text-primary fs-1"></i>
                        </div>
                        <h1 class="display-5 fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ __('site.cookie_policy_full') }}</h1>
                        <p class="text-secondary">{{ __('site.last_updated') }}: May 9, 2026</p>
                    </div>

                    <div class="content text-secondary">
                        <h4 class="fw-bold text-dark mb-4">1. {{ app()->getLocale() == 'sw' ? 'Vidakuzi ni Nini?' : 'What are Cookies?' }}</h4>
                        <p>{{ app()->getLocale() == 'sw' ? 'Vidakuzi ni faili ndogo za maandishi zinazohifadhiwa kwenye kompyuta au kifaa chako cha mkononi unapotembela tovuti yetu. Zinatusaidia kukupa uzoefu bora kwa kukumbuka mapendeleo yako na kutusaidia kuelewa jinsi unavyotumia tovuti yetu.' : 'Cookies are small text files that are stored on your computer or mobile device when you visit our website. They help us provide you with a better experience by remembering your preferences and helping us understand how you use our site.' }}</p>

                        <h4 class="fw-bold text-dark mt-5 mb-4">2. {{ app()->getLocale() == 'sw' ? 'Jinsi Tunavyotumia Vidakuzi' : 'How We Use Cookies' }}</h4>
                        <p>{{ app()->getLocale() == 'sw' ? 'Tunatumia vidakuzi kwa sababu kadhaa, ikijumuisha:' : 'We use cookies for several reasons, including:' }}</p>
                        <ul class="mb-4">
                            <li><strong>{{ app()->getLocale() == 'sw' ? 'Vidakuzi Muhimu:' : 'Essential Cookies:' }}</strong> {{ app()->getLocale() == 'sw' ? 'Vya lazima ili tovuti ifanye kazi vizuri (mf. kuingia, usalama).' : 'Necessary for the website to function correctly (e.g., login, security).' }}</li>
                            <li><strong>{{ app()->getLocale() == 'sw' ? 'Vidakuzi vya Uchanganuzi:' : 'Analytics Cookies:' }}</strong> {{ app()->getLocale() == 'sw' ? 'Hutusaidia kuelewa jinsi wageni wanavyoingiliana na tovuti kwa kukusanya data isiyojulikana.' : 'Help us understand how visitors interact with the site by collecting anonymous data.' }}</li>
                            <li><strong>{{ app()->getLocale() == 'sw' ? 'Vidakuzi vya Mapendeleo:' : 'Preference Cookies:' }}</strong> {{ app()->getLocale() == 'sw' ? 'Hukumbuka uchaguzi uliofanya (mf. lugha, ukubwa wa herufi).' : 'Remember choices you\'ve made (e.g., language, font size).' }}</li>
                            <li><strong>{{ app()->getLocale() == 'sw' ? 'Vidakuzi vya Uuzaji:' : 'Marketing Cookies:' }}</strong> {{ app()->getLocale() == 'sw' ? 'Hutumiwa kufuatilia wageni katika tovuti kutoa matangazo yanayofaa.' : 'Used to track visitors across websites to deliver relevant ads.' }}</li>
                        </ul>

                        <h4 class="fw-bold text-dark mt-5 mb-4">3. {{ app()->getLocale() == 'sw' ? 'Kusimamia Mapendeleo Yako' : 'Managing Your Preferences' }}</h4>
                        <p>{{ app()->getLocale() == 'sw' ? 'Una haki ya kuamua kukubali au kukataa vidakuzi. Unaweza kuweka au kurekebisha udhibiti wa kivinjari chako cha wavuti kukubali au kukataa vidakuzi. Ikiwa unachagua kukataa vidakuzi, bado unaweza kutumia tovuti yetu, ingawa ufikiaji wako kwa baadhi ya utendaji na maeneo ya tovuti yetu unaweza kupunguzwa.' : 'You have the right to decide whether to accept or reject cookies. You can set or amend your web browser controls to accept or refuse cookies. If you choose to reject cookies, you may still use our website, though your access to some functionality and areas of our website may be restricted.' }}</p>

                        <div class="alert alert-primary border-0 rounded-4 p-4 mt-5">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-info-circle-fill fs-3 me-3"></i>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'sw' ? 'Hali ya Idhini' : 'Consent Status' }}</h5>
                                    <p class="mb-0" id="current-status">{{ app()->getLocale() == 'sw' ? 'Inakagua mapendeleo yako...' : 'Checking your preferences...' }}</p>
                                </div>
                                <div class="ms-auto">
                                    <button class="btn btn-primary btn-sm rounded-pill px-4 me-2" onclick="acceptCookies()">{{ app()->getLocale() == 'sw' ? 'Kubali Zote' : 'Accept All' }}</button>
                                    <button class="btn btn-outline-primary btn-sm rounded-pill px-4" onclick="declineCookies()">{{ app()->getLocale() == 'sw' ? 'Kataa Zisizo Muhimu' : 'Reject Non-Essential' }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function updateStatusDisplay() {
        const consent = localStorage.getItem('cookieConsent');
        const statusEl = document.getElementById('current-status');
        if (consent === 'accepted') {
            statusEl.innerHTML = '<span class="badge bg-success">Accepted</span> You have accepted all cookies.';
        } else if (consent === 'declined') {
            statusEl.innerHTML = '<span class="badge bg-warning text-dark">Declined</span> You have declined non-essential cookies.';
        } else {
            statusEl.innerHTML = 'You have not yet set your cookie preferences.';
        }
    }

    document.addEventListener('DOMContentLoaded', updateStatusDisplay);
</script>

<style>
    .breadcrumb-item + .breadcrumb-item::before {
        content: "\F138";
        font-family: "bootstrap-icons";
        font-size: 0.75rem;
        color: #6c757d;
    }
    .content p { line-height: 1.8; }
    .content ul li { margin-bottom: 10px; }
</style>
@endsection
