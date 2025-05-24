@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    body { background: #f8f9fa; }
    .sidebar {
        position: fixed;
        top: 64px;
        left: 0;
        min-height: calc(100vh - 64px);
        height: 100%;
        background: #fff;
        border-right: 1px solid #e5e7eb;
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
        border-bottom: 1px solid #e5e7eb;
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
        color: #6c757d; 
        margin-bottom: 2rem; 
    }
    .card { 
        border-radius: 12px;
        border: 1px solid #e9ecef;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.05);
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
        border-bottom: 2px solid #e9ecef;
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
        background-color: #333;
        border-color: #333;
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
        color: #6c757d;
        border-color: #6c757d;
    }
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }
    .form-control:focus {
        border-color: #000;
        box-shadow: 0 0 0 0.2rem rgba(0,0,0,.15);
    }
    .dropdown-menu {
        border: 1px solid #e9ecef;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.05);
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
        background-color: #6c757d;
        color: #fff;
    }
    .badge.resolved {
        background-color: #198754;
        color: #fff;
    }
    .badge.high {
        background-color: #000;
        color: #fff;
    }
    .badge.medium {
        background-color: #6c757d;
        color: #fff;
    }
    .badge.low {
        background-color: #adb5bd;
        color: #fff;
    }
    @media (max-width: 991px) {
        .sidebar { display: none; }
        .main-content { margin-left: 0; }
    }
</style>

<!-- Topbar (Full Width, Fixed) -->
<div class="topbar">
    <span class="system-title">Child Protection Database System</span>
    <div class="user-info">
        <span><i class="bi bi-person"></i> {{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>

<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('caseManagement') }}"><i class="bi bi-folder2-open"></i> Case Management</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('submateCase') }}"><i class="bi bi-plus-circle"></i> Submit Case</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="mb-4">
        <div class="section-title mb-1">Case Management</div>
        <div class="section-subtitle">View and manage child protection cases</div>
    </div>

    <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
        <form class="flex-grow-1" method="GET" action="{{ route('caseManagement') }}">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search cases by ID, name, or location..." value="{{ request('search') }}">
                <button class="btn btn-dark" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>
        <div class="dropdown">
            <button class="btn btn-outline-dark d-flex align-items-center" type="button" data-bs-toggle="dropdown" style="height: 38px;">
                <i class="bi bi-funnel me-2"></i>Filter
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('caseManagement', ['status' => 'active']) }}">Active Cases</a></li>
                <li><a class="dropdown-item" href="{{ route('caseManagement', ['status' => 'pending']) }}">Pending Cases</a></li>
                <li><a class="dropdown-item" href="{{ route('caseManagement', ['status' => 'resolved']) }}">Resolved Cases</a></li>
            </ul>
        </div>
        <a href="{{ route('submateCase') }}" class="btn btn-dark d-flex align-items-center" style="height: 38px;">
            <i class="bi bi-plus-lg me-2"></i>New Case
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Case ID</th>
                            <th>Victim Name</th>
                            <th>Date Reported</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cases as $case)
                            <tr>
                                <td class="fw-bold">CASE-{{ str_pad($case->id, 7, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $case->informant_name ?? 'N/A' }}</td>
                                <td>{{ $case->date_of_incident ?? $case->created_at->format('Y-m-d') }}</td>
                                <td>{{ $case->incident_place ?? 'N/A' }}</td>
                                <td>
                                    @if(isset($case->status))
                                        @if($case->status === 'active')
                                            <span class="badge active">Active</span>
                                        @elseif($case->status === 'pending')
                                            <span class="badge pending">Pending</span>
                                        @elseif($case->status === 'resolved')
                                            <span class="badge resolved">Resolved</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($case->status) }}</span>
                                        @endif
                                    @else
                                        <span class="badge active">Active</span>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($case->priority))
                                        @if($case->priority === 'high')
                                            <span class="badge high">High</span>
                                        @elseif($case->priority === 'medium')
                                            <span class="badge medium">Medium</span>
                                        @elseif($case->priority === 'low')
                                            <span class="badge low">Low</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($case->priority) }}</span>
                                        @endif
                                    @else
                                        <span class="badge medium">Medium</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('cases.show', $case->id) }}" class="btn btn-outline-primary btn-sm" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if($case->status !== 'resolved')
                                            <a href="{{ route('cases.edit', $case->id) }}" class="btn btn-outline-secondary btn-sm" title="Edit Case">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        No cases found
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($cases->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $cases->links() }}
        </div>
    @endif
</div>
@endsection
