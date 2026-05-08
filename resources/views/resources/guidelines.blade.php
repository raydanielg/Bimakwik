@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white">
    <div class="container py-5 mt-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <span class="badge rounded-pill bg-success-soft text-success px-3 py-2 mb-3">RESOURCES</span>
            <h1 class="display-4 fw-bold">Guidelines & Materials</h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Everything you need to know about our processes and insurance policies.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 p-5 h-100 hover-lift border-start border-primary border-5">
                    <h3 class="fw-bold mb-4 text-primary">Guidelines</h3>
                    <ul class="list-unstyled">
                        <li class="mb-4 d-flex gap-3">
                            <div class="icon-circle bg-primary text-white"><i class="bi bi-file-earmark-text"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Claim Process Guide</h6>
                                <p class="text-secondary small mb-0">Step-by-step instructions on how to file and track your claims.</p>
                            </div>
                        </li>
                        <li class="mb-4 d-flex gap-3">
                            <div class="icon-circle bg-primary text-white"><i class="bi bi-shield-check"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Policy Management</h6>
                                <p class="text-secondary small mb-0">Understand how to manage, renew, and update your policies.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 p-5 h-100 hover-lift border-start border-success border-5">
                    <h3 class="fw-bold mb-4 text-success">Materials</h3>
                    <ul class="list-unstyled">
                        <li class="mb-4 d-flex gap-3">
                            <div class="icon-circle bg-success text-white"><i class="bi bi-download"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Brochures & Forms</h6>
                                <p class="text-secondary small mb-0">Download our latest product brochures and application forms.</p>
                            </div>
                        </li>
                        <li class="mb-4 d-flex gap-3">
                            <div class="icon-circle bg-success text-white"><i class="bi bi-file-pdf"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Terms & Conditions</h6>
                                <p class="text-secondary small mb-0">Access detailed T&C documents for all insurance packages.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
</style>
@endsection
