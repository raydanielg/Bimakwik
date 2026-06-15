@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'Commission Rates',
        'subtitle' => 'Configure commission rates for your products and distribution channels',
        'icon' => 'bi-percent'
    ])

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-percent text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Total Rates</h6>
                            <h4 class="mb-0 fw-bold">{{ $rates->total() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-check-circle text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Active</h6>
                            <h4 class="mb-0 fw-bold">{{ $rates->where('is_active', true)->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-stop-circle text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted small">Inactive</h6>
                            <h4 class="mb-0 fw-bold">{{ $rates->where('is_active', false)->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRateModal">
                <i class="bi bi-plus-lg me-1"></i> Add Rate
            </button>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Channel</th>
                            <th>Category/Product</th>
                            <th>Type</th>
                            <th>Rate</th>
                            <th>Premium Range</th>
                            <th>Effective</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rates as $rate)
                        <tr>
                            <td><span class="badge bg-info">{{ $rate->channel_type }}</span></td>
                            <td class="small">{{ $rate->product?->product_name ?? $rate->category?->category_name ?? 'All Products' }}</td>
                            <td>{{ $rate->rate_type }}</td>
                            <td class="fw-semibold">{{ $rate->rate_type === 'percentage' ? $rate->rate_value . '%' : 'TZS ' . number_format($rate->rate_value, 0) }}</td>
                            <td class="small">
                                @if($rate->min_premium_amount || $rate->max_premium_amount)
                                    TZS {{ number_format($rate->min_premium_amount ?? 0, 0) }} - TZS {{ number_format($rate->max_premium_amount ?? 0, 0) }}
                                @else
                                    All
                                @endif
                            </td>
                            <td class="small">
                                {{ $rate->effective_from ? $rate->effective_from->format('d/m/Y') : '∞' }}
                                → {{ $rate->effective_to ? $rate->effective_to->format('d/m/Y') : '∞' }}
                            </td>
                            <td>
                                <span class="badge bg-{{ $rate->is_active ? 'success' : 'secondary' }}">
                                    {{ $rate->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-primary" onclick="editRate({{ $rate->id }})" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('insurer.network.commission-rates.toggle', $rate) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-outline-{{ $rate->is_active ? 'warning' : 'success' }}" title="{{ $rate->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="bi bi-{{ $rate->is_active ? 'pause' : 'play' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('insurer.network.commission-rates.destroy', $rate) }}" method="POST"
                                          class="d-inline" onsubmit="return confirm('Delete this rate?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center py-5 text-muted">No rates configured.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($rates->hasPages())
        <div class="card-footer bg-white">{{ $rates->links() }}</div>
        @endif
    </div>
</div>

<!-- Add Rate Modal -->
<div class="modal fade" id="addRateModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('insurer.network.commission-rates.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle me-1"></i> Add Commission Rate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Channel *</label>
                        <select name="channel_type" class="form-select" required>
                            <option value="">Select channel</option>
                            <option value="agent">Agent</option>
                            <option value="broker">Broker</option>
                            <option value="bancassurance">Bancassurance</option>
                            <option value="sfe">SFE</option>
                            <option value="direct">Direct</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rate Type *</label>
                        <select name="rate_type" class="form-select" required>
                            <option value="percentage">Percentage (%)</option>
                            <option value="fixed">Fixed Amount (TZS)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rate Value *</label>
                        <input type="number" name="rate_value" class="form-control" step="0.0001" min="0" max="999.9999" required
                               placeholder="e.g. 10 for 10% or 50000 for TZS">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Policy Category</label>
                        <select name="policy_category_id" class="form-select">
                            <option value="">All categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product (specific)</label>
                        <select name="insurance_product_id" class="form-select">
                            <option value="">All products</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label">Min Premium</label>
                            <input type="number" name="min_premium_amount" class="form-control" min="0" placeholder="TZS">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Max Premium</label>
                            <input type="number" name="max_premium_amount" class="form-control" min="0" placeholder="TZS">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Rate Modal -->
<div class="modal fade" id="editRateModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="editRateForm">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><i class="bi bi-pencil me-1"></i> Edit Commission Rate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Channel *</label>
                        <select name="channel_type" id="edit_channel_type" class="form-select" required>
                            <option value="agent">Agent</option>
                            <option value="broker">Broker</option>
                            <option value="bancassurance">Bancassurance</option>
                            <option value="sfe">SFE</option>
                            <option value="direct">Direct</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rate Type *</label>
                        <select name="rate_type" id="edit_rate_type" class="form-select" required>
                            <option value="percentage">Percentage (%)</option>
                            <option value="fixed">Fixed Amount (TZS)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rate Value *</label>
                        <input type="number" name="rate_value" id="edit_rate_value" class="form-control" step="0.0001" min="0" max="999.9999" required>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label">Min Premium</label>
                            <input type="number" name="min_premium_amount" id="edit_min_premium" class="form-control" min="0" placeholder="TZS">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Max Premium</label>
                            <input type="number" name="max_premium_amount" id="edit_max_premium" class="form-control" min="0" placeholder="TZS">
                        </div>
                    </div>
                    <div class="form-check mt-3">
                        <input type="checkbox" name="is_active" id="edit_is_active" class="form-check-input" value="1">
                        <label class="form-check-label" for="edit_is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
const ratesData = @json($rates->items());

function editRate(id) {
    const rate = ratesData.find(r => r.id === id);
    if (!rate) { alert('Rate not found'); return; }

    document.getElementById('edit_channel_type').value = rate.channel_type;
    document.getElementById('edit_rate_type').value = rate.rate_type;
    document.getElementById('edit_rate_value').value = rate.rate_value;
    document.getElementById('edit_min_premium').value = rate.min_premium_amount || '';
    document.getElementById('edit_max_premium').value = rate.max_premium_amount || '';
    document.getElementById('edit_is_active').checked = rate.is_active;

    document.getElementById('editRateForm').action = '{{ url('insurer/network/commission-rates') }}/' + id;

    new bootstrap.Modal(document.getElementById('editRateModal')).show();
}
</script>
@endpush
