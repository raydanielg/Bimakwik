@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1">System Configurations</h2>
        <p class="text-muted small mb-0">Manage platform settings and configurations</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">General Settings</h5>
            </div>
            <div class="card-body">
                <form>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Platform Name</label>
                        <input type="text" class="form-control" value="BimaKwik">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Default Currency</label>
                        <select class="form-select">
                            <option>TZS - Tanzanian Shilling</option>
                            <option>USD - US Dollar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Time Zone</label>
                        <select class="form-select">
                            <option>Africa/Dar_es_Salaam (EAT)</option>
                            <option>UTC</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="Swal.fire('Saved!', 'Settings updated', 'success')">
                        <i class="bi bi-check-circle me-2"></i>Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-bold">Email Settings</h5>
            </div>
            <div class="card-body">
                <form>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">SMTP Host</label>
                        <input type="text" class="form-control" placeholder="smtp.example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">SMTP Port</label>
                        <input type="number" class="form-control" value="587">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">From Email</label>
                        <input type="email" class="form-control" placeholder="noreply@bimakwik.com">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="Swal.fire('Saved!', 'Email settings updated', 'success')">
                        <i class="bi bi-check-circle me-2"></i>Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
