@extends('layouts.auth')

@section('content')
<div class="auth-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card border-0 shadow-lg overflow-hidden rounded-4 animate__animated animate__fadeInUp">
                    <div class="row g-0">
                        <!-- Left Side: Registration Flow Info -->
                        <div class="col-lg-5 d-none d-lg-block bg-primary text-white p-5 position-relative">
                            <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background-image: url('{{ asset('logo.png') }}'); background-repeat: no-repeat; background-position: center; background-size: contain;"></div>
                            
                            <div class="position-relative z-index-1">
                                <h2 class="fw-bold mb-4">Registration Flow</h2>
                                <p class="mb-5 opacity-75">Join the Bima Kwik digital ecosystem in 3 simple steps.</p>

                                <div class="flow-steps">
                                    <div class="d-flex mb-4">
                                        <div class="step-num me-3 bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; flex-shrink: 0;">1</div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Select Your Role</h6>
                                            <p class="small opacity-75 mb-0">Choose whether you are a Customer, Broker, Insurer, or Partner.</p>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <div class="step-num me-3 bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; flex-shrink: 0;">2</div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Account Information</h6>
                                            <p class="small opacity-75 mb-0">Provide your basic details and secure your account with a password.</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="step-num me-3 bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; flex-shrink: 0;">3</div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Verify & Access</h6>
                                            <p class="small opacity-75 mb-0">Complete KYC (if required) and get instant access to your specialized dashboard.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 p-4 bg-white bg-opacity-10 rounded-4">
                                    <h6 class="fw-bold mb-2"><i class="bi bi-info-circle me-2"></i> Need Help?</h6>
                                    <p class="small mb-0 opacity-75 text-white">Contact our support team for assistance with corporate or partner registration.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Registration Form -->
                        <div class="col-lg-7 p-4 p-md-5 bg-white">
                            <div class="text-center mb-4">
                                <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" style="height: 50px;" class="mb-3">
                                <h3 class="fw-bold">Create Your Account</h3>
                                <p class="text-secondary small">Select your role and enter your details to get started.</p>
                            </div>

                            <form method="POST" action="{{ route('register') }}" id="registrationForm">
                                @csrf

                                <!-- Role Selection -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-uppercase letter-spacing-1">I am registering as a:</label>
                                    <div class="row g-2">
                                        <div class="col-6 col-md-4">
                                            <input type="radio" class="btn-check" name="role" id="role-customer" value="customer" checked>
                                            <label class="btn btn-outline-primary w-100 p-3 rounded-4 role-option shadow-none h-100 d-flex flex-column align-items-center justify-content-center" for="role-customer">
                                                <i class="bi bi-person-fill fs-3 mb-2"></i>
                                                <span class="small fw-bold">Customer</span>
                                            </label>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <input type="radio" class="btn-check" name="role" id="role-broker" value="broker">
                                            <label class="btn btn-outline-primary w-100 p-3 rounded-4 role-option shadow-none h-100 d-flex flex-column align-items-center justify-content-center" for="role-broker">
                                                <i class="bi bi-briefcase-fill fs-3 mb-2"></i>
                                                <span class="small fw-bold">Broker/Agent</span>
                                            </label>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <input type="radio" class="btn-check" name="role" id="role-insurer" value="insurer">
                                            <label class="btn btn-outline-primary w-100 p-3 rounded-4 role-option shadow-none h-100 d-flex flex-column align-items-center justify-content-center" for="role-insurer">
                                                <i class="bi bi-building-fill-check fs-3 mb-2"></i>
                                                <span class="small fw-bold">Insurer</span>
                                            </label>
                                        </div>
                                    </div>
                                    @error('role')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="name" class="form-label small fw-bold text-muted">Full Name / Entity Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-person text-primary"></i></span>
                                            <input id="name" type="text" class="form-control bg-light border-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="John Doe or Company Ltd">
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="email" class="form-label small fw-bold text-muted">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-primary"></i></span>
                                            <input id="email" type="email" class="form-control bg-light border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@example.com">
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label small fw-bold text-muted">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-lock text-primary"></i></span>
                                            <input id="password" type="password" class="form-control bg-light border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="password-confirm" class="form-label small fw-bold text-muted">Confirm</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-shield-lock text-primary"></i></span>
                                            <input id="password-confirm" type="password" class="form-control bg-light border-0" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="checkbox" name="terms" id="terms" required>
                                        <label class="form-check-label small text-muted" for="terms">
                                            I agree to the <a href="{{ route('legal.terms') }}" class="text-primary text-decoration-none fw-bold">Terms of Service</a> and <a href="{{ route('legal.privacy') }}" class="text-primary text-decoration-none fw-bold">Privacy Policy</a>.
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm transition-all hover-lift-sm">
                                    Create My Account <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </form>

                            <div class="text-center mt-4">
                                <p class="text-muted small">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Log in here</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .auth-page {
        min-height: 100vh;
        background: #f8f9fa;
        display: flex;
        align-items: center;
    }
    .letter-spacing-1 { letter-spacing: 0.5px; }
    .role-option {
        border-width: 2px;
        transition: all 0.3s ease;
    }
    .btn-check:checked + .role-option {
        background-color: rgba(13, 110, 253, 0.05);
        border-color: #0d6efd;
        color: #0d6efd;
        transform: scale(1.02);
        box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.1) !important;
    }
    .role-option:hover {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.02);
    }
    .input-group-text {
        border-top-left-radius: 12px !important;
        border-bottom-left-radius: 12px !important;
    }
    .form-control {
        border-top-right-radius: 12px !important;
        border-bottom-right-radius: 12px !important;
        padding: 0.75rem 1rem;
    }
    .hover-lift-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(13, 110, 253, 0.2) !important;
    }
    .transition-all { transition: all 0.3s ease; }
</style>
@endsection
