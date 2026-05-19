@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 animate__animated animate__fadeInDown">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 d-none d-md-block" style="background: url('/serious-expert-expressing-support-colleague.jpg') center/cover;">
                            <div class="h-100 w-100 p-5 d-flex flex-column justify-content-end" style="background: linear-gradient(transparent, rgba(0, 74, 153, 0.9));">
                                <h2 class="text-white fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ app()->getLocale() == 'sw' ? 'Uko Tayari Kulinda Mustakabali Wako?' : 'Ready to secure your future?' }}</h2>
                                <p class="text-white-50">{{ app()->getLocale() == 'sw' ? 'Jaza fomu na wataalam wetu watakurudishia nukuu iliyobinafsishwa ndani ya masaa 24.' : 'Fill out the form and our experts will get back to you with a personalized quote within 24 hours.' }}</p>
                            </div>
                        </div>
                        <div class="col-md-7 p-5 bg-white">
                            <div class="mb-4">
                                <h3 class="fw-bold mb-2" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ __('site.request_quote_full') }}</h3>
                                <p class="text-secondary small">{{ app()->getLocale() == 'sw' ? 'Furahia urahisi wa bima ya kidijitali na BimaKwik.' : 'Experience the ease of digital insurance with BimaKwik.' }}</p>
                            </div>

                            <form action="{{ route('quote.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">{{ app()->getLocale() == 'sw' ? 'Jina Kamili' : 'Full Name' }}</label>
                                        <input type="text" name="name" class="form-control form-control-lg bg-light border-0 px-3" placeholder="{{ app()->getLocale() == 'sw' ? 'Jina Lako' : 'John Doe' }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">{{ __('site.email_address') }}</label>
                                        <input type="email" name="email" class="form-control form-control-lg bg-light border-0 px-3" placeholder="name@example.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">{{ app()->getLocale() == 'sw' ? 'Nambari ya Simu' : 'Phone Number' }}</label>
                                        <input type="tel" name="phone" class="form-control form-control-lg bg-light border-0 px-3" placeholder="+255 --- --- ---" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">{{ __('site.select_insurance_type') }}</label>
                                        <select name="insurance_type" class="form-select form-select-lg bg-light border-0 px-3" required>
                                            <option value="" selected disabled>{{ app()->getLocale() == 'sw' ? 'Chagua aina...' : 'Choose type...' }}</option>
                                            <option value="Motor">{{ __('site.motor_insurance') }}</option>
                                            <option value="Health">{{ __('site.health_insurance') }}</option>
                                            <option value="Life">{{ __('site.life_insurance') }}</option>
                                            <option value="Fire">{{ app()->getLocale() == 'sw' ? 'Bima ya Moto' : 'Fire Insurance' }}</option>
                                            <option value="Travel">{{ app()->getLocale() == 'sw' ? 'Bima ya Safari' : 'Travel Insurance' }}</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">{{ app()->getLocale() == 'sw' ? 'Ujumbe wa Ziada (Si Lazima)' : 'Additional Message (Optional)' }}</label>
                                        <textarea name="message" class="form-control bg-light border-0 px-3" rows="3" placeholder="{{ app()->getLocale() == 'sw' ? 'Tuambie zaidi kuhusu mahitaji yako...' : 'Tell us more about your needs...' }}"></textarea>
                                    </div>
                                    <div class="col-12 mt-4 text-end">
                                        <button type="submit" class="btn-quote-custom">
                                            <span>{{ __('site.request_quote_full') }}</span>
                                            <div class="icon-circle">
                                                <i class="bi bi-chevron-right"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
