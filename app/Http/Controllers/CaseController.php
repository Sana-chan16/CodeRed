<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of cases with search functionality.
     */
    public function index(Request $request)
    {
        $query = CaseModel::query();

        // If user is not admin, only show their cases
        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('informant_name', 'like', "%{$searchTerm}%")
                  ->orWhere('suspect_name', 'like', "%{$searchTerm}%")
                  ->orWhere('victim_name', 'like', "%{$searchTerm}%")
                  ->orWhere('incident_place', 'like', "%{$searchTerm}%")
                  ->orWhere('incident_description', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('incident_date', [$request->start_date, $request->end_date]);
        }

        // Sort functionality
        $sortField = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        $cases = $query->paginate(10);

        return view('cases.index', compact('cases'));
    }

    /**
     * Show the form for creating a new case.
     */
    public function create()
    {
        return view('cases.create');
    }

    /**
     * Store a newly created case in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'informant_name' => 'required|string|max:255',
            'informant_contact_number' => 'nullable|string|max:20',
            'informant_address' => 'nullable|string|max:255',
            'reasons_for_reporting' => 'required|string',
            'incident_date' => 'required|date',
            'incident_time' => 'required',
            'suspect_name' => 'nullable|string|max:255',
            'suspect_address' => 'nullable|string|max:255',
            'suspect_dob' => 'nullable|date',
            'suspect_age' => 'nullable|integer',
            'suspect_nationality' => 'nullable|string|max:100',
            'suspect_foreign_address' => 'nullable|string|max:255',
            'victim_name' => 'nullable|string|max:255',
            'victim_age_gender' => 'nullable|string|max:100',
            'incident_place' => 'required|string|max:255',
            'incident_description' => 'required|string',
            'involved_persons' => 'nullable|array',
            'initial_findings' => 'nullable|string',
            'recommendation' => 'nullable|string',
            'attachments_description' => 'nullable|string',
            'prepared_by' => 'required|string|max:255',
            'prepared_by_designation' => 'required|string|max:255',
            'acknowledged_by' => 'nullable|string|max:255',
        ]);

        // Add the user_id to the case
        $validated['user_id'] = Auth::id();

        $case = CaseModel::create($validated);

        return redirect()->route('cases.show', $case)
            ->with('success', 'Case created successfully.');
    }

    /**
     * Display the specified case.
     */
    public function show(CaseModel $case)
    {
        // Check if user has permission to view this case
        if (!Auth::user()->isAdmin() && $case->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('cases.show', compact('case'));
    }

    /**
     * Show the form for editing the specified case.
     */
    public function edit(CaseModel $case)
    {
        // Check if user has permission to edit this case
        if (!Auth::user()->isAdmin() && $case->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('cases.edit', compact('case'));
    }

    /**
     * Update the specified case in storage.
     */
    public function update(Request $request, CaseModel $case)
    {
        // Check if user has permission to update this case
        if (!Auth::user()->isAdmin() && $case->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'informant_name' => 'required|string|max:255',
            'informant_contact_number' => 'nullable|string|max:20',
            'informant_address' => 'nullable|string|max:255',
            'reasons_for_reporting' => 'required|string',
            'incident_date' => 'required|date',
            'incident_time' => 'required',
            'suspect_name' => 'nullable|string|max:255',
            'suspect_address' => 'nullable|string|max:255',
            'suspect_dob' => 'nullable|date',
            'suspect_age' => 'nullable|integer',
            'suspect_nationality' => 'nullable|string|max:100',
            'suspect_foreign_address' => 'nullable|string|max:255',
            'victim_name' => 'nullable|string|max:255',
            'victim_age_gender' => 'nullable|string|max:100',
            'incident_place' => 'required|string|max:255',
            'incident_description' => 'required|string',
            'involved_persons' => 'nullable|array',
            'initial_findings' => 'nullable|string',
            'recommendation' => 'nullable|string',
            'attachments_description' => 'nullable|string',
            'prepared_by' => 'required|string|max:255',
            'prepared_by_designation' => 'required|string|max:255',
            'acknowledged_by' => 'nullable|string|max:255',
        ]);

        $case->update($validated);

        return redirect()->route('cases.show', $case)
            ->with('success', 'Case updated successfully.');
    }

    /**
     * Remove the specified case from storage.
     */
    public function destroy(CaseModel $case)
    {
        // Check if user has permission to delete this case
        if (!Auth::user()->isAdmin() && $case->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $case->delete();

        return redirect()->route('cases.index')
            ->with('success', 'Case deleted successfully.');
    }
} 