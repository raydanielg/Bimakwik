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
                                <h2 class="text-white fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ __('site.quote_ready_title') }}</h2>
                                <p class="text-white-50">{{ __('site.quote_ready_subtitle') }}</p>
                            </div>
                        </div>
                        <div class="col-md-7 p-5 bg-white">
                            <div class="mb-4">
                                <h3 class="fw-bold mb-2" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ __('site.request_quote_full') }}</h3>
                                <p class="text-secondary small">{{ __('site.quote_experience_text') }}</p>
                            </div>

                            <form action="{{ route('quote.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">{{ __('site.full_name') }}</label>
                                        <input type="text" name="name" class="form-control form-control-lg bg-light border-0 px-3" placeholder="{{ __('site.full_name_placeholder') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">{{ __('site.email_address') }}</label>
                                        <input type="email" name="email" class="form-control form-control-lg bg-light border-0 px-3" placeholder="name@example.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">{{ __('site.phone_number') }}</label>
                                        <input type="tel" name="phone" class="form-control form-control-lg bg-light border-0 px-3" placeholder="+255 --- --- ---" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">{{ __('site.select_insurance_type') }}</label>
                                        <select name="insurance_type" class="form-select form-select-lg bg-light border-0 px-3" required>
                                            <option value="" selected disabled>{{ __('site.choose_type') }}</option>
                                            <option value="Motor">{{ __('site.motor_insurance') }}</option>
                                            <option value="Health">{{ __('site.health_insurance') }}</option>
                                            <option value="Life">{{ __('site.life_insurance') }}</option>
                                            <option value="Fire">{{ __('site.fire_insurance') }}</option>
                                            <option value="Travel">{{ __('site.travel_insurance') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">{{ __('site.additional_message_optional') }}</label>
                                        <textarea name="message" class="form-control bg-light border-0 px-3" rows="3" placeholder="{{ __('site.additional_message_placeholder') }}"></textarea>
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
