@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 text-center py-4 bg-white rounded-4 shadow-sm mb-4">
            <h4 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Msaada & Huduma kwa Wateja' : 'Help & Customer Support' }}</h4>
            <p class="text-muted">{{ app()->getLocale() == 'sw' ? 'Tuko hapa kukusaidia saa 24 kwa siku.' : 'We are here to help you 24/7.' }}</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Contact Methods -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4 text-center hover-lift">
                <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                    <i class="bi bi-chat-dots text-success fs-1"></i>
                </div>
                <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Gumzo Mubashara' : 'Live Chat' }}</h5>
                <p class="small text-muted mb-4">{{ app()->getLocale() == 'sw' ? 'Zungumza na mtoa huduma wetu sasa hivi.' : 'Chat with our support agent right now.' }}</p>
                <button class="btn btn-success w-100 rounded-pill">{{ app()->getLocale() == 'sw' ? 'Anza Gumzo' : 'Start Chat' }}</button>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4 text-center hover-lift">
                <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                    <i class="bi bi-telephone text-primary fs-1"></i>
                </div>
                <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Tupigie Simu' : 'Call Support' }}</h5>
                <p class="small text-muted mb-4">{{ app()->getLocale() == 'sw' ? 'Piga simu bila malipo kwa maswali ya haraka.' : 'Call our toll-free line for urgent inquiries.' }}</p>
                <a href="tel:+255762883065" class="btn btn-primary w-100 rounded-pill">+255 762 883 065</a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4 text-center hover-lift">
                <div class="bg-info bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                    <i class="bi bi-envelope text-info fs-1"></i>
                </div>
                <h5 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Barua Pepe' : 'Email Support' }}</h5>
                <p class="small text-muted mb-4">{{ app()->getLocale() == 'sw' ? 'Tutakujibu ndani ya saa 2.' : 'We will respond within 2 hours.' }}</p>
                <a href="mailto:info@bimakwik.com" class="btn btn-info text-white w-100 rounded-pill">info@bimakwik.com</a>
            </div>
        </div>

        <!-- FAQ & Support Ticket -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-2">{{ app()->getLocale() == 'sw' ? 'Fungua Tiketi ya Msaada' : 'Open a Support Ticket' }}</h5>
                    <form action="#" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">{{ app()->getLocale() == 'sw' ? 'Mada' : 'Subject' }}</label>
                                <input type="text" class="form-control rounded-3" placeholder="{{ app()->getLocale() == 'sw' ? 'Mf: Shida ya malipo' : 'e.g. Payment issue' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">{{ app()->getLocale() == 'sw' ? 'Aina ya Tatizo' : 'Issue Category' }}</label>
                                <select class="form-select rounded-3">
                                    <option value="billing">{{ app()->getLocale() == 'sw' ? 'Malipo / Wallet' : 'Billing / Wallet' }}</option>
                                    <option value="policy">{{ app()->getLocale() == 'sw' ? 'Masuala ya Bima' : 'Policy Issues' }}</option>
                                    <option value="claims">{{ app()->getLocale() == 'sw' ? 'Madai' : 'Claims' }}</option>
                                    <option value="technical">{{ app()->getLocale() == 'sw' ? 'Ufundi / Programu' : 'Technical / App' }}</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">{{ app()->getLocale() == 'sw' ? 'Maelezo' : 'Message' }}</label>
                                <textarea class="form-control rounded-3" rows="5" placeholder="{{ app()->getLocale() == 'sw' ? 'Elezea kwa kina tatizo lako...' : 'Describe your issue in detail...' }}"></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill">{{ app()->getLocale() == 'sw' ? 'Tuma Tiketi' : 'Submit Ticket' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Knowledge Base -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">{{ app()->getLocale() == 'sw' ? 'Maswali ya Kawaida' : 'Popular FAQs' }}</h5>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action px-0 py-3 bg-transparent">
                            <h6 class="fw-bold small mb-1">{{ app()->getLocale() == 'sw' ? 'Jinsi ya kuongeza pesa kwenye wallet?' : 'How to add funds to my wallet?' }}</h6>
                            <i class="bi bi-chevron-right float-end small mt-1"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action px-0 py-3 bg-transparent">
                            <h6 class="fw-bold small mb-1">{{ app()->getLocale() == 'sw' ? 'Vigezo vya kulipwa madai ni vipi?' : 'What are the claim requirements?' }}</h6>
                            <i class="bi bi-chevron-right float-end small mt-1"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action px-0 py-3 bg-transparent border-0">
                            <h6 class="fw-bold small mb-1">{{ app()->getLocale() == 'sw' ? 'Jinsi ya kupakua hati ya bima?' : 'How to download my certificate?' }}</h6>
                            <i class="bi bi-chevron-right float-end small mt-1"></i>
                        </a>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('support.faqs') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">{{ app()->getLocale() == 'sw' ? 'Angalia Zote' : 'View All' }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
