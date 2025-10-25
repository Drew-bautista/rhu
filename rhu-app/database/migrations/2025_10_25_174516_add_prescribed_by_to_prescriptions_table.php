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
            // Add prescribed_by field if it doesn't exist
            if (!Schema::hasColumn('prescriptions', 'prescribed_by')) {
                $table->unsignedBigInteger('prescribed_by')->nullable()->after('doctor_name');
            }
        });
        
        // If prescribed_by exists but is required, make it nullable
        if (Schema::hasColumn('prescriptions', 'prescribed_by')) {
            DB::statement('ALTER TABLE prescriptions MODIFY prescribed_by BIGINT UNSIGNED NULL DEFAULT NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            if (Schema::hasColumn('prescriptions', 'prescribed_by')) {
                $table->dropColumn('prescribed_by');
            }
        });
    }
};
