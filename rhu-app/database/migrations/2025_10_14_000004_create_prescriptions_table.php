<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments');
            $table->foreignId('inventory_id')->constrained('inventory');
            $table->foreignId('prescribed_by')->constrained('users'); // Doctor who prescribed
            $table->string('patient_name');
            $table->integer('quantity_prescribed');
            $table->string('dosage_instructions'); // e.g., "1 tablet 3x a day"
            $table->integer('duration_days'); // How many days to take
            $table->text('special_instructions')->nullable();
            $table->enum('status', ['pending', 'dispensed', 'partially_dispensed', 'cancelled'])->default('pending');
            $table->timestamp('dispensed_at')->nullable();
            $table->foreignId('dispensed_by')->nullable()->constrained('users'); // Staff who dispensed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
