<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments');
            $table->string('patient_name');
            $table->date('date_of_birth');
            $table->integer('age');
            $table->enum('age_group', ['infant', 'child', 'adolescent', 'adult', 'senior']);
            $table->enum('sex', ['male', 'female', 'other']);
            $table->string('contact_number');
            $table->string('address');
            $table->string('vaccine_type'); // BCG, DPT, OPV, MMR, Hepatitis B, COVID-19, Flu, etc.
            $table->string('dose_number'); // 1st dose, 2nd dose, booster, etc.
            $table->date('date_administered');
            $table->date('next_dose_date')->nullable();
            $table->string('administered_by'); // Name of healthcare provider
            $table->string('batch_number')->nullable();
            $table->date('expiry_date')->nullable();
            $table->text('adverse_reactions')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
