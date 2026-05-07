<footer class="bg-dark text-white pt-5 pb-4 mt-auto">
    <div class="container text-center text-md-start">
        <div class="row text-center text-md-start">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-primary">
                    <img src="{{ asset('logo.png') }}" alt="Logo" height="30" class="me-2 brightness-0 invert">
                    {{ config('app.name', 'BimaKwik') }}
                </h5>
                <p class="text-secondary">
                    We provide top-notch digital insurance services. Simple, fast, and reliable for your everyday life.
                </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Quick Links</h5>
                <p><a href="#" class="text-secondary text-decoration-none hover-white">Services</a></p>
                <p><a href="#" class="text-secondary text-decoration-none hover-white">About Us</a></p>
                <p><a href="#" class="text-secondary text-decoration-none hover-white">Careers</a></p>
                <p><a href="#" class="text-secondary text-decoration-none hover-white">Blog</a></p>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Support</h5>
                <p><a href="#" class="text-secondary text-decoration-none hover-white">Help Center</a></p>
                <p><a href="#" class="text-secondary text-decoration-none hover-white">Terms of Use</a></p>
                <p><a href="#" class="text-secondary text-decoration-none hover-white">Privacy Policy</a></p>
                <p><a href="#" class="text-secondary text-decoration-none hover-white">Contact</a></p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 text-secondary">
                <h5 class="text-uppercase mb-4 font-weight-bold text-white">Contact</h5>
                <p><i class="bi bi-house-door me-2"></i> Dar es Salaam, Tanzania</p>
                <p><i class="bi bi-envelope me-2"></i> info@bimakwik.com</p>
                <p><i class="bi bi-telephone me-2"></i> +255 123 456 789</p>
            </div>
        </div>

        <hr class="mb-4 opacity-25">

        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8 text-secondary">
                <p> &copy; {{ date('Y') }} {{ config('app.name', 'BimaKwik') }}. All rights reserved.</p>
            </div>
            <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-end">
                    <ul class="list-unstyled list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-twitter-x"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-instagram"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .hover-white:hover { color: white !important; }
    .brightness-0 { filter: brightness(0); }
    .invert { filter: invert(1); }
</style>
