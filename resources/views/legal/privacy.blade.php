@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 animate__animated animate__fadeInUp">
                <div class="card border-0 shadow-sm rounded-4 p-5">
                    <h1 class="fw-bold mb-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ __('site.privacy_policy_full') }}</h1>
                    <p class="text-secondary mb-4">{{ __('site.last_updated') }}: May 08, 2026</p>
                    
                    <div class="legal-content text-dark" style="line-height: 1.8;">
                        <h5 class="fw-bold mt-4 text-primary">1. {{ app()->getLocale() == 'sw' ? 'Utangulizi' : 'Introduction' }}</h5>
                        <p>{{ app()->getLocale() == 'sw' ? 'Karibu BimaKwik. Tunathamini faragha yako na ulinzi wa data yako binafsi. Sera hii ya Faragha inaelezea jinsi tunavyokusanya, kutumia, na kulinda taarifa zako unapotumia jukwaa letu la bima la kidijitali.' : 'Welcome to BimaKwik. We value your privacy and the protection of your personal data. This Privacy Policy explains how we collect, use, and safeguard your information when you use our digital insurance platform.' }}</p>

                        <h5 class="fw-bold mt-4 text-primary">2. {{ app()->getLocale() == 'sw' ? 'Taarifa Tunazokusanya' : 'Information We Collect' }}</h5>
                        <p>{{ app()->getLocale() == 'sw' ? 'Tunakusanya taarifa unazotupa moja kwa moja, ikijumuisha jina lako, anwani ya barua pepe, nambari ya simu, na maelezo yanayohusiana na sera zako za bima na madai.' : 'We collect information that you provide directly to us, including your name, email address, phone number, and details related to your insurance policies and claims.' }}</p>

                        <h5 class="fw-bold mt-4 text-primary">3. {{ app()->getLocale() == 'sw' ? 'Jinsi Tunavyotumia Taarifa Zako' : 'How We Use Your Information' }}</h5>
                        <p>{{ app()->getLocale() == 'sw' ? 'Taarifa zako zinatumika kusindika maombi yako ya bima, kusimamia sera zako, kushughulikia madai, na kukupa masasisho na mawasiliano ya uuzaji ikiwa umechagua.' : 'Your information is used to process your insurance applications, manage your policies, handle claims, and provide you with updates and marketing communications if you have opted in.' }}</p>

                        <h5 class="fw-bold mt-4 text-primary">4. {{ app()->getLocale() == 'sw' ? 'Usalama wa Data' : 'Data Security' }}</h5>
                        <p>{{ app()->getLocale() == 'sw' ? 'Tunatekeleza hatua madhubuti za kiufundi na kiutawala kulinda data yako dhidi ya ufikiaji usioidhinishwa, upotevu, au mabadiliko. Data yote inapitishwa kupitia miunganisho salama iliyosimbwa.' : 'We implement robust technical and organizational measures to protect your data against unauthorized access, loss, or alteration. All data is transmitted over secure encrypted connections.' }}</p>

                        <h5 class="fw-bold mt-4 text-primary">5. {{ app()->getLocale() == 'sw' ? 'Kushiriki na Wahusika Wengine' : 'Third-Party Sharing' }}</h5>
                        <p>{{ app()->getLocale() == 'sw' ? 'Hatuuzi data yako. Tunashiriki taarifa tu na washirika wa bima na mamlaka za udhibiti inapohitajika kutoa huduma zetu na kuzingatia sheria katika Jamhuri ya Muungano wa Tanzania.' : 'We do not sell your data. We only share information with insurance partners and regulatory authorities as necessary to provide our services and comply with the law in the United Republic of Tanzania.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
