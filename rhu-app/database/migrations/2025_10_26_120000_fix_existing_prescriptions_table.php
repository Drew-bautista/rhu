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
        // Check if prescriptions table exists
        if (!Schema::hasTable('prescriptions')) {
            // Create prescriptions table if it doesn't exist
            Schema::create('prescriptions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('appointment_id')->nullable();
                $table->string('patient_name');
                $table->text('patient_address')->nullable();
                $table->string('patient_contact')->nullable();
                $table->text('diagnosis')->nullable();
                $table->text('symptoms')->nullable();
                $table->text('medical_history')->nullable();
                $table->enum('status', ['pending', 'dispensed', 'cancelled', 'completed'])->default('pending');
                $table->string('doctor_name')->nullable();
                $table->unsignedBigInteger('prescribed_by')->nullable();
                $table->date('prescription_date')->nullable();
                $table->date('follow_up_date')->nullable();
                $table->text('follow_up_notes')->nullable();
                $table->timestamps();

                $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
                $table->foreign('prescribed_by')->references('id')->on('users')->onDelete('set null');
            });
        } else {
            // Table exists, check and add missing columns
            $this->addMissingColumns();
        }
    }

    /**
     * Add missing columns to existing prescriptions table
     */
    private function addMissingColumns(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            // Check and add missing columns
            if (!Schema::hasColumn('prescriptions', 'patient_name')) {
                $table->string('patient_name')->after('appointment_id');
            }
            if (!Schema::hasColumn('prescriptions', 'patient_address')) {
                $table->text('patient_address')->nullable()->after('patient_name');
            }
            if (!Schema::hasColumn('prescriptions', 'patient_contact')) {
                $table->string('patient_contact')->nullable()->after('patient_address');
            }
            if (!Schema::hasColumn('prescriptions', 'diagnosis')) {
                $table->text('diagnosis')->nullable()->after('patient_contact');
            }
            if (!Schema::hasColumn('prescriptions', 'symptoms')) {
                $table->text('symptoms')->nullable()->after('diagnosis');
            }
            if (!Schema::hasColumn('prescriptions', 'medical_history')) {
                $table->text('medical_history')->nullable()->after('symptoms');
            }
            if (!Schema::hasColumn('prescriptions', 'doctor_name')) {
                $table->string('doctor_name')->nullable()->after('status');
            }
            if (!Schema::hasColumn('prescriptions', 'prescribed_by')) {
                $table->unsignedBigInteger('prescribed_by')->nullable()->after('doctor_name');
            }
            if (!Schema::hasColumn('prescriptions', 'prescription_date')) {
                $table->date('prescription_date')->nullable()->after('prescribed_by');
            }
            if (!Schema::hasColumn('prescriptions', 'follow_up_date')) {
                $table->date('follow_up_date')->nullable()->after('prescription_date');
            }
            if (!Schema::hasColumn('prescriptions', 'follow_up_notes')) {
                $table->text('follow_up_notes')->nullable()->after('follow_up_date');
            }
        });

        // Add foreign key constraints if they don't exist
        try {
            if (!$this->foreignKeyExists('prescriptions', 'prescriptions_appointment_id_foreign')) {
                Schema::table('prescriptions', function (Blueprint $table) {
                    $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
                });
            }
            if (!$this->foreignKeyExists('prescriptions', 'prescriptions_prescribed_by_foreign')) {
                Schema::table('prescriptions', function (Blueprint $table) {
                    $table->foreign('prescribed_by')->references('id')->on('users')->onDelete('set null');
                });
            }
        } catch (\Exception $e) {
            // Foreign keys might already exist or tables might not exist
            \Log::info('Foreign key creation skipped: ' . $e->getMessage());
        }
    }

    /**
     * Check if foreign key exists
     */
    private function foreignKeyExists($table, $keyName): bool
    {
        $keys = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = ? 
            AND CONSTRAINT_NAME = ?
        ", [$table, $keyName]);
        
        return count($keys) > 0;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Don't drop the table in down() to prevent data loss
        // Schema::dropIfExists('prescriptions');
    }
};
