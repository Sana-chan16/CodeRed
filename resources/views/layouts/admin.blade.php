<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Child Protection Database System</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            top: 64px;
            left: 0;
            min-height: calc(100vh - 64px);
            height: 100%;
            background: #fff;
            border-right: 1px solid #000;
            padding-top: 2rem;
            width: 260px;
            z-index: 1040;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #000;
            color: #fff !important;
            border-radius: 8px;
        }
        .sidebar .nav-link {
            color: #000;
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
        .sidebar .nav-link i {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            background: #fff;
            border-bottom: 1px solid #000;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1050;
        }
        .topbar .system-title {
            font-weight: 700;
            font-size: 1.25rem;
            color: #000;
        }
        .topbar .user-info {
            display: flex; align-items: center; gap: 1rem;
        }
        .main-content {
            padding: 2rem 2.5rem;
            margin-left: 260px;
            margin-top: 80px;
        }
        .section-title { 
            font-weight: 700; 
            font-size: 2rem;
            color: #000;
        }
        .section-subtitle { 
            color: #000; 
            margin-bottom: 2rem; 
        }
        .card { 
            border-radius: 12px;
            border: 1px solid #000;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.1);
            background: #fff;
        }
        .badge { 
            font-size: 1em; 
            font-weight: 500; 
            padding: 0.5em 1em; 
        }
        .table { 
            margin-bottom: 0;
            color: #000;
        }
        .table th { 
            font-weight: 600;
            background-color: #f8f9fa;
            border-bottom: 2px solid #000;
            color: #000;
        }
        .table td { 
            vertical-align: middle;
            color: #000;
        }
        .btn-sm { 
            padding: 0.25rem 0.5rem; 
        }
        .btn-outline-primary {
            color: #000;
            border-color: #000;
        }
        .btn-outline-primary:hover {
            background-color: #000;
            color: #fff;
        }
        .btn-dark {
            background-color: #000;
            border-color: #000;
        }
        .btn-dark:hover {
            background-color: #000;
            border-color: #000;
            opacity: 0.9;
        }
        .btn-outline-dark {
            color: #000;
            border-color: #000;
        }
        .btn-outline-dark:hover {
            background-color: #000;
            color: #fff;
        }
        .btn-outline-secondary {
            color: #000;
            border-color: #000;
        }
        .btn-outline-secondary:hover {
            background-color: #000;
            color: #fff;
        }
        .form-control:focus {
            border-color: #000;
            box-shadow: 0 0 0 0.2rem rgba(0,0,0,.15);
        }
        .dropdown-menu {
            border: 1px solid #000;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.1);
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #000;
        }
        .dropdown-item.active {
            background-color: #000;
            color: #fff;
        }
        .badge.active {
            background-color: #000;
            color: #fff;
        }
        .badge.pending {
            background-color: #000;
            color: #fff;
            opacity: 0.8;
        }
        .badge.resolved {
            background-color: #000;
            color: #fff;
            opacity: 0.6;
        }
        .badge.high {
            background-color: #000;
            color: #fff;
        }
        .badge.medium {
            background-color: #000;
            color: #fff;
            opacity: 0.8;
        }
        .badge.low {
            background-color: #000;
            color: #fff;
            opacity: 0.6;
        }
        .alert-success {
            background-color: #fff;
            border-color: #000;
            color: #000;
        }
        .alert-danger {
            background-color: #fff;
            border-color: #000;
            color: #000;
        }
        @media (max-width: 991px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>
    <!-- Topbar (Full Width, Fixed) -->
    <div class="topbar">
        <span class="system-title">Child Protection Database System</span>
        <div class="user-info">
            <span><i class="bi bi-person"></i> {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-dark btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

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
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="bi bi-people"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}" href="#">
                    <i class="bi bi-gear"></i> Settings
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
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