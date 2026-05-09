@extends('layouts.auth')

@section('content')
<div class="auth-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10">
                <div class="card border-0 shadow-lg overflow-hidden rounded-4 animate__animated animate__fadeInUp">
                    <div class="row g-0">
                        <!-- Column 1: Role Selection -->
                        <div class="col-lg-6 p-4 p-md-5 bg-white border-end">
                            <div class="mb-4">
                                <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" style="height: 50px;" class="mb-3">
                                <h3 class="fw-bold text-dark">Join Bima Kwik</h3>
                                <p class="text-secondary">Select your account type to see the registration process.</p>
                            </div>

                            <div class="role-selector">
                                <div class="role-item mb-3">
                                    <input type="radio" class="btn-check" name="role_select" id="role-customer" value="customer" checked onchange="updateSteps('customer')">
                                    <label class="btn btn-outline-primary w-100 p-4 rounded-4 text-start d-flex align-items-center role-card" for="role-customer">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 icon-box">
                                            <i class="bi bi-person-fill fs-3"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Individual Customer</h6>
                                            <p class="small mb-0 opacity-75">Buy bima, track claims, and manage policies.</p>
                                        </div>
                                    </label>
                                </div>

                                <div class="role-item mb-3">
                                    <input type="radio" class="btn-check" name="role_select" id="role-broker" value="broker" onchange="updateSteps('broker')">
                                    <label class="btn btn-outline-primary w-100 p-4 rounded-4 text-start d-flex align-items-center role-card" for="role-broker">
                                        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3 icon-box">
                                            <i class="bi bi-briefcase-fill fs-3 text-info"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-info">Broker / Agent</h6>
                                            <p class="small mb-0 opacity-75 text-dark">Sell insurance and earn commissions.</p>
                                        </div>
                                    </label>
                                </div>

                                <div class="role-item mb-3">
                                    <input type="radio" class="btn-check" name="role_select" id="role-insurer" value="insurer" onchange="updateSteps('insurer')">
                                    <label class="btn btn-outline-primary w-100 p-4 rounded-4 text-start d-flex align-items-center role-card" for="role-insurer">
                                        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3 icon-box">
                                            <i class="bi bi-building-fill-check fs-3 text-success"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-success">Insurance Company</h6>
                                            <p class="small mb-0 opacity-75 text-dark">Digitalize products and reach more customers.</p>
                                        </div>
                                    </label>
                                </div>

                                <div class="role-item">
                                    <input type="radio" class="btn-check" name="role_select" id="role-provider" value="provider" onchange="updateSteps('provider')">
                                    <label class="btn btn-outline-primary w-100 p-4 rounded-4 text-start d-flex align-items-center role-card" for="role-provider">
                                        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3 icon-box">
                                            <i class="bi bi-hospital fs-3 text-warning"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-warning">Service Provider</h6>
                                            <p class="small mb-0 opacity-75 text-dark">Hospitals, Garages, and Pharmacies network.</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Registration Steps -->
                        <div class="col-lg-6 p-4 p-md-5 bg-light d-flex flex-column justify-content-between">
                            <div id="steps-container" class="animate__animated animate__fadeIn">
                                <h5 class="fw-bold mb-4 text-uppercase small letter-spacing-1 text-primary">Registration Process</h5>
                                
                                <div id="role-steps">
                                    <!-- Steps will be injected here by JS -->
                                </div>
                            </div>

                            <div class="mt-5">
                                <a href="#" id="continue-btn" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm transition-all hover-lift-sm">
                                    Continue to Registration <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                                <p class="text-center mt-3 small text-muted">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Log in</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const stepsData = {
        customer: {
            url: "{{ route('register.customer') }}",
            steps: [
                { title: "Basic Info", desc: "Provide your name and contact details." },
                { title: "Secure Account", desc: "Create a strong password for your dashboard." },
                { title: "Start Buying", desc: "Instant access to all insurance products." }
            ]
        },
        broker: {
            url: "{{ route('register.broker') }}",
            steps: [
                { title: "Agency Details", desc: "Register your legal agency or broker name." },
                { title: "TIRA Compliance", desc: "Prepare your TIRA license for verification." },
                { title: "Portal Setup", desc: "Get tools to manage your clients and commissions." }
            ]
        },
        insurer: {
            url: "{{ route('register.insurer') }}",
            steps: [
                { title: "Partnership Request", desc: "Provide corporate entity details." },
                { title: "Integration", desc: "Our team will contact you for TIRAMIS setup." },
                { title: "Go Live", desc: "Launch your products to the digital market." }
            ]
        },
        provider: {
            url: "{{ route('register.provider') }}",
            steps: [
                { title: "Facility Info", desc: "Register your Hospital, Garage, or Pharmacy." },
                { title: "Category Selection", desc: "Choose your specialty in our network." },
                { title: "Claims Network", desc: "Start receiving and processing digital claims." }
            ]
        }
    };

    function updateSteps(role) {
        const container = document.getElementById('role-steps');
        const continueBtn = document.getElementById('continue-btn');
        const data = stepsData[role];
        
        // Update Steps HTML
        let html = '';
        data.steps.forEach((step, index) => {
            html += `
                <div class="d-flex mb-4 animate__animated animate__fadeInRight" style="animation-delay: ${index * 0.1}s">
                    <div class="step-num me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; flex-shrink: 0;">${index + 1}</div>
                    <div>
                        <h6 class="fw-bold mb-1">${step.title}</h6>
                        <p class="small text-muted mb-0">${step.desc}</p>
                    </div>
                </div>
            `;
        });
        
        container.innerHTML = html;
        continueBtn.href = data.url;
    }

    // Initialize with default
    document.addEventListener('DOMContentLoaded', () => {
        updateSteps('customer');
    });
</script>

<style>
    .auth-page { min-height: 100vh; background: #f0f2f5; display: flex; align-items: center; }
    .letter-spacing-1 { letter-spacing: 1.5px; }
    .role-card { 
        border: 2px solid #e9ecef; 
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1); 
        background: #fff;
    }
    .role-card:hover { border-color: #0d6efd; background: rgba(13, 110, 253, 0.02); }
    .btn-check:checked + .role-card { 
        border-color: #0d6efd; 
        background-color: rgba(13, 110, 253, 0.05);
        transform: scale(1.02);
        box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.1) !important;
    }
    .icon-box { transition: transform 0.3s ease; }
    .role-card:hover .icon-box { transform: scale(1.1) rotate(5deg); }
    .hover-lift-sm:hover { transform: translateY(-2px); box-shadow: 0 0.5rem 1.5rem rgba(13, 110, 253, 0.2) !important; }
    .transition-all { transition: all 0.3s ease; }
</style>
@endsection
