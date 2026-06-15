@extends('layouts.auth')

@section('content')
<style>
    /* Tailwind/Custom Button Classes mapping to plain CSS */
    .bg-brand { background-color: #10b981 !important; color: #ffffff !important; }
    .bg-brand:hover { background-color: #059669 !important; }
    
    .bg-neutral-secondary-medium { background-color: #e2e8f0 !important; color: #1e293b !important; }
    .bg-neutral-secondary-medium:hover { background-color: #cbd5e1 !important; color: #0f172a !important; }
    
    .bg-neutral-primary-soft { background-color: #f1f5f9 !important; color: #334155 !important; border-color: #cbd5e1 !important; }
    .bg-neutral-primary-soft:hover { background-color: #e2e8f0 !important; color: #0f172a !important; }
    
    .bg-success { background-color: #10b981 !important; color: #ffffff !important; }
    .bg-success:hover { background-color: #059669 !important; }
    
    .bg-danger { background-color: #ef4444 !important; color: #ffffff !important; }
    .bg-danger:hover { background-color: #dc2626 !important; }
    
    .bg-warning { background-color: #f59e0b !important; color: #ffffff !important; }
    .bg-warning:hover { background-color: #d97706 !important; }
    
    .bg-dark { background-color: #1e293b !important; color: #ffffff !important; }
    .bg-dark:hover { background-color: #0f172a !important; }
    
    .box-border { box-sizing: border-box; }
    .rounded-base { border-radius: 8px !important; }
    .shadow-xs { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important; }
    .leading-5 { line-height: 1.25rem !important; }
    
    /* Responsive sizing adjustment for the demo buttons */
    .demo-btn {
        padding: 6px 12px !important;
        font-size: 0.8rem !important;
        font-weight: 500 !important;
        border: 1px solid transparent;
        transition: all 0.2s ease-in-out;
    }

    /* Sweet alert demo toast */
    .demo-toast-popup {
        border-radius: 14px !important;
        border: 1px solid rgba(16,185,129,0.35) !important;
        box-shadow: 0 8px 32px rgba(16,185,129,0.18), 0 2px 12px rgba(0,0,0,0.35) !important;
        min-width: 320px !important;
        max-width: 480px !important;
    }
    .demo-toast-progress {
        background: linear-gradient(90deg, #10b981, #059669) !important;
        height: 3px !important;
    }
</style>

<div class="auth-page">
    <div class="auth-card animate__animated animate__fadeInDown" style="max-width: 550px;">
        <div class="auth-logo">
            <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" style="height: 64px; width: auto; filter: drop-shadow(0 0 8px rgba(16, 185, 129, 0.2));">
        </div>
        
        <h1 class="auth-title">Log in</h1>

        <!-- Demo Accounts Quick Login Section -->
        <div class="mb-4 p-3 bg-light rounded-3 border text-center">
            <div class="small text-muted fw-bold mb-2"><i class="bi bi-lightning-charge-fill text-warning me-1"></i>DEMO — Chagua Role</div>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <button type="button" class="text-white bg-brand box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('super-admin@bimakwik.com', this)">Super Admin</button>
                <button type="button" class="text-white bg-brand box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('admin@bimakwik.com', this)">Admin</button>
                <button type="button" class="text-white bg-brand box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('sub-admin@bimakwik.com', this)">Sub Admin</button>
                <button type="button" class="text-white bg-success box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('insurer@bimakwik.com', this)">Insurer</button>
                <button type="button" class="text-white bg-dark box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('broker@bimakwik.com', this)">Broker</button>
                <button type="button" class="text-white bg-dark box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('aggregator@bimakwik.com', this)">Aggregator</button>
                <button type="button" class="text-white bg-dark box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('agent@bimakwik.com', this)">Agent</button>
                <button type="button" class="text-white bg-warning box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('sfe@bimakwik.com', this)">SFE</button>
                <button type="button" class="text-white bg-warning box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('bancassurance@bimakwik.com', this)">Bancassurance</button>
                <button type="button" class="text-body bg-neutral-secondary-medium box-border border shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('customer@bimakwik.com', this)">Customer</button>
                <button type="button" class="text-white bg-success box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('service-provider@bimakwik.com', this)">Service Provider</button>
                <button type="button" class="text-white bg-danger box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('regulator@bimakwik.com', this)">Regulator</button>
                <button type="button" class="text-body bg-neutral-primary-soft border shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('financing-partner@bimakwik.com', this)">Financing Partner</button>
                <button type="button" class="text-white bg-dark box-border border border-transparent shadow-xs font-medium leading-5 rounded-base demo-btn focus:outline-none" onclick="fillCredentials('developer@bimakwik.com', this)">Developer</button>
            </div>
            <div id="demo-hint" class="mt-2 small text-success fw-semibold" style="display:none;">
                <i class="bi bi-check-circle-fill me-1"></i>Credentials zimejaza — bonyeza <strong>Log in</strong> kuendelea.
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="insurer@bimakwik.com">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-top-right-radius: 6px; border-bottom-right-radius: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn-auth-primary" id="loginSubmit">
                <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <span class="btn-text">Log in &rarr;</span>
            </button>
        </form>

        <script>
            document.getElementById('togglePassword').addEventListener('click', function (e) {
                const password = document.getElementById('password');
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
            });

            function fillCredentials(email, clickedBtn) {
                document.getElementById('email').value = email;
                document.getElementById('password').value = 'password';

                // Reset all demo buttons highlight, then highlight selected
                document.querySelectorAll('.demo-btn').forEach(function(b) {
                    b.style.outline = '';
                    b.style.boxShadow = '';
                });
                clickedBtn.style.outline = '2px solid #10b981';
                clickedBtn.style.boxShadow = '0 0 0 3px rgba(16,185,129,0.3)';

                // Show hint message
                document.getElementById('demo-hint').style.display = 'block';

                // Sweet alert toast - top banner
                const roleName = clickedBtn.textContent.trim();
                Swal.fire({
                    toast: true,
                    position: 'top',
                    icon: 'success',
                    html: `<span style="font-size:0.95rem;"><strong>${roleName}</strong> — credentials zimejaza! Bonyeza <strong>Log in</strong> kuendelea.</span>`,
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                    background: 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)',
                    color: '#f1f5f9',
                    iconColor: '#10b981',
                    padding: '0.75rem 1.25rem',
                    customClass: {
                        popup: 'demo-toast-popup',
                        timerProgressBar: 'demo-toast-progress',
                    },
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });

                // Scroll login button into view
                document.getElementById('loginSubmit').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            document.getElementById('loginForm').addEventListener('submit', function(e) {
                const btn = document.getElementById('loginSubmit');
                btn.classList.add('loading');
            });
        </script>

        @if($errors->any())
        <script>
            const firstError = @json($errors->first());
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: firstError || 'Invalid email or password',
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'Try Again'
            });
        </script>
        @endif

        <div class="auth-divider">
            <span>or</span>
        </div>

        <button type="button" class="btn-auth-social">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
            Continue with Google
        </button>

        <div class="auth-footer">
            Don't have an account? <a href="{{ route('register') }}">Sign up</a>
        </div>
    </div>
</div>
@endsection
