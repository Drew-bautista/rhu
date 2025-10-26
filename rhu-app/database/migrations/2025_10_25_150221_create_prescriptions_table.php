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
        // Skip if table already exists (for deployment compatibility)
        if (Schema::hasTable('prescriptions')) {
            return;
        }
        
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            
            // Patient Information
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->string('patient_name');
            $table->integer('patient_age')->nullable();
            $table->string('patient_contact')->nullable();
            
            // Prescription Details
            $table->string('prescription_number')->unique();
            $table->date('prescription_date');
            $table->string('doctor_name');
            
            // Medical Information
            $table->text('diagnosis')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('medical_history')->nullable();
            
            // Prescription Status
            $table->enum('status', ['Draft', 'Prescribed', 'Dispensed', 'Completed'])->default('Draft');
            $table->text('notes')->nullable();
            
            // Follow-up
            $table->date('follow_up_date')->nullable();
            $table->text('follow_up_notes')->nullable();
            
            $table->timestamps();
            
            // Foreign key
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('set null');
            
            // Indexes
            $table->index('prescription_number');
            $table->index('patient_name');
            $table->index('prescription_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
