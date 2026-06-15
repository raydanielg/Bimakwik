@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Assign TIRAMIS Codes</h4>
        <small class="text-muted">Bulk assign company codes and sales codes to entities</small>
    </div>
    <div>
        <a href="{{ route('admin.tiramis.codes.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Codes
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.tiramis.codes.assign') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Entity Type <span class="text-danger">*</span></label>
                    <select name="entity_type" class="form-select" required>
                        <option value="">Select type...</option>
                        <option value="insurer">Insurer (Company Code)</option>
                        <option value="broker">Broker (Sales Code)</option>
                        <option value="agent">Agent / SFE / Bancassurance (Sales Code)</option>
                        <option value="provider">Service Provider (Company Code)</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Code Prefix <span class="text-danger">*</span></label>
                    <input type="text" name="code_prefix" class="form-control" required placeholder="e.g. TZ" maxlength="10">
                    <div class="form-text">Prefix for auto-generated codes (e.g. TZ, KE, UG)</div>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">
                        <i class="bi bi-check2-circle me-1"></i> Assign Codes
                    </button>
                </div>
            </div>

            <hr class="my-4">

            <h6 class="fw-semibold mb-3">Select entities to assign codes to:</h6>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border">
                        <div class="card-header bg-light">
                            <div class="form-check">
                                <input class="form-check-input select-all" type="checkbox" data-target="insurer-checkboxes">
                                <label class="form-check-label fw-semibold">Insurers ({{ $insurers->count() }} without codes)</label>
                            </div>
                        </div>
                        <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                            @forelse($insurers as $ins)
                            <div class="form-check">
                                <input class="form-check-input insurer-checkboxes" type="checkbox" name="entity_ids[]" value="{{ $ins->id }}">
                                <label class="form-check-label">{{ $ins->insurer_name }} ({{ $ins->insurer_code }})</label>
                            </div>
                            @empty
                            <small class="text-muted">All insurers already have codes</small>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border">
                        <div class="card-header bg-light">
                            <div class="form-check">
                                <input class="form-check-input select-all" type="checkbox" data-target="broker-checkboxes">
                                <label class="form-check-label fw-semibold">Brokers ({{ $brokers->count() }} without codes)</label>
                            </div>
                        </div>
                        <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                            @forelse($brokers as $br)
                            <div class="form-check">
                                <input class="form-check-input broker-checkboxes" type="checkbox" name="entity_ids[]" value="{{ $br->id }}">
                                <label class="form-check-label">{{ $br->company_name }} ({{ $br->broker_number }})</label>
                            </div>
                            @empty
                            <small class="text-muted">All brokers already have codes</small>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border">
                        <div class="card-header bg-light">
                            <div class="form-check">
                                <input class="form-check-input select-all" type="checkbox" data-target="agent-checkboxes">
                                <label class="form-check-label fw-semibold">Agents ({{ $agents->count() }} without codes)</label>
                            </div>
                        </div>
                        <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                            @forelse($agents as $ag)
                            <div class="form-check">
                                <input class="form-check-input agent-checkboxes" type="checkbox" name="entity_ids[]" value="{{ $ag->id }}">
                                <label class="form-check-label">{{ $ag->first_name }} {{ $ag->last_name }} ({{ $ag->agent_number }})</label>
                            </div>
                            @empty
                            <small class="text-muted">All agents already have codes</small>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border">
                        <div class="card-header bg-light">
                            <div class="form-check">
                                <input class="form-check-input select-all" type="checkbox" data-target="provider-checkboxes">
                                <label class="form-check-label fw-semibold">Service Providers ({{ $providers->count() }} without codes)</label>
                            </div>
                        </div>
                        <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                            @forelse($providers as $sp)
                            <div class="form-check">
                                <input class="form-check-input provider-checkboxes" type="checkbox" name="entity_ids[]" value="{{ $sp->id }}">
                                <label class="form-check-label">{{ $sp->provider_name }} ({{ $sp->provider_code }})</label>
                            </div>
                            @empty
                            <small class="text-muted">All providers already have codes</small>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.select-all').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var target = this.dataset.target;
        document.querySelectorAll('.' + target).forEach(function(cb) {
            cb.checked = checkbox.checked;
        });
    });
});
</script>
@endpush
@endsection
