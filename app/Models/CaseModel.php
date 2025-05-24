<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'informant_name',
        'informant_contact_number',
        'informant_address',
        'reasons_for_reporting',
        'incident_date',
        'incident_time',
        'suspect_name',
        'suspect_address',
        'suspect_dob',
        'suspect_age',
        'suspect_nationality',
        'suspect_foreign_address',
        'victim_name',
        'victim_age_gender',
        'incident_place',
        'incident_description',
        'involved_persons',
        'initial_findings',
        'recommendation',
        'attachments_description',
        'prepared_by',
        'prepared_by_designation',
        'acknowledged_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'incident_date' => 'date',
        'suspect_dob' => 'date',
        'involved_persons' => 'json',
    ];

    /**
     * Get the user that created the case.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Assuming cases can be linked to users who created or are assigned
    // public function creator(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }

    // public function assignee(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'assigned_to');
    // }
} 