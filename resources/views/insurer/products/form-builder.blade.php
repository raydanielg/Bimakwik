@extends('layouts.dashboard')
@section('dashboard_content')
@include('insurer._partials.page-header', ['pageTitle' => 'Dynamic Form Builder', 'pageSubtitle' => 'Build custom application & quote forms', 'pageIcon' => 'ui-checks-grid',
    'pageAction' => '<button class="btn btn-primary" onclick="Swal.fire(\'Form Builder\',\'Drag-and-drop builder coming soon\',\'info\')"><i class="bi bi-plus-lg me-1"></i>New Form</button>'])
<div class="row g-3">
    @forelse($forms as $form)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="fw-bold mb-0">{{ $form->name ?? 'Form' }}</h6>
                    <i class="bi bi-ui-checks text-primary fs-5"></i>
                </div>
                <p class="small text-muted mb-3">{{ $form->description ?? 'Dynamic form' }}</p>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary flex-grow-1"><i class="bi bi-pencil me-1"></i>Edit</button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">@include('insurer._partials.empty-state', ['emptyIcon' => 'ui-checks-grid', 'emptyTitle' => 'No forms yet', 'emptyText' => 'Build dynamic forms for your products'])</div>
    @endforelse
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
