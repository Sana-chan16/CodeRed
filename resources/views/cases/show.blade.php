@extends(Auth::user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Case #{{ $case->id }}</h2>
                    <div>
                        <a href="{{ route('cases.edit', $case) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('cases.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Informant Information -->
                    <div class="mb-4">
                        <h4>Informant Information</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Name:</strong> {{ $case->informant_name }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Contact Number:</strong> {{ $case->informant_contact_number }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Address:</strong> {{ $case->informant_address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Incident Information -->
                    <div class="mb-4">
                        <h4>Incident Information</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Reasons for Reporting:</strong></p>
                                <p>{{ $case->reasons_for_reporting }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Date:</strong> {{ $case->incident_date->format('M d, Y') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Time:</strong> {{ $case->incident_time }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Place:</strong> {{ $case->incident_place }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Suspect Information -->
                    <div class="mb-4">
                        <h4>Suspect Information</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Name:</strong> {{ $case->suspect_name }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Date of Birth:</strong> {{ $case->suspect_dob?->format('M d, Y') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Age:</strong> {{ $case->suspect_age }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Nationality:</strong> {{ $case->suspect_nationality }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Address:</strong> {{ $case->suspect_address }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Foreign Address:</strong> {{ $case->suspect_foreign_address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Victim Information -->
                    <div class="mb-4">
                        <h4>Victim Information</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ $case->victim_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Age & Gender:</strong> {{ $case->victim_age_gender }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Case Details -->
                    <div class="mb-4">
                        <h4>Case Details</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Incident Description:</strong></p>
                                <p>{{ $case->incident_description }}</p>
                            </div>
                            <div class="col-md-12">
                                <p><strong>Involved Persons:</strong></p>
                                <p>{{ $case->involved_persons }}</p>
                            </div>
                            <div class="col-md-12">
                                <p><strong>Initial Findings:</strong></p>
                                <p>{{ $case->initial_findings }}</p>
                            </div>
                            <div class="col-md-12">
                                <p><strong>Recommendation:</strong></p>
                                <p>{{ $case->recommendation }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Case Preparation -->
                    <div class="mb-4">
                        <h4>Case Preparation</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Prepared By:</strong> {{ $case->prepared_by }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Designation:</strong> {{ $case->prepared_by_designation }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Acknowledged By:</strong> {{ $case->acknowledged_by }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Attachments -->
                    <div class="mb-4">
                        <h4>Attachments</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Description:</strong></p>
                                <p>{{ $case->attachments_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 