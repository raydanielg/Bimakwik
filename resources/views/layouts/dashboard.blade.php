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
        
        body { font-family: 'Public Sans', sans-serif; overflow-x: hidden; background-color: #f4f7fa; color: #334155; }
        #wrapper { display: flex; width: 100%; align-items: stretch; }
        
        /* Sidebar Styling like the image */
        #sidebar-wrapper { 
            min-width: 260px; 
            max-width: 260px; 
            min-height: 100vh; 
            transition: all 0.3s; 
            background: #2b3448; /* Dark Navy from image */
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
        }
        
        .sidebar-user-section {
            padding: 30px 20px;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        
        .user-avatar-lg {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            margin-right: 12px;
        }
        
        .user-info-text {
            color: #fff;
            font-size: 0.85rem;
        }
        
        .user-info-text .name { font-weight: 600; display: block; }
        .user-info-text .role { color: rgba(255,255,255,0.5); font-size: 0.75rem; }

        .sidebar-heading { 
            padding: 20px 25px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.3);
            font-weight: 700;
        }

        .list-group-item { 
            background: transparent; 
            color: rgba(255,255,255,0.7); 
            border: none; 
            padding: 12px 25px; 
            transition: all 0.2s; 
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }
        
        .list-group-item i { font-size: 1.1rem; margin-right: 15px; opacity: 0.7; }
        .list-group-item:hover { background: rgba(255,255,255,0.05); color: #fff; }
        .list-group-item.active { 
            background: rgba(13, 110, 253, 0.1) !important; 
            color: #3b82f6 !important; 
            border-left: 4px solid #3b82f6;
            border-radius: 0 !important;
        }
        .list-group-item.active i { opacity: 1; color: #3b82f6; }

        #page-content-wrapper { width: 100%; flex-grow: 1; }
        
        /* Navbar Styling */
        .navbar { 
            background: #fff; 
            padding: 15px 30px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .search-bar {
            background: #f1f5f9;
            border: none;
            border-radius: 8px;
            padding: 8px 15px;
            font-size: 0.9rem;
            width: 300px;
        }

        .card { 
            border: none; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border-radius: 12px; 
            background: #fff;
        }
        
        .stat-card { padding: 20px; }
        .stat-value { font-size: 1.5rem; font-weight: 700; margin-bottom: 5px; }
        .stat-label { font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase; }
        .stat-trend { font-size: 0.7rem; font-weight: 600; }
        
        #sidebar-wrapper.toggled { margin-left: -260px; }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-user-section d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=0D6EFD&color=fff" class="user-avatar-lg">
                <div class="user-info-text">
                    <span class="name">Dorice Malle</span>
                    <span class="role">Super Admin</span>
                </div>
            </div>

            <div class="sidebar-heading mt-3">Main Menu</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action active">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-people-fill"></i> Manage Users
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-shield-check"></i> Insurance Policies
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-file-earmark-bar-graph"></i> Claims Report
                </a>
            </div>

            <div class="sidebar-heading mt-4">Settings & Tools</div>
            <div class="list-group list-group-flush px-2">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="bi bi-gear-fill"></i> System Settings
                </a>
                <a href="#" class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="btn p-0 me-3" id="menu-toggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    
                    <form class="d-none d-md-flex ms-2">
                        <input class="search-bar" type="search" placeholder="Search data, reports...">
                    </form>

                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown me-3">
                            <a href="#" class="text-dark position-relative" data-bs-toggle="dropdown">
                                <i class="bi bi-bell fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.5rem;">5</span>
                            </a>
                        </div>
                        <div class="dropdown me-3">
                            <a href="#" class="text-dark" data-bs-toggle="dropdown">
                                <i class="bi bi-chat-dots fs-5"></i>
                            </a>
                        </div>
                        <div class="vr mx-3 text-secondary opacity-25" style="height: 25px;"></div>
                        <span class="small fw-semibold me-2 d-none d-md-inline">Dorice Malle</span>
                        <img src="https://ui-avatars.com/api/?name=Dorice+Malle" class="rounded-circle" width="35">
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
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
