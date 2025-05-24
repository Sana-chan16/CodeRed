<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('case_models', function (Blueprint $table) {
            $table->id();
            $table->string('informant_name');
            $table->string('informant_contact_number')->nullable();
            $table->string('informant_address')->nullable();
            $table->text('reasons_for_reporting');
            $table->date('incident_date');
            $table->time('incident_time');
            $table->string('suspect_name')->nullable();
            $table->string('suspect_address')->nullable();
            $table->date('suspect_dob')->nullable();
            $table->integer('suspect_age')->nullable();
            $table->string('suspect_nationality')->nullable();
            $table->string('suspect_foreign_address')->nullable();
            $table->string('victim_name')->nullable();
            $table->string('victim_age_gender')->nullable();
            $table->string('incident_place');
            $table->text('incident_description');
            $table->json('involved_persons')->nullable();
            $table->text('initial_findings')->nullable();
            $table->text('recommendation')->nullable();
            $table->text('attachments_description')->nullable();
            $table->string('prepared_by');
            $table->string('prepared_by_designation');
            $table->string('acknowledged_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_models');
    }
}; 