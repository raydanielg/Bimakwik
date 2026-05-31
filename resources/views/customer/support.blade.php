@extends('layouts.dashboard')

@section('content')
@php
    $tickets = isset($tickets) ? $tickets : collect();
@endphp
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 text-center py-4 bg-white rounded-4 shadow-sm mb-4">
            <h4 class="fw-bold">{{ __('customer.support_title') }}</h4>
            <p class="text-muted">{{ __('customer.support_subtitle') }}</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Contact Methods -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4 text-center hover-lift">
                <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                    <i class="bi bi-chat-dots text-success fs-1"></i>
                </div>
                <h5 class="fw-bold">{{ __('customer.live_chat') }}</h5>
                <p class="small text-muted mb-4">{{ __('customer.chat_agent_now') }}</p>
                <button class="btn btn-success w-100 rounded-pill" data-bs-toggle="modal" data-bs-target="#liveChatModal">
                    <i class="bi bi-chat-dots me-2"></i>Start Live Chat
                </button>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4 text-center hover-lift">
                <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                    <i class="bi bi-telephone text-primary fs-1"></i>
                </div>
                <h5 class="fw-bold">{{ __('customer.call_support') }}</h5>
                <p class="small text-muted mb-4">{{ __('customer.toll_free_text') }}</p>
                <a href="tel:+255762883065" class="btn btn-primary w-100 rounded-pill">+255 762 883 065</a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4 text-center hover-lift">
                <div class="bg-info bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                    <i class="bi bi-envelope text-info fs-1"></i>
                </div>
                <h5 class="fw-bold">{{ __('customer.email_support') }}</h5>
                <p class="small text-muted mb-4">{{ __('customer.response_within_2h') }}</p>
                <a href="mailto:info@bimakwik.com" class="btn btn-info text-white w-100 rounded-pill">info@bimakwik.com</a>
            </div>
        </div>

        <!-- FAQ & Support Ticket -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-2">{{ __('customer.open_support_ticket') }}</h5>
                    <form action="{{ route('customer.support.store') }}" method="POST"
                          data-ajax="true"
                          data-success-msg="Ticket submitted! Our team will respond within 2 hours.">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Subject</label>
                                <input type="text" name="subject" class="form-control rounded-3" placeholder="Brief description of your issue" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Issue Category</label>
                                <select name="category" class="form-select rounded-3" required>
                                    <option value="billing">Billing & Wallet</option>
                                    <option value="policy">Policy Issues</option>
                                    <option value="claims">Claim Issues</option>
                                    <option value="technical">Technical / App</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Message</label>
                                <textarea name="message" class="form-control rounded-3" rows="5" placeholder="Describe your issue in detail..." required></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill">
                                <i class="bi bi-send me-2"></i>Submit Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Knowledge Base -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">{{ __('customer.popular_faqs') }}</h5>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action px-0 py-3 bg-transparent">
                            <h6 class="fw-bold small mb-1">{{ __('customer.faq_add_wallet') }}</h6>
                            <i class="bi bi-chevron-right float-end small mt-1"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action px-0 py-3 bg-transparent">
                            <h6 class="fw-bold small mb-1">{{ __('customer.faq_claim_requirements') }}</h6>
                            <i class="bi bi-chevron-right float-end small mt-1"></i>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action px-0 py-3 bg-transparent border-0">
                            <h6 class="fw-bold small mb-1">{{ __('customer.faq_download_certificate') }}</h6>
                            <i class="bi bi-chevron-right float-end small mt-1"></i>
                        </a>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('support.faqs') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">{{ __('customer.view_all') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
