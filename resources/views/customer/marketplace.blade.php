@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Soko la Bima' : 'Insurance Marketplace' }}</h4>
                <p class="text-muted small">{{ app()->getLocale() == 'sw' ? 'Gundua na ulinganishe bidhaa za bima.' : 'Discover and compare insurance products from top providers.' }}</p>
            </div>
            <div class="input-group w-auto">
                <input type="text" class="form-control rounded-start-pill border-0 shadow-sm" placeholder="Search products...">
                <button class="btn btn-primary rounded-end-pill px-4 shadow-sm"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </div>

    <div class="row g-4">
        @php
            $categories = [
                ['name' => 'Health', 'icon' => 'bi-heart-pulse', 'color' => 'danger', 'count' => 12],
                ['name' => 'Life', 'icon' => 'bi-person-vcard', 'color' => 'primary', 'count' => 8],
                ['name' => 'Motor', 'icon' => 'bi-car-front', 'color' => 'success', 'count' => 15],
                ['name' => 'Travel', 'icon' => 'bi-airplane', 'color' => 'info', 'count' => 5],
            ];
        @endphp

        @foreach($categories as $cat)
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center hover-lift h-100">
                <div class="bg-{{ $cat['color'] }} bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                    <i class="bi {{ $cat['icon'] }} text-{{ $cat['color'] }} fs-2"></i>
                </div>
                <h6 class="fw-bold mb-1">{{ $cat['name'] }}</h6>
                <p class="small text-muted mb-0">{{ $cat['count'] }} {{ app()->getLocale() == 'sw' ? 'Bidhaa' : 'Products' }}</p>
            </div>
        </div>
        @endforeach

        <div class="col-12 mt-5">
            <h5 class="fw-bold mb-4">{{ app()->getLocale() == 'sw' ? 'Bidhaa Zinazovuma' : 'Trending Products' }}</h5>
            <div class="row g-4">
                @for($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 hover-lift">
                        <div class="bg-primary bg-opacity-10 p-4 text-center">
                            <i class="bi bi-shield-check display-4 text-primary"></i>
                        </div>
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-2">Bima Kwik Secure {{ $i }}</h6>
                            <p class="small text-muted mb-4">Comprehensive coverage for your family's safety and well-being.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">TZS 50,000/yr</span>
                                <a href="{{ route('customer.buy') }}" class="btn btn-sm btn-primary rounded-pill px-3">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection
