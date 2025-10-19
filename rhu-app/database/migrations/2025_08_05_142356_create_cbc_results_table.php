<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cbc_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->decimal('hemoglobin', 5, 2)->nullable();
            $table->decimal('hematocrit', 5, 2)->nullable();
            $table->decimal('rbc_count', 5, 2)->nullable();
            $table->decimal('wbc_count', 5, 2)->nullable();
            $table->decimal('platelet_count', 5, 2)->nullable();
            $table->decimal('mcv', 5, 2)->nullable();
            $table->decimal('mch', 5, 2)->nullable();
            $table->decimal('mchc', 5, 2)->nullable();
            $table->decimal('neutrophils', 5, 2)->nullable();
            $table->decimal('lymphocytes', 5, 2)->nullable();
            $table->decimal('monocytes', 5, 2)->nullable();
            $table->decimal('eosinophils', 5, 2)->nullable();
            $table->decimal('basophils', 5, 2)->nullable();

            $table->string('newborn_screening')->nullable();  // Positive / Negative / Result code
            $table->string('hepa_b_screening')->nullable();   // HBsAg / Anti-HBs result
            $table->decimal('fasting_blood_sugar', 5, 2)->nullable(); // mmol/L or mg/dL
            $table->decimal('cholesterol', 5, 2)->nullable(); // mg/dL
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cbc_results');
    }
};
