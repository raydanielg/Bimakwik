@extends('layouts.auth')

@section('content')
<div class="auth-page">
    <div class="auth-card animate__animated animate__fadeInDown">
        <div class="auth-logo">
            <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" style="height: 64px; width: auto; filter: drop-shadow(0 0 8px rgba(16, 185, 129, 0.2));">
        </div>
        
        <h1 class="auth-title">Log in</h1>

        <!-- Demo Accounts Quick Login Section -->
        <div class="mb-4 p-3 bg-light rounded-3 border text-center">
            <div class="small text-muted fw-bold mb-2"><i class="bi bi-lightning-charge-fill text-warning me-1"></i>DEMO QUICK LOGIN</div>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <button type="button" class="btn btn-sm btn-outline-primary px-3 py-1" onclick="quickLogin('super-admin@bimakwik.com')">Super Admin</button>
                <button type="button" class="btn btn-sm btn-outline-primary px-3 py-1" onclick="quickLogin('admin@bimakwik.com')">Admin</button>
                <button type="button" class="btn btn-sm btn-outline-success px-3 py-1" onclick="quickLogin('insurer@bimakwik.com')">Insurer</button>
                <button type="button" class="btn btn-sm btn-outline-info px-3 py-1" onclick="quickLogin('broker@bimakwik.com')">Broker</button>
                <button type="button" class="btn btn-sm btn-outline-warning text-dark px-3 py-1" onclick="quickLogin('bancassurance@bimakwik.com')">Bancassurance</button>
                <button type="button" class="btn btn-sm btn-outline-secondary px-3 py-1" onclick="quickLogin('customer@bimakwik.com')">Customer</button>
                <button type="button" class="btn btn-sm btn-outline-dark px-3 py-1" onclick="quickLogin('developer@bimakwik.com')">Developer</button>
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

            function quickLogin(email) {
                document.getElementById('email').value = email;
                document.getElementById('password').value = 'password';
                
                // Trigger submit loading state & submit form
                const btn = document.getElementById('loginSubmit');
                btn.classList.add('loading');
                
                setTimeout(() => {
                    document.getElementById('loginForm').submit();
                }, 300);
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
