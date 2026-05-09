@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 translate-middle bg-primary opacity-5 rounded-circle" style="width: 400px; height: 400px;"></div>
    
    <div class="container py-5 mt-5 position-relative">
        <nav aria-label="breadcrumb" class="mb-4 animate__animated animate__fadeInDown">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-primary">Home</a></li>
                <li class="breadcrumb-item active fw-bold" aria-current="page">Cookies Policy</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 animate__animated animate__fadeInUp">
                    <div class="text-center mb-5">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-flex mb-4">
                            <i class="bi bi-cookie text-primary fs-1"></i>
                        </div>
                        <h1 class="display-5 fw-bold">Cookies Policy</h1>
                        <p class="text-secondary">Last updated: May 9, 2026</p>
                    </div>

                    <div class="content text-secondary">
                        <h4 class="fw-bold text-dark mb-4">1. What are Cookies?</h4>
                        <p>Cookies are small text files that are stored on your computer or mobile device when you visit our website. They help us provide you with a better experience by remembering your preferences and helping us understand how you use our site.</p>

                        <h4 class="fw-bold text-dark mt-5 mb-4">2. How We Use Cookies</h4>
                        <p>We use cookies for several reasons, including:</p>
                        <ul class="mb-4">
                            <li><strong>Essential Cookies:</strong> Necessary for the website to function correctly (e.g., login, security).</li>
                            <li><strong>Analytics Cookies:</strong> Help us understand how visitors interact with the site by collecting anonymous data.</li>
                            <li><strong>Preference Cookies:</strong> Remember choices you've made (e.g., language, font size).</li>
                            <li><strong>Marketing Cookies:</strong> Used to track visitors across websites to deliver relevant ads.</li>
                        </ul>

                        <h4 class="fw-bold text-dark mt-5 mb-4">3. Managing Your Preferences</h4>
                        <p>You have the right to decide whether to accept or reject cookies. You can set or amend your web browser controls to accept or refuse cookies. If you choose to reject cookies, you may still use our website, though your access to some functionality and areas of our website may be restricted.</p>

                        <div class="alert alert-primary border-0 rounded-4 p-4 mt-5">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-info-circle-fill fs-3 me-3"></i>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-2">Consent Status</h5>
                                    <p class="mb-0" id="current-status">Checking your preferences...</p>
                                </div>
                                <div class="ms-auto">
                                    <button class="btn btn-primary btn-sm rounded-pill px-4 me-2" onclick="acceptCookies()">Accept All</button>
                                    <button class="btn btn-outline-primary btn-sm rounded-pill px-4" onclick="declineCookies()">Reject Non-Essential</button>
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
