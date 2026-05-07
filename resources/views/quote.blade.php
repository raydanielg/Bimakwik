@extends('layouts.landing')

@section('content')
<section class="py-5 bg-light">
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 animate__animated animate__fadeInDown">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 d-none d-md-block" style="background: url('/serious-expert-expressing-support-colleague.jpg') center/cover;">
                            <div class="h-100 w-100 p-5 d-flex flex-column justify-content-end" style="background: linear-gradient(transparent, rgba(0, 74, 153, 0.9));">
                                <h2 class="text-white fw-bold">Ready to secure your future?</h2>
                                <p class="text-white-50">Fill out the form and our experts will get back to you with a personalized quote within 24 hours.</p>
                            </div>
                        </div>
                        <div class="col-md-7 p-5 bg-white">
                            <div class="mb-4">
                                <h3 class="fw-bold mb-2">Request a Quote</h3>
                                <p class="text-secondary small">Experience the ease of digital insurance with BimaKwik.</p>
                            </div>

                            <form action="#" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Full Name</label>
                                        <input type="text" class="form-control form-control-lg bg-light border-0 px-3" placeholder="John Doe" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Email Address</label>
                                        <input type="email" class="form-control form-control-lg bg-light border-0 px-3" placeholder="name@example.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Phone Number</label>
                                        <input type="tel" class="form-control form-control-lg bg-light border-0 px-3" placeholder="+255 --- --- ---" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Insurance Type</label>
                                        <select class="form-select form-select-lg bg-light border-0 px-3" required>
                                            <option value="" selected disabled>Choose type...</option>
                                            <option>Motor Insurance</option>
                                            <option>Health Insurance</option>
                                            <option>Life Insurance</option>
                                            <option>Fire Insurance</option>
                                            <option>Travel Insurance</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Additional Message (Optional)</label>
                                        <textarea class="form-control bg-light border-0 px-3" rows="3" placeholder="Tell us more about your needs..."></textarea>
                                    </div>
                                    <div class="col-12 mt-4 text-end">
                                        <button type="submit" class="btn-quote-custom">
                                            <span>Request a Quote</span>
                                            <div class="icon-circle">
                                                <i class="bi bi-chevron-right"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
