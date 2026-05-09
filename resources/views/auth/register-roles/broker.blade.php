@extends('layouts.auth')

@section('content')
<div class="auth-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 animate__animated animate__fadeInUp">
                    <div class="text-center mb-4">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                            <i class="bi bi-briefcase text-info fs-1"></i>
                        </div>
                        <h2 class="fw-bold">Broker & Agent Portal</h2>
                        <p class="text-muted">Register as an intermediary and start growing your business.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role" value="broker">

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Agency/Broker Name</label>
                            <input type="text" name="name" class="form-control rounded-pill px-4 @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Legal Agency Name">
                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Professional Email</label>
                            <input type="email" name="email" class="form-control rounded-pill px-4 @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="business@agency.com">
                            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Password</label>
                                <input type="password" name="password" class="form-control rounded-pill px-4" required placeholder="••••••••">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Confirm</label>
                                <input type="password" name="password_confirmation" class="form-control rounded-pill px-4" required placeholder="••••••••">
                            </div>
                        </div>

                        <div class="alert alert-info border-0 rounded-4 small py-2 mb-4">
                            <i class="bi bi-info-circle me-2"></i> After registration, you will need to upload your TIRA license for verification.
                        </div>

                        <button type="submit" class="btn btn-info text-white w-100 py-3 rounded-pill fw-bold shadow-sm">Submit Application</button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="small text-muted mb-0">Partner login? <a href="{{ route('login') }}" class="text-info fw-bold text-decoration-none">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
