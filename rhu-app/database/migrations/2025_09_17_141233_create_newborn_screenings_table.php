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
        Schema::create('newborn_screenings', function (Blueprint $table) {
            $table->id();

            // 🍼 Newborn Info
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->enum('sex', ['Male', 'Female']);
            $table->date('date_of_birth');
            $table->time('time_of_birth')->nullable();
            $table->decimal('birth_weight', 5, 2)->nullable(); // in kg
            $table->integer('gestational_age')->nullable(); // in weeks
            $table->string('place_of_birth')->nullable();

            // 👩‍🍼 Mother Info
            $table->string('mother_name');
            $table->integer('mother_age')->nullable();
            $table->string('mother_address')->nullable();
            $table->string('mother_contact')->nullable();

            // 🧾 Screening Details
            $table->date('screening_date');
            $table->string('facility')->nullable();
            $table->string('kit_no')->nullable();
            $table->dateTime('sample_collection_at')->nullable();
            $table->string('specimen_type')->nullable();

            // 🧪 Screening Results
            $table->json('conditions_tested')->nullable(); // para sa multiple conditions
            $table->enum('result_status', ['Normal', 'Positive', 'Retest'])->default('Normal');
            $table->text('remarks')->nullable();

            // 👨‍⚕️ Health Provider
            $table->string('provider_name')->nullable();
            $table->string('provider_role')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newborn_screenings');
    }
};
