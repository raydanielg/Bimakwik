@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1"><i class="bi bi-gear-fill text-primary me-2"></i>System Configurations</h2>
            <p class="text-muted small mb-0">Manage platform-wide settings and configurations</p>
        </div>
        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
            <i class="bi bi-check-circle me-1"></i>{{ $configs->count() }} Settings Loaded
        </span>
    </div>
</div>

<form id="configForm">
    @csrf
    <div class="row g-3">
        <!-- General Settings -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-sliders me-2 text-primary"></i>General Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Platform Name</label>
                        <input type="text" name="platform_name" class="form-control" value="{{ optional($configs->get('platform_name'))->value ?? 'BimaKwik' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Default Currency</label>
                        <select name="default_currency" class="form-select">
                            @php $cur = optional($configs->get('default_currency'))->value ?? 'TZS'; @endphp
                            <option value="TZS" {{ $cur == 'TZS' ? 'selected' : '' }}>TZS - Tanzanian Shilling</option>
                            <option value="USD" {{ $cur == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                            <option value="KES" {{ $cur == 'KES' ? 'selected' : '' }}>KES - Kenyan Shilling</option>
                            <option value="UGX" {{ $cur == 'UGX' ? 'selected' : '' }}>UGX - Ugandan Shilling</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Time Zone</label>
                        <select name="timezone" class="form-select">
                            @php $tz = optional($configs->get('timezone'))->value ?? 'Africa/Dar_es_Salaam'; @endphp
                            <option value="Africa/Dar_es_Salaam" {{ $tz == 'Africa/Dar_es_Salaam' ? 'selected' : '' }}>Africa/Dar_es_Salaam (EAT)</option>
                            <option value="Africa/Nairobi" {{ $tz == 'Africa/Nairobi' ? 'selected' : '' }}>Africa/Nairobi (EAT)</option>
                            <option value="UTC" {{ $tz == 'UTC' ? 'selected' : '' }}>UTC</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Support Email</label>
                        <input type="email" name="support_email" class="form-control" value="{{ optional($configs->get('support_email'))->value ?? 'support@bimakwik.com' }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Email Settings -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-envelope-at me-2 text-primary"></i>Email (SMTP) Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">SMTP Host</label>
                        <input type="text" name="smtp_host" class="form-control" placeholder="smtp.example.com" value="{{ optional($configs->get('smtp_host'))->value }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">SMTP Port</label>
                        <input type="number" name="smtp_port" class="form-control" value="{{ optional($configs->get('smtp_port'))->value ?? 587 }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">SMTP Username</label>
                        <input type="text" name="smtp_username" class="form-control" value="{{ optional($configs->get('smtp_username'))->value }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">From Email</label>
                        <input type="email" name="from_email" class="form-control" placeholder="noreply@bimakwik.com" value="{{ optional($configs->get('from_email'))->value ?? 'noreply@bimakwik.com' }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Gateway Settings -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-credit-card-2-front me-2 text-primary"></i>Payment Gateway</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Default Gateway</label>
                        <select name="default_gateway" class="form-select">
                            @php $gw = optional($configs->get('default_gateway'))->value ?? 'mpesa'; @endphp
                            <option value="mpesa" {{ $gw == 'mpesa' ? 'selected' : '' }}>M-Pesa</option>
                            <option value="tigopesa" {{ $gw == 'tigopesa' ? 'selected' : '' }}>Tigo Pesa</option>
                            <option value="airtel_money" {{ $gw == 'airtel_money' ? 'selected' : '' }}>Airtel Money</option>
                            <option value="card" {{ $gw == 'card' ? 'selected' : '' }}>Card / Stripe</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Transaction Fee (%)</label>
                        <input type="number" step="0.01" name="transaction_fee" class="form-control" value="{{ optional($configs->get('transaction_fee'))->value ?? 1.5 }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Auto-Settlement (Days)</label>
                        <input type="number" name="auto_settlement_days" class="form-control" value="{{ optional($configs->get('auto_settlement_days'))->value ?? 7 }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-shield-lock me-2 text-primary"></i>Security & Authentication</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Session Timeout (Minutes)</label>
                        <input type="number" name="session_timeout" class="form-control" value="{{ optional($configs->get('session_timeout'))->value ?? 120 }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Max Login Attempts</label>
                        <input type="number" name="max_login_attempts" class="form-control" value="{{ optional($configs->get('max_login_attempts'))->value ?? 5 }}">
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="enforce_2fa" value="1" {{ optional($configs->get('enforce_2fa'))->value == '1' ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold">Enforce 2FA for Admin Users</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="maintenance_mode" value="1" {{ optional($configs->get('maintenance_mode'))->value == '1' ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold">Maintenance Mode</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4 gap-2">
        <button type="button" class="btn btn-outline-secondary" onclick="window.location.reload()">
            <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
        </button>
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check-circle me-1"></i>Save All Configurations
        </button>
    </div>
</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('configForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    Swal.fire({ title: 'Saving...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

    fetch("{{ route('admin.system.configurations.save') }}", {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            Swal.fire({ icon: 'success', title: 'Saved!', text: data.message, confirmButtonColor: '#0d6efd' });
        } else {
            Swal.fire({ icon: 'error', title: 'Error', text: data.message, confirmButtonColor: '#dc3545' });
        }
    })
    .catch(err => Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to save settings', confirmButtonColor: '#dc3545' }));
});
</script>
@endpush
@endsection
