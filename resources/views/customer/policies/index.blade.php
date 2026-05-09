@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Bima Zangu' : 'My Active Policies' }}</h4>
            <p class="text-muted small">{{ app()->getLocale() == 'sw' ? 'Orodha ya bima zako zinazofanya kazi sasa.' : 'List of your currently active insurance policies.' }}</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 border-0 small text-muted text-uppercase">Policy Name</th>
                                <th class="px-4 py-3 border-0 small text-muted text-uppercase">Provider</th>
                                <th class="px-4 py-3 border-0 small text-muted text-uppercase">Status</th>
                                <th class="px-4 py-3 border-0 small text-muted text-uppercase">Expiry Date</th>
                                <th class="px-4 py-3 border-0 small text-muted text-uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="bi bi-car-front text-success"></i>
                                        </div>
                                        <span class="fw-bold">Motor Comprehensive</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">Alliance Insurance</td>
                                <td class="px-4 py-3"><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Active</span></td>
                                <td class="px-4 py-3">12 Dec 2026</td>
                                <td class="px-4 py-3">
                                    <a href="#" class="btn btn-sm btn-light rounded-pill px-3">View Details</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="bi bi-heart-pulse text-primary"></i>
                                        </div>
                                        <span class="fw-bold">Health Smart Pro</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">Jubilee Insurance</td>
                                <td class="px-4 py-3"><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Active</span></td>
                                <td class="px-4 py-3">20 Jan 2027</td>
                                <td class="px-4 py-3">
                                    <a href="#" class="btn btn-sm btn-light rounded-pill px-3">View Details</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
