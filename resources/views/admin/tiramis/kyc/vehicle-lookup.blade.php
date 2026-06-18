@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Vehicle Registration Lookup</h4>
        <small class="text-muted">Lookup vehicle details by registration number via TIRAMIS</small>
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
                <form method="POST" action="{{ route('admin.tiramis.kyc.vehicle.lookup') }}" id="vehicleForm">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Registration Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-truck"></i></span>
                            <input type="text" name="registration_number" class="form-control form-control-lg text-uppercase"
                                   placeholder="e.g. T 123 ABC"
                                   value="{{ old('registration_number') }}" required minlength="3" maxlength="20" autofocus>
                        </div>
                        <small class="text-muted">Enter the vehicle plate/registration number</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-warning btn-lg rounded-pill" id="lookupBtn">
                            <i class="bi bi-search me-2"></i>
                            <span id="btnText">Lookup Vehicle</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-pill" onclick="useDemo()">
                            <i class="bi bi-lightning me-1"></i> Use Demo Plate
                        </button>
                    </div>
                </form>

                <div id="resultContainer" class="mt-4 d-none"></div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-3">
            <div class="card-body">
                <h6 class="fw-semibold mb-2"><i class="bi bi-info-circle me-2 text-warning"></i>About Vehicle Lookup</h6>
                <p class="text-muted small mb-0">
                    This service connects to TIRAMIS vehicle registry to retrieve vehicle details
                    including make, model, chassis number, engine number, year of manufacture,
                    and current insurance status. This is essential for motor insurance underwriting.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function useDemo() {
    document.querySelector('[name="registration_number"]').value = 'T 123 ABC';
}

document.getElementById('vehicleForm').addEventListener('submit', async function(e) {
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
                    <i class="bi bi-check-circle me-2"></i><strong>Vehicle Found!</strong>
                </div>
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Vehicle Details</h6>
                        <div class="row g-2 small">
                            <div class="col-6"><span class="text-muted">Registration:</span></div>
                            <div class="col-6 fw-bold">${d.registration_number || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Make/Model:</span></div>
                            <div class="col-6">${d.make || ''} ${d.model || ''}</div>
                            <div class="col-6"><span class="text-muted">Body Type:</span></div>
                            <div class="col-6">${d.body_type || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Color:</span></div>
                            <div class="col-6">${d.color || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Year:</span></div>
                            <div class="col-6">${d.year_of_manufacture || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Engine Capacity:</span></div>
                            <div class="col-6">${d.engine_capacity || 'N/A'} cc</div>
                            <div class="col-6"><span class="text-muted">Fuel:</span></div>
                            <div class="col-6">${d.fuel_type || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Chassis:</span></div>
                            <div class="col-6"><code>${d.chassis_number || 'N/A'}</code></div>
                            <div class="col-6"><span class="text-muted">Engine:</span></div>
                            <div class="col-6"><code>${d.engine_number || 'N/A'}</code></div>
                            <div class="col-6"><span class="text-muted">Seating:</span></div>
                            <div class="col-6">${d.sitting_capacity || 'N/A'}</div>
                            <div class="col-6"><span class="text-muted">Insurance Status:</span></div>
                            <div class="col-6"><span class="badge bg-${d.insurance_status === 'insured' ? 'success' : 'warning'}">${d.insurance_status || 'N/A'}</span></div>
                        </div>
                        ${data.simulated ? '<div class="mt-2"><span class="badge bg-warning">Simulated</span></div>' : ''}
                    </div>
                </div>`;
        } else {
            resultContainer.innerHTML = `
                <div class="alert alert-danger border-0">
                    <i class="bi bi-x-circle me-2"></i><strong>Not Found</strong><br>
                    <small>${data.error || 'Vehicle not found in registry'}</small>
                </div>`;
        }
    } catch(e) {
        resultContainer.classList.remove('d-none');
        resultContainer.innerHTML = `<div class="alert alert-danger border-0">Error: ${e.message}</div>`;
    } finally {
        btn.disabled = false;
        btnText.textContent = 'Lookup Vehicle';
        btnSpinner.classList.add('d-none');
    }
});
</script>
@endsection
