@extends('layouts.dashboard')

@section('dashboard_title', 'Track Claims')

@section('dashboard_content')
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-search me-2"></i>
            Fuatilia Madai Yako
        </h2>
        <p class="text-muted">Tafuta na fuatilia hali ya madai yako kwa wakati halisi</p>
    </div>
</div>

<!-- Search Section -->
<div class="row mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form id="searchForm">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" id="claimSearch" placeholder="Ingiza namba ya madai (mfano: CLM-2024-001)" aria-label="Search claims">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search me-2"></i> Tafuta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Status Filter -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <label class="fw-bold mb-3">Kwa Hali</label>
                <select class="form-select" id="statusFilter">
                    <option value="">Zote</option>
                    <option value="pending">Inasubiri</option>
                    <option value="approved">Iliyoidhinisha</option>
                    <option value="rejected">Iliyokataliwa</option>
                    <option value="paid">Iliyolipwa</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Claims List -->
<div class="row">
    <div class="col-12">
        <!-- No Claims Message -->
        <div id="noClaims" class="alert alert-info" role="alert">
            <i class="bi bi-info-circle me-2"></i>
            Hujauliza madai. Bonyeza kitufe "Juta Madai" ili kuanza.
        </div>

        <!-- Claims Container -->
        <div id="claimsContainer">
            <!-- Claim Card 1 - Pending -->
            <div class="card border-0 shadow-sm mb-3 claim-card" data-status="pending">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-start gap-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning bg-opacity-10 rounded-3 p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-hourglass-split text-warning" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1">
                                        Namba ya Madai: <span class="text-primary">CLM-2024-001</span>
                                    </h5>
                                    <p class="text-muted mb-2">
                                        <i class="bi bi-calendar me-2"></i> 
                                        Tarehe: <strong>15 Mei 2024</strong>
                                    </p>
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-briefcase me-2"></i>
                                        Aina: <strong>Motor Insurance - Uharibifu wa Gari</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <div class="mb-2">
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-clock me-1"></i> Inasubiri
                                </span>
                            </div>
                            <p class="mb-2">
                                <small class="text-muted">Kiasi:</small>
                                <br>
                                <strong class="fs-5">TZS 500,000</strong>
                            </p>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between mb-2">
                            <small class="fw-bold">Hatua ya Hadharani:</small>
                            <small class="text-muted">2/4</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row text-center mt-3 small">
                            <div class="col-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <br>
                                <small>Kutumiwa</small>
                            </div>
                            <div class="col-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <br>
                                <small>Kujibu</small>
                            </div>
                            <div class="col-3">
                                <i class="bi bi-hourglass-split text-warning"></i>
                                <br>
                                <small>Ukaguzi</small>
                            </div>
                            <div class="col-3">
                                <i class="bi bi-circle text-muted"></i>
                                <br>
                                <small>Kulipa</small>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-top">
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye me-1"></i> Tazama Maelezo
                        </a>
                    </div>
                </div>
            </div>

            <!-- Claim Card 2 - Approved -->
            <div class="card border-0 shadow-sm mb-3 claim-card" data-status="approved">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-start gap-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 rounded-3 p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-check-circle text-success" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1">
                                        Namba ya Madai: <span class="text-primary">CLM-2024-002</span>
                                    </h5>
                                    <p class="text-muted mb-2">
                                        <i class="bi bi-calendar me-2"></i> 
                                        Tarehe: <strong>10 Mei 2024</strong>
                                    </p>
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-briefcase me-2"></i>
                                        Aina: <strong>Health Insurance - Gharama za Hospitali</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <div class="mb-2">
                                <span class="badge bg-success">
                                    <i class="bi bi-check me-1"></i> Iliyoidhinisha
                                </span>
                            </div>
                            <p class="mb-2">
                                <small class="text-muted">Kiasi:</small>
                                <br>
                                <strong class="fs-5">TZS 250,000</strong>
                            </p>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between mb-2">
                            <small class="fw-bold">Hatua ya Hadharani:</small>
                            <small class="text-muted">3/4</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row text-center mt-3 small">
                            <div class="col-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <br>
                                <small>Kutumiwa</small>
                            </div>
                            <div class="col-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <br>
                                <small>Kujibu</small>
                            </div>
                            <div class="col-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <br>
                                <small>Ukaguzi</small>
                            </div>
                            <div class="col-3">
                                <i class="bi bi-hourglass-split text-warning"></i>
                                <br>
                                <small>Kulipa</small>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-top">
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye me-1"></i> Tazama Maelezo
                        </a>
                    </div>
                </div>
            </div>

            <!-- Claim Card 3 - Paid -->
            <div class="card border-0 shadow-sm mb-3 claim-card" data-status="paid">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-start gap-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-info bg-opacity-10 rounded-3 p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-check-all text-info" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="fw-bold mb-1">
                                        Namba ya Madai: <span class="text-primary">CLM-2024-003</span>
                                    </h5>
                                    <p class="text-muted mb-2">
                                        <i class="bi bi-calendar me-2"></i> 
                                        Tarehe: <strong>01 Mei 2024</strong>
                                    </p>
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-briefcase me-2"></i>
                                        Aina: <strong>Property Insurance - Uharibifu wa Nyumba</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <div class="mb-2">
                                <span class="badge bg-info">
                                    <i class="bi bi-check-all me-1"></i> Iliyolipwa
                                </span>
                            </div>
                            <p class="mb-2">
                                <small class="text-muted">Kiasi:</small>
                                <br>
                                <strong class="fs-5">TZS 1,000,000</strong>
                            </p>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between mb-2">
                            <small class="fw-bold">Hatua ya Hadharani:</small>
                            <small class="text-muted">4/4</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row text-center mt-3 small">
                            <div class="col-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <br>
                                <small>Kutumiwa</small>
                            </div>
                            <div class="col-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <br>
                                <small>Kujibu</small>
                            </div>
                            <div class="col-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <br>
                                <small>Ukaguzi</small>
                            </div>
                            <div class="col-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <br>
                                <small>Kulipa</small>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-top">
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye me-1"></i> Tazama Maelezo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Button -->
<div class="row mt-4">
    <div class="col-12 text-center">
        <a href="{{ route('customer.claims.create') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle me-2"></i> Juta Madai Mpya
        </a>
    </div>
</div>

<style>
    .claim-card {
        transition: all 0.3s ease;
        border-left: 4px solid #dee2e6;
    }

    .claim-card:hover {
        box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.1) !important;
        transform: translateX(4px);
    }

    .claim-card[data-status="pending"] {
        border-left-color: #ffc107;
    }

    .claim-card[data-status="approved"] {
        border-left-color: #28a745;
    }

    .claim-card[data-status="paid"] {
        border-left-color: #17a2b8;
    }

    .claim-card[data-status="rejected"] {
        border-left-color: #dc3545;
    }
</style>

<script>
    // Filter claims by status
    document.getElementById('statusFilter').addEventListener('change', function() {
        const selectedStatus = this.value;
        const claims = document.querySelectorAll('.claim-card');

        claims.forEach(claim => {
            if (selectedStatus === '' || claim.dataset.status === selectedStatus) {
                claim.style.display = 'block';
            } else {
                claim.style.display = 'none';
            }
        });
    });

    // Search functionality
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const searchTerm = document.getElementById('claimSearch').value.toLowerCase();
        const claims = document.querySelectorAll('.claim-card');

        claims.forEach(claim => {
            const claimNumber = claim.querySelector('.text-primary').textContent.toLowerCase();
            if (searchTerm === '' || claimNumber.includes(searchTerm)) {
                claim.style.display = 'block';
            } else {
                claim.style.display = 'none';
            }
        });
    });
</script>
@endsection
