@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Our Journey | Hadithi Yetu</h6>
                <h1 class="display-4 fw-bold mb-4">Building Africa's Smartest Insurance Ecosystem</h1>
                <p class="lead text-secondary">Bima Kwik was born from a simple but powerful observation: insurance in Africa was too complex, too slow, and too inaccessible.</p>
            </div>
        </div>

        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <div class="p-4 bg-light rounded-5 shadow-sm border-start border-5 border-primary">
                    <h3 class="fw-bold mb-3">Our Story</h3>
                    <p class="text-muted">In 2022, a group of experienced technologists and insurance professionals came together with a shared vision: make insurance work for everyone, instantly.</p>
                    <p class="text-muted">The name <strong>"Bima Kwik"</strong> means "Insurance Quick" in Swahili. It represents our promise: fast, simple, and reliable insurance access through a single digital platform.</p>
                </div>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <div class="p-4 bg-primary text-white rounded-5 shadow-lg">
                    <h3 class="fw-bold mb-3">Hadithi Yetu</h3>
                    <p class="opacity-90">Bima Kwik ilizaliwa kutokana na uchunguzi mmoja rahisi: bima barani Afrika ilikuwa ngumu sana, polepole, na haikufiki kwa watu wa kawaida na biashara.</p>
                    <p class="opacity-90">Jina <strong>"Bima Kwik"</strong> linamaanisha "Insurance Quick" kwa Kiswahili. Inawakilisha ahadi yetu: haraka, rahisi, na kuaminika kupitia jukwaa moja la kidijitali.</p>
                </div>
            </div>
        </div>

        <div class="row py-5 bg-light rounded-5 px-4 mb-5">
            <div class="col-md-6 border-end">
                <h4 class="fw-bold mb-4 text-primary"><i class="bi bi-exclamation-triangle me-2"></i> The Problem | Tatizo</h4>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex"><i class="bi bi-x-circle text-danger me-3 mt-1"></i> <span>Long paperwork and slow claims processing. / Nyaraka nyingi na usindikaji wa polepole wa madai.</span></li>
                    <li class="mb-3 d-flex"><i class="bi bi-x-circle text-danger me-3 mt-1"></i> <span>Confusion for brokers and agents managing clients. / Kuchanganyikiwa kwa brokers na mawakala katika kusimamia wateja.</span></li>
                    <li class="mb-3 d-flex"><i class="bi bi-x-circle text-danger me-3 mt-1"></i> <span>Slow payments for hospitals and garages. / Malipo ya polepole kwa hospitali na gereji.</span></li>
                </ul>
            </div>
            <div class="col-md-6 ps-md-5 mt-4 mt-md-0">
                <h4 class="fw-bold mb-4 text-success"><i class="bi bi-check-circle me-2"></i> The Solution | Suluhu</h4>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex"><i class="bi bi-check-lg text-success me-3 mt-1"></i> <span>Buy insurance in minutes and file claims instantly. / Nunua bima kwa dakika na wasilisha madai papo hapo.</span></li>
                    <li class="mb-3 d-flex"><i class="bi bi-check-lg text-success me-3 mt-1"></i> <span>Powerful platform for brokers to earn transparently. / Jukwaa lenye nguvu kwa brokers kupata tume kwa uwazi.</span></li>
                    <li class="mb-3 d-flex"><i class="bi bi-check-lg text-success me-3 mt-1"></i> <span>Real-time visibility for regulators. / Muono wa wakati halisi kwa wadhibiti.</span></li>
                </ul>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-12 mb-5">
                <h3 class="fw-bold">Our Journey So Far | Safari Yetu</h3>
            </div>
            <div class="col-md-2 col-6 mb-4">
                <h5 class="fw-bold text-primary">2022</h5>
                <p class="small text-muted">Idea Conception<br>Wazo</p>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <h5 class="fw-bold text-primary">2023</h5>
                <p class="small text-muted">Platform Development<br>Uundaji wa Mfumo</p>
            </div>
            <div class="col-md-2 col-6 mb-4">
                <h5 class="fw-bold text-primary">2024</h5>
                <p class="small text-muted">Pilot Launch<br>Uzinduzi wa Majaribio</p>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <h5 class="fw-bold text-primary">2025</h5>
                <p class="small text-muted">Full Rollout<br>Uzinduzi Kamili</p>
            </div>
            <div class="col-md-2 col-12 mb-4">
                <h5 class="fw-bold text-primary">2026+</h5>
                <p class="small text-muted">African Expansion<br>Upanuzi Afrika</p>
            </div>
        </div>
    </div>
</section>
@endsection
