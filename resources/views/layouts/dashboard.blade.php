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
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; background-color: #f8f9fa; }
        #wrapper { display: flex; width: 100%; align-items: stretch; }
        #sidebar-wrapper { min-width: 260px; max-width: 260px; min-height: 100vh; transition: all 0.3s; background: #1a1d20; z-index: 1000; }
        #sidebar-wrapper.toggled { margin-left: -260px; }
        #page-content-wrapper { width: 100%; flex-grow: 1; }
        .sidebar-heading { background: #141619; color: #fff; }
        .list-group-item { background: transparent; color: rgba(255,255,255,0.7); border: none; padding: 12px 25px; transition: all 0.2s; font-size: 0.95rem; }
        .list-group-item:hover { background: rgba(255,255,255,0.05); color: #fff; }
        .list-group-item.active { background: #0d6efd !important; color: #fff !important; font-weight: 600; }
        .navbar { background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .card { border: none; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05); border-radius: 12px; }
        .sticky-top { top: 0; z-index: 999; }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading p-4 fs-4 fw-bold border-bottom border-secondary shadow-sm">
                <span class="text-primary">BIMA</span>KWIK
            </div>
            <div class="list-group list-group-flush p-2 mt-2">
                <a href="#" class="list-group-item list-group-item-action rounded mb-1 active">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a href="#" class="list-group-item list-group-item-action rounded mb-1">
                    <i class="bi bi-people me-2"></i> Users
                </a>
                <a href="#" class="list-group-item list-group-item-action rounded mb-1">
                    <i class="bi bi-shield-check me-2"></i> Policies
                </a>
                <a href="#" class="list-group-item list-group-item-action rounded mb-1">
                    <i class="bi bi-file-earmark-text me-2"></i> Claims
                </a>
                <a href="#" class="list-group-item list-group-item-action rounded mb-1">
                    <i class="bi bi-gear me-2"></i> Settings
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light px-4 py-3 sticky-top">
                <button class="btn btn-link text-dark p-0 me-3" id="menu-toggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h5 class="mb-0 fw-bold">@yield('dashboard_title', 'Dashboard')</h5>
                
                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown me-3">
                        <button class="btn btn-link text-dark position-relative p-0" data-bs-toggle="dropdown">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.5rem;">3</span>
                        </button>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-link text-dark d-flex align-items-center text-decoration-none dropdown-toggle p-0" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=0D6EFD&color=fff" class="rounded-circle me-2" width="35">
                            <span class="d-none d-md-inline small fw-semibold text-dark">{{ auth()->user()->name ?? 'Guest' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
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
