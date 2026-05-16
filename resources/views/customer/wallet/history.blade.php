@extends('layouts.dashboard')

@section('dashboard_title', 'Wallet History')

@section('dashboard_content')
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-clock-history me-2"></i>
            Historia ya Mkoba
        </h2>
        <p class="text-muted">Tazama kila kitu kilicho hatua kwenye mkoba wako</p>
    </div>
</div>

<!-- Filters -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <label class="fw-bold mb-2 small">Kwa Aina</label>
                <select class="form-select form-select-sm" id="typeFilter">
                    <option value="">Zote</option>
                    <option value="deposit">Kumweka (Deposit)</option>
                    <option value="payment">Kulipa</option>
                    <option value="refund">Kurudi Pesa</option>
                    <option value="bonus">Zawadi</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <label class="fw-bold mb-2 small">Kwa Hali</label>
                <select class="form-select form-select-sm" id="statusFilter">
                    <option value="">Zote</option>
                    <option value="completed">Imekamilika</option>
                    <option value="pending">Inasubiri</option>
                    <option value="failed">Imeshindwa</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <label class="fw-bold mb-2 small">Tarehe</label>
                <input type="date" class="form-control form-control-sm" id="dateFilter">
            </div>
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-bold py-3">Tarehe & Saa</th>
                                <th class="fw-bold py-3">Aina</th>
                                <th class="fw-bold py-3">Maelezo</th>
                                <th class="fw-bold py-3">Kiasi</th>
                                <th class="fw-bold py-3">Hali</th>
                                <th class="fw-bold py-3">Hatua</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Deposit -->
                            <tr class="transaction-row" data-type="deposit" data-status="completed">
                                <td class="py-3">
                                    <small class="fw-bold">16 Mei 2024</small>
                                    <br>
                                    <small class="text-muted">14:30</small>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="bi bi-plus-circle me-1"></i> Kumweka
                                    </span>
                                </td>
                                <td>
                                    <small><strong>M-Pesa Deposit</strong></small>
                                    <br>
                                    <small class="text-muted">TRX ID: TRX-2024-0001</small>
                                </td>
                                <td>
                                    <strong class="text-success">+TZS 100,000</strong>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i> Imekamilika
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal">
                                        Tazama
                                    </button>
                                </td>
                            </tr>

                            <!-- Payment -->
                            <tr class="transaction-row" data-type="payment" data-status="completed">
                                <td class="py-3">
                                    <small class="fw-bold">14 Mei 2024</small>
                                    <br>
                                    <small class="text-muted">09:15</small>
                                </td>
                                <td>
                                    <span class="badge bg-danger">
                                        <i class="bi bi-dash-circle me-1"></i> Kulipa
                                    </span>
                                </td>
                                <td>
                                    <small><strong>Bima Premium - Motor</strong></small>
                                    <br>
                                    <small class="text-muted">Policy #POL-2024-001</small>
                                </td>
                                <td>
                                    <strong class="text-danger">-TZS 50,000</strong>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i> Imekamilika
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal">
                                        Tazama
                                    </button>
                                </td>
                            </tr>

                            <!-- Refund -->
                            <tr class="transaction-row" data-type="refund" data-status="completed">
                                <td class="py-3">
                                    <small class="fw-bold">10 Mei 2024</small>
                                    <br>
                                    <small class="text-muted">11:42</small>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i> Kurudi
                                    </span>
                                </td>
                                <td>
                                    <small><strong>Kurudi Madai - CLM-2024-001</strong></small>
                                    <br>
                                    <small class="text-muted">Madai iliyoidhinishwa</small>
                                </td>
                                <td>
                                    <strong class="text-info">+TZS 250,000</strong>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i> Imekamilika
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal">
                                        Tazama
                                    </button>
                                </td>
                            </tr>

                            <!-- Payment Pending -->
                            <tr class="transaction-row" data-type="payment" data-status="pending">
                                <td class="py-3">
                                    <small class="fw-bold">16 Mei 2024</small>
                                    <br>
                                    <small class="text-muted">16:05</small>
                                </td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-dash-circle me-1"></i> Kulipa
                                    </span>
                                </td>
                                <td>
                                    <small><strong>Bima Annual - Property</strong></small>
                                    <br>
                                    <small class="text-muted">Policy #POL-2024-003</small>
                                </td>
                                <td>
                                    <strong>-TZS 150,000</strong>
                                </td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock me-1"></i> Inasubiri
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        Tazama
                                    </button>
                                </td>
                            </tr>

                            <!-- Bonus -->
                            <tr class="transaction-row" data-type="bonus" data-status="completed">
                                <td class="py-3">
                                    <small class="fw-bold">08 Mei 2024</small>
                                    <br>
                                    <small class="text-muted">08:20</small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-gift me-1"></i> Zawadi
                                    </span>
                                </td>
                                <td>
                                    <small><strong>Bonasi ya Referral</strong></small>
                                    <br>
                                    <small class="text-muted">Friend Sign-up Reward</small>
                                </td>
                                <td>
                                    <strong class="text-success">+TZS 10,000</strong>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i> Imekamilika
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        Tazama
                                    </button>
                                </td>
                            </tr>

                            <!-- Payment Failed -->
                            <tr class="transaction-row" data-type="payment" data-status="failed">
                                <td class="py-3">
                                    <small class="fw-bold">05 Mei 2024</small>
                                    <br>
                                    <small class="text-muted">13:50</small>
                                </td>
                                <td>
                                    <span class="badge bg-danger">
                                        <i class="bi bi-dash-circle me-1"></i> Kulipa
                                    </span>
                                </td>
                                <td>
                                    <small><strong>Bima Renewal</strong></small>
                                    <br>
                                    <small class="text-muted">Policy #POL-2024-002</small>
                                </td>
                                <td>
                                    <strong>-TZS 75,000</strong>
                                </td>
                                <td>
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i> Imeshindwa
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-danger">
                                        Jaribu Tena
                                    </button>
                                </td>
                            </tr>

                            <!-- Deposit -->
                            <tr class="transaction-row" data-type="deposit" data-status="completed">
                                <td class="py-3">
                                    <small class="fw-bold">01 Mei 2024</small>
                                    <br>
                                    <small class="text-muted">10:00</small>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="bi bi-plus-circle me-1"></i> Kumweka
                                    </span>
                                </td>
                                <td>
                                    <small><strong>Bank Transfer</strong></small>
                                    <br>
                                    <small class="text-muted">TRX ID: TRX-2024-0000</small>
                                </td>
                                <td>
                                    <strong class="text-success">+TZS 500,000</strong>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i> Imekamilika
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        Tazama
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Button -->
<div class="row mt-4">
    <div class="col-12">
        <a href="{{ route('customer.wallet.add-funds') }}" class="btn btn-primary">
            <i class="bi bi-wallet-plus me-2"></i> Ongeza Pesa
        </a>
        <a href="{{ route('customer.wallet.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i> Rudi kwenye Mkoba
        </a>
    </div>
</div>

<style>
    .transaction-row {
        transition: background-color 0.2s ease;
    }

    .transaction-row:hover {
        background-color: #f8f9fa;
    }

    table tbody tr {
        border-bottom: 1px solid #dee2e6;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
    }
</style>

<script>
    // Filter transactions
    function filterTransactions() {
        const typeFilter = document.getElementById('typeFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;
        const rows = document.querySelectorAll('.transaction-row');

        rows.forEach(row => {
            let show = true;
            
            if (typeFilter && row.dataset.type !== typeFilter) {
                show = false;
            }
            
            if (statusFilter && row.dataset.status !== statusFilter) {
                show = false;
            }
            
            row.style.display = show ? '' : 'none';
        });
    }

    // Event listeners for filters
    document.getElementById('typeFilter').addEventListener('change', filterTransactions);
    document.getElementById('statusFilter').addEventListener('change', filterTransactions);
    document.getElementById('dateFilter').addEventListener('change', filterTransactions);
</script>
@endsection
