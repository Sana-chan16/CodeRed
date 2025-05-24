<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseReport;

class CaseReportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'informant_name' => 'required|string|max:255',
            'informant_contact' => 'nullable|string|max:255',
            'informant_address' => 'nullable|string|max:255',
            'informant_reason' => 'nullable|string|max:255',
            'date_of_incident' => 'required|date',
            'time_of_incident' => 'nullable|string|max:255',
            'suspect_name' => 'nullable|string|max:255',
            'suspect_address' => 'nullable|string|max:255',
            'suspect_dob' => 'nullable|date',
            'suspect_age' => 'nullable|string|max:255',
            'suspect_nationality' => 'nullable|string|max:255',
            'suspect_foreign_address' => 'nullable|string|max:255',
            'victim_name' => 'nullable|string|max:255',
            'victim_age_gender' => 'nullable|string|max:255',
            'incident_place' => 'nullable|string|max:255',
            'what_happened' => 'nullable|string',
            'initial_findings' => 'nullable|string',
            'recommendation' => 'nullable|string',
            'attachments' => 'nullable|string',
            'prepared_by' => 'nullable|string|max:255',
            'prepared_date' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'acknowledged_by' => 'nullable|string|max:255',
            'acknowledged_date' => 'nullable|string|max:255',
        ]);

        $case = CaseReport::create($validated);

        return redirect()->route('caseManagement')->with('success', 'Case submitted successfully!');
    }

    public function index(Request $request)
    {
        $query = CaseReport::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('informant_name', 'like', "%{$searchTerm}%")
                  ->orWhere('victim_name', 'like', "%{$searchTerm}%")
                  ->orWhere('incident_place', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Sort by created_at in descending order
        $query->orderBy('created_at', 'desc');

        // Paginate the results
        $cases = $query->paginate(10);

        return view('user.caseManagement', compact('cases'));
    }
} 