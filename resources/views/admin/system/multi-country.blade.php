@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1">Multi-Country Management</h2>
        <p class="text-muted small mb-0">Manage operations across different countries</p>
    </div>
</div>

<div class="row g-3">
    @foreach([
        ['country' => 'Tanzania', 'code' => 'TZ', 'status' => 'active', 'policies' => '12,456', 'revenue' => '245M'],
        ['country' => 'Kenya', 'code' => 'KE', 'status' => 'coming_soon', 'policies' => '-', 'revenue' => '-'],
        ['country' => 'Uganda', 'code' => 'UG', 'status' => 'coming_soon', 'policies' => '-', 'revenue' => '-'],
    ] as $country)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $country['country'] }}</h5>
                        <small class="text-muted">{{ $country['code'] }}</small>
                    </div>
                    <span class="badge bg-{{ $country['status'] == 'active' ? 'success' : 'secondary' }} bg-opacity-10 text-{{ $country['status'] == 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst(str_replace('_', ' ', $country['status'])) }}
                    </span>
                </div>
                <div class="row g-2">
                    <div class="col-6">
                        <small class="text-muted d-block">Policies</small>
                        <strong>{{ $country['policies'] }}</strong>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Revenue</small>
                        <strong>{{ $country['revenue'] }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
