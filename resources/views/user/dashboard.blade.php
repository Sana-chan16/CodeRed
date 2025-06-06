@extends('layouts.app')

@section('content')
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    .card-custom {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .icon-circle {
        width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;
        border-radius: 50%; font-size: 1.3rem; margin-bottom: 0.5rem;
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
    .dashboard-content {
        padding: 2rem 2.5rem;
        margin-left: 260px;
        margin-top: 80px;
    }
    .section-title { font-weight: 700; font-size: 2rem; }
    .section-subtitle { color: #6b7280; margin-bottom: 2rem; }
    .recent-activity .case-status-bar { width: 4px; height: 40px; border-radius: 2px; display: inline-block; margin-right: 10px; }
    .recent-activity .case-status-bar.active { background: #0d6efd; }
    .recent-activity .case-status-bar.investigation { background: #fd7e14; }
    .recent-activity .case-status-bar.resolved { background: #198754; }
    @media (max-width: 991px) {
        .sidebar { display: none; }
        .dashboard-content { margin-left: 0; }
    }
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
        margin-bottom: 1rem;
    }
</style>
<!-- Topbar (Full Width, Fixed) -->
<div class="topbar">
    <span class="system-title">Child Protection Database System</span>
    <div class="user-info">
        <span><i class="bi bi-person"></i> {{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>
<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link active" href="{{ route('dashboard') }}"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('caseManagement') }}"><i class="bi bi-folder2-open"></i> Case Management</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('submateCase') }}"><i class="bi bi-plus-circle"></i> Submit Case</a></li>
    </ul>
</div>
<div class="dashboard-content">
    <!-- Main Dashboard Content -->
    <div class="section-title mb-1">Dashboard</div>
    <div class="section-subtitle">Overview of child protection cases and system statistics</div>
    <!-- Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card card-custom p-3">
                <div class="icon-circle bg-primary text-white"><i class="bi bi-clipboard-data"></i></div>
                <div class="fw-bold fs-4">{{ $totalCases }}</div>
                <div class="fw-semibold">Total Cases</div>
                <div class="text-muted small">All time cases in the system</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom p-3">
                <div class="icon-circle bg-warning text-white"><i class="bi bi-exclamation-triangle"></i></div>
                <div class="fw-bold fs-4">{{ $activeCases }}</div>
                <div class="fw-semibold">Current Active Cases</div>
                <div class="text-muted small">Currently active investigations</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom p-3">
                <div class="icon-circle bg-success text-white"><i class="bi bi-check-circle"></i></div>
                <div class="fw-bold fs-4">{{ $resolvedCases }}</div>
                <div class="fw-semibold">Resolved Cases</div>
                <div class="text-muted small">Successfully resolved cases</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom p-3">
                <div class="icon-circle bg-purple text-white" style="background:#a259ff!important"><i class="bi bi-clock-history"></i></div>
                <div class="fw-bold fs-4">{{ $pendingReview }}</div>
                <div class="fw-semibold">Pending Review</div>
                <div class="text-muted small">Awaiting case officer review</div>
            </div>
        </div>
    </div>
    <!-- Monthly Cases Chart -->
    <div class="card card-custom p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <div class="fw-bold fs-5">Monthly Case Reports</div>
                <div class="text-muted small">Number of cases reported per month</div>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="monthlyCasesChart"></canvas>
        </div>
    </div>
    <!-- Gender Distribution Chart -->
    <div class="card card-custom p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <div class="fw-bold fs-5">Victim Gender Distribution</div>
                <div class="text-muted small">Distribution of victim gender across cases</div>
            </div>
            <select id="genderMonthFilter" class="form-select form-select-sm" style="width: auto;">
                <option value="all">All Time</option>
                @foreach($monthlyLabels as $index => $label)
                    <option value="{{ $index }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="chart-container" style="height: 400px;">
            <canvas id="genderChart"></canvas>
        </div>
    </div>
    <!-- Info Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-custom p-3">
                <div class="fw-semibold">New Reports Today</div>
                <div class="fs-3">{{ $newReportsToday }}</div>
                <div class="text-muted small">Last 24 hours</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom p-3">
                <div class="fw-semibold">Connected Agencies</div>
                <div class="fs-3">{{ $connectedAgencies }}</div>
                <div class="text-muted small">Data sources integrated</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom p-3">
                <div class="fw-semibold text-warning"><i class="bi bi-exclamation-diamond me-1"></i>Risk Alerts</div>
                <div class="fs-3 text-warning">{{ $riskAlerts }}</div>
                <div class="text-muted small">High priority cases</div>
            </div>
        </div>
    </div>
    <!-- Recent Case Activity -->
    <div class="card card-custom recent-activity p-4">
        <div class="fw-bold fs-5 mb-2">Recent Case Activity</div>
        <div class="text-muted mb-3">Last 5 case updates in the system</div>
        @foreach($recentCases as $case)
            <div class="d-flex align-items-start mb-3">
                <span class="case-status-bar {{ $case->status == 'active' ? 'active' : ($case->status == 'under investigation' ? 'investigation' : ($case->status == 'resolved' ? 'resolved' : '')) }}"></span>
                <div>
                    <div class="fw-semibold">Case #CR-{{ str_pad($case->id, 4, '0', STR_PAD_LEFT) }}</div>
                    <div class="text-muted small">{{ $case->description ?? 'No description' }}</div>
                    <div class="text-muted small">{{ $case->updated_at->format('M d, Y h:i A') }}</div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('monthlyCasesChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($monthlyLabels),
                    datasets: [{
                        label: 'Number of Cases',
                        data: @json($monthlyStats),
                        backgroundColor: 'rgba(13, 110, 253, 0.7)',
                        borderColor: 'rgba(13, 110, 253, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                        barThickness: 30,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    return `Cases: ${context.raw}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            suggestedMax: 5,  // Set max to 200 to make 100 appear as average
                            ticks: {
                                stepSize: 0,  // Show ticks every 20 units
                                precision: 0,
                                callback: function(value) {
                                    return value;
                                }
                            },
                            grid: {
                                display: true,
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('genderChart').getContext('2d');
            const genderData = @json($genderDistribution);
            const monthlyGenderData = @json($monthlyGenderDistribution);
            
            let genderChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Male', 'Female', 'Other'],
                    datasets: [{
                        data: [
                            genderData.male,
                            genderData.female,
                            genderData.other
                        ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(255, 206, 86, 0.8)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Distribution of Victim Gender'
                        }
                    }
                }
            });

            // Handle month filter change
            document.getElementById('genderMonthFilter').addEventListener('change', function(e) {
                const selectedMonth = e.target.value;
                let newData;
                
                if (selectedMonth === 'all') {
                    newData = genderData;
                } else {
                    newData = monthlyGenderData[selectedMonth];
                }

                genderChart.data.datasets[0].data = [
                    newData.male,
                    newData.female,
                    newData.other
                ];
                genderChart.update();
            });
        });
    </script>
</div>
@endsection
