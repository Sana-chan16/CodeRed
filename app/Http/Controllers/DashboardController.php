<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseReport;    // Use CaseReport instead of Case
use App\Models\Agency;  // Make sure you have this model
use App\Models\Report;  // Make sure you have this model
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get current and previous month date ranges
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // Fetch cases for current and previous months
        $casesCurrentMonth = CaseReport::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->get();
        $casesPreviousMonth = CaseReport::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->get();

        // Total reports/cases
        $totalReportsCurrent = $casesCurrentMonth->count();
        $totalReportsPrevious = $casesPreviousMonth->count();
        $totalReportsChange = $this->calculatePercentageChange($totalReportsCurrent, $totalReportsPrevious);

        // Active cases
        $activeCasesCurrent = $casesCurrentMonth->where('status', 'active')->count();
        $activeCasesPrevious = $casesPreviousMonth->where('status', 'active')->count();
        $activeCasesChange = $this->calculatePercentageChange($activeCasesCurrent, $activeCasesPrevious);

        // Resolved cases
        $resolvedCasesCurrent = $casesCurrentMonth->where('status', 'resolved')->count();
        $resolvedCasesPrevious = $casesPreviousMonth->where('status', 'resolved')->count();
        $resolvedCasesChange = $this->calculatePercentageChange($resolvedCasesCurrent, $resolvedCasesPrevious);

        // Pending review
        $pendingReviewCurrent = $casesCurrentMonth->where('status', 'pending_review')->count();
        $pendingReviewPrevious = $casesPreviousMonth->where('status', 'pending_review')->count();
        $pendingReviewChange = $this->calculatePercentageChange($pendingReviewCurrent, $pendingReviewPrevious);

        // Active investigations (mapped from high priority for now)
        $activeInvestigationsCurrent = $casesCurrentMonth->where('priority', 'high')->count();
        $activeInvestigationsPrevious = $casesPreviousMonth->where('priority', 'high')->count();
        $activeInvestigationsChange = $this->calculatePercentageChange($activeInvestigationsCurrent, $activeInvestigationsPrevious);

        // New reports today (This metric might not fit the month-over-month change pattern, leaving as is)
        $newReportsToday = CaseReport::where('created_at', '>=', now()->startOfDay())->count();

        // Connected agencies (static for now)
        $connectedAgencies = 0;
        if (class_exists('App\\Models\\Agency')) {
            $connectedAgencies = \App\Models\Agency::count();
        }

        // Recent case activity (last 5 updates)
        $recentCases = CaseReport::orderBy('updated_at', 'desc')->take(5)->get();

        return view('dashboard', [
            'totalReports' => $totalReportsCurrent,
            'totalReportsChange' => $totalReportsChange,
            'totalCasesCount' => $totalReportsCurrent, // Assuming Total Cases is same as Total Reports for now
            'totalCasesChange' => $totalReportsChange, // Assuming Total Cases is same as Total Reports for now
            'activeCasesCount' => $activeCasesCurrent,
            'activeCasesChange' => $activeCasesChange,
            'activeInvestigations' => $activeInvestigationsCurrent,
            'activeInvestigationsChange' => $activeInvestigationsChange,
            'resolvedCasesCount' => $resolvedCasesCurrent,
            'resolvedCasesChange' => $resolvedCasesChange,
            'pendingReviewCount' => $pendingReviewCurrent,
            'pendingReviewChange' => $pendingReviewChange,
            'newReportsToday' => $newReportsToday,
            'connectedAgencies' => $connectedAgencies,
            'recentCases' => $recentCases,
        ]);
    }

    /**
     * Calculate the percentage change between two values.
     *
     * @param int $current The current value.
     * @param int $previous The previous value.
     * @return float|int The percentage change.
     */
    private function calculatePercentageChange($current, $previous)
    {
        if ($previous === 0) {
            return ($current > 0) ? 100 : 0; // If previous is 0 and current is > 0, consider it 100% increase or more, simplify to 100%
        }
        return (($current - $previous) / $previous) * 100;
    }
} 