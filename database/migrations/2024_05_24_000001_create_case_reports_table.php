<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_reports', function (Blueprint $table) {
            $table->id();
            $table->string('informant_name');
            $table->string('informant_contact')->nullable();
            $table->string('informant_address')->nullable();
            $table->string('informant_reason')->nullable();
            $table->date('date_of_incident');
            $table->string('time_of_incident')->nullable();
            $table->string('suspect_name')->nullable();
            $table->string('suspect_address')->nullable();
            $table->date('suspect_dob')->nullable();
            $table->string('suspect_age')->nullable();
            $table->string('suspect_nationality')->nullable();
            $table->string('suspect_foreign_address')->nullable();
            $table->string('victim_name')->nullable();
            $table->string('victim_age_gender')->nullable();
            $table->string('incident_place')->nullable();
            $table->text('what_happened')->nullable();
            $table->text('initial_findings')->nullable();
            $table->text('recommendation')->nullable();
            $table->string('attachments')->nullable();
            $table->string('prepared_by')->nullable();
            $table->string('prepared_date')->nullable();
            $table->string('designation')->nullable();
            $table->string('acknowledged_by')->nullable();
            $table->string('acknowledged_date')->nullable();
            $table->string('status')->default('pending');
            $table->string('priority')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_reports');
    }
}; 