@extends('layouts.app')

@section('content')
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark border-right text-white" id="sidebar-wrapper" style="min-width: 250px; min-height: 100vh;">
        <div class="sidebar-heading p-4 fs-4 fw-bold border-bottom border-secondary">
            <span class="text-primary">BIMA</span>KWIK
        </div>
        <div class="list-group list-group-flush p-3">
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 mb-2 rounded hover-primary active">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 mb-2 rounded hover-primary">
                <i class="bi bi-people me-2"></i> Users
            </a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 mb-2 rounded hover-primary">
                <i class="bi bi-shield-check me-2"></i> Policies
            </a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 mb-2 rounded hover-primary">
                <i class="bi bi-file-earmark-text me-2"></i> Claims
            </a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-0 mb-2 rounded hover-primary">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper" class="w-100 bg-light">
        <nav class="navbar navbar-expand-lg navbar-white bg-white border-bottom px-4 py-3 shadow-sm">
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
                        <span class="d-none d-md-inline small fw-semibold">{{ auth()->user()->name ?? 'Guest' }}</span>
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
    <!-- /#page-content-wrapper -->
</div>

<style>
    #sidebar-wrapper .list-group-item { transition: all 0.3s; }
    #sidebar-wrapper .list-group-item:hover { background-color: rgba(13, 110, 253, 0.2) !important; color: #0D6EFD !important; }
    #sidebar-wrapper .list-group-item.active { background-color: #0D6EFD !important; color: #fff !important; }
    .card { border-radius: 12px; transition: transform 0.3s; }
    .card:hover { transform: translateY(-5px); }
    .btn-primary { border-radius: 8px; padding: 10px 20px; }
</style>

<script>
    document.getElementById("menu-toggle").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("wrapper").classList.toggle("toggled");
    });
</script>
@endsection
