@extends('layouts.dashboard')

@section('dashboard_title', __('customer.create_claim_title'))

@section('content')
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-file-earmark-plus me-2"></i>
            {{ __('customer.create_claim_header') }}
        </h2>
        <p class="text-muted">{{ __('customer.create_claim_subtitle') }}</p>
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
                        <i class="bi bi-1-circle me-2"></i> {{ __('customer.select_policy') }}
                    </h5>

                    <div class="mb-4">
                        <label class="form-label">{{ __('customer.insurance_policy') }}</label>
                        <select class="form-select" name="policy_id" required>
                            <option value="">{{ __('customer.choose_policy') }}</option>
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
                        <i class="bi bi-2-circle me-2"></i> {{ __('customer.claim_details') }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label">{{ __('customer.claim_type_label') }}</label>
                        <select class="form-select" name="claim_type" required>
                            <option value="">{{ __('customer.choose_type') }}</option>
                            <option value="accident">{{ __('customer.accident_or_collision') }}</option>
                            <option value="theft">{{ __('customer.theft_or_loss') }}</option>
                            <option value="damage">{{ __('customer.damage') }}</option>
                            <option value="medical">{{ __('customer.medical_expenses') }}</option>
                            <option value="other">{{ __('customer.other') }}</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('customer.incident_date_label') }}</label>
                        <input type="date" class="form-control" name="incident_date" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('customer.incident_description') }}</label>
                        <textarea class="form-control" name="description" rows="5" placeholder="{{ __('customer.incident_description_ph') }}" required></textarea>
                        <small class="text-muted">{{ __('customer.incident_description_hint') }}</small>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('customer.claim_amount_label') }}</label>
                            <div class="input-group">
                                <span class="input-group-text">TZS</span>
                                <input type="number" class="form-control" name="claim_amount" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('customer.incident_location') }}</label>
                            <input type="text" class="form-control" name="incident_location" placeholder="{{ __('customer.incident_location_ph') }}" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Supporting Documents -->
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-3-circle me-2"></i> {{ __('customer.supporting_documents') }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label">{{ __('customer.upload_documents_optional') }}</label>
                        <div class="border-2 border-dashed rounded p-4 text-center" style="border-color: #dee2e6; cursor: pointer;" id="dropZone">
                            <i class="bi bi-cloud-arrow-up" style="font-size: 2rem; color: #6c757d;"></i>
                            <p class="mt-2 mb-0">
                                <strong>{{ __('customer.drag_files_prompt') }}</strong>
                            </p>
                            <small class="text-muted">PNG, JPG, PDF (Max 5MB)</small>
                            <input type="file" id="fileInput" name="documents[]" multiple accept=".png,.jpg,.jpeg,.pdf" style="display: none;">
                        </div>
                        <div id="fileList" class="mt-3"></div>
                    </div>

                    <hr class="my-4">

                    <!-- Additional Information -->
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-4-circle me-2"></i> {{ __('customer.additional_info') }}
                    </h5>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="third_party" id="thirdParty">
                            <label class="form-check-label" for="thirdParty">
                                {{ __('customer.third_party_involved') }}
                            </label>
                        </div>
                    </div>

                    <div id="thirdPartyInfo" style="display: none;" class="mb-3 p-3 bg-light rounded">
                        <input type="text" class="form-control" name="third_party_name" placeholder="{{ __('customer.third_party_name') }}">
                        <input type="text" class="form-control mt-2" name="third_party_contact" placeholder="{{ __('customer.third_party_contact') }}">
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="police_report" id="policeReport">
                            <label class="form-check-label" for="policeReport">
                                {{ __('customer.police_report_question') }}
                            </label>
                        </div>
                    </div>

                    <!-- Terms and Submit -->
                    <div class="alert alert-info small">
                        <i class="bi bi-info-circle me-2"></i>
                        {{ __('customer.claim_terms_agree') }}
                    </div>

                    <div class="d-flex gap-2 pt-3">
                        <a href="{{ route('customer.claims.track') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i> {{ __('customer.back') }}
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <i class="bi bi-send me-2"></i> {{ __('customer.submit_claim_form') }}
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
                    <i class="bi bi-info-circle me-2"></i> {{ __('customer.important_info') }}
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">{{ __('customer.what_you_need') }}</h6>
                    <ul class="small list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Namba ya sera
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            {{ __('customer.incident_details_item') }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            {{ __('customer.claim_amount_item') }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            {{ __('customer.photos_or_docs') }}
                        </li>
                    </ul>
                </div>

                <hr>

                <div class="mb-4">
                    <h6 class="fw-bold mb-2">{{ __('customer.accepted_documents') }}</h6>
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
                    <h6 class="fw-bold mb-2">{{ __('customer.response_time') }}</h6>
                    <p class="small mb-0">
                        {{ __('customer.response_time_text') }}
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
        alert('{{ __('customer.claim_submitted_alert') }}');
    });
</script>
@endsection
