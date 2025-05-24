@extends(Auth::user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('content')
<div class="mb-4">
    <div class="section-title mb-1">Dashboard</div>
    <div class="section-subtitle">Overview of child protection activities and statistics</div>
</div>

<div class="row g-3 mb-4">
    <!-- Total Reports Card -->
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="icon-circle bg-dark text-white"><i class="bi bi-file-earmark-text"></i></div>
            <div class="fw-bold fs-4">{{ $totalReports ?? 'N/A' }}</div>
            <div class="fw-semibold">Total Reports</div>
            <div class="text-muted small">
                @if(($totalReportsChange ?? 0) > 0)
                    <span class="text-dark">↑ {{ number_format(abs($totalReportsChange ?? 0), 0) }}% from last month</span>
                @elseif(($totalReportsChange ?? 0) < 0)
                    <span class="text-dark">↓ {{ number_format(abs($totalReportsChange ?? 0), 0) }}% from last month</span>
                @else
                    No change from last month
                @endif
            </div>
        </div>
    </div>

    <!-- Total Cases Card -->
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="icon-circle bg-dark text-white"><i class="bi bi-folder"></i></div>
            <div class="fw-bold fs-4">{{ $totalCasesCount ?? 'N/A' }}</div>
            <div class="fw-semibold">Total Cases</div>
            <div class="text-muted small">
                @if(($totalCasesChange ?? 0) > 0)
                    <span class="text-dark">↑ {{ number_format(abs($totalCasesChange ?? 0), 0) }}% from last month</span>
                @elseif(($totalCasesChange ?? 0) < 0)
                    <span class="text-dark">↓ {{ number_format(abs($totalCasesChange ?? 0), 0) }}% from last month</span>
                @else
                    No change from last month
                @endif
            </div>
        </div>
    </div>

    <!-- Active Cases Card -->
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="icon-circle bg-dark text-white"><i class="bi bi-lightning-charge"></i></div>
            <div class="fw-bold fs-4">{{ $activeCasesCount ?? 'N/A' }}</div>
            <div class="fw-semibold">Active Cases</div>
            <div class="text-muted small">
                @if(($activeCasesChange ?? 0) > 0)
                    <span class="text-dark">↑ {{ number_format(abs($activeCasesChange ?? 0), 0) }}% from last month</span>
                @elseif(($activeCasesChange ?? 0) < 0)
                    <span class="text-dark">↓ {{ number_format(abs($activeCasesChange ?? 0), 0) }}% from last month</span>
                @else
                    No change from last month
                @endif
            </div>
        </div>
    </div>

    <!-- Active Investigations Card -->
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="icon-circle bg-dark text-white"><i class="bi bi-person-badge"></i></div>
            <div class="fw-bold fs-4">{{ $activeInvestigations ?? 'N/A' }}</div>
            <div class="fw-semibold">Active Investigations</div>
            <div class="text-muted small">
                @if(($activeInvestigationsChange ?? 0) > 0)
                    <span class="text-dark">↑ {{ number_format(abs($activeInvestigationsChange ?? 0), 0) }}% from last month</span>
                @elseif(($activeInvestigationsChange ?? 0) < 0)
                    <span class="text-dark">↓ {{ number_format(abs($activeInvestigationsChange ?? 0), 0) }}% from last month</span>
                @else
                    No change from last month
                @endif
            </div>
        </div>
    </div>

    <!-- Resolved Cases Card -->
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="icon-circle bg-dark text-white"><i class="bi bi-check-circle"></i></div>
            <div class="fw-bold fs-4">{{ $resolvedCasesCount ?? 'N/A' }}</div>
            <div class="fw-semibold">Resolved Cases</div>
            <div class="text-muted small">
                @if(($resolvedCasesChange ?? 0) > 0)
                    <span class="text-dark">↑ {{ number_format(abs($resolvedCasesChange ?? 0), 0) }}% from last month</span>
                @elseif(($resolvedCasesChange ?? 0) < 0)
                    <span class="text-dark">↓ {{ number_format(abs($resolvedCasesChange ?? 0), 0) }}% from last month</span>
                @else
                    No change from last month
                @endif
            </div>
        </div>
    </div>

    <!-- Pending Review Card -->
    <div class="col-md-4">
        <div class="card card-custom p-3">
            <div class="icon-circle bg-dark text-white"><i class="bi bi-clock"></i></div>
            <div class="fw-bold fs-4">{{ $pendingReviewCount ?? 'N/A' }}</div>
            <div class="fw-semibold">Pending Review</div>
            <div class="text-muted small">
                @if(($pendingReviewChange ?? 0) > 0)
                    <span class="text-dark">↑ {{ number_format(abs($pendingReviewChange ?? 0), 0) }}% from last month</span>
                @elseif(($pendingReviewChange ?? 0) < 0)
                    <span class="text-dark">↓ {{ number_format(abs($pendingReviewChange ?? 0), 0) }}% from last month</span>
                @else
                    No change from last month
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .card-custom {
        border-radius: 12px;
        border: 1px solid #000;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.1);
        background: #fff;
        transition: transform 0.2s ease-in-out;
    }
    .card-custom:hover {
        transform: translateY(-2px);
    }
    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    .icon-circle i {
        font-size: 1.5rem;
    }
    .text-dark {
        color: #000 !important;
    }
    .text-muted {
        color: #000 !important;
        opacity: 0.7;
    }
</style>
@endsection 