@extends('layouts.auth')

@section('content')
<div class="auth-page py-5 position-relative overflow-hidden">
    <!-- Decorative Background -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%); z-index: 0;"></div>
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 1440 320\"><path fill=\"rgba(255,255,255,0.1)\" fill-opacity=\"1\" d=\"M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z\"></path></svg>') no-repeat bottom; background-size: cover; z-index: 0;"></div>
    
    <!-- Floating Shapes -->
    <div class="position-absolute top-20 start-10 bg-white opacity-10 rounded-circle" style="width: 300px; height: 300px; transform: translate(-50%, -50%); z-index: 0;"></div>
    <div class="position-absolute bottom-20 end-10 bg-white opacity-10 rounded-circle" style="width: 200px; height: 200px; transform: translate(50%, 50%); z-index: 0;"></div>
    <div class="position-absolute top-1/2 start-1/2 bg-white opacity-5 rounded-circle" style="width: 400px; height: 400px; transform: translate(-50%, -50%); z-index: 0;"></div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10">
                <div class="card border-0 shadow-2xl overflow-hidden rounded-5 animate__animated animate__fadeInUp" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                    <div class="row g-0">
                        <!-- Column 1: Role Selection -->
                        <div class="col-lg-6 p-5 p-md-6 bg-white">
                            <div class="mb-5">
                                <div class="d-flex align-items-center mb-4">
                                    <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" style="height: 60px;" class="me-3">
                                    <div>
                                        <h3 class="fw-bold text-dark mb-0">Join Bima Kwik</h3>
                                        <p class="text-secondary small mb-0">Select your account type to get started</p>
                                    </div>
                                </div>
                            </div>

                            <div class="role-selector">
                                <div class="role-item mb-4">
                                    <input type="radio" class="btn-check" name="role_select" id="role-customer" value="customer" checked onchange="updateSteps('customer')">
                                    <label class="btn w-100 p-4 rounded-4 text-start d-flex align-items-center role-card" for="role-customer">
                                        <div class="position-relative me-4">
                                            <div class="avatar-box rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                <i class="bi bi-person-fill fs-1 text-white"></i>
                                            </div>
                                            <div class="position-absolute bottom-0 end-0 bg-white rounded-circle shadow d-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">
                                                <i class="bi bi-check-circle-fill text-success" style="font-size: 1rem;"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-dark">Individual Customer</h6>
                                            <p class="small mb-0 opacity-75">Personalized insurance dashboard for you</p>
                                        </div>
                                    </label>
                                </div>

                                <div class="role-item mb-4">
                                    <input type="radio" class="btn-check" name="role_select" id="role-broker" value="broker" onchange="updateSteps('broker')">
                                    <label class="btn w-100 p-4 rounded-4 text-start d-flex align-items-center role-card" for="role-broker">
                                        <div class="position-relative me-4">
                                            <div class="avatar-box rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 80px; height: 80px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                                <i class="bi bi-briefcase-fill fs-1 text-white"></i>
                                            </div>
                                            <div class="position-absolute bottom-0 end-0 bg-white rounded-circle shadow d-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">
                                                <i class="bi bi-star-fill text-warning" style="font-size: 1rem;"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-dark">Broker / Agent</h6>
                                            <p class="small mb-0 opacity-75">Grow your agency with digital tools</p>
                                        </div>
                                    </label>
                                </div>

                                <div class="role-item mb-4">
                                    <input type="radio" class="btn-check" name="role_select" id="role-insurer" value="insurer" onchange="updateSteps('insurer')">
                                    <label class="btn w-100 p-4 rounded-4 text-start d-flex align-items-center role-card" for="role-insurer">
                                        <div class="position-relative me-4">
                                            <div class="avatar-box rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 80px; height: 80px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                                <i class="bi bi-building-fill fs-1 text-white"></i>
                                            </div>
                                            <div class="position-absolute bottom-0 end-0 bg-white rounded-circle shadow d-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">
                                                <i class="bi bi-shield-fill-check text-primary" style="font-size: 1rem;"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-dark">Insurance Company</h6>
                                            <p class="small mb-0 opacity-75">Scale your digital products across Africa</p>
                                        </div>
                                    </label>
                                </div>

                                <div class="role-item">
                                    <input type="radio" class="btn-check" name="role_select" id="role-provider" value="provider" onchange="updateSteps('provider')">
                                    <label class="btn w-100 p-4 rounded-4 text-start d-flex align-items-center role-card" for="role-provider">
                                        <div class="position-relative me-4">
                                            <div class="avatar-box rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 80px; height: 80px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                                                <i class="bi bi-hospital-fill fs-1 text-white"></i>
                                            </div>
                                            <div class="position-absolute bottom-0 end-0 bg-white rounded-circle shadow d-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">
                                                <i class="bi bi-plus-circle-fill text-danger" style="font-size: 1rem;"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-dark">Service Provider</h6>
                                            <p class="small mb-0 opacity-75">Hospitals, Garages & Pharmacies network</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Registration Steps -->
                        <div class="col-lg-6 p-5 p-md-6 d-flex flex-column justify-content-between" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
                            <div id="steps-container" class="animate__animated animate__fadeIn">
                                <h5 class="fw-bold mb-4 text-uppercase small letter-spacing-1" style="color: #667eea;">Registration Process</h5>
                                
                                <div id="role-steps">
                                    <!-- Steps will be injected here by JS -->
                                </div>
                            </div>

                            <div class="mt-5">
                                <a href="#" id="continue-btn" class="btn w-100 py-3 rounded-pill fw-bold shadow-lg transition-all hover-lift-sm text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    Continue to Registration <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                                <p class="text-center mt-3 small text-muted">Already have an account? <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color: #667eea;">Log in</a></p>
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
