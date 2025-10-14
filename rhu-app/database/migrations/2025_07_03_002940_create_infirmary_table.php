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
        Schema::create('infirmary', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->enum('sex', ['male', 'female']);
            $table->date('birthdate');
            $table->string('contact_no');
            $table->string('emergency_contact');
            $table->text('address');
            // Physical examination fields
            $table->decimal('height', 5, 2); // Assuming height in cm
            $table->decimal('weight', 5, 2); // Assuming weight in kg
            $table->string('blood_pressure'); // e.g., "120/80 mmHg     "
            $table->integer('heart_rate'); // Beats per minute
            $table->integer('respiratory_rate'); // Breaths per minute   
            $table->string('visual_acuity'); // e.g., "20/20"
            $table->decimal('temperature', 4, 2); // Assuming temperature in Celsius
            // Treatment fields
            $table->dateTime('consultation_date_time'); // Date and time of consultation
            $table->string('chief_complaint')->nullable(); // Chief complaint of the patient
            $table->string('laboratory_findings')->nullable(); // Findings from laboratory tests        
            $table->string('assessment_diagnosis')->nullable(); // Diagnosis made by the healthcare provider
            $table->string('medical_history')->nullable(); // Patient's medical history
            $table->string('medication_treatment')->nullable(); // Medication or treatment prescribed
            $table->string('personal_social_history')->nullable(); // Personal and social history of the patient
            $table->string('pregnancy_history')->nullable(); // Pregnancy history if applicable            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infirmary');
    }
};
