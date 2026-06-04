@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">Workflow Management</h2>
                <p class="text-muted small mb-0">Design and manage automated workflows</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createWorkflowModal">
                <i class="bi bi-plus-circle me-2"></i>Create Workflow
            </button>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Active Workflows</p>
                        <h3 class="fw-bold mb-0">{{ $workflows->where('status', 'active')->count() }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-lightning-charge text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Workflows</p>
                        <h3 class="fw-bold mb-0">{{ $workflows->total() }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-play-circle text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Inactive Workflows</p>
                        <h3 class="fw-bold mb-0">{{ $workflows->where('status', 'inactive')->count() }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-graph-up text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">This Page</p>
                        <h3 class="fw-bold mb-0">{{ $workflows->count() }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    @forelse($workflows as $workflow)
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $workflow->name ?? ('Workflow #' . $workflow->id) }}</h5>
                        <small class="text-muted">
                            <i class="bi bi-lightning me-1"></i>Trigger: {{ $workflow->trigger ?? $workflow->trigger_event ?? 'N/A' }}
                        </small>
                    </div>
                    <span class="badge bg-{{ ($workflow->status ?? 'inactive') == 'active' ? 'success' : 'secondary' }} bg-opacity-10 text-{{ ($workflow->status ?? 'inactive') == 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst($workflow->status ?? 'inactive') }}
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Created {{ optional($workflow->created_at)->format('M d, Y') ?? 'N/A' }}</small>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-outline-info" title="View Logs">
                            <i class="bi bi-list-ul"></i>
                        </button>
                        <form id="delete-workflow-{{ $workflow->id }}" method="POST" action="{{ route('admin.operations.workflows.delete', $workflow->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-outline-danger" title="Delete" onclick="confirmDelete('delete-workflow-{{ $workflow->id }}')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-diagram-3 fs-1 text-muted d-block mb-3"></i>
                <p class="text-muted mb-0">No workflows found</p>
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($workflows->hasPages())
<div class="mt-4 d-flex justify-content-end">
    {{ $workflows->links() }}
</div>
@endif

<!-- Create Workflow Modal -->
<div class="modal fade" id="createWorkflowModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">Create New Workflow</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Workflow Name</label>
                        <input type="text" class="form-control" placeholder="e.g., Policy Approval Process" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Trigger Event</label>
                        <select class="form-select" required>
                            <option value="">Select trigger...</option>
                            <option>New Policy Created</option>
                            <option>Claim Submitted</option>
                            <option>Payment Received</option>
                            <option>Document Uploaded</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" rows="3" placeholder="Describe what this workflow does..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="Swal.fire('Success!', 'Workflow created', 'success')">
                    <i class="bi bi-check-circle me-2"></i>Create Workflow
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
