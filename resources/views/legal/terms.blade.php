@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 animate__animated animate__fadeInUp">
                <div class="card border-0 shadow-sm rounded-4 p-5">
                    <h1 class="fw-bold mb-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ __('site.terms_of_service') }}</h1>
                    <p class="text-secondary mb-4">{{ __('site.last_updated') }}: May 08, 2026</p>
                    
                    <div class="legal-content text-dark" style="line-height: 1.8;">
                        <h5 class="fw-bold mt-4 text-primary">1. {{ __('site.acceptance_of_terms') }}</h5>
                        <p>{{ app()->getLocale() == 'sw' ? 'Kwa kufikia na kutumia BimaKwik, unakubali kufungwa na Masharti haya ya Huduma na sheria na kanuni zote zinazotumika Tanzania.' : 'By accessing and using BimaKwik, you agree to be bound by these Terms of Service and all applicable laws and regulations in Tanzania.' }}</p>

                        <h5 class="fw-bold mt-4 text-primary">2. {{ __('site.use_of_services') }}</h5>
                        <p>{{ app()->getLocale() == 'sw' ? 'Unakubali kutumia jukwaa letu kwa madhumuni halali tu. Wewe una jukumu la kudumisha usiri wa taarifa za akaunti yako.' : 'You agree to use our platform only for lawful purposes. You are responsible for maintaining the confidentiality of your account credentials.' }}</p>

                        <h5 class="fw-bold mt-4 text-primary">3. {{ app()->getLocale() == 'sw' ? 'Sera za Bima' : 'Insurance Policies' }}</h5>
                        <p>{{ app()->getLocale() == 'sw' ? 'Bidhaa zote za bima zinategemea masharti na vigezo maalum vilivyotolewa na makampuni ya bima. BimaKwik inafanya kazi kama mwezesha na msimamizi wa jukwaa.' : 'All insurance products are subject to the specific terms and conditions provided by the underwriting insurance companies. BimaKwik acts as a facilitator and platform manager.' }}</p>

                        <h5 class="fw-bold mt-4 text-primary">4. {{ app()->getLocale() == 'sw' ? 'Usahihi wa Taarifa' : 'Accuracy of Information' }}</h5>
                        <p>{{ app()->getLocale() == 'sw' ? 'Unawakilisha kwamba taarifa zote ulizotupa ni sahihi na kamili. Kutoa taarifa za uwongo kunaweza kusababisha kufutwa kwa sera zako za bima.' : 'You represent that all information provided to us is accurate and complete. Providing false information may lead to the cancellation of your insurance policies.' }}</p>

                        <h5 class="fw-bold mt-4 text-primary">5. {{ __('site.limitation_liability') }}</h5>
                        <p>{{ app()->getLocale() == 'sw' ? 'BimaKwik haitawajibika kwa uharibifu wowote usio wa moja kwa moja, wa bahati mbaya, au wa matokeo yanayotokana na matumizi yako au kutoweza kutumia jukwaa letu.' : 'BimaKwik shall not be liable for any indirect, incidental, or consequential damages arising out of your use or inability to use our platform.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
