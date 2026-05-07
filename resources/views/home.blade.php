@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-6 animate__animated animate__fadeInLeft">
                            <h6 class="text-primary fw-bold text-uppercase mb-3">Welcome Back</h6>
                            <h1 class="display-5 fw-bold mb-4">Hello, {{ Auth::user()->name }}!</h1>
                            <p class="lead text-secondary mb-4">You have successfully logged into the {{ config('app.name', 'BimaKwik') }} system. Start managing your insurance policies easily.</p>
                            <div class="d-grid d-md-flex gap-2">
                                <a href="#" class="btn btn-primary btn-lg px-4 rounded-pill text-white">View My Policies</a>
                                <a href="#" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">My Profile</a>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-block animate__animated animate__fadeInRight text-center">
                            <img src="{{ asset('logo.png') }}" alt="Dashboard" class="img-fluid" style="max-height: 250px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-3 hover-lift">
                        <div class="card-body">
                            <div class="icon-shape bg-primary-soft text-primary rounded-3 mb-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: rgba(13, 110, 253, 0.1);">
                                <i class="bi bi-shield-check fs-4"></i>
                            </div>
                            <h5 class="fw-bold">Active Policies</h5>
                            <p class="text-secondary small">Manage all your active insurance policies here.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-3 hover-lift">
                        <div class="card-body">
                            <div class="icon-shape bg-success-soft text-success rounded-3 mb-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: rgba(25, 135, 84, 0.1);">
                                <i class="bi bi-plus-circle fs-4"></i>
                            </div>
                            <h5 class="fw-bold">Apply for New Policy</h5>
                            <p class="text-secondary small">Get a new policy easily and quickly digital.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-3 hover-lift">
                        <div class="card-body">
                            <div class="icon-shape bg-warning-soft text-warning rounded-3 mb-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: rgba(255, 193, 7, 0.1);">
                                <i class="bi bi-clock-history fs-4"></i>
                            </div>
                            <h5 class="fw-bold">History</h5>
                            <p class="text-secondary small">View all your past payments and claims history.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-lift { transition: transform 0.2s ease-in-out; }
    .hover-lift:hover { transform: translateY(-5px); }
</style>
@endsection
