@extends('layouts.landing')

@section('content')
<section class="py-5 bg-dark text-white" style="margin-top: 80px; background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('/hero/smiling-man-purchasing-clothes-internet-with-credit-card_482257-92484.jpg'); background-size: cover; background-position: center;">
    <div class="container py-5 text-center">
        <h6 class="text-warning fw-bold text-uppercase mb-3">Affiliate Program | Mpango wa Ushiriki</h6>
        <h1 class="display-3 fw-bold mb-4">Earn with Bima Kwik</h1>
        <p class="lead opacity-75 mx-auto mb-5" style="max-width: 700px;">Share Bima Kwik with your network and earn competitive commissions for every successful policy purchase made through your unique link.</p>
        <a href="{{ route('register.customer') }}" class="btn btn-warning btn-lg px-5 rounded-pill fw-bold shadow">Apply to Join</a>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="p-4">
                    <div class="h1 text-primary fw-bold mb-2">1. Join</div>
                    <p class="text-muted">Sign up for our affiliate program and get your unique referral link.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4">
                    <div class="h1 text-primary fw-bold mb-2">2. Share</div>
                    <p class="text-muted">Promote Bima Kwik on your website, social media, or via email.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4">
                    <div class="h1 text-primary fw-bold mb-2">3. Earn</div>
                    <p class="text-muted">Receive a commission for every policy purchased through your link.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
