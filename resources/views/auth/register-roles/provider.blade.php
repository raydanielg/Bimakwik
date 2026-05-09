@extends('layouts.auth')

@section('content')
<div class="auth-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 animate__animated animate__fadeInUp">
                    <div class="text-center mb-4">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                            <i class="bi bi-hospital text-warning fs-1"></i>
                        </div>
                        <h2 class="fw-bold">Service Provider Network</h2>
                        <p class="text-muted">Hospitals, Garages, and Pharmacies—Join our claims network.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role" value="service-provider">

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Provider Name (Facility Name)</label>
                            <input type="text" name="name" class="form-control rounded-pill px-4 @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="e.g. City Hospital or Quick Garage">
                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Admin Email</label>
                            <input type="email" name="email" class="form-control rounded-pill px-4 @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="admin@provider.com">
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

                        <div class="mb-4">
                            <p class="small text-muted mb-0">Note: You will be asked to select your category (Hospital, Garage, etc.) after logging in.</p>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill fw-bold shadow-sm">Join Network</button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="small text-muted mb-0">Provider login? <a href="{{ route('login') }}" class="text-warning fw-bold text-decoration-none">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
