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
        Schema::create('health_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->text('height')->nullable();
            $table->text('weight')->nullable();
            $table->text('blood_pressure')->nullable();
            $table->text('heart_rate')->nullable();
            $table->text('respiratory_rate')->nullable();
            $table->text('visual_acuity')->nullable();
            $table->text('temperature')->nullable();
            // $table->text('medical_history')->nullable();
            // $table->text('medical_conditions')->nullable();
            // $table->text('allergies')->nullable();
            // $table->text('symptoms')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_assessment');
    }
};
