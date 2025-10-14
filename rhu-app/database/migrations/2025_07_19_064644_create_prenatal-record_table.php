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
        Schema::create('prenatal_record', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->integer('age_of_gestation')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->enum('nutritional_status', ['normal', 'underweight', 'overweight'])->nullable();
            $table->text('birth_plan')->nullable();
            $table->text('dental_checkup')->nullable();
            $table->timestamps();

            // $table->foreign('patient_appointment_id')->references('id')->on('appointments')->onDelete('cascade');
        });
    }
    // Schema::create('appointments', function (Blueprint $table) {
    //     $table->id();
    //     $table->string('patient_name');
    //     // $table->string('contact_info');
    //     $table->date('date_of_appointment');
    //     $table->decimal('weight', 5, 2); // Weight in kg (e.g., 65.5 kg)
    //     $table->integer('age_of_gestation'); // Age of gestation in weeks
    //     $table->string('blood_pressure'); // Blood pressure (e.g., 120/80)
    //     $table->enum('nutritional_status', ['normal', 'underweight', 'overweight']);
    //     $table->enum('number_of_checkup', ['first checkup', 'second checkup', 'third checkup']);
    //     $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
    //     $table->text('birth_plan');
    //     $table->text('dental_checkup');
    //     $table->timestamps(); // created_at and updated_at columns


    public function down(): void
    {
        Schema::dropIfExists('prenatal_record');
    }
};
