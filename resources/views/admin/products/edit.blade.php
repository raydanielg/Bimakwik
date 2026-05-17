@extends('layouts.dashboard')

@section('dashboard_title', 'Edit Product')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Edit Product</h4>
    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.update', $product) }}">
            @csrf
            @method('PUT')
            @include('admin.products._form')
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
