@extends('layouts.dashboard')

@section('dashboard_content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">{{ app()->getLocale() == 'sw' ? 'Mapendekezo ya AI' : 'AI Recommendations' }}</h4>
            <p class="text-muted small">{{ app()->getLocale() == 'sw' ? 'Bidhaa za bima zilizochaguliwa maalum kwa ajili yako.' : 'Insurance products specially selected for you based on your profile.' }}</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-primary text-white">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-white bg-opacity-20 rounded-circle p-3 me-3">
                        <i class="bi bi-robot fs-1"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">{{ app()->getLocale() == 'sw' ? 'Bima Kwik AI Inasema...' : 'Bima Kwik AI Says...' }}</h5>
                        <p class="mb-0 opacity-75">{{ app()->getLocale() == 'sw' ? 'Kulingana na maisha yako, unaweza kupata faida zaidi kwa kuongeza bima ya maisha.' : 'Based on your recent activity, you could benefit from adding a Life Insurance cover.' }}</p>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mb-3">{{ app()->getLocale() == 'sw' ? 'Bidhaa Zinazopendekezwa' : 'Recommended Products' }}</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                        <div class="card-body p-4">
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill mb-3">Best Value</span>
                            <h5 class="fw-bold mb-2">Health Pro Plan</h5>
                            <p class="small text-muted mb-4">Full coverage for you and your family at affordable rates.</p>
                            <a href="{{ route('customer.buy') }}" class="btn btn-primary btn-sm rounded-pill px-4">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                        <div class="card-body p-4">
                            <span class="badge bg-info bg-opacity-10 text-info rounded-pill mb-3">Popular</span>
                            <h5 class="fw-bold mb-2">Smart Life Cover</h5>
                            <p class="small text-muted mb-4">Secure your family's future with our flexible life plans.</p>
                            <a href="{{ route('customer.buy') }}" class="btn btn-primary btn-sm rounded-pill px-4">Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'sw' ? 'Kuhusu AI Yetu' : 'About Our AI' }}</h5>
                <p class="small text-muted">
                    Our AI analyzes thousands of data points to provide you with the most relevant insurance advice. We respect your privacy and only use data to improve your experience.
                </p>
                <hr>
                <h6 class="fw-bold small mb-2">Insight Score</h6>
                <div class="progress rounded-pill mb-2" style="height: 10px;">
                    <div class="progress-bar bg-success" style="width: 85%;"></div>
                </div>
                <p class="extra-small text-muted">Your profile completeness is at 85%.</p>
            </div>
        </div>
    </div>
</div>
@endsection
