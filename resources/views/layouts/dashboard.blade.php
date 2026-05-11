<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Bima Kwik Dashboard') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap');
        
        body { font-family: 'Public Sans', sans-serif; overflow-x: hidden; background-color: #eef2f6; color: #475569; transition: padding 0.3s; }
        #wrapper { display: flex; width: 100%; align-items: stretch; }
        
        /* Sidebar Styling */
        #sidebar-wrapper { 
            min-width: 250px; 
            max-width: 250px; 
            min-height: 100vh; 
            transition: all 0.3s; 
            background: #f8fafc;
            z-index: 1000;
            border-right: 1px solid #e2e8f0;
        }

        /* Responsive Sidebar */
        @media (max-width: 991.98px) {
            #sidebar-wrapper {
                margin-left: -250px;
                position: fixed;
                height: 100vh;
                top: 0;
            }
            #sidebar-wrapper.toggled {
                margin-left: 0;
                box-shadow: 0 0 20px rgba(0,0,0,0.2);
            }
            #page-content-wrapper {
                min-width: 100vw;
            }
        }
        
        .sidebar-brand {
            padding: 25px;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-brand .brand-name {
            font-size: 1.25rem;
            font-weight: 800;
            color: #1e293b;
        }
        
        .sidebar-brand .admin-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            color: #d946ef; /* Pinkish-purple accent from image */
            font-weight: 700;
            letter-spacing: 1px;
        }

        .sidebar-heading { 
            padding: 20px 25px 10px;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #94a3b8;
            font-weight: 600;
        }

        .list-group-item { 
            background: transparent; 
            color: #64748b; 
            border: none; 
            padding: 10px 25px; 
            transition: all 0.2s; 
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            font-weight: 500;
        }
        
        .list-group-item i { font-size: 1.1rem; margin-right: 12px; opacity: 0.8; }
        .list-group-item:hover { background: rgba(217, 70, 239, 0.05); color: #d946ef; }
        
        .list-group-item.active { 
            background: #fdf2f8 !important; /* Soft pink background for active */
            color: #d946ef !important; 
            border-radius: 8px;
            margin: 0 10px;
            padding: 10px 15px;
        }
        .list-group-item.active i { color: #d946ef; opacity: 1; }

        .logout-section {
            padding: 20px;
            border-top: 1px solid #f1f5f9;
            margin-top: auto;
        }
        
        .logout-btn {
            display: flex;
            align-items: center;
            color: #ef4444;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        
        .logout-btn:hover { background: #fef2f2; }

        #page-content-wrapper { width: 100%; flex-grow: 1; display: flex; flex-direction: column; }
        
        /* Navbar Styling */
        .navbar { 
            background: transparent; 
            padding: 15px 30px;
            border: none;
        }
        
        .page-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
        }

        .header-profile {
            background: #f8fafc;
            border-radius: 50px;
            padding: 5px 15px 5px 5px;
            display: flex;
            align-items: center;
            border: 1px solid #e2e8f0;
            cursor: pointer;
        }

        .card { 
            border: none; 
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            border-radius: 15px; 
            background: #fff;
            margin-bottom: 20px;
        }
        
        .stat-card { padding: 15px 20px; display: flex; align-items: center; }
        .stat-icon-box {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
        }
        .stat-info .value { font-size: 1.25rem; font-weight: 700; color: #1e293b; display: block; }
        .stat-info .label { font-size: 0.75rem; color: #94a3b8; font-weight: 500; }
        
        #sidebar-wrapper.toggled { margin-left: -250px; }

        /* Overlay for mobile when sidebar is open */
        .sidebar-overlay {
            display: none;
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            top: 0;
            left: 0;
        }
        .sidebar-overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="d-flex flex-column" style="overflow-y: auto;">
            <div class="sidebar-brand sticky-top bg-white border-bottom">
                <span class="brand-name"><span class="text-primary">BIMA</span>KWIK</span>
                <span class="admin-label">{{ auth()->user()->roles->first()->name ?? 'Portal' }}</span>
            </div>

            @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('sub_admin'))
            <!-- Super Admin Menu -->
            <div class="sidebar-heading">Core</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i> Overview
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-robot"></i> AI Insights
                </a>
            </div>

            <div class="sidebar-heading mt-3">Identity & Access</div>
            <div class="list-group list-group-flush px-2">
                <a href="#userSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-people-fill"></i> User Management</span>
                    <i class="bi bi-chevron-down small"></i>
                </a>
                <div class="collapse ps-3" id="userSubmenu">
                    <a href="#" class="list-group-item list-group-item-action py-2 small">Admins & Staff</a>
                    <a href="#" class="list-group-item list-group-item-action py-2 small">Insurers</a>
                    <a href="#" class="list-group-item list-group-item-action py-2 small">Brokers / Aggregators</a>
                    <a href="#" class="list-group-item list-group-item-action py-2 small">Agents (SFE/Banc)</a>
                    <a href="#" class="list-group-item list-group-item-action py-2 small">Customers</a>
                    <a href="#" class="list-group-item list-group-item-action py-2 small">Service Providers</a>
                    <a href="#" class="list-group-item list-group-item-action py-2 small">RBAC Settings</a>
                </div>
            </div>

            <div class="sidebar-heading mt-3">Product Engine</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-box-seam"></i> Product List
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-hammer"></i> Low-Code Builder
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-diagram-3"></i> Comparison Matrix
                </a>
            </div>

            <div class="sidebar-heading mt-3">Finances</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action text-nowrap">
                    <i class="bi bi-wallet2"></i> Wallet & Balances
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-cash-stack"></i> Premium Collections
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-percent"></i> Commissions
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-bank"></i> Payout Requests
                </a>
            </div>

            <div class="sidebar-heading mt-3">Operations</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-exclamation-octagon"></i> Claims Center
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-lightning-charge"></i> Workflows
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-file-earmark-pdf"></i> Document Vault
                </a>
            </div>

            <div class="sidebar-heading mt-3">Governance</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-shield-check"></i> Compliance (TIRA)
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-bar-chart-line"></i> Advanced Analytics
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-chat-left-dots"></i> Communications
                </a>
            </div>

            <div class="sidebar-heading mt-3">System & Tech</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-gear-fill"></i> Configurations
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-code-slash"></i> Developer Portal
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-globe"></i> Multi-Country
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-journal-text"></i> Audit Logs
                </a>
            </div>

            @elseif(auth()->user()->hasRole('insurer'))
            <!-- Insurer Menu -->
            <div class="sidebar-heading">Performance</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('insurer.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('insurer.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </div>
            @elseif(auth()->user()->hasRole('sfe'))
            <!-- SFE Menu -->
            <div class="sidebar-heading">SFE Operations</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('sfe.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('sfe.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('sfe.customers.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('sfe.customers.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Customers
                </a>
                <a href="{{ route('sfe.policies.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('sfe.policies.*') ? 'active' : '' }}">
                    <i class="bi bi-shield-check"></i> My Sales (Policies)
                </a>
            </div>

            <div class="sidebar-heading mt-3">Sales & Earnings</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('sfe.commissions.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('sfe.commissions.*') ? 'active' : '' }}">
                    <i class="bi bi-wallet2"></i> Commissions & Wallet
                </a>
                <a href="{{ route('sfe.performance.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('sfe.performance.*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart-line"></i> Performance
                </a>
            </div>

            <div class="sidebar-heading mt-3">Resources</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('sfe.products.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('sfe.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Product Catalog
                </a>
                <a href="{{ route('sfe.training.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('sfe.training.*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i> Training & Guides
                </a>
                <a href="{{ route('sfe.support.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('sfe.support.*') ? 'active' : '' }}">
                    <i class="bi bi-question-circle"></i> Help & Support
                </a>
            </div>

            <div class="sidebar-heading mt-3">Portfolio</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-box-seam"></i> My Products
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-hammer"></i> Create Product
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-people"></i> My Customers
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-diagram-3"></i> Channel Network
                </a>
            </div>

            <div class="sidebar-heading mt-3">Financials</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-wallet2"></i> Premiums Received
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-cash-stack"></i> Commission Payouts
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-bank"></i> Cash-out Requests
                </a>
            </div>

            <div class="sidebar-heading mt-3">Claims & Providers</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-exclamation-octagon"></i> Claims Management
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-hospital"></i> Service Providers
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-receipt"></i> Provider Bills
                </a>
            </div>

            <div class="sidebar-heading mt-3">Reports & Tools</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-bar-chart-line"></i> Analytics Reports
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-chat-left-dots"></i> Communication
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-building-gear"></i> Company Profile
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-key"></i> API Integration
                </a>
            </div>

            @elseif(auth()->user()->hasRole('broker'))
            <!-- Broker Menu -->
            <div class="sidebar-heading">Core Dashboard</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('broker.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('broker.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Overview
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-pie-chart"></i> Commission Summary
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-list-ul"></i> Recent Transactions
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-robot"></i> AI Sales Insights
                </a>
            </div>

            <div class="sidebar-heading mt-3">Product Management</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-box-seam"></i> View All Products
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-arrow-left-right"></i> Comparison Matrix
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-magic"></i> AI Recommendations
                </a>
            </div>

            <div class="sidebar-heading mt-3">Customer Management</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-person-plus"></i> Onboard New Customer
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-people"></i> Customer List
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-person-vcard"></i> KYC Status
                </a>
            </div>

            <div class="sidebar-heading mt-3">Policy Management</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-cart-plus"></i> Purchase Policy
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-arrow-repeat"></i> Renew Policy
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-shield-plus"></i> Endorsement
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-bell"></i> Expiry Alerts
                </a>
            </div>

            <div class="sidebar-heading mt-3">Wallet & Payments</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-wallet2"></i> My Wallet Balance
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-graph-up-arrow"></i> Commission Earned
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-bank"></i> Request Cash-out
                </a>
            </div>

            <div class="sidebar-heading mt-3">Claims Management</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-exclamation-octagon"></i> Submit Claim
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-activity"></i> Track Claim Status
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-shield-lock"></i> Fraud Alerts
                </a>
            </div>

            <div class="sidebar-heading mt-3">Reports & Communication</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-bar-chart-line"></i> Sales & Claims Reports
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-chat-left-dots"></i> Messaging & Notifications
                </a>
            </div>

            <div class="sidebar-heading mt-3">Compliance & Settings</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-journal-text"></i> Regulatory Filings
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-person-gear"></i> Profile & Bank Details
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-code-square"></i> API Keys
                </a>
            </div>

            @elseif(auth()->user()->hasRole('aggregator'))
            <!-- Aggregator Menu -->
            <div class="sidebar-heading">Market Monitoring</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('aggregator.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('aggregator.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Overview
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-activity"></i> Traffic Metrics
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-person-check"></i> Lead Generation
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-robot"></i> AI Market Insights
                </a>
            </div>

            <div class="sidebar-heading mt-3">Product Comparison</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-grid-3x3-gap"></i> Comparison Matrix
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-layout-split"></i> Side-by-Side View
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-magic"></i> AI Smart Compare
                </a>
            </div>

            <div class="sidebar-heading mt-3">Lead Management</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-calculator"></i> Generate Quote
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-send-plus"></i> Send Lead to Broker
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-briefcase"></i> Track Lead Status
                </a>
            </div>

            <div class="sidebar-heading mt-3">Wallet & Earnings</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-wallet2"></i> My Wallet
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-cash-stack"></i> Referral Fees
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-bank"></i> Cash-out
                </a>
            </div>

            <div class="sidebar-heading mt-3">Settings & Reports</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-bar-chart-steps"></i> Traffic & Lead Reports
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-person-gear"></i> Profile & Integration
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-shield-lock"></i> Privacy Logs
                </a>
            </div>

            @elseif(auth()->user()->hasRole('customer'))
            <!-- Customer Menu -->
            <div class="sidebar-heading">My Overview</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('customer.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('customer.ai-recommendations') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.ai-recommendations') ? 'active' : '' }}">
                    <i class="bi bi-robot"></i> AI Recommendations
                </a>
            </div>

            <div class="sidebar-heading mt-3">Marketplace</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('customer.marketplace') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.marketplace') ? 'active' : '' }}">
                    <i class="bi bi-search"></i> Browse Products
                </a>
                <a href="{{ route('customer.compare') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.compare') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right"></i> Compare & Calculate
                </a>
                <a href="{{ route('customer.buy') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.buy') ? 'active' : '' }}">
                    <i class="bi bi-cart-plus"></i> Buy New Policy
                </a>
            </div>

            <div class="sidebar-heading mt-3">My Insurance</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('customer.policies.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.policies.index') ? 'active' : '' }}">
                    <i class="bi bi-shield-check"></i> Active Policies
                </a>
                <a href="{{ route('customer.policies.renewals') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.policies.renewals') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i> Renewals & History
                </a>
                <a href="{{ route('customer.policies.documents') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.policies.documents') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-pdf"></i> Policy Documents
                </a>
            </div>

            <div class="sidebar-heading mt-3">Claims</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('customer.claims.create') }}" class="list-group-item list-group-item-action text-danger {{ request()->routeIs('customer.claims.create') ? 'active' : '' }}">
                    <i class="bi bi-exclamation-octagon"></i> Submit New Claim
                </a>
                <a href="{{ route('customer.claims.track') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.claims.track') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i> Track My Claims
                </a>
            </div>

            <div class="sidebar-heading mt-3">Wallet</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('customer.wallet.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.wallet.index') ? 'active' : '' }}">
                    <i class="bi bi-wallet2"></i> My Wallet Balance
                </a>
                <a href="{{ route('customer.wallet.add-funds') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.wallet.add-funds') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle"></i> Add Funds
                </a>
                <a href="{{ route('customer.wallet.history') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.wallet.history') ? 'active' : '' }}">
                    <i class="bi bi-list-ul"></i> Transaction History
                </a>
            </div>

            <div class="sidebar-heading mt-3">Account & Support</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('customer.profile') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.profile') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i> My Profile & KYC
                </a>
                <a href="{{ route('customer.support') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.support') ? 'active' : '' }}">
                    <i class="bi bi-headset"></i> Help & Support
                </a>
            </div>

            @elseif(auth()->user()->hasRole('agent'))
            <!-- Agent Menu -->
            <div class="sidebar-heading">Customer</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-people-fill"></i> All Customers
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-person-plus"></i> Add New Customer
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-file-earmark-person"></i> Customer KYC
                </a>
            </div>

            <div class="sidebar-heading mt-3">Policy</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-shield-check"></i> My Policies
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-cart-plus"></i> Buy New Policy
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-clock-history"></i> Renewals
                </a>
            </div>

            <div class="sidebar-heading mt-3">Product</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-box-seam"></i> Product Catalog
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-grid-3x3-gap"></i> Product Comparison
                </a>
            </div>

            <div class="sidebar-heading mt-3">Claims</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-exclamation-octagon"></i> Submit New Claim
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-activity"></i> Track Claims
                </a>
            </div>

            <div class="sidebar-heading mt-3">Commission</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-wallet2"></i> My Commissions
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-graph-up-arrow"></i> Commission Reports
                </a>
            </div>

            <div class="sidebar-heading mt-3">Performance</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-bar-chart-line"></i> Sales Reports
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-activity"></i> Activity Logs
                </a>
            </div>

            <div class="sidebar-heading mt-3">Training</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-book"></i> Training Materials
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-person-video2"></i> Video Tutorials
                </a>
            </div>

            <div class="sidebar-heading mt-3">Support</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-headset"></i> Help & Support
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-question-circle"></i> FAQs
                </a>
            </div>

            @elseif(auth()->user()->hasRole('bancassurance'))
            <!-- Bancassurance Menu -->
            <div class="sidebar-heading">Bank Operations</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('bancassurance.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('bancassurance.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('bancassurance.integration.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('bancassurance.integration.*') ? 'active' : '' }}">
                    <i class="bi bi-bank"></i> Bank Integration
                </a>
                <a href="{{ route('bancassurance.customers.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('bancassurance.customers.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Bank Customers
                </a>
            </div>

            <div class="sidebar-heading mt-3">Insurance Sales</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('bancassurance.policies.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('bancassurance.policies.*') ? 'active' : '' }}">
                    <i class="bi bi-shield-check"></i> My Sales
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-cart-plus"></i> Bancassurance Products
                </a>
            </div>

            <div class="sidebar-heading mt-3">Compliance & Reports</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('bancassurance.compliance.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('bancassurance.compliance.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-check"></i> Compliance
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-bar-chart-line"></i> Performance
                </a>
            </div>

            @elseif(auth()->user()->hasRole('service_provider'))
            <!-- Service Provider Menu -->
            <div class="sidebar-heading">Service Operations</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('service-provider.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('service-provider.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('service-provider.customer.verify') }}" class="list-group-item list-group-item-action {{ request()->routeIs('service-provider.customer.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i> Verify Customer
                </a>
                <a href="{{ route('service-provider.claims.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('service-provider.claims.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-medical"></i> Claims & Bills
                </a>
            </div>

            <div class="sidebar-heading mt-3">Financials</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('service-provider.payments.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('service-provider.payments.*') ? 'active' : '' }}">
                    <i class="bi bi-cash-stack"></i> Payments
                </a>
                <a href="{{ route('service-provider.bank.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('service-provider.bank.*') ? 'active' : '' }}">
                    <i class="bi bi-bank"></i> Bank Details
                </a>
            </div>

            <div class="sidebar-heading mt-3">Management</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('service-provider.agreements.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('service-provider.agreements.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i> Agreements (SLAs)
                </a>
                <a href="{{ route('service-provider.performance.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('service-provider.performance.*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart-line"></i> Performance
                </a>
                <a href="{{ route('service-provider.support.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('service-provider.support.*') ? 'active' : '' }}">
                    <i class="bi bi-question-circle"></i> Help & Support
                </a>
            </div>

            @elseif(auth()->user()->hasRole('regulator'))
            <!-- Regulator Menu -->
            <div class="sidebar-heading">Market Oversight</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('regulator.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('regulator.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="#oversightSubmenu" data-bs-toggle="collapse" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-shield-shaded"></i> Oversight</span>
                    <i class="bi bi-chevron-down small"></i>
                </a>
                <div class="collapse ps-3" id="oversightSubmenu">
                    <a href="#" class="list-group-item list-group-item-action py-1 small">Insurers</a>
                    <a href="#" class="list-group-item list-group-item-action py-1 small">Brokers</a>
                    <a href="#" class="list-group-item list-group-item-action py-1 small">Agents</a>
                </div>
            </div>

            <div class="sidebar-heading mt-3">Monitoring</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-activity"></i> Claims Monitoring
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-check-circle"></i> Product Approvals
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-exclamation-triangle"></i> Compliance
                </a>
            </div>

            <div class="sidebar-heading mt-3">Intelligence</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-graph-up"></i> Market Stats
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-shield-lock"></i> Consumer Protection
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-journal-text"></i> Audit Logs
                </a>
            </div>

            @elseif(auth()->user()->hasRole('financing_partner'))
            <!-- Financing Partner Menu -->
            <div class="sidebar-heading">Core Monitoring</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('financing-partner.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('financing-partner.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('financing-partner.requests.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('financing-partner.requests.*') ? 'active' : '' }}">
                    <i class="bi bi-inboxes"></i> Loan Requests
                </a>
            </div>

            <div class="sidebar-heading mt-3">Operations</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('financing-partner.disbursements.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('financing-partner.disbursements.*') ? 'active' : '' }}">
                    <i class="bi bi-cash-stack"></i> Disbursements
                </a>
                <a href="{{ route('financing-partner.repayments.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('financing-partner.repayments.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-repeat"></i> Repayments
                </a>
                <a href="{{ route('financing-partner.collections.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('financing-partner.collections.*') ? 'active' : '' }}">
                    <i class="bi bi-exclamation-triangle"></i> Collections
                </a>
            </div>

            <div class="sidebar-heading mt-3">Reports & Settings</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('financing-partner.reports.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('financing-partner.reports.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-bar-graph"></i> Performance
                </a>
                <a href="{{ route('financing-partner.settings.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('financing-partner.settings.*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i> Settings
                </a>
            </div>

            @elseif(auth()->user()->hasRole('developer'))
            <!-- Developer Menu -->
            <div class="sidebar-heading">Tech Monitoring</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('developer.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('developer.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('developer.usage.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('developer.usage.*') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i> API Usage
                </a>
            </div>

            <div class="sidebar-heading mt-3">API Management</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('developer.apps.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('developer.apps.*') ? 'active' : '' }}">
                    <i class="bi bi-grid-3x3-gap"></i> My Applications
                </a>
                <a href="{{ route('developer.keys.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('developer.keys.*') ? 'active' : '' }}">
                    <i class="bi bi-key"></i> API Keys
                </a>
                <a href="{{ route('developer.webhooks.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('developer.webhooks.*') ? 'active' : '' }}">
                    <i class="bi bi-link-45deg"></i> Webhooks
                </a>
            </div>

            <div class="sidebar-heading mt-3">Resources & Testing</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('developer.docs.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('developer.docs.*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i> API Documentation
                </a>
                <a href="{{ route('developer.testing.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('developer.testing.*') ? 'active' : '' }}">
                    <i class="bi bi-terminal"></i> API Console
                </a>
                <a href="{{ route('developer.sandbox.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('developer.sandbox.*') ? 'active' : '' }}">
                    <i class="bi bi-box"></i> Sandbox
                </a>
            </div>

            <div class="sidebar-heading mt-3">Settings</div>
            <div class="list-group list-group-flush px-2">
                <a href="{{ route('developer.profile.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('developer.profile.*') ? 'active' : '' }}">
                    <i class="bi bi-person-gear"></i> Developer Profile
                </a>
            </div>
            @endif

            <div class="logout-section mt-4 mb-4">
                <a href="#" class="logout-btn mx-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-power me-2"></i> {{ auth()->user()->hasRole('super-admin') ? 'Shutdown System' : 'Sign Out' }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg border-bottom bg-white sticky-top">
                <div class="container-fluid">
                    <button class="btn btn-link me-2 p-0 text-dark" id="menu-toggle-mobile">
                        <i class="bi bi-list fs-3"></i>
                    </button>
                    <span class="page-title d-none d-sm-inline">Dashboard</span>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="bg-white rounded-circle p-2 shadow-sm me-3 border" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-bell text-secondary"></i>
                        </div>
                        
                        <div class="header-profile shadow-sm" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="bg-primary bg-opacity-10 rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-weight: 700; font-size: 0.8rem; color: #0d6efd;">
                                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                            </div>
                            <div class="d-none d-md-block">
                                <div style="font-size: 0.75rem; font-weight: 700; line-height: 1; color: #1e293b;">{{ auth()->user()->name ?? 'User Name' }}</div>
                                <div style="font-size: 0.65rem; color: #94a3b8; font-weight: 500;">{{ auth()->user()->roles->first()->name ?? 'Role' }} <i class="bi bi-chevron-down ms-1"></i></div>
                            </div>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2"></i> My Profile</a></li>
                            <li><a class="dropdown-item py-2" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item py-2 text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-left me-2"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid px-4 py-2">
                @yield('dashboard_content')
            </div>
        </div>
    </div>

    @include('partials.mobile_nav')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Universal Sidebar toggle (Works for both desktop and mobile)
            $("#menu-toggle, #menu-toggle-mobile, #sidebar-overlay").click(function(e) {
                e.preventDefault();
                $("#sidebar-wrapper").toggleClass("toggled");
                $("#sidebar-overlay").toggleClass("active");
                
                // Toggle body scroll
                if ($("#sidebar-wrapper").hasClass("toggled") && window.innerWidth < 992) {
                    $("body").css("overflow", "hidden");
                } else {
                    $("body").css("overflow", "auto");
                }
            });
        });
    </script>
</body>
</html>
