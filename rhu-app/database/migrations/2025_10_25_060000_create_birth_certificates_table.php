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
        Schema::create('birth_certificates', function (Blueprint $table) {
            $table->id();
            
            // Child Information
            $table->string('child_first_name');
            $table->string('child_middle_name')->nullable();
            $table->string('child_last_name');
            $table->enum('child_sex', ['Male', 'Female']);
            $table->date('date_of_birth');
            $table->time('time_of_birth')->nullable();
            $table->string('place_of_birth');
            $table->decimal('birth_weight', 5, 2)->nullable(); // in kg
            $table->integer('birth_length')->nullable(); // in cm
            $table->enum('type_of_birth', ['Single', 'Twin', 'Triplet', 'Multiple'])->default('Single');
            $table->enum('birth_order', ['1st', '2nd', '3rd', '4th', '5th', 'Other'])->nullable();
            
            // Mother Information
            $table->string('mother_first_name');
            $table->string('mother_middle_name')->nullable();
            $table->string('mother_last_name');
            $table->string('mother_maiden_name')->nullable();
            $table->date('mother_date_of_birth')->nullable();
            $table->integer('mother_age_at_birth')->nullable();
            $table->string('mother_citizenship')->nullable();
            $table->string('mother_religion')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_address');
            
            // Father Information
            $table->string('father_first_name')->nullable();
            $table->string('father_middle_name')->nullable();
            $table->string('father_last_name')->nullable();
            $table->date('father_date_of_birth')->nullable();
            $table->integer('father_age_at_birth')->nullable();
            $table->string('father_citizenship')->nullable();
            $table->string('father_religion')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_address')->nullable();
            
            // Marriage Information
            $table->date('parents_marriage_date')->nullable();
            $table->string('parents_marriage_place')->nullable();
            
            // Birth Attendant Information
            $table->string('attendant_name')->nullable();
            $table->enum('attendant_type', ['Doctor', 'Midwife', 'Nurse', 'Hilot', 'Others'])->nullable();
            $table->string('attendant_title')->nullable();
            
            // Registration Information
            $table->string('registry_number')->unique()->nullable();
            $table->date('date_registered')->nullable();
            $table->string('registered_by')->nullable();
            $table->string('registrar_name')->nullable();
            
            // Additional Information
            $table->text('remarks')->nullable();
            $table->enum('status', ['Draft', 'Registered', 'Issued'])->default('Draft');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birth_certificates');
    }
};
