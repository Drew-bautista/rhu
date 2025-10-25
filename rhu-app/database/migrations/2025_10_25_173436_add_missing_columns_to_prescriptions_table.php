<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            // Add missing columns that are in the model but not in the database
            if (!Schema::hasColumn('prescriptions', 'patient_age')) {
                $table->integer('patient_age')->nullable()->after('patient_name');
            }
            if (!Schema::hasColumn('prescriptions', 'patient_contact')) {
                $table->string('patient_contact')->nullable()->after('patient_age');
            }
            if (!Schema::hasColumn('prescriptions', 'prescription_number')) {
                $table->string('prescription_number')->nullable()->after('patient_contact');
            }
            if (!Schema::hasColumn('prescriptions', 'prescription_date')) {
                $table->date('prescription_date')->nullable()->after('prescription_number');
            }
            if (!Schema::hasColumn('prescriptions', 'doctor_name')) {
                $table->string('doctor_name')->nullable()->after('prescription_date');
            }
            if (!Schema::hasColumn('prescriptions', 'diagnosis')) {
                $table->text('diagnosis')->nullable()->after('doctor_name');
            }
            if (!Schema::hasColumn('prescriptions', 'symptoms')) {
                $table->text('symptoms')->nullable()->after('diagnosis');
            }
            if (!Schema::hasColumn('prescriptions', 'medical_history')) {
                $table->text('medical_history')->nullable()->after('symptoms');
            }
            if (!Schema::hasColumn('prescriptions', 'status')) {
                $table->enum('status', ['Draft', 'Prescribed', 'Dispensed', 'Completed', 'Cancelled'])->default('Draft')->after('medical_history');
            }
            if (!Schema::hasColumn('prescriptions', 'notes')) {
                $table->text('notes')->nullable()->after('status');
            }
            if (!Schema::hasColumn('prescriptions', 'follow_up_date')) {
                $table->date('follow_up_date')->nullable()->after('notes');
            }
            if (!Schema::hasColumn('prescriptions', 'follow_up_notes')) {
                $table->text('follow_up_notes')->nullable()->after('follow_up_date');
            }
            
            // Handle inventory_id field if it exists but shouldn't be required
            if (Schema::hasColumn('prescriptions', 'inventory_id')) {
                DB::statement('ALTER TABLE prescriptions MODIFY inventory_id BIGINT UNSIGNED NULL DEFAULT NULL');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropColumn([
                'patient_age',
                'patient_contact', 
                'prescription_number',
                'prescription_date',
                'doctor_name',
                'diagnosis',
                'symptoms',
                'medical_history',
                'status',
                'notes',
                'follow_up_date',
                'follow_up_notes'
            ]);
        });
    }
};
