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

        // Fetch all cases for gender distribution
        $allCases = CaseReport::all();
        
        // Process gender distribution
        $genderDistribution = [
            'male' => 0,
            'female' => 0,
            'other' => 0
        ];

        // Initialize monthly gender distribution array
        $monthlyGenderDistribution = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyGenderDistribution[] = [
                'male' => 0,
                'female' => 0,
                'other' => 0
            ];
        }

        foreach ($allCases as $case) {
            if ($case->victim_age_gender) {
                $gender = strtolower(trim($case->victim_age_gender));
                $monthIndex = 5 - (now()->diffInMonths($case->created_at));
                
                // Only process if the case is within the last 6 months
                if ($monthIndex >= 0 && $monthIndex <= 5) {
                    if (str_contains($gender, 'female')) {
                        $monthlyGenderDistribution[$monthIndex]['female']++;
                    } elseif (str_contains($gender, 'male')) {
                        $monthlyGenderDistribution[$monthIndex]['male']++;
                    } else {
                        $monthlyGenderDistribution[$monthIndex]['other']++;
                    }
                }

                // Update overall distribution
                if (str_contains($gender, 'female')) {
                    $genderDistribution['female']++;
                } elseif (str_contains($gender, 'male')) {
                    $genderDistribution['male']++;
                } else {
                    $genderDistribution['other']++;
                }
            }
        }

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

        // Get monthly case statistics for the last 6 months
        $monthlyStats = [];
        $monthlyLabels = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyStats[] = CaseReport::whereYear('created_at', $date->year)
                                      ->whereMonth('created_at', $date->month)
                                      ->count();
            $monthlyLabels[] = $date->format('M Y');
        }

        // Get total cases (all time)
        $totalCases = CaseReport::count();
        
        // Get active cases (current month)
        $activeCases = $activeCasesCurrent;
        
        // Get resolved cases (current month)
        $resolvedCases = $resolvedCasesCurrent;
        
        // Get pending review cases (current month)
        $pendingReview = $pendingReviewCurrent;
        
        // Get risk alerts (high priority cases)
        $riskAlerts = $activeInvestigationsCurrent;

        return view('user.dashboard', [
            'totalCases' => $totalCases,
            'activeCases' => $activeCases,
            'resolvedCases' => $resolvedCases,
            'pendingReview' => $pendingReview,
            'newReportsToday' => $newReportsToday,
            'connectedAgencies' => $connectedAgencies,
            'recentCases' => $recentCases,
            'monthlyStats' => $monthlyStats,
            'monthlyLabels' => $monthlyLabels,
            'riskAlerts' => $riskAlerts,
            'genderDistribution' => $genderDistribution,
            'monthlyGenderDistribution' => $monthlyGenderDistribution
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