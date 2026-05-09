@extends('layouts.landing')

@section('content')
<section class="py-5 bg-white" style="margin-top: 80px;">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h6 class="text-primary fw-bold text-uppercase letter-spacing-1 mb-3">Join Our Mission | Fursa za Kazi</h6>
                <h1 class="display-4 fw-bold mb-4">Build the Future of Insurance</h1>
                <p class="lead text-secondary">We are building the future of insurance in Africa, and we need passionate, talented, and driven people to help us get there.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 border-end pe-md-5">
                <h4 class="fw-bold mb-4 text-primary">Why Join Bima Kwik?</h4>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex"><i class="bi bi-star-fill text-warning me-3"></i> <span><strong>Mission-Driven:</strong> Help millions of Africans access fair insurance.</span></li>
                    <li class="mb-3 d-flex"><i class="bi bi-cpu-fill text-info me-3"></i> <span><strong>Cutting-Edge Tech:</strong> Work with AI and cloud-native architecture.</span></li>
                    <li class="mb-3 d-flex"><i class="bi bi-people-fill text-success me-3"></i> <span><strong>Inclusive Culture:</strong> We celebrate diversity and innovation.</span></li>
                </ul>
            </div>
            <div class="col-md-6 ps-md-5">
                <h4 class="fw-bold mb-4 text-primary">Kwa Nini Ujiunge Nasi?</h4>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex"><i class="bi bi-star-fill text-warning me-3"></i> <span><strong>Kazi yenye Lengo:</strong> Saidia mamilioni ya Waafrika kupata bima.</span></li>
                    <li class="mb-3 d-flex"><i class="bi bi-cpu-fill text-info me-3"></i> <span><strong>Teknolojia ya Kisasa:</strong> Fanya kazi na AI na mifumo ya kisasa.</span></li>
                    <li class="mb-3 d-flex"><i class="bi bi-people-fill text-success me-3"></i> <span><strong>Utamaduni Shirikishi:</strong> Tunathamini utofauti na uvumbuzi.</span></li>
                </ul>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <h3 class="fw-bold mb-4">Open Positions | Nafasi Zilizo Wazi</h3>
                <div class="table-responsive">
                    <table class="table table-hover border">
                        <thead class="bg-light">
                            <tr>
                                <th>Position | Nafasi</th>
                                <th>Location | Mahali</th>
                                <th>Type | Aina</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">Senior Software Engineer (Backend)</td>
                                <td>Dar es Salaam</td>
                                <td><span class="badge bg-primary">Full-time</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Regional Sales Manager</td>
                                <td>Arusha / Mwanza</td>
                                <td><span class="badge bg-primary">Full-time</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">UI/UX Designer</td>
                                <td>Remote / Dar es Salaam</td>
                                <td><span class="badge bg-primary">Full-time</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Graduate Trainee – Technology</td>
                                <td>Dar es Salaam</td>
                                <td><span class="badge bg-info">6 Months</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-primary text-white p-5 rounded-5 text-center shadow-lg">
            <h3 class="fw-bold mb-3">How to Apply | Jinsi ya Kutuma Maombi</h3>
            <p class="mb-4 opacity-90">Send your CV and cover letter to: <strong>careers@bimakwik.com</strong></p>
            <div class="small opacity-75">
                <p class="mb-1">Subject: Position Title – Your Full Name</p>
                <p>Example: Senior Software Engineer – James Omondi</p>
            </div>
        </div>
    </div>
</section>
@endsection
