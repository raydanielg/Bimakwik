@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Customer KYC Lookup</h4>
        <small class="text-muted">Lookup customer KYC data by identity type via TIRAMIS</small>
    </div>
    <div>
        <a href="{{ route('admin.tiramis.kyc.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.tiramis.kyc.customer.lookup') }}" id="lookupForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Identity Type <span class="text-danger">*</span></label>
                        <select name="identity_type" class="form-select form-select-lg" required>
                            <option value="NIDA" @selected(old('identity_type') == 'NIDA')>NIDA (National ID)</option>
                            <option value="PASSPORT" @selected(old('identity_type') == 'PASSPORT')>Passport</option>
                            <option value="DRIVING_LICENSE" @selected(old('identity_type') == 'DRIVING_LICENSE')>Driving License</option>
                            <option value="VOTER_ID" @selected(old('identity_type') == 'VOTER_ID')>Voter ID</option>
                            <option value="ZANID" @selected(old('identity_type') == 'ZANID')>Zanzibar ID (ZANID)</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Identity Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person-badge"></i></span>
                            <input type="text" name="identity_number" class="form-control form-control-lg"
                                   placeholder="Enter identity number..."
                                   value="{{ old('identity_number') }}" required minlength="5" autofocus>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill" id="lookupBtn">
                            <i class="bi bi-search me-2"></i>
                            <span id="btnText">Lookup Customer</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
                        </button>
                    </div>
                </form>
                <div id="resultContainer" class="mt-4 d-none"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('lookupForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('lookupBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');
    const resultContainer = document.getElementById('resultContainer');

    btn.disabled = true;
    btnText.textContent = 'Looking up...';
    btnSpinner.classList.remove('d-none');

    try {
        const formData = new FormData(this);
        const res = await fetch(this.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData
        });
        const data = await res.json();

        resultContainer.classList.remove('d-none');
        if (data.success) {
            const d = data.data;
            resultContainer.innerHTML = `
                <div class="alert alert-success border-0">
                    <i class="bi bi-check-circle me-2"></i><strong>Customer Found!</strong>
                </div>
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Customer Details</h6>
                        <div class="row g-2 small">
                            <div class="col-6"><span class="text-muted">Name:</span></div>
                            <div class="col-6 fw-semibold">${d.full_name || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Gender:</span></div>
                            <div class="col-6">${d.gender === 'M' ? 'Male' : d.gender === 'F' ? 'Female' : d.gender || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">DOB:</span></div>
                            <div class="col-6">${d.date_of_birth || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Phone:</span></div>
                            <div class="col-6">${d.phone || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Email:</span></div>
                            <div class="col-6">${d.email || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Region:</span></div>
                            <div class="col-6">${d.region || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">District:</span></div>
                            <div class="col-6">${d.district || 'N/A'}</div>
                        </div>
                        ${data.simulated ? '<div class="mt-2"><span class="badge bg-warning">Simulated</span></div>' : ''}
                    </div>
                </div>`;
        } else {
            resultContainer.innerHTML = `
                <div class="alert alert-danger border-0">
                    <i class="bi bi-x-circle me-2"></i><strong>Not Found</strong><br>
                    <small>${data.error || 'Customer not found'}</small>
                </div>`;
        }
    } catch(e) {
        resultContainer.classList.remove('d-none');
        resultContainer.innerHTML = `<div class="alert alert-danger border-0">Error: ${e.message}</div>`;
    } finally {
        btn.disabled = false;
        btnText.textContent = 'Lookup Customer';
        btnSpinner.classList.add('d-none');
    }
});
</script>
@endsection
