@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Mkoba Wangu (Wallet)' : 'My Wallet' }}</h4>
            <p class="text-muted small">{{ app()->getLocale() == 'sw' ? 'Simamia salio lako na malipo.' : 'Manage your balance, add funds, and view transactions.' }}</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-primary text-white h-100">
                <h6 class="small text-uppercase opacity-75 mb-3">Available Balance</h6>
                <h2 class="fw-bold mb-4">TZS 125,000</h2>
                <div class="d-grid gap-2">
                    <a href="{{ route('customer.wallet.add-funds') }}" class="btn btn-light rounded-pill fw-bold">Add Funds</a>
                    <button class="btn btn-outline-light rounded-pill">Withdraw</button>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h6 class="fw-bold mb-4">Recent Transactions</h6>
                <div class="list-group list-group-flush">
                    <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center bg-transparent">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-arrow-down-left text-success"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Added Funds (Mobile Money)</h6>
                                <small class="text-muted">May 8, 2026 • 10:20 AM</small>
                            </div>
                        </div>
                        <span class="fw-bold text-success">+TZS 50,000</span>
                    </div>
                    <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center bg-transparent border-0">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-arrow-up-right text-danger"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Policy Payment - Motor</h6>
                                <small class="text-muted">May 5, 2026 • 02:45 PM</small>
                            </div>
                        </div>
                        <span class="fw-bold text-danger">-TZS 25,000</span>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('customer.wallet.history') }}" class="btn btn-light rounded-pill px-4 btn-sm">View Full History</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
