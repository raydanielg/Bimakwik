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
        <div id="sidebar-wrapper" class="d-flex flex-column">
            <div class="sidebar-brand">
                <span class="brand-name"><span class="text-primary">BIMA</span>KWIK</span>
                <span class="admin-label">Insurance Portal</span>
            </div>

            <div class="sidebar-heading">Main</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
            </div>

            <div class="sidebar-heading">Insurance Management</div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-shield-check"></i> Policies
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-file-earmark-text"></i> Claims
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-people"></i> Customers
                </a>
            </div>

            <div class="sidebar-heading">System</div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-gear"></i> Settings
                </a>
            </div>

            <div class="logout-section">
                <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left me-2"></i> Sign Out
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
