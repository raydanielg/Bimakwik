@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white">
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-4 animate__animated animate__fadeIn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('resources.news') }}" class="text-decoration-none">News</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $post['category'] }}</li>
                    </ol>
                </nav>

                <article class="animate__animated animate__fadeInUp">
                    <h1 class="display-5 fw-bold mb-4">{{ $post['title'] }}</h1>
                    
                    <div class="d-flex align-items-center mb-5 p-3 bg-light rounded-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-person-fill text-primary fs-4"></i>
                        </div>
                        <div class="me-auto">
                            <div class="fw-bold text-dark">{{ $post['author'] }}</div>
                            <div class="small text-muted">{{ $post['date'] }} • 5 min read</div>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-share"></i></button>
                            <button class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-bookmark"></i></button>
                        </div>
                    </div>

                    <img src="{{ $post['image'] }}" class="img-fluid rounded-4 shadow-sm mb-5 w-100" alt="{{ $post['title'] }}" style="max-height: 500px; object-fit: cover;">

                    <div class="news-content fs-5 text-secondary mb-5" style="line-height: 1.8;">
                        <p class="lead text-dark fw-medium mb-4">
                            Digital transformation is no longer a luxury but a necessity for the insurance sector in Tanzania. BimaKwik is at the forefront of this revolution.
                        </p>
                        <p>
                            {{ $post['content'] }}
                        </p>
                        <p>
                            As we look towards 2026, the integration of Artificial Intelligence and mobile-first platforms will redefine how customers interact with insurance products. The ease of access provided by platforms like BimaKwik ensures that even those in rural areas can secure their assets with just a few clicks.
                        </p>
                        <blockquote class="p-4 bg-primary bg-opacity-10 border-start border-primary border-4 rounded-3 my-5">
                            <p class="mb-0 fw-bold text-primary">"Our goal is to make insurance as easy as sending a mobile money transaction. We are building the infrastructure for the future of financial security in East Africa."</p>
                        </blockquote>
                        <p>
                            The research shows a 40% increase in digital policy issuance over the last quarter. This trend is expected to accelerate as more service providers and brokers join the ecosystem.
                        </p>
                    </div>

                    <hr class="my-5">

                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="tags">
                            <span class="badge bg-light text-secondary rounded-pill px-3 py-2 me-2">#InsuranceTech</span>
                            <span class="badge bg-light text-secondary rounded-pill px-3 py-2 me-2">#DigitalTanzania</span>
                            <span class="badge bg-light text-secondary rounded-pill px-3 py-2">#BimaKwik</span>
                        </div>
                    </div>

                    <!-- Author Bio -->
                    <div class="card border-0 bg-light rounded-4 p-4 mb-5">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="bg-white rounded-circle p-3 shadow-sm">
                                    <i class="bi bi-award-fill text-primary fs-2"></i>
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="fw-bold mb-1">About {{ $post['author'] }}</h5>
                                <p class="small text-muted mb-0">The editorial team at BimaKwik focuses on providing the most accurate and up-to-date information about the insurance industry in East Africa.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="card border-0 bg-primary text-white rounded-4 p-5 text-center">
                        <h4 class="fw-bold mb-3">Don't miss our next update</h4>
                        <p class="opacity-75 mb-4">Get the latest news and research directly in your inbox.</p>
                        <form class="d-flex gap-2 justify-content-center">
                            <input type="email" class="form-control rounded-pill px-4 border-0" placeholder="Enter your email" style="max-width: 300px;">
                            <button class="btn btn-warning rounded-pill px-4 fw-bold">Subscribe</button>
                        </form>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection
