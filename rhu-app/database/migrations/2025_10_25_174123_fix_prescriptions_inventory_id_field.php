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
        // Fix inventory_id field to be nullable
        if (Schema::hasColumn('prescriptions', 'inventory_id')) {
            DB::statement('ALTER TABLE prescriptions MODIFY inventory_id BIGINT UNSIGNED NULL DEFAULT NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert inventory_id to be required (if needed)
        if (Schema::hasColumn('prescriptions', 'inventory_id')) {
            DB::statement('ALTER TABLE prescriptions MODIFY inventory_id BIGINT UNSIGNED NOT NULL');
        }
    }
};
