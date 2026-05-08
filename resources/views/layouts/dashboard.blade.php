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
        
        body { font-family: 'Public Sans', sans-serif; overflow-x: hidden; background-color: #eef2f6; color: #475569; }
        #wrapper { display: flex; width: 100%; align-items: stretch; }
        
        /* Light Sidebar Styling like the new image */
        #sidebar-wrapper { 
            min-width: 250px; 
            max-width: 250px; 
            min-height: 100vh; 
            transition: all 0.3s; 
            background: #f8fafc; /* Very light/white sidebar */
            z-index: 1000;
            border-right: 1px solid #e2e8f0;
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
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="d-flex flex-column" style="overflow-y: auto;">
            <div class="sidebar-brand sticky-top bg-white border-bottom">
                <span class="brand-name"><span class="text-primary">BIMA</span>KWIK</span>
                <span class="admin-label">{{ auth()->user()->roles->first()->name ?? 'Portal' }}</span>
            </div>

            @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('sub-admin'))
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
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <span class="page-title">Dashboard</span>
                    
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("sidebar-wrapper").classList.toggle("toggled");
        });
    </script>
</body>
</html>
