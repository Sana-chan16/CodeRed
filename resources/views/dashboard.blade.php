@extends(Auth::user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Dashboard</h2>
    <p class="text-muted">Overview of child protection activities and statistics</p>

    <h3 class="mt-4">Dashboard Overview</h3>
    <p class="text-muted">Monitor and manage child protection cases and investigations</p>

    <div class="row mt-4">
        <!-- Total Reports Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-muted">Total Reports</h5>
                        <h1 class="card-text">{{ $totalReports ?? 'N/A' }}</h1>
                        <p class="card-text @if(($totalReportsChange ?? 0) > 0) text-success @elseif(($totalReportsChange ?? 0) < 0) text-danger @else text-muted @endif">{{ number_format(abs($totalReportsChange ?? 0), 0) }}% from last month</p>
                    </div>
                    <i class="bi bi-file-earmark-text fs-2 text-primary"></i>
                </div>
            </div>
        </div>

        <!-- Total Cases Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-muted">Total Cases</h5>
                        <h1 class="card-text">{{ $totalCasesCount ?? 'N/A' }}</h1>
                        <p class="card-text @if(($totalCasesChange ?? 0) > 0) text-success @elseif(($totalCasesChange ?? 0) < 0) text-danger @else text-muted @endif">{{ number_format(abs($totalCasesChange ?? 0), 0) }}% from last month</p>
                    </div>
                    <i class="bi bi-folder fs-2 text-success"></i>
                </div>
            </div>
        </div>

        <!-- Active Cases Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-muted">Active Cases</h5>
                        <h1 class="card-text">{{ $activeCasesCount ?? 'N/A' }}</h1>
                        <p class="card-text @if(($activeCasesChange ?? 0) > 0) text-success @elseif(($activeCasesChange ?? 0) < 0) text-danger @else text-muted @endif">{{ number_format(abs($activeCasesChange ?? 0), 0) }}% from last month</p>
                    </div>
                    <i class="bi bi-lightning-charge fs-2 text-warning"></i>
                </div>
            </div>
        </div>

        <!-- Active Investigations Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-muted">Active Investigations</h5>
                        <h1 class="card-text">{{ $activeInvestigations ?? 'N/A' }}</h1>
                        <p class="card-text @if(($activeInvestigationsChange ?? 0) > 0) text-success @elseif(($activeInvestigationsChange ?? 0) < 0) text-danger @else text-muted @endif">{{ number_format(abs($activeInvestigationsChange ?? 0), 0) }}% from last month</p>
                    </div>
                    <i class="bi bi-person-badge fs-2 text-info"></i>
                </div>
            </div>
        </div>

        <!-- Resolved Cases Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-muted">Resolved Cases</h5>
                        <h1 class="card-text">{{ $resolvedCasesCount ?? 'N/A' }}</h1>
                        <p class="card-text @if(($resolvedCasesChange ?? 0) > 0) text-success @elseif(($resolvedCasesChange ?? 0) < 0) text-danger @else text-muted @endif">{{ number_format(abs($resolvedCasesChange ?? 0), 0) }}% from last month</p>
                    </div>
                    <i class="bi bi-check-circle fs-2 text-success"></i>
                </div>
            </div>
        </div>

        <!-- Pending Review Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-muted">Pending Review</h5>
                        <h1 class="card-text">{{ $pendingReviewCount ?? 'N/A' }}</h1>
                        <p class="card-text @if(($pendingReviewChange ?? 0) > 0) text-success @elseif(($pendingReviewChange ?? 0) < 0) text-danger @else text-muted @endif">{{ number_format(abs($pendingReviewChange ?? 0), 0) }}% from last month</p>
                    </div>
                    <i class="bi bi-clock fs-2 text-secondary"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 