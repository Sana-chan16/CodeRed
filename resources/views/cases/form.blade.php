@props(['case' => null])

<div class="row">
    <!-- Informant Information -->
    <div class="col-md-12 mb-4">
        <h4>Informant Information</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="informant_name">Name *</label>
                    <input type="text" class="form-control @error('informant_name') is-invalid @enderror" 
                           id="informant_name" name="informant_name" 
                           value="{{ old('informant_name', $case?->informant_name) }}" required>
                    @error('informant_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="informant_contact_number">Contact Number</label>
                    <input type="text" class="form-control @error('informant_contact_number') is-invalid @enderror" 
                           id="informant_contact_number" name="informant_contact_number" 
                           value="{{ old('informant_contact_number', $case?->informant_contact_number) }}">
                    @error('informant_contact_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="informant_address">Address</label>
                    <input type="text" class="form-control @error('informant_address') is-invalid @enderror" 
                           id="informant_address" name="informant_address" 
                           value="{{ old('informant_address', $case?->informant_address) }}">
                    @error('informant_address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Incident Information -->
    <div class="col-md-12 mb-4">
        <h4>Incident Information</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="reasons_for_reporting">Reasons for Reporting *</label>
                    <textarea class="form-control @error('reasons_for_reporting') is-invalid @enderror" 
                              id="reasons_for_reporting" name="reasons_for_reporting" rows="3" required>{{ old('reasons_for_reporting', $case?->reasons_for_reporting) }}</textarea>
                    @error('reasons_for_reporting')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="incident_date">Date *</label>
                    <input type="date" class="form-control @error('incident_date') is-invalid @enderror" 
                           id="incident_date" name="incident_date" 
                           value="{{ old('incident_date', $case?->incident_date?->format('Y-m-d')) }}" required>
                    @error('incident_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="incident_time">Time *</label>
                    <input type="time" class="form-control @error('incident_time') is-invalid @enderror" 
                           id="incident_time" name="incident_time" 
                           value="{{ old('incident_time', $case?->incident_time) }}" required>
                    @error('incident_time')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="incident_place">Place *</label>
                    <input type="text" class="form-control @error('incident_place') is-invalid @enderror" 
                           id="incident_place" name="incident_place" 
                           value="{{ old('incident_place', $case?->incident_place) }}" required>
                    @error('incident_place')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Suspect Information -->
    <div class="col-md-12 mb-4">
        <h4>Suspect Information</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="suspect_name">Name</label>
                    <input type="text" class="form-control @error('suspect_name') is-invalid @enderror" 
                           id="suspect_name" name="suspect_name" 
                           value="{{ old('suspect_name', $case?->suspect_name) }}">
                    @error('suspect_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="suspect_dob">Date of Birth</label>
                    <input type="date" class="form-control @error('suspect_dob') is-invalid @enderror" 
                           id="suspect_dob" name="suspect_dob" 
                           value="{{ old('suspect_dob', $case?->suspect_dob?->format('Y-m-d')) }}">
                    @error('suspect_dob')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="suspect_age">Age</label>
                    <input type="number" class="form-control @error('suspect_age') is-invalid @enderror" 
                           id="suspect_age" name="suspect_age" 
                           value="{{ old('suspect_age', $case?->suspect_age) }}">
                    @error('suspect_age')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="suspect_nationality">Nationality</label>
                    <input type="text" class="form-control @error('suspect_nationality') is-invalid @enderror" 
                           id="suspect_nationality" name="suspect_nationality" 
                           value="{{ old('suspect_nationality', $case?->suspect_nationality) }}">
                    @error('suspect_nationality')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="suspect_address">Address</label>
                    <input type="text" class="form-control @error('suspect_address') is-invalid @enderror" 
                           id="suspect_address" name="suspect_address" 
                           value="{{ old('suspect_address', $case?->suspect_address) }}">
                    @error('suspect_address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="suspect_foreign_address">Foreign Address</label>
                    <input type="text" class="form-control @error('suspect_foreign_address') is-invalid @enderror" 
                           id="suspect_foreign_address" name="suspect_foreign_address" 
                           value="{{ old('suspect_foreign_address', $case?->suspect_foreign_address) }}">
                    @error('suspect_foreign_address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Victim Information -->
    <div class="col-md-12 mb-4">
        <h4>Victim Information</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="victim_name">Name</label>
                    <input type="text" class="form-control @error('victim_name') is-invalid @enderror" 
                           id="victim_name" name="victim_name" 
                           value="{{ old('victim_name', $case?->victim_name) }}">
                    @error('victim_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="victim_age_gender">Age & Gender</label>
                    <input type="text" class="form-control @error('victim_age_gender') is-invalid @enderror" 
                           id="victim_age_gender" name="victim_age_gender" 
                           value="{{ old('victim_age_gender', $case?->victim_age_gender) }}">
                    @error('victim_age_gender')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Case Details -->
    <div class="col-md-12 mb-4">
        <h4>Case Details</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="incident_description">Incident Description *</label>
                    <textarea class="form-control @error('incident_description') is-invalid @enderror" 
                              id="incident_description" name="incident_description" rows="4" required>{{ old('incident_description', $case?->incident_description) }}</textarea>
                    @error('incident_description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="involved_persons">Involved Persons</label>
                    <textarea class="form-control @error('involved_persons') is-invalid @enderror" 
                              id="involved_persons" name="involved_persons" rows="3">{{ old('involved_persons', $case?->involved_persons) }}</textarea>
                    @error('involved_persons')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="initial_findings">Initial Findings</label>
                    <textarea class="form-control @error('initial_findings') is-invalid @enderror" 
                              id="initial_findings" name="initial_findings" rows="3">{{ old('initial_findings', $case?->initial_findings) }}</textarea>
                    @error('initial_findings')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="recommendation">Recommendation</label>
                    <textarea class="form-control @error('recommendation') is-invalid @enderror" 
                              id="recommendation" name="recommendation" rows="3">{{ old('recommendation', $case?->recommendation) }}</textarea>
                    @error('recommendation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Case Preparation -->
    <div class="col-md-12 mb-4">
        <h4>Case Preparation</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="prepared_by">Prepared By *</label>
                    <input type="text" class="form-control @error('prepared_by') is-invalid @enderror" 
                           id="prepared_by" name="prepared_by" 
                           value="{{ old('prepared_by', $case?->prepared_by) }}" required>
                    @error('prepared_by')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="prepared_by_designation">Designation *</label>
                    <input type="text" class="form-control @error('prepared_by_designation') is-invalid @enderror" 
                           id="prepared_by_designation" name="prepared_by_designation" 
                           value="{{ old('prepared_by_designation', $case?->prepared_by_designation) }}" required>
                    @error('prepared_by_designation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="acknowledged_by">Acknowledged By</label>
                    <input type="text" class="form-control @error('acknowledged_by') is-invalid @enderror" 
                           id="acknowledged_by" name="acknowledged_by" 
                           value="{{ old('acknowledged_by', $case?->acknowledged_by) }}">
                    @error('acknowledged_by')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Attachments -->
    <div class="col-md-12 mb-4">
        <h4>Attachments</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="attachments_description">Description of Attachments</label>
                    <textarea class="form-control @error('attachments_description') is-invalid @enderror" 
                              id="attachments_description" name="attachments_description" rows="3">{{ old('attachments_description', $case?->attachments_description) }}</textarea>
                    @error('attachments_description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div> 