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
        // Fetch all cases
        $cases = CaseReport::orderBy('created_at', 'desc')->get();

        // Total cases
        $totalCases = $cases->count();

        // Current active cases (if status field exists, otherwise all are active)
        $activeCases = $cases->where('status', 'active')->count();
        if ($activeCases === 0) $activeCases = $totalCases;

        // Resolved cases (if status field exists)
        $resolvedCases = $cases->where('status', 'resolved')->count();

        // Pending review (if status field exists)
        $pendingReview = $cases->where('status', 'pending_review')->count();

        // New reports today
        $newReportsToday = $cases->where('created_at', '>=', now()->startOfDay())->count();

        // Connected agencies (static for now)
        $connectedAgencies = 0;
        if (class_exists('App\\Models\\Agency')) {
            $connectedAgencies = \App\Models\Agency::count();
        }

        // Risk alerts (static for now)
        $riskAlerts = $cases->where('priority', 'high')->count();

        // Recent case activity (last 5 updates)
        $recentCases = $cases->take(5);

        return view('user.dashboard', [
            'totalCases' => $totalCases,
            'activeCases' => $activeCases,
            'resolvedCases' => $resolvedCases,
            'pendingReview' => $pendingReview,
            'newReportsToday' => $newReportsToday,
            'connectedAgencies' => $connectedAgencies,
            'riskAlerts' => $riskAlerts,
            'recentCases' => $recentCases,
        ]);
    }
} 