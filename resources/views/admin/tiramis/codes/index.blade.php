@extends('layouts.dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">TIRAMIS Codes Management</h4>
        <small class="text-muted">Manage company codes and sales codes for TIRAMIS integration</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.tiramis.codes.assign') }}" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="bi bi-plus-circle me-1"></i> Assign Codes
        </a>
        <a href="{{ route('admin.tiramis.codes.export') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-download me-1"></i> Export
        </a>
    </div>
</div>

<ul class="nav nav-tabs mb-4" id="codeTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="insurers-tab" data-bs-toggle="tab" data-bs-target="#insurers" type="button" role="tab">
            <i class="bi bi-building me-1"></i> Insurers (Company Codes)
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="brokers-tab" data-bs-toggle="tab" data-bs-target="#brokers" type="button" role="tab">
            <i class="bi bi-briefcase me-1"></i> Brokers (Sales Codes)
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="agents-tab" data-bs-toggle="tab" data-bs-target="#agents" type="button" role="tab">
            <i class="bi bi-person-badge me-1"></i> Agents / SFE / Bancassurance
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="providers-tab" data-bs-toggle="tab" data-bs-target="#providers" type="button" role="tab">
            <i class="bi bi-hospital me-1"></i> Service Providers
        </button>
    </li>
</ul>

<div class="tab-content">
    <!-- Insurers Tab -->
    <div class="tab-pane fade show active" id="insurers" role="tabpanel">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Insurer</th>
                                <th>Insurer Code</th>
                                <th>Company Code</th>
                                <th>Sales Code</th>
                                <th>TIRAMIS</th>
                                <th>Last Sync</th>
                                <th class="pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($insurers as $ins)
                            <tr>
                                <td class="ps-3">{{ $ins->id }}</td>
                                <td class="fw-semibold">{{ $ins->insurer_name }}</td>
                                <td><code>{{ $ins->insurer_code }}</code></td>
                                <td>
                                    @if($ins->company_code)
                                        <span class="badge bg-primary bg-opacity-10 text-primary">{{ $ins->company_code }}</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($ins->sales_code)
                                        <span class="badge bg-info bg-opacity-10 text-info">{{ $ins->sales_code }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($ins->tiramis_enabled)
                                        <span class="badge bg-success bg-opacity-10 text-success">Enabled</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">Disabled</span>
                                    @endif
                                </td>
                                <td><small class="text-muted">{{ $ins->tiramis_last_sync_at?->diffForHumans() ?? 'Never' }}</small></td>
                                <td class="pe-3">
                                    <button class="btn btn-sm btn-outline-primary" onclick="editCodes({{ $ins->id }}, 'insurer', '{{ $ins->company_code ?? '' }}', '{{ $ins->sales_code ?? '' }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-{{ $ins->tiramis_enabled ? 'danger' : 'success' }}"
                                        onclick="toggleTiramis({{ $ins->id }}, 'insurer', {{ $ins->tiramis_enabled ? 'false' : 'true' }})">
                                        <i class="bi bi-{{ $ins->tiramis_enabled ? 'pause' : 'play' }}"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="8" class="text-center text-muted py-4">No insurers found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Brokers Tab -->
    <div class="tab-pane fade" id="brokers" role="tabpanel">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Company</th>
                                <th>Broker Number</th>
                                <th>Company Code</th>
                                <th>Sales Code</th>
                                <th>TIRAMIS</th>
                                <th class="pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($brokers as $br)
                            <tr>
                                <td class="ps-3">{{ $br->id }}</td>
                                <td class="fw-semibold">{{ $br->company_name }}</td>
                                <td><code>{{ $br->broker_number }}</code></td>
                                <td>
                                    @if($br->company_code)
                                        <span class="badge bg-primary bg-opacity-10 text-primary">{{ $br->company_code }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($br->sales_code)
                                        <span class="badge bg-info bg-opacity-10 text-info">{{ $br->sales_code }}</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($br->tiramis_enabled)
                                        <span class="badge bg-success">Enabled</span>
                                    @else
                                        <span class="badge bg-secondary">Disabled</span>
                                    @endif
                                </td>
                                <td class="pe-3">
                                    <button class="btn btn-sm btn-outline-primary" onclick="editCodes({{ $br->id }}, 'broker', '{{ $br->company_code ?? '' }}', '{{ $br->sales_code ?? '' }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center text-muted py-4">No brokers found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Agents Tab -->
    <div class="tab-pane fade" id="agents" role="tabpanel">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Agent Number</th>
                                <th>Company Code</th>
                                <th>Sales Code</th>
                                <th>TIRAMIS</th>
                                <th class="pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($agents as $ag)
                            <tr>
                                <td class="ps-3">{{ $ag->id }}</td>
                                <td class="fw-semibold">{{ $ag->first_name }} {{ $ag->last_name }}</td>
                                <td><span class="badge bg-light text-dark">{{ ucfirst($ag->agent_type) }}</span></td>
                                <td><code>{{ $ag->agent_number }}</code></td>
                                <td>
                                    @if($ag->company_code)
                                        <span class="badge bg-primary bg-opacity-10 text-primary">{{ $ag->company_code }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($ag->sales_code)
                                        <span class="badge bg-info bg-opacity-10 text-info">{{ $ag->sales_code }}</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($ag->tiramis_enabled)
                                        <span class="badge bg-success">Enabled</span>
                                    @else
                                        <span class="badge bg-secondary">Disabled</span>
                                    @endif
                                </td>
                                <td class="pe-3">
                                    <button class="btn btn-sm btn-outline-primary" onclick="editCodes({{ $ag->id }}, 'agent', '{{ $ag->company_code ?? '' }}', '{{ $ag->sales_code ?? '' }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="8" class="text-center text-muted py-4">No agents found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Providers Tab -->
    <div class="tab-pane fade" id="providers" role="tabpanel">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Company</th>
                                <th>Provider Number</th>
                                <th>Company Code</th>
                                <th>Sales Code</th>
                                <th class="pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($providers as $sp)
                            <tr>
                                <td class="ps-3">{{ $sp->id }}</td>
                                <td class="fw-semibold">{{ $sp->company_name }}</td>
                                <td><code>{{ $sp->provider_number }}</code></td>
                                <td>
                                    @if($sp->company_code)
                                        <span class="badge bg-primary bg-opacity-10 text-primary">{{ $sp->company_code }}</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($sp->sales_code)
                                        <span class="badge bg-info bg-opacity-10 text-info">{{ $sp->sales_code }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="pe-3">
                                    <button class="btn btn-sm btn-outline-primary" onclick="editCodes({{ $sp->id }}, 'provider', '{{ $sp->company_code ?? '' }}', '{{ $sp->sales_code ?? '' }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No service providers found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Codes Modal -->
<div class="modal fade" id="editCodesModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editCodesForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit TIRAMIS Codes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Company Code</label>
                        <input type="text" name="company_code" id="edit_company_code" class="form-control" placeholder="e.g. TZ-INS-001">
                        <div class="form-text">TIRA-assigned company identifier</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sales Code</label>
                        <input type="text" name="sales_code" id="edit_sales_code" class="form-control" placeholder="e.g. SL-AG-001">
                        <div class="form-text">Unique sales agent/broker identifier</div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="tiramis_enabled" id="edit_tiramis_enabled" class="form-check-input" value="1">
                        <label class="form-check-label" for="edit_tiramis_enabled">Enable TIRAMIS Integration</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Codes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editCodes(id, type, companyCode, salesCode) {
    document.getElementById('edit_company_code').value = companyCode;
    document.getElementById('edit_sales_code').value = salesCode;
    document.getElementById('edit_tiramis_enabled').checked = false;
    document.getElementById('editCodesForm').action = '/admin/tiramis/codes/' + type + '/' + id;
    new bootstrap.Modal(document.getElementById('editCodesModal')).show();
}

function toggleTiramis(id, type, enable) {
    if (!confirm(enable ? 'Enable TIRAMIS integration?' : 'Disable TIRAMIS integration?')) return;
    fetch('/admin/tiramis/codes/' + type + '/' + id + '/toggle', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
        body: JSON.stringify({ tiramis_enabled: enable })
    }).then(r => r.json()).then(d => { if(d.success) location.reload(); else alert(d.message); });
}
</script>
@endpush
@endsection
