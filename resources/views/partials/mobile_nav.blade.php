@auth
@php
    $user = auth()->user();
    $role = $user->roles->first()->name ?? 'guest';
@endphp

<!-- Mobile Bottom Navigation - Role Aware -->
<div class="mobile-bottom-nav d-lg-none fixed-bottom bg-white border-top shadow-lg py-1" style="z-index:1050;">
    <div class="row text-center align-items-center g-0 px-1">

        {{-- ── CUSTOMER ── --}}
        @if($role === 'customer')
        <div class="col">
            <a href="{{ route('customer.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('customer.policies.index') }}" class="mobile-nav-link {{ request()->routeIs('customer.policies.*') ? 'active' : '' }}">
                <i class="bi bi-shield-check fs-5 d-block"></i><span class="x-small fw-semibold">Policies</span>
            </a>
        </div>
        <div class="col">
            <div style="position:relative; top:-14px;">
                <a href="{{ route('customer.buy') }}" class="mobile-fab-btn d-flex align-items-center justify-content-center mx-auto">
                    <i class="bi bi-plus-lg text-white fs-5"></i>
                </a>
                <span class="x-small fw-semibold d-block mt-1 text-muted">Buy</span>
            </div>
        </div>
        <div class="col">
            <a href="{{ route('customer.claims.create') }}" class="mobile-nav-link {{ request()->routeIs('customer.claims.*') ? 'active' : '' }}">
                <i class="bi bi-exclamation-octagon fs-5 d-block"></i><span class="x-small fw-semibold">Claims</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-person-circle fs-5 d-block"></i><span class="x-small fw-semibold">Me</span>
            </a>
        </div>

        {{-- ── SUPER ADMIN / ADMIN / SUB ADMIN ── --}}
        @elseif(in_array($role, ['super_admin', 'admin', 'sub_admin']))
        <div class="col">
            <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 fs-5 d-block"></i><span class="x-small fw-semibold">Overview</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('admin.users.index') }}" class="mobile-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill fs-5 d-block"></i><span class="x-small fw-semibold">Users</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('admin.operations.claims') }}" class="mobile-nav-link {{ request()->routeIs('admin.operations.*') ? 'active' : '' }}">
                <i class="bi bi-exclamation-octagon fs-5 d-block"></i><span class="x-small fw-semibold">Ops</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('admin.finance.premiums') }}" class="mobile-nav-link {{ request()->routeIs('admin.finance.*') ? 'active' : '' }}">
                <i class="bi bi-cash-stack fs-5 d-block"></i><span class="x-small fw-semibold">Finance</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">More</span>
            </a>
        </div>

        {{-- ── INSURER ── --}}
        @elseif($role === 'insurer')
        <div class="col">
            <a href="{{ route('insurer.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('insurer.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('insurer.products.index') }}" class="mobile-nav-link {{ request()->routeIs('insurer.products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam fs-5 d-block"></i><span class="x-small fw-semibold">Products</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('insurer.policies.index') }}" class="mobile-nav-link {{ request()->routeIs('insurer.policies.*') ? 'active' : '' }}">
                <i class="bi bi-shield-check fs-5 d-block"></i><span class="x-small fw-semibold">Policies</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('insurer.claims.index') }}" class="mobile-nav-link {{ request()->routeIs('insurer.claims.*') ? 'active' : '' }}">
                <i class="bi bi-exclamation-octagon fs-5 d-block"></i><span class="x-small fw-semibold">Claims</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">More</span>
            </a>
        </div>

        {{-- ── BROKER ── --}}
        @elseif($role === 'broker')
        <div class="col">
            <a href="{{ route('broker.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('broker.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('broker.customers') }}" class="mobile-nav-link {{ request()->routeIs('broker.customers') ? 'active' : '' }}">
                <i class="bi bi-people-fill fs-5 d-block"></i><span class="x-small fw-semibold">Customers</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('broker.policies') }}" class="mobile-nav-link {{ request()->routeIs('broker.policies') ? 'active' : '' }}">
                <i class="bi bi-shield-check fs-5 d-block"></i><span class="x-small fw-semibold">Policies</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('broker.commissions') }}" class="mobile-nav-link {{ request()->routeIs('broker.commissions') ? 'active' : '' }}">
                <i class="bi bi-cash-coin fs-5 d-block"></i><span class="x-small fw-semibold">Earnings</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">More</span>
            </a>
        </div>

        {{-- ── AGENT ── --}}
        @elseif($role === 'agent')
        <div class="col">
            <a href="{{ route('agent.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('agent.customers') }}" class="mobile-nav-link {{ request()->routeIs('agent.customers') ? 'active' : '' }}">
                <i class="bi bi-people-fill fs-5 d-block"></i><span class="x-small fw-semibold">Customers</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('agent.policies') }}" class="mobile-nav-link {{ request()->routeIs('agent.policies') ? 'active' : '' }}">
                <i class="bi bi-shield-check fs-5 d-block"></i><span class="x-small fw-semibold">Policies</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('agent.claims') }}" class="mobile-nav-link {{ request()->routeIs('agent.claims') ? 'active' : '' }}">
                <i class="bi bi-exclamation-octagon fs-5 d-block"></i><span class="x-small fw-semibold">Claims</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">More</span>
            </a>
        </div>

        {{-- ── SFE ── --}}
        @elseif($role === 'sfe')
        <div class="col">
            <a href="{{ route('sfe.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('sfe.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('sfe.customers.index') }}" class="mobile-nav-link {{ request()->routeIs('sfe.customers.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill fs-5 d-block"></i><span class="x-small fw-semibold">Customers</span>
            </a>
        </div>
        <div class="col">
            <div style="position:relative; top:-14px;">
                <a href="{{ route('sfe.policies.buy') }}" class="mobile-fab-btn d-flex align-items-center justify-content-center mx-auto">
                    <i class="bi bi-plus-lg text-white fs-5"></i>
                </a>
                <span class="x-small fw-semibold d-block mt-1 text-muted">Sell</span>
            </div>
        </div>
        <div class="col">
            <a href="{{ route('sfe.commissions.index') }}" class="mobile-nav-link {{ request()->routeIs('sfe.commissions.*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin fs-5 d-block"></i><span class="x-small fw-semibold">Earnings</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">More</span>
            </a>
        </div>

        {{-- ── BANCASSURANCE ── --}}
        @elseif($role === 'bancassurance')
        <div class="col">
            <a href="{{ route('bancassurance.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('bancassurance.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('bancassurance.customers') }}" class="mobile-nav-link {{ request()->is('bancassurance/customers*') ? 'active' : '' }}">
                <i class="bi bi-people-fill fs-5 d-block"></i><span class="x-small fw-semibold">Customers</span>
            </a>
        </div>
        <div class="col">
            <div style="position:relative; top:-14px;">
                <a href="{{ route('bancassurance.sales') }}" class="mobile-fab-btn d-flex align-items-center justify-content-center mx-auto">
                    <i class="bi bi-plus-lg text-white fs-5"></i>
                </a>
                <span class="x-small fw-semibold d-block mt-1 text-muted">Sell</span>
            </div>
        </div>
        <div class="col">
            <a href="{{ route('bancassurance.my-sales') }}" class="mobile-nav-link {{ request()->is('bancassurance/my-sales*') ? 'active' : '' }}">
                <i class="bi bi-shield-check fs-5 d-block"></i><span class="x-small fw-semibold">My Sales</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">More</span>
            </a>
        </div>

        {{-- ── SERVICE PROVIDER ── --}}
        @elseif($role === 'service_provider')
        <div class="col">
            <a href="{{ route('service-provider.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('service-provider.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('service-provider.customer.verify') }}" class="mobile-nav-link {{ request()->routeIs('service-provider.customer.*') ? 'active' : '' }}">
                <i class="bi bi-person-vcard fs-5 d-block"></i><span class="x-small fw-semibold">Verify</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('service-provider.claims.index') }}" class="mobile-nav-link {{ request()->routeIs('service-provider.claims.*') ? 'active' : '' }}">
                <i class="bi bi-exclamation-octagon fs-5 d-block"></i><span class="x-small fw-semibold">Claims</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('service-provider.payments.index') }}" class="mobile-nav-link {{ request()->routeIs('service-provider.payments.*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin fs-5 d-block"></i><span class="x-small fw-semibold">Payments</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">More</span>
            </a>
        </div>

        {{-- ── AGGREGATOR ── --}}
        @elseif($role === 'aggregator')
        <div class="col">
            <a href="{{ route('aggregator.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('aggregator.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('aggregator.products') }}" class="mobile-nav-link {{ request()->routeIs('aggregator.products*') ? 'active' : '' }}">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">Products</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('aggregator.customers') }}" class="mobile-nav-link {{ request()->routeIs('aggregator.customers') ? 'active' : '' }}">
                <i class="bi bi-people-fill fs-5 d-block"></i><span class="x-small fw-semibold">Customers</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('aggregator.commissions') }}" class="mobile-nav-link {{ request()->routeIs('aggregator.commissions') ? 'active' : '' }}">
                <i class="bi bi-cash-coin fs-5 d-block"></i><span class="x-small fw-semibold">Earnings</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">More</span>
            </a>
        </div>

        {{-- ── REGULATOR ── --}}
        @elseif($role === 'regulator')
        <div class="col">
            <a href="{{ route('regulator.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('regulator.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('regulator.compliance') }}" class="mobile-nav-link {{ request()->routeIs('regulator.compliance') ? 'active' : '' }}">
                <i class="bi bi-shield-lock fs-5 d-block"></i><span class="x-small fw-semibold">Compliance</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('regulator.analytics') }}" class="mobile-nav-link {{ request()->routeIs('regulator.analytics') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line fs-5 d-block"></i><span class="x-small fw-semibold">Analytics</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('regulator.reports') }}" class="mobile-nav-link {{ request()->routeIs('regulator.reports') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph fs-5 d-block"></i><span class="x-small fw-semibold">Reports</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">More</span>
            </a>
        </div>

        {{-- ── FINANCING PARTNER ── --}}
        @elseif($role === 'financing_partner')
        <div class="col">
            <a href="{{ route('financing-partner.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('financing-partner.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('financing-partner.requests.index') }}" class="mobile-nav-link {{ request()->routeIs('financing-partner.requests.*') ? 'active' : '' }}">
                <i class="bi bi-inboxes fs-5 d-block"></i><span class="x-small fw-semibold">Requests</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('financing-partner.disbursements.index') }}" class="mobile-nav-link {{ request()->routeIs('financing-partner.disbursements.*') ? 'active' : '' }}">
                <i class="bi bi-cash-stack fs-5 d-block"></i><span class="x-small fw-semibold">Disburse</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('financing-partner.repayments.index') }}" class="mobile-nav-link {{ request()->routeIs('financing-partner.repayments.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-repeat fs-5 d-block"></i><span class="x-small fw-semibold">Repayments</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">More</span>
            </a>
        </div>

        {{-- ── DEVELOPER ── --}}
        @elseif($role === 'developer')
        <div class="col">
            <a href="{{ route('developer.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('developer.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('developer.apps.index') }}" class="mobile-nav-link {{ request()->routeIs('developer.apps.*') ? 'active' : '' }}">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">Apps</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('developer.keys.index') }}" class="mobile-nav-link {{ request()->routeIs('developer.keys.*') ? 'active' : '' }}">
                <i class="bi bi-key fs-5 d-block"></i><span class="x-small fw-semibold">API Keys</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('developer.testing.index') }}" class="mobile-nav-link {{ request()->routeIs('developer.testing.*') ? 'active' : '' }}">
                <i class="bi bi-terminal fs-5 d-block"></i><span class="x-small fw-semibold">Console</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">More</span>
            </a>
        </div>

        {{-- ── FALLBACK ── --}}
        @else
        <div class="col">
            <a href="{{ route('dashboard') }}" class="mobile-nav-link">
                <i class="bi bi-house-door fs-5 d-block"></i><span class="x-small fw-semibold">Home</span>
            </a>
        </div>
        <div class="col">
            <a href="#" class="mobile-nav-link" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
                <i class="bi bi-grid-3x3-gap fs-5 d-block"></i><span class="x-small fw-semibold">Menu</span>
            </a>
        </div>
        @endif

    </div>
</div>

<!-- Mobile Menu Drawer (Offcanvas) - Role Aware -->
<div class="offcanvas offcanvas-start mobile-menu-drawer" tabindex="-1" id="mobileMenuDrawer" aria-labelledby="mobileMenuDrawerLabel">
    <div class="offcanvas-header p-4" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
        <div class="d-flex align-items-center w-100">
            <div class="avatar-initials me-3 d-flex align-items-center justify-content-center rounded-circle fw-bold"
                 style="width:48px; height:48px; background:rgba(255,255,255,0.15); color:#fff; font-size:1.2rem;">
                {{ substr($user->name ?? 'U', 0, 1) }}
            </div>
            <div class="flex-grow-1">
                <div class="fw-bold text-white" style="font-size:0.9rem;">{{ $user->name ?? 'User' }}</div>
                <div class="text-white-50" style="font-size:0.72rem;">{{ $user->email ?? '' }}</div>
                <span class="badge mt-1 px-2 py-1" style="background:rgba(16,185,129,0.25); color:#34d399; font-size:0.6rem; border-radius:6px; text-transform:uppercase; letter-spacing:0.5px;">
                    {{ ucfirst(str_replace('_', ' ', $role)) }}
                </span>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">

        {{-- Customer Drawer --}}
        @if($role === 'customer')
        <div class="drawer-section-title">My Insurance</div>
        <a href="{{ route('customer.wallet.index') }}" class="drawer-link"><i class="bi bi-wallet2"></i> My Wallet</a>
        <a href="{{ route('customer.policies.renewals') }}" class="drawer-link"><i class="bi bi-arrow-repeat"></i> Renewals</a>
        <a href="{{ route('customer.policies.documents') }}" class="drawer-link"><i class="bi bi-file-earmark-pdf"></i> Policy Documents</a>
        <a href="{{ route('customer.claims.track') }}" class="drawer-link"><i class="bi bi-activity"></i> Track Claims</a>
        <div class="drawer-section-title">Account</div>
        <a href="{{ route('customer.profile') }}" class="drawer-link"><i class="bi bi-person-circle"></i> My Profile & KYC</a>
        <a href="{{ route('customer.support') }}" class="drawer-link"><i class="bi bi-headset"></i> Help & Support</a>
        <a href="{{ route('customer.ai-recommendations') }}" class="drawer-link"><i class="bi bi-robot"></i> AI Recommendations</a>

        {{-- Admin Drawer --}}
        @elseif(in_array($role, ['super_admin', 'admin', 'sub_admin']))
        <div class="drawer-section-title">System</div>
        <a href="{{ route('admin.products.index') }}" class="drawer-link"><i class="bi bi-box-seam"></i> Products</a>
        <a href="{{ route('admin.governance.compliance') }}" class="drawer-link"><i class="bi bi-shield-check"></i> Compliance</a>
        <a href="{{ route('admin.governance.analytics') }}" class="drawer-link"><i class="bi bi-bar-chart-line"></i> Analytics</a>
        <a href="{{ route('admin.governance.communications') }}" class="drawer-link"><i class="bi bi-chat-left-dots"></i> Communications</a>
        <div class="drawer-section-title">Tech</div>
        <a href="{{ route('admin.system.configurations') }}" class="drawer-link"><i class="bi bi-gear-fill"></i> Configurations</a>
        <a href="{{ route('admin.system.audit-logs') }}" class="drawer-link"><i class="bi bi-journal-text"></i> Audit Logs</a>
        <a href="{{ route('admin.ai-insights') }}" class="drawer-link"><i class="bi bi-robot"></i> AI Insights</a>

        {{-- Insurer Drawer --}}
        @elseif($role === 'insurer')
        <div class="drawer-section-title">Finance</div>
        <a href="{{ route('insurer.finance.premiums') }}" class="drawer-link"><i class="bi bi-cash-stack"></i> Premiums Report</a>
        <a href="{{ route('insurer.finance.commissions') }}" class="drawer-link"><i class="bi bi-percent"></i> Commissions</a>
        <a href="{{ route('insurer.finance.tax') }}" class="drawer-link"><i class="bi bi-receipt"></i> Tax & Statements</a>
        <div class="drawer-section-title">Network & Settings</div>
        <a href="{{ route('insurer.network.providers') }}" class="drawer-link"><i class="bi bi-hospital"></i> Service Providers</a>
        <a href="{{ route('insurer.network.brokers') }}" class="drawer-link"><i class="bi bi-briefcase"></i> Brokers</a>
        <a href="{{ route('insurer.settings.company') }}" class="drawer-link"><i class="bi bi-building"></i> Company Profile</a>
        <a href="{{ route('insurer.ai-insights') }}" class="drawer-link"><i class="bi bi-robot"></i> AI Insights</a>

        {{-- Broker Drawer --}}
        @elseif($role === 'broker')
        <div class="drawer-section-title">More</div>
        <a href="{{ route('broker.wallet') }}" class="drawer-link"><i class="bi bi-wallet2"></i> My Wallet</a>
        <a href="{{ route('broker.wallet.cashout') }}" class="drawer-link"><i class="bi bi-bank"></i> Request Cash-out</a>
        <a href="{{ route('broker.claims') }}" class="drawer-link"><i class="bi bi-exclamation-octagon"></i> Claims</a>
        <a href="{{ route('broker.reports') }}" class="drawer-link"><i class="bi bi-bar-chart-line"></i> Reports</a>
        <a href="{{ route('broker.compliance') }}" class="drawer-link"><i class="bi bi-journal-text"></i> Compliance</a>
        <a href="{{ route('broker.profile') }}" class="drawer-link"><i class="bi bi-person-gear"></i> Profile</a>
        <a href="{{ route('broker.ai-insights') }}" class="drawer-link"><i class="bi bi-robot"></i> AI Insights</a>

        {{-- Agent Drawer --}}
        @elseif($role === 'agent')
        <div class="drawer-section-title">My Work</div>
        <a href="{{ route('agent.commissions') }}" class="drawer-link"><i class="bi bi-cash-coin"></i> Commissions</a>
        <a href="{{ route('agent.products') }}" class="drawer-link"><i class="bi bi-box-seam"></i> Product Catalog</a>
        <a href="{{ route('agent.reports') }}" class="drawer-link"><i class="bi bi-bar-chart-line"></i> Reports</a>

        {{-- SFE Drawer --}}
        @elseif($role === 'sfe')
        <div class="drawer-section-title">More</div>
        <a href="{{ route('sfe.policies.index') }}" class="drawer-link"><i class="bi bi-shield-check"></i> My Policies</a>
        <a href="{{ route('sfe.claims.index') }}" class="drawer-link"><i class="bi bi-exclamation-octagon"></i> Claims</a>
        <a href="{{ route('sfe.performance.index') }}" class="drawer-link"><i class="bi bi-bar-chart-line"></i> Performance</a>
        <a href="{{ route('sfe.training.index') }}" class="drawer-link"><i class="bi bi-book"></i> Training</a>
        <a href="{{ route('sfe.products.index') }}" class="drawer-link"><i class="bi bi-box-seam"></i> Product Catalog</a>
        <a href="{{ route('sfe.support.index') }}" class="drawer-link"><i class="bi bi-headset"></i> Support</a>
        <a href="{{ route('sfe.profile.index') }}" class="drawer-link"><i class="bi bi-person-gear"></i> My Profile</a>

        {{-- Bancassurance Drawer --}}
        @elseif($role === 'bancassurance')
        <div class="drawer-section-title">More</div>
        <a href="{{ route('bancassurance.integration') }}" class="drawer-link"><i class="bi bi-bank"></i> Bank Integration</a>
        <a href="{{ route('bancassurance.products') }}" class="drawer-link"><i class="bi bi-box-seam"></i> Products</a>
        <a href="{{ route('bancassurance.reports') }}" class="drawer-link"><i class="bi bi-file-earmark-bar-graph"></i> Reports</a>
        <a href="{{ route('bancassurance.compliance') }}" class="drawer-link"><i class="bi bi-shield-check"></i> Compliance</a>

        {{-- Service Provider Drawer --}}
        @elseif($role === 'service_provider')
        <div class="drawer-section-title">More</div>
        <a href="{{ route('service-provider.agreements.index') }}" class="drawer-link"><i class="bi bi-file-earmark-text"></i> Agreements</a>
        <a href="{{ route('service-provider.performance.index') }}" class="drawer-link"><i class="bi bi-graph-up-arrow"></i> Performance</a>
        <a href="{{ route('service-provider.bank.index') }}" class="drawer-link"><i class="bi bi-bank"></i> Bank Details</a>
        <a href="{{ route('service-provider.support.index') }}" class="drawer-link"><i class="bi bi-headset"></i> Support</a>

        {{-- Aggregator Drawer --}}
        @elseif($role === 'aggregator')
        <div class="drawer-section-title">More</div>
        <a href="{{ route('aggregator.market.traffic') }}" class="drawer-link"><i class="bi bi-activity"></i> Traffic Metrics</a>
        <a href="{{ route('aggregator.market.leads') }}" class="drawer-link"><i class="bi bi-person-check"></i> Lead Generation</a>
        <a href="{{ route('aggregator.market.ai-insights') }}" class="drawer-link"><i class="bi bi-robot"></i> AI Market Insights</a>
        <a href="{{ route('aggregator.brokers') }}" class="drawer-link"><i class="bi bi-briefcase"></i> Brokers</a>
        <a href="{{ route('aggregator.reports') }}" class="drawer-link"><i class="bi bi-bar-chart-steps"></i> Reports</a>
        <a href="{{ route('aggregator.wallet') }}" class="drawer-link"><i class="bi bi-wallet2"></i> Wallet</a>

        {{-- Regulator Drawer --}}
        @elseif($role === 'regulator')
        <div class="drawer-section-title">Oversight</div>
        <a href="{{ route('regulator.insurers') }}" class="drawer-link"><i class="bi bi-building"></i> Insurers</a>
        <a href="{{ route('regulator.brokers') }}" class="drawer-link"><i class="bi bi-briefcase"></i> Brokers</a>
        <a href="{{ route('regulator.agents') }}" class="drawer-link"><i class="bi bi-person-badge"></i> Agents</a>
        <a href="{{ route('regulator.oversight') }}" class="drawer-link"><i class="bi bi-shield-lock"></i> Consumer Protection</a>

        {{-- Financing Partner Drawer --}}
        @elseif($role === 'financing_partner')
        <div class="drawer-section-title">More</div>
        <a href="{{ route('financing-partner.collections.index') }}" class="drawer-link"><i class="bi bi-exclamation-triangle"></i> Collections</a>
        <a href="{{ route('financing-partner.reports.index') }}" class="drawer-link"><i class="bi bi-file-earmark-bar-graph"></i> Performance</a>
        <a href="{{ route('financing-partner.settings.index') }}" class="drawer-link"><i class="bi bi-gear"></i> Settings</a>

        {{-- Developer Drawer --}}
        @elseif($role === 'developer')
        <div class="drawer-section-title">More</div>
        <a href="{{ route('developer.sandbox.index') }}" class="drawer-link"><i class="bi bi-box"></i> Sandbox</a>
        <a href="{{ route('developer.docs.index') }}" class="drawer-link"><i class="bi bi-book"></i> Documentation</a>
        <a href="{{ route('developer.webhooks.index') }}" class="drawer-link"><i class="bi bi-link-45deg"></i> Webhooks</a>
        <a href="{{ route('developer.usage.index') }}" class="drawer-link"><i class="bi bi-activity"></i> API Usage</a>
        <a href="{{ route('developer.profile.index') }}" class="drawer-link"><i class="bi bi-person-gear"></i> My Profile</a>
        @endif

        <!-- Logout always visible -->
        <div class="drawer-section-title">Account</div>
        <a href="{{ route('logout') }}" class="drawer-link text-danger"
           onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Sign Out
        </a>
        <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
</div>

<style>
    .mobile-bottom-nav {
        height: 62px;
        z-index: 1050;
    }
    .mobile-nav-link {
        text-decoration: none;
        color: #94a3b8;
        transition: all 0.2s;
        display: block;
        padding: 4px 0;
    }
    .mobile-nav-link:hover,
    .mobile-nav-link.active {
        color: #d946ef;
    }
    .mobile-nav-link.active i { color: #d946ef; }
    .x-small { font-size: 0.62rem; }
    .mobile-fab-btn {
        background: linear-gradient(135deg, #d946ef, #a855f7);
        width: 46px;
        height: 46px;
        border-radius: 50%;
        box-shadow: 0 4px 14px rgba(217,70,239,0.4);
        border: 3px solid #fff;
        text-decoration: none;
    }
    .mobile-menu-drawer { width: 290px !important; }
    .drawer-section-title {
        padding: 14px 20px 6px;
        font-size: 0.62rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #94a3b8;
        font-weight: 700;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
    }
    .drawer-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 13px 20px;
        color: #374151;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        border-bottom: 1px solid #f9fafb;
        transition: all 0.15s;
    }
    .drawer-link:hover { background: #fdf4ff; color: #d946ef; }
    .drawer-link i { font-size: 1.05rem; opacity: 0.85; }
    @media (min-width: 992px) {
        .mobile-bottom-nav { display: none !important; }
        body.has-mobile-nav { padding-bottom: 0 !important; }
    }
    @media (max-width: 991.98px) {
        body { padding-bottom: 62px; }
    }
</style>
@else
{{-- Guest: no mobile nav needed --}}
@endauth
