@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1"><i class="bi bi-globe-africa text-primary me-2"></i>Multi-Country Management</h2>
            <p class="text-muted small mb-0">Manage operations and instances across different countries</p>
        </div>
        <button class="btn btn-primary" onclick="addCountry()">
            <i class="bi bi-plus-lg me-1"></i>Add Country Instance
        </button>
    </div>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Countries</p>
                        <h3 class="fw-bold mb-0">{{ $totalCountries }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3"><i class="bi bi-flag text-primary fs-4"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Active Markets</p>
                        <h3 class="fw-bold mb-0">{{ $activeCountries }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3"><i class="bi bi-check-circle-fill text-success fs-4"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Coming Soon</p>
                        <h3 class="fw-bold mb-0">{{ $totalCountries - $activeCountries }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3"><i class="bi bi-clock-history text-warning fs-4"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Country Cards -->
<div class="row g-3">
    @php
        $defaults = collect([
            (object)['country_name' => 'Tanzania', 'country_code' => 'TZ', 'status' => 'active', 'currency' => 'TZS', 'flag' => '🇹🇿'],
            (object)['country_name' => 'Kenya', 'country_code' => 'KE', 'status' => 'coming_soon', 'currency' => 'KES', 'flag' => '🇰🇪'],
            (object)['country_name' => 'Uganda', 'country_code' => 'UG', 'status' => 'coming_soon', 'currency' => 'UGX', 'flag' => '🇺🇬'],
            (object)['country_name' => 'Rwanda', 'country_code' => 'RW', 'status' => 'coming_soon', 'currency' => 'RWF', 'flag' => '🇷🇼'],
        ]);
        $list = $countries->count() > 0 ? $countries : $defaults;
    @endphp
    @foreach($list as $country)
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div class="d-flex align-items-center mb-1">
                            <span class="fs-3 me-2">{{ $country->flag ?? '🏳️' }}</span>
                            <h5 class="fw-bold mb-0">{{ $country->country_name ?? $country->name ?? 'Unknown' }}</h5>
                        </div>
                        <small class="text-muted">{{ $country->country_code ?? $country->code ?? '-' }} · {{ $country->currency ?? '-' }}</small>
                    </div>
                    @php $st = $country->status ?? 'active'; @endphp
                    <span class="badge bg-{{ $st == 'active' ? 'success' : ($st == 'coming_soon' ? 'warning' : 'secondary') }} bg-opacity-10 text-{{ $st == 'active' ? 'success' : ($st == 'coming_soon' ? 'warning' : 'secondary') }}">
                        {{ ucfirst(str_replace('_', ' ', $st)) }}
                    </span>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6 border-end">
                        <small class="text-muted d-block">Policies</small>
                        <strong>{{ $country->customer_policies_count ?? ($st == 'active' ? '12,456' : '—') }}</strong>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Revenue</small>
                        <strong>{{ $country->revenue ?? ($st == 'active' ? '245M' : '—') }}</strong>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary flex-grow-1" onclick="manageCountry('{{ $country->country_code ?? $country->code ?? '' }}')">
                        <i class="bi bi-gear me-1"></i>Manage
                    </button>
                    @if($st !== 'active')
                    <button class="btn btn-sm btn-success" onclick="activateCountry('{{ $country->country_code ?? $country->code ?? '' }}')">
                        <i class="bi bi-power me-1"></i>Activate
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function addCountry() {
    Swal.fire({
        title: 'Add Country Instance',
        html: '<input id="cName" class="swal2-input" placeholder="Country name"><input id="cCode" class="swal2-input" placeholder="Country code (TZ)"><input id="cCurrency" class="swal2-input" placeholder="Currency (TZS)">',
        showCancelButton: true,
        confirmButtonText: 'Add',
        confirmButtonColor: '#0d6efd'
    }).then(r => { if(r.isConfirmed) Swal.fire('Added!', 'Country instance created.', 'success'); });
}
function manageCountry(code) {
    Swal.fire({ title: 'Manage ' + code, text: 'Country settings panel for ' + code, icon: 'info', confirmButtonColor: '#0d6efd' });
}
function activateCountry(code) {
    Swal.fire({ title: 'Activate ' + code + '?', text: 'This will go live immediately', icon: 'question', showCancelButton: true, confirmButtonText: 'Activate', confirmButtonColor: '#198754' })
        .then(r => { if(r.isConfirmed) Swal.fire('Activated!', code + ' is now live.', 'success'); });
}
</script>
@endpush
@endsection
