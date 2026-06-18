@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">NIDA Identity Verification</h4>
        <small class="text-muted">Verify customer identity via TIRAMIS NIDA API</small>
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
                <form method="POST" action="{{ route('admin.tiramis.kyc.nida.verify') }}" id="nidaForm">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-semibold">NIDA Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person-vcard"></i></span>
                            <input type="text" name="nida_number" class="form-control form-control-lg"
                                   placeholder="e.g. 19850615-12345-00001-23"
                                   value="{{ old('nida_number') }}" required minlength="10" maxlength="30"
                                   pattern="[A-Za-z0-9\-]+" autofocus>
                        </div>
                        <small class="text-muted">Enter the full NIDA number as it appears on the ID card</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill" id="verifyBtn">
                            <i class="bi bi-shield-check me-2"></i>
                            <span id="btnText">Verify NIDA Identity</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-pill" onclick="useDemo()">
                            <i class="bi bi-lightning me-1"></i> Use Demo NIDA
                        </button>
                    </div>
                </form>

                <div id="resultContainer" class="mt-4 d-none"></div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body">
                <h6 class="fw-semibold mb-2"><i class="bi bi-info-circle me-2 text-primary"></i>About NIDA Verification</h6>
                <p class="text-muted small mb-0">
                    This service connects to TIRAMIS NIDA verification API to authenticate customer identity.
                    The verification returns full KYC data including name, date of birth, gender, address,
                    and other demographic information registered with NIDA.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function useDemo() {
    document.querySelector('[name="nida_number"]').value = '19850615-12345-00001-23';
}

document.getElementById('nidaForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('verifyBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');
    const resultContainer = document.getElementById('resultContainer');

    btn.disabled = true;
    btnText.textContent = 'Verifying...';
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
        if (data.success && data.verified) {
            const d = data.data;
            resultContainer.innerHTML = `
                <div class="alert alert-success border-0">
                    <i class="bi bi-check-circle me-2"></i><strong>Verified!</strong> Identity confirmed.
                </div>
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Customer KYC Data</h6>
                        <div class="row g-2 small">
                            <div class="col-6"><span class="text-muted">Full Name:</span></div>
                            <div class="col-6 fw-semibold">${d.full_name || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Gender:</span></div>
                            <div class="col-6">${d.gender === 'M' ? 'Male' : d.gender === 'F' ? 'Female' : d.gender || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Date of Birth:</span></div>
                            <div class="col-6">${d.date_of_birth || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Phone:</span></div>
                            <div class="col-6">${d.phone || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Email:</span></div>
                            <div class="col-6">${d.email || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Region:</span></div>
                            <div class="col-6">${d.region || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">District:</span></div>
                            <div class="col-6">${d.district || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Address:</span></div>
                            <div class="col-6">${d.address || 'N/A'}</div>
                        </div>
                        ${data.simulated ? '<div class="mt-2"><span class="badge bg-warning">Simulated Data</span></div>' : ''}
                    </div>
                </div>`;
        } else {
            resultContainer.innerHTML = `
                <div class="alert alert-danger border-0">
                    <i class="bi bi-x-circle me-2"></i><strong>Verification Failed</strong><br>
                    <small>${data.error || 'Unknown error'}</small>
                </div>`;
        }
    } catch(e) {
        resultContainer.classList.remove('d-none');
        resultContainer.innerHTML = `<div class="alert alert-danger border-0">Error: ${e.message}</div>`;
    } finally {
        btn.disabled = false;
        btnText.textContent = 'Verify NIDA Identity';
        btnSpinner.classList.add('d-none');
    }
});
</script>
@endsection
