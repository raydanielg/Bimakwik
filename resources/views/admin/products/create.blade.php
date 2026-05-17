@extends('layouts.dashboard')

@section('dashboard_title', 'Create Product')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Create Product</h4>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            @include('admin.products._form')
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
