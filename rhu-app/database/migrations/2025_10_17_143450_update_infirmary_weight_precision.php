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
        Schema::table('infirmary', function (Blueprint $table) {
            // Increase weight column precision to handle larger values
            $table->decimal('weight', 6, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('infirmary', function (Blueprint $table) {
            // Revert back to original precision
            $table->decimal('weight', 5, 2)->change();
        });
    }
};
