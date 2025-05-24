<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseReport extends Model
{
    use HasFactory;
    // Table name (optional if it matches plural snake_case of model)
    protected $table = 'case_reports';

    protected $fillable = [
        'informant_name',
        'informant_contact',
        'informant_address',
        'informant_reason',
        'date_of_incident',
        'time_of_incident',
        'suspect_name',
        'suspect_address',
        'suspect_dob',
        'suspect_age',
        'suspect_nationality',
        'suspect_foreign_address',
        'victim_name',
        'victim_age_gender',
        'incident_place',
        'what_happened',
        'initial_findings',
        'recommendation',
        'attachments',
        'prepared_by',
        'prepared_date',
        'designation',
        'acknowledged_by',
        'acknowledged_date',
    ];
} 