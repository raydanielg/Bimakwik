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

<!-- Live Chat Modal -->
<div class="modal fade" id="liveChatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="bi bi-chat-dots text-success me-2"></i>Live Chat Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex align-items-center gap-3 mb-4 p-3 bg-success bg-opacity-10 rounded-3">
                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                        <i class="bi bi-headset text-white"></i>
                    </div>
                    <div>
                        <div class="fw-bold small">Support Team</div>
                        <div class="x-small text-success"><i class="bi bi-circle-fill" style="font-size:.5rem;"></i> Online — avg reply 2 min</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Your Name</label>
                    <input type="text" class="form-control rounded-3" id="chatName" value="{{ auth()->user()->name }}">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">How can we help you?</label>
                    <textarea class="form-control rounded-3" id="chatMessage" rows="3" placeholder="Describe your issue briefly..."></textarea>
                </div>
                <div class="alert alert-info small mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    A support agent will connect with you via WhatsApp or phone call within 2 minutes.
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success rounded-pill px-4" id="startChatBtn"
                    onclick="startChatSession()">
                    <i class="bi bi-send me-2"></i>Start Chat
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function startChatSession() {
    const name    = document.getElementById('chatName').value.trim();
    const message = document.getElementById('chatMessage').value.trim();
    if (!message) { bkToast('Please describe your issue first.', 'warning'); return; }
    btnLoad('#startChatBtn', 'Connecting...');
    setTimeout(() => {
        bootstrap.Modal.getInstance(document.getElementById('liveChatModal')).hide();
        bkToast('Chat request sent! An agent will contact you shortly.', 'success', 5000);
    }, 1500);
}
</script>
@endpush
@endsection
