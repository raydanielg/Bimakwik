@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white">
    <div class="container py-5 mt-5">
        <div class="text-center mb-5 animate__animated animate__fadeIn">
            <h1 class="display-4 fw-bold">Contact Us</h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Have questions or need assistance? Reach out to us through any of the following channels.</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-5 animate__animated animate__fadeInLeft">
                <div class="card border-0 shadow-sm rounded-4 p-5 h-100 bg-primary text-white">
                    <h3 class="fw-bold mb-4">Contact Information</h3>
                    <p class="mb-5 opacity-75">We are here to provide you with more information, answer any questions you may have and create an effective solution for your insurance needs.</p>
                    
                    <div class="d-flex align-items-center mb-4 gap-3">
                        <div class="icon-circle bg-white text-primary">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Address</h6>
                            <p class="mb-0 small opacity-75">Bima Complex, Posta mpya, Dar es Salaam</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-4 gap-3">
                        <div class="icon-circle bg-white text-primary">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Phone</h6>
                            <p class="mb-0 small opacity-75">+255 762 883 065</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-4 gap-3">
                        <div class="icon-circle bg-white text-primary">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Email</h6>
                            <p class="mb-0 small opacity-75">info@bimakwik.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 animate__animated animate__fadeInRight">
                <div class="card border-0 shadow-sm rounded-4 p-5">
                    <h3 class="fw-bold mb-4">Send us a Message</h3>
                    <form action="#" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Your Name</label>
                                <input type="text" class="form-control bg-light border-0 px-3" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Your Email</label>
                                <input type="email" class="form-control bg-light border-0 px-3" placeholder="john@example.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Subject</label>
                                <input type="text" class="form-control bg-light border-0 px-3" placeholder="I have a question about..." required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Message</label>
                                <textarea class="form-control bg-light border-0 px-3" rows="5" placeholder="Write your message here..." required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 fw-bold w-100">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
</style>
@endsection
