@extends('layouts.dashboard')

@section('dashboard_title', 'File a Claim')

@section('dashboard_content')
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-file-earmark-plus me-2"></i>
            Juta Madai Mpya
        </h2>
        <p class="text-muted">Juta madai kwa ajili ya gharama za ziada au uharibifu</p>
    </div>
</div>

<!-- Claim Form -->
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form id="claimForm" method="POST" action="#" enctype="multipart/form-data">
                    @csrf

                    <!-- Policy Selection -->
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-1-circle me-2"></i> Chagua Sera
                    </h5>

                    <div class="mb-4">
                        <label class="form-label">Sera ya Bima</label>
                        <select class="form-select" name="policy_id" required>
                            <option value="">Chagua sera...</option>
                            <option value="1">
                                Policy #POL-2024-001 - Motor Insurance (Active)
                            </option>
                            <option value="2">
                                Policy #POL-2024-002 - Health Insurance (Active)
                            </option>
                            <option value="3">
                                Policy #POL-2024-003 - Property Insurance (Active)
                            </option>
                        </select>
                    </div>

                    <hr class="my-4">

                    <!-- Claim Details -->
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-2-circle me-2"></i> Maelezo ya Madai
                    </h5>

                    <div class="mb-3">
                        <label class="form-label">Aina ya Madai</label>
                        <select class="form-select" name="claim_type" required>
                            <option value="">Chagua aina...</option>
                            <option value="accident">Ajali au Mgogoro</option>
                            <option value="theft">Wizi au Mhasara</option>
                            <option value="damage">Uharibifu</option>
                            <option value="medical">Gharama za Usada</option>
                            <option value="other">Nyingine</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tarehe ya Wakati (When it happened)</label>
                        <input type="date" class="form-control" name="incident_date" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Maelezo ya Hadharani</label>
                        <textarea class="form-control" name="description" rows="5" placeholder="Eleza kwa undani ni nini kilichotokea..." required></textarea>
                        <small class="text-muted">Toa maelezo ya kina kuhusu kilichotokea</small>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Kiasi cha Madai</label>
                            <div class="input-group">
                                <span class="input-group-text">TZS</span>
                                <input type="number" class="form-control" name="claim_amount" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mahali pa Hadharani</label>
                            <input type="text" class="form-control" name="incident_location" placeholder="Mfano: Dar es Salaam" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Supporting Documents -->
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-3-circle me-2"></i> Nyaraka za Ushahidi
                    </h5>

                    <div class="mb-3">
                        <label class="form-label">Sambaza Nyaraka (Optional)</label>
                        <div class="border-2 border-dashed rounded p-4 text-center" style="border-color: #dee2e6; cursor: pointer;" id="dropZone">
                            <i class="bi bi-cloud-arrow-up" style="font-size: 2rem; color: #6c757d;"></i>
                            <p class="mt-2 mb-0">
                                <strong>Dobeza mafaili au bonyeza kuteua</strong>
                            </p>
                            <small class="text-muted">PNG, JPG, PDF (Max 5MB)</small>
                            <input type="file" id="fileInput" name="documents[]" multiple accept=".png,.jpg,.jpeg,.pdf" style="display: none;">
                        </div>
                        <div id="fileList" class="mt-3"></div>
                    </div>

                    <hr class="my-4">

                    <!-- Additional Information -->
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-4-circle me-2"></i> Taarifa za Ziada
                    </h5>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="third_party" id="thirdParty">
                            <label class="form-check-label" for="thirdParty">
                                Kuna upande wa tatu uliyohusika?
                            </label>
                        </div>
                    </div>

                    <div id="thirdPartyInfo" style="display: none;" class="mb-3 p-3 bg-light rounded">
                        <input type="text" class="form-control" name="third_party_name" placeholder="Jina la upande wa tatu">
                        <input type="text" class="form-control mt-2" name="third_party_contact" placeholder="Simu au barua pepe">
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="police_report" id="policeReport">
                            <label class="form-check-label" for="policeReport">
                                Ripoti ilifanywa kwa polisi?
                            </label>
                        </div>
                    </div>

                    <!-- Terms and Submit -->
                    <div class="alert alert-info small">
                        <i class="bi bi-info-circle me-2"></i>
                        Nakubali kuwa taarifa zote nzilizo kwenye fomu hii ni za ukweli na nzima.
                    </div>

                    <div class="d-flex gap-2 pt-3">
                        <a href="{{ route('customer.claims.track') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i> Rudi
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <i class="bi bi-send me-2"></i> Tuma Madai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
            <div class="card-header bg-light border-0 p-4">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-info-circle me-2"></i> Habari Muhimu
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Kile unachohitaji:</h6>
                    <ul class="small list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Namba ya sera
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Maelezo ya hadharani
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Kiasi cha madai
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Picha au nyaraka
                        </li>
                    </ul>
                </div>

                <hr>

                <div class="mb-4">
                    <h6 class="fw-bold mb-2">Nyaraka Zinazokubali:</h6>
                    <ul class="small list-unstyled">
                        <li class="mb-1">
                            <i class="bi bi-file-image me-2"></i> Picha (PNG, JPG)
                        </li>
                        <li class="mb-1">
                            <i class="bi bi-file-pdf me-2"></i> Hati (PDF)
                        </li>
                        <li>
                            <small class="text-muted">Max 5MB kwa faili</small>
                        </li>
                    </ul>
                </div>

                <hr>

                <div>
                    <h6 class="fw-bold mb-2">Muda wa Kujibu:</h6>
                    <p class="small mb-0">
                        Tunajibu madai ndani ya <strong>5-10 siku za kazi</strong>. Utakamatia habari kwa njia ya SMS na barua pepe.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #dropZone {
        transition: all 0.3s ease;
    }

    #dropZone:hover,
    #dropZone.drag-over {
        background-color: #e7f3ff;
        border-color: #0066cc !important;
    }

    .file-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .file-item .btn-remove {
        margin-left: auto;
        padding: 0;
        border: none;
        background: none;
        color: #dc3545;
        cursor: pointer;
    }
</style>

<script>
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');
    let files = [];

    // Click to select files
    dropZone.addEventListener('click', () => fileInput.click());

    // Drag and drop
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('drag-over');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('drag-over');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drag-over');
        handleFiles(e.dataTransfer.files);
    });

    // File input change
    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(newFiles) {
        files = Array.from(newFiles);
        updateFileList();
    }

    function updateFileList() {
        fileList.innerHTML = '';
        files.forEach((file, index) => {
            const div = document.createElement('div');
            div.className = 'file-item';
            div.innerHTML = `
                <i class="bi bi-file"></i>
                <div>
                    <small><strong>${file.name}</strong></small><br>
                    <small class="text-muted">${(file.size / 1024).toFixed(2)} KB</small>
                </div>
                <button type="button" class="btn-remove" onclick="removeFile(${index})">
                    <i class="bi bi-x-circle"></i>
                </button>
            `;
            fileList.appendChild(div);
        });
    }

    function removeFile(index) {
        files.splice(index, 1);
        updateFileList();
    }

    // Third party toggle
    document.getElementById('thirdParty').addEventListener('change', function() {
        document.getElementById('thirdPartyInfo').style.display = this.checked ? 'block' : 'none';
    });

    // Form submission
    document.getElementById('claimForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Madai yako yamekubali! Unatakamatia namba ya kurekebisha kwa barua pepe.');
    });
</script>
@endsection
