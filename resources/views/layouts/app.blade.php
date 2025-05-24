<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Protection System</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #ffffff;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            padding-top: 1rem;
            border-right: 1px solid #e9ecef;
        }
        .sidebar .nav-link {
            color: #495057;
            padding: 0.5rem 1rem;
            margin: 0.2rem 0;
            border-radius: 0.25rem;
        }
        .sidebar .nav-link:hover {
            background-color: #f8f9fa;
            color: #212529;
        }
        .sidebar .nav-link.active {
            background-color: rgba(0, 0, 0, 0.05);
            color: #212529;
            font-weight: 500;
        }
        .sidebar .nav-link i {
            margin-right: 0.5rem;
            color: #6c757d;
        }
        .sidebar .nav-link.active i {
            color: #212529;
        }
        .main-content {
            padding: 2rem;
            background-color: #ffffff;
        }
        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 4px rgba(0,0,0,.05);
            border-bottom: 1px solid #e9ecef;
        }
        .navbar-dark .navbar-brand,
        .navbar-dark .nav-link {
            color: #212529 !important;
        }
        .navbar-dark .navbar-toggler {
            border-color: #dee2e6;
        }
        .navbar-dark .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(33, 37, 41, 0.75)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.05);
            border: 1px solid #e9ecef;
            background-color: #ffffff;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
        .table {
            background-color: #ffffff;
        }
        .table-light {
            background-color: #f8f9fa;
        }
        .btn-group .btn {
            border-color: #dee2e6;
        }
        .dropdown-menu {
            border: 1px solid #e9ecef;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.05);
            background-color: #ffffff;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        .alert {
            border: 1px solid #e9ecef;
            background-color: #ffffff;
        }
        .alert-success {
            border-left: 4px solid #198754;
        }
        .alert-danger {
            border-left: 4px solid #dc3545;
        }
        .btn-close {
            color: #212529;
        }
        .form-control {
            background-color: #ffffff;
            border-color: #dee2e6;
        }
        .form-control:focus {
            background-color: #ffffff;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .invalid-feedback {
            color: #dc3545;
        }
        .btn {
            font-weight: 500;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-light {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #212529;
        }
        .btn-light:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
            color: #212529;
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-shield-check"></i> Child Protection System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky">
                    <div class="sidebar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('cases.index') ? 'active' : '' }}" href="{{ route('cases.index') }}">
                                    <i class="bi bi-file-earmark-text"></i> Cases
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('cases.create') ? 'active' : '' }}" href="{{ route('cases.create') }}">
                                    <i class="bi bi-plus-circle"></i> Submit Case
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="#">
                                    <i class="bi bi-person"></i> Profile
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
</body>
</html> 