@extends('layouts.dashboard')

@section('dashboard_title', 'My Insurance Dashboard')

@section('dashboard_content')
<!-- Customer Welcome Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); border-radius: 20px;">
            <div class="card-body p-4 p-md-5 text-white">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="fw-bold mb-2">Habari, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h2>
                        <p class="opacity-75 mb-4">Karibu kwenye Bima Kwik. Una bima 2 zinazofanya kazi kwa sasa. Kila kitu kiko salama.</p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('customer.buy') }}" class="btn btn-primary px-4 py-2" style="border-radius: 10px;">
                                <i class="bi bi-cart-plus me-2"></i> Nunua Bima Mpya
                            </a>
                            <a href="{{ route('customer.claims.create') }}" class="btn btn-outline-light px-4 py-2" style="border-radius: 10px;">
                                <i class="bi bi-exclamation-octagon me-2"></i> Ripoti Tatizo
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 d-none d-md-block text-end">
                        <i class="bi bi-shield-check-fill" style="font-size: 8rem; opacity: 0.1;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Stats -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary me-2">
                        <i class="bi bi-shield-fill fs-4"></i>
                    </div>
                    <span class="small fw-bold text-muted d-none d-md-inline">Bima Zangu</span>
                </div>
                <h3 class="fw-bold mb-0">2</h3>
                <p class="x-small text-muted mb-0 mt-1">Bima Zilizo Hai</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 p-2 rounded-3 text-warning me-2">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                    <span class="small fw-bold text-muted d-none d-md-inline">Muda Unaoisha</span>
                </div>
                <h3 class="fw-bold mb-0">12</h3>
                <p class="x-small text-muted mb-0 mt-1">Siku Zilizobaki</p>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 p-2 rounded-3 text-info me-2">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <span class="small fw-bold text-muted">Traffic & Leads</span>
                </div>
                <h3 class="fw-bold mb-0">324 / 12</h3>
                <p class="x-small text-muted mb-0 mt-1">Visitors vs Interest</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Active Policies List -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Bima Zangu Zilizo Hai</h5>
                    <a href="{{ route('customer.policies.index') }}" class="small text-decoration-none">Zote</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4 py-3 small text-muted text-uppercase">Bima</th>
                                <th class="border-0 py-3 small text-muted text-uppercase d-none d-md-table-cell">No. Ya Policy</th>
                                <th class="border-0 py-3 small text-muted text-uppercase">Hali</th>
                                <th class="border-0 py-3 small text-muted text-uppercase">Mwisho</th>
                                <th class="border-0 px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 p-2 rounded-3 text-info me-3">
                                            <i class="bi bi-car-front fs-5"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold small">Motor Insurance</div>
                                            <div class="x-small text-muted">Toyota Hilux</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 d-none d-md-table-cell">
                                    <span class="x-small">BK-MOT-2024-001</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-success-subtle text-success px-2 py-1" style="font-size: 0.65rem;">Hai</span>
                                </td>
                                <td class="py-3 text-danger fw-bold small">15 Jun</td>
                                <td class="px-4 py-3 text-end">
                                    <button class="btn btn-sm btn-light rounded-circle"><i class="bi bi-chevron-right"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-danger bg-opacity-10 p-2 rounded-3 text-danger me-3">
                                            <i class="bi bi-heart-pulse fs-5"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold small">Health Insurance</div>
                                            <div class="x-small text-muted">Aga Khan Network</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 border-0 d-none d-md-table-cell">
                                    <span class="x-small">BK-HEA-2024-052</span>
                                </td>
                                <td class="py-3 border-0">
                                    <span class="badge bg-success-subtle text-success px-2 py-1" style="font-size: 0.65rem;">Hai</span>
                                </td>
                                <td class="py-3 border-0 small text-muted">10 Jan</td>
                                <td class="px-4 py-3 border-0 text-end">
                                    <button class="btn btn-sm btn-light rounded-circle"><i class="bi bi-chevron-right"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar Content -->
    <div class="col-lg-4">
        <!-- AI Recommendations -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; background: #fdf2f8;">
            <div class="card-body p-4 text-center">
                <div class="bg-white rounded-circle shadow-sm mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <i class="bi bi-robot fs-2 text-primary"></i>
                </div>
                <h6 class="fw-bold mb-2">Ushauri wa AI</h6>
                <p class="x-small text-muted mb-3">Tumeona unamiliki gari lakini huna bima ya nyumba. Kinga makazi yako sasa!</p>
                <button class="btn btn-sm btn-primary w-100 rounded-pill py-2 small">Angalia Ofa</button>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4">Msaada wa Haraka</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('customer.support') }}" class="btn btn-light text-start border-0 py-3 px-3 d-flex align-items-center">
                        <i class="bi bi-chat-dots me-3 text-primary"></i>
                        <span class="small fw-bold">Ongea Nasi (Live Chat)</span>
                    </a>
                    <a href="{{ route('customer.policies.documents') }}" class="btn btn-light text-start border-0 py-3 px-3 d-flex align-items-center">
                        <i class="bi bi-download me-3 text-success"></i>
                        <span class="small fw-bold">Pakua Vitambulisho</span>
                    </a>
                    <a href="#" class="btn btn-light text-start border-0 py-3 px-3 d-flex align-items-center">
                        <i class="bi bi-geo-alt me-3 text-danger"></i>
                        <span class="small fw-bold">Hospitali Zilizo Karibu</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
    .bg-gradient-primary { background: linear-gradient(45deg, #0d6efd, #0dcaf0); }
</style>
@endsection
