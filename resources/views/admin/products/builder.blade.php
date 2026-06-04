@extends('layouts.dashboard')

@section('dashboard_title', 'Low-Code Builder')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Low-Code Product Builder</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary">
            <i class="bi bi-plus-circle me-2"></i>Standard Create Form
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Product List
        </a>
    </div>
</div>

<div class="alert alert-info border-0 mb-4">
    <i class="bi bi-magic me-2"></i>
    Use this builder to quickly scaffold a product from a template, then fine-tune fields before saving.
</div>

<div class="card mb-4">
    <div class="card-body">
        <h6 class="mb-3">Template Starter</h6>
        <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-sm btn-outline-primary" data-template="motor">Motor Basic</button>
            <button type="button" class="btn btn-sm btn-outline-primary" data-template="health">Health Basic</button>
            <button type="button" class="btn btn-sm btn-outline-primary" data-template="travel">Travel Basic</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-template="clear">Clear</button>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.store') }}" id="builderForm">
            @csrf
            @include('admin.products._form')
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Build & Save Product</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    const templates = {
        motor: {
            product_name: 'Motor Protect Basic',
            product_code: 'MOTOR-BASIC',
            description: 'Starter motor insurance product with core third-party and accident protection.',
            base_premium: '120000',
            min_age: '18',
            max_age: '75',
            benefits: 'Third-party liability\nAccidental damage\nEmergency towing',
            exclusions: 'Racing use\nDriving without valid license',
            premium_calculation_logic: '{\n  "factors": ["vehicle_value", "driver_age", "claims_history"],\n  "formula": "base_premium * risk_multiplier"\n}'
        },
        health: {
            product_name: 'Health Cover Starter',
            product_code: 'HEALTH-START',
            description: 'Starter health plan covering outpatient and inpatient limits.',
            base_premium: '240000',
            min_age: '0',
            max_age: '80',
            benefits: 'Outpatient cover\nInpatient cover\nEmergency care',
            exclusions: 'Cosmetic procedures\nPre-existing conditions waiting period',
            premium_calculation_logic: '{\n  "factors": ["age_band", "family_size", "region"],\n  "formula": "base_premium + age_loading + family_loading"\n}'
        },
        travel: {
            product_name: 'Travel Secure Basic',
            product_code: 'TRAVEL-BASIC',
            description: 'Starter travel product for trip cancellation, baggage loss, and medical emergencies.',
            base_premium: '85000',
            min_age: '1',
            max_age: '85',
            benefits: 'Trip cancellation\nMedical emergency\nBaggage loss',
            exclusions: 'High-risk sports\nWar and civil unrest',
            premium_calculation_logic: '{\n  "factors": ["destination_zone", "trip_duration", "traveler_age"],\n  "formula": "base_premium * zone_multiplier * duration_factor"\n}'
        },
        clear: {
            product_name: '',
            product_code: '',
            description: '',
            base_premium: '',
            min_age: '',
            max_age: '',
            benefits: '',
            exclusions: '',
            premium_calculation_logic: ''
        }
    };

    document.querySelectorAll('[data-template]').forEach((btn) => {
        btn.addEventListener('click', function () {
            const key = this.getAttribute('data-template');
            const data = templates[key];
            if (!data) return;

            Object.keys(data).forEach((field) => {
                const el = document.getElementById(field);
                if (el) el.value = data[field];
            });
        });
    });
})();
</script>
@endpush
