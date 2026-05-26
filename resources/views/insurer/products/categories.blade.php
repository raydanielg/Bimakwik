@extends('layouts.dashboard')
@section('dashboard_content')
@include('insurer._partials.page-header', ['pageTitle' => 'Product Categories', 'pageSubtitle' => 'Organize products into categories', 'pageIcon' => 'collection',
    'pageAction' => '<button class="btn btn-primary" onclick="Swal.fire({title:\'Add Category\',input:\'text\',inputPlaceholder:\'Category name\',showCancelButton:true,confirmButtonColor:\'#0d6efd\'})"><i class="bi bi-plus-lg me-1"></i>New Category</button>'])

<div class="row g-3">
    @forelse($categories as $cat)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="fw-bold mb-0">{{ $cat->name ?? 'Category' }}</h6>
                    <span class="badge bg-primary bg-opacity-10 text-primary">{{ $cat->products_count ?? 0 }} products</span>
                </div>
                <p class="small text-muted mb-2">{{ $cat->description ?? 'Product category' }}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">@include('insurer._partials.empty-state', ['emptyIcon' => 'collection', 'emptyTitle' => 'No categories', 'emptyText' => 'Create product categories to organize your catalog'])</div>
    @endforelse
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
