@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    body { background: #f6f8fb; }
    .section-title { font-weight: bold; color: #0d6efd; margin-top: 2rem; margin-bottom: 1rem; }
    .form-label { font-weight: 500; }
    .table-bordered th, .table-bordered td { border: 1px solid #dee2e6 !important; }
    .dotted { border-bottom: 1px dotted #333; min-width: 180px; display: inline-block; }
    .signature-line { border-bottom: 1px solid #333; min-width: 220px; display: inline-block; margin-bottom: 0.5rem; }
    .small-note { font-size: 0.85em; color: #888; }
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
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('caseManagement') }}">
                <i class="bi bi-folder2-open"></i> Case Management
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('submateCase') }}">
                <i class="bi bi-plus-circle"></i> Submit Case
            </a>
        </li>
    </ul>
</div>
<div class="main-content">
    <div class="container bg-white p-4 my-4 rounded shadow-sm" style="max-width:900px;">
        <form id="incidentForm" method="POST" action="{{ route('caseReports.store') }}">
            @csrf
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <h5 class="mb-0">INCIDENT REPORT <span class="text-danger" style="font-size:0.9rem;">confidential</span></h5>
                    <div class="small-note">INFORMATION OF THE INFORMANT</div>
                </div>
                <img src="https://i.imgur.com/1Q9Z1Zm.png" alt="Logo" style="height:48px;">
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="informant_name">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Contact Number</label>
                    <input type="text" class="form-control" name="informant_contact">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Present Address</label>
                    <input type="text" class="form-control" name="informant_address">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Reasons for Reporting</label>
                    <input type="text" class="form-control" name="informant_reason">
                </div>
            </div>
            <div class="section-title">DETAILS OF INCIDENT</div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <label class="form-label">When (Date of Incident)</label>
                    <input type="date" class="form-control" name="date_of_incident">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Time of Incident</label>
                    <input type="time" class="form-control" name="time_of_incident">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <label class="form-label">Name of Alleged Suspect</label>
                    <input type="text" class="form-control" name="suspect_name">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Address of the Alleged Suspect</label>
                    <input type="text" class="form-control" name="suspect_address">
                </div>
                <div class="col-md-4">
                    <label class="form-label">DOB of Alleged Suspect</label>
                    <input type="date" class="form-control" name="suspect_dob">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <label class="form-label">Age of Alleged Suspect</label>
                    <input type="number" class="form-control" name="suspect_age">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nationality</label>
                    <input type="text" class="form-control" name="suspect_nationality">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Foreign Address</label>
                    <input type="text" class="form-control" name="suspect_foreign_address">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <label class="form-label">Name of Alleged Victim</label>
                    <input type="text" class="form-control" name="victim_name">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Age & Gender of the Alleged Victim</label>
                    <input type="text" class="form-control" name="victim_age_gender">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Where (Place of Incident)</label>
                    <input type="text" class="form-control" name="incident_place">
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label">What Happened? / How?</label>
                <input type="text" class="form-control" name="what_happened">
            </div>
            <div class="mb-3">
                <label class="form-label">Who's Involved (other persons involved in the case):</label>
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Nature of Involvement</th>
                            <th>Relation to Victim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-3">
                <label class="form-label">Initial Findings :</label>
                <textarea class="form-control" rows="4" name="initial_findings"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Recommendation:</label>
                <input type="text" class="form-control" name="recommendation">
            </div>
            <div class="mb-3">
                <label class="form-label">Applicable Attachment/s (Please describe):</label>
                <input type="text" class="form-control mb-2" name="attachments">
                <input type="text" class="form-control">
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Prepared By:</label>
                    <div class="signature-line"></div>
                    <div class="small-note">Complete Name & Signature</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date / Time :</label>
                    <div class="signature-line"></div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Designation:</label>
                <input type="text" class="form-control" name="designation">
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Acknowledged By (Informant):</label>
                    <div class="signature-line"></div>
                    <div class="small-note">Complete Name & Signature</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date / Time :</label>
                    <div class="signature-line"></div>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button class="btn btn-outline-secondary" type="button">Save as Draft</button>
                <button class="btn btn-primary" type="submit">Submit Report</button>
            </div>
        </form>
    </div>
</div>
@endsection
