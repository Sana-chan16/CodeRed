@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    body { background: #f6f8fb; }
    .sidebar {
        position: fixed;
        top: 64px; /* height of navbar */
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
        background: #111827;
        color: #fff !important;
        border-radius: 8px;
    }
    .sidebar .nav-link {
        color: #111827;
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
    }
    .topbar .user-info {
        display: flex; align-items: center; gap: 1rem;
    }
    .main-content {
        padding: 2rem 2.5rem;
        margin-left: 260px;
        margin-top: 80px;
    }
    .section-title { font-weight: 700; font-size: 2rem; }
    .section-subtitle { color: #6b7280; margin-bottom: 2rem; }
    .card { border-radius: 12px; }
    .badge { font-size: 1em; font-weight: 500; padding: 0.5em 1em; }
    @media (max-width: 991px) {
        .sidebar { display: none; }
        .main-content { margin-left: 0; }
    }
</style>
<!-- Topbar (Full Width, Fixed) -->
<div class="topbar">
    <span class="system-title">Child Protection Database System</span>
    <div class="user-info">
        <span><i class="bi bi-person"></i> Administrator</span>
        <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-box-arrow-right"></i> Logout</button>
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
        <form class="flex-grow-1" method="GET" action="">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search cases by ID, name, or location..." value="{{ request('search') }}">
                <button class="btn btn-dark" type="submit">Search</button>
            </div>
        </form>
        <button class="btn btn-outline-dark d-flex align-items-center" type="button" style="height: 38px;">
            <i class="bi bi-funnel me-2"></i>Filter
        </button>
        <a href="{{ route('submateCase') }}" class="btn btn-dark d-flex align-items-center" style="height: 38px;">
            <i class="bi bi-plus-lg me-2"></i>New Case
        </a>
    </div>
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Case ID</th>
                        <th>Victim Name</th>
                        <th>Date Reported</th>
                        <th>Province</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cases as $case)
                        <tr>
                            <td class="fw-bold">CASE-{{ str_pad($case->id, 7, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $case->informant_name ?? 'N/A' }}</td>
                            <td>{{ $case->date_of_incident ?? $case->created_at->format('Y-m-d') }}</td>
                            <td>{{ $case->incident_place ?? 'N/A' }}</td>
                            <td>
                                @if(isset($case->status))
                                    @if($case->status === 'active')
                                        <span class="badge rounded-pill" style="background:#ffe5b3; color:#b8860b;">Active</span>
                                    @elseif($case->status === 'pending')
                                        <span class="badge rounded-pill bg-light text-secondary">Pending</span>
                                    @elseif($case->status === 'resolved')
                                        <span class="badge rounded-pill bg-success">Resolved</span>
                                    @else
                                        <span class="badge rounded-pill bg-secondary">{{ ucfirst($case->status) }}</span>
                                    @endif
                                @else
                                    <span class="badge rounded-pill" style="background:#ffe5b3; color:#b8860b;">Active</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($case->priority))
                                    @if($case->priority === 'high')
                                        <span class="badge rounded-pill" style="background:#ff5c5c; color:#fff;">High</span>
                                    @elseif($case->priority === 'medium')
                                        <span class="badge rounded-pill" style="background:#ffc107; color:#212529;">Medium</span>
                                    @elseif($case->priority === 'low')
                                        <span class="badge rounded-pill" style="background:#3cb4fc; color:#fff;">Low</span>
                                    @else
                                        <span class="badge rounded-pill bg-secondary">{{ ucfirst($case->priority) }}</span>
                                    @endif
                                @else
                                    <span class="badge rounded-pill" style="background:#ffc107; color:#212529;">Medium</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-outline-primary btn-sm" title="Show Details">
                                    <i class="bi bi-eye"></i> Show
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
