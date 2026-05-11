<!-- Mobile Bottom Navigation -->
<div class="mobile-bottom-nav d-lg-none fixed-bottom bg-white border-top shadow-lg py-2">
    <div class="container">
        <div class="row text-center align-items-center">
            <div class="col">
                <a href="{{ route('dashboard') }}" class="mobile-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door fs-4 d-block"></i>
                    <span class="x-small fw-bold">Home</span>
                </a>
            </div>
            <div class="col">
                <a href="{{ auth()->check() && auth()->user()->hasRole('customer') ? route('customer.policies') : '#' }}" class="mobile-nav-link {{ request()->routeIs('customer.policies') ? 'active' : '' }}">
                    <i class="bi bi-shield-check fs-4 d-block"></i>
                    <span class="x-small fw-bold">Policies</span>
                </a>
            </div>
            <div class="col">
                <div class="buy-insurance-fab-wrapper">
                    <a href="#" class="mobile-nav-link buy-insurance-fab">
                        <i class="bi bi-plus-lg text-white"></i>
                    </a>
                    <span class="x-small fw-bold mt-1 d-block">Buy</span>
                </div>
            </div>
            <div class="col">
                <a href="{{ auth()->check() && auth()->user()->hasRole('customer') ? route('customer.claims') : '#' }}" class="mobile-nav-link {{ request()->routeIs('customer.claims') ? 'active' : '' }}">
                    <i class="bi bi-exclamation-octagon fs-4 d-block"></i>
                    <span class="x-small fw-bold">Claims</span>
                </a>
            </div>
            <div class="col">
                <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                    <i class="bi bi-person-circle fs-4 d-block"></i>
                    <span class="x-small fw-bold">Profile</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Menu Drawer (Offcanvas) -->
<div class="offcanvas offcanvas-start mobile-menu-drawer" tabindex="-1" id="mobileMenuDrawer" aria-labelledby="mobileMenuDrawerLabel">
    <div class="offcanvas-header bg-primary text-white p-4">
        <div class="d-flex align-items-center">
            @auth
                <div class="avatar-circle bg-white text-primary fw-bold me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 50%; font-size: 1.2rem;">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <h6 class="offcanvas-title fw-bold" id="mobileMenuDrawerLabel">{{ auth()->user()->name }}</h6>
                    <small class="opacity-75">{{ auth()->user()->email }}</small>
                </div>
            @else
                <i class="bi bi-person-circle fs-1 me-3"></i>
                <div>
                    <h6 class="offcanvas-title fw-bold">Guest User</h6>
                    <small class="opacity-75">Please login to see more</small>
                </div>
            @endauth
        </div>
        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action py-3 px-4 border-0 d-flex align-items-center">
                <i class="bi bi-wallet2 text-primary me-3 fs-5"></i> My Wallet
            </a>
            <a href="#" class="list-group-item list-group-item-action py-3 px-4 border-0 d-flex align-items-center">
                <i class="bi bi-arrow-repeat text-primary me-3 fs-5"></i> Renewals
            </a>
            <a href="#" class="list-group-item list-group-item-action py-3 px-4 border-0 d-flex align-items-center">
                <i class="bi bi-geo-alt text-primary me-3 fs-5"></i> Service Providers Near Me
            </a>
            <hr class="my-2 opacity-10">
            <a href="#" class="list-group-item list-group-item-action py-3 px-4 border-0 d-flex align-items-center">
                <i class="bi bi-bell text-primary me-3 fs-5"></i> Notifications
                <span class="badge bg-danger rounded-pill ms-auto">3</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action py-3 px-4 border-0 d-flex align-items-center">
                <i class="bi bi-gear text-primary me-3 fs-5"></i> Settings
            </a>
            <a href="#" class="list-group-item list-group-item-action py-3 px-4 border-0 d-flex align-items-center">
                <i class="bi bi-headset text-primary me-3 fs-5"></i> Support & Help
            </a>
            <hr class="my-2 opacity-10">
            <a href="#" class="list-group-item list-group-item-action py-3 px-4 border-0 d-flex align-items-center">
                <i class="bi bi-share text-primary me-3 fs-5"></i> Share App
            </a>
            <a href="#" class="list-group-item list-group-item-action py-3 px-4 border-0 d-flex align-items-center">
                <i class="bi bi-star text-primary me-3 fs-5"></i> Rate App
            </a>
            @auth
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action py-3 px-4 border-0 d-flex align-items-center text-danger">
                <i class="bi bi-box-arrow-right me-3 fs-5"></i> Logout
            </a>
            @endauth
        </div>
    </div>
</div>

<style>
    .mobile-bottom-nav {
        z-index: 1050;
        height: 70px;
    }
    .mobile-nav-link {
        text-decoration: none;
        color: #64748b;
        transition: all 0.2s;
        display: block;
    }
    .mobile-nav-link:hover, .mobile-nav-link.active {
        color: var(--bs-primary);
    }
    .x-small {
        font-size: 0.65rem;
    }
    .buy-insurance-fab-wrapper {
        position: relative;
        top: -15px;
    }
    .buy-insurance-fab {
        background: var(--bs-primary);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        border: 4px solid #fff;
    }
    .mobile-menu-drawer {
        width: 280px !important;
    }
    .mobile-menu-drawer .list-group-item:active {
        background-color: rgba(0, 123, 255, 0.05);
    }
    /* Hide on Desktop */
    @media (min-width: 992px) {
        .mobile-bottom-nav { display: none !important; }
    }
    /* Add padding to body to prevent content being hidden by nav */
    body {
        padding-bottom: 70px;
    }
    @media (min-width: 992px) {
        body { padding-bottom: 0; }
    }
</style>
