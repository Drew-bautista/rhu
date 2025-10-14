<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animal_bite_cases', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('appointment_id')->nullable();

            // Incident Details
            $table->date('date_of_incident')->nullable();

            // Animal Info
            $table->string('animal_type')->nullable(); // dog, cat, others
            $table->enum('animal_ownership', ['Owned', 'Stray'])->nullable();
            $table->enum('animal_vaccination_status', ['Vaccinated', 'Unvaccinated', 'Unknown'])->nullable();
            $table->enum('animal_behavior', ['Normal', 'Aggressive', 'Rabid Signs'])->nullable();

            // Bite Details
            $table->string('bite_site')->nullable(); // e.g., left leg
            $table->enum('bite_category', ['I', 'II', 'III'])->nullable();
            $table->text('wound_description')->nullable();

            // Treatment
            $table->date('first_consultation_date')->nullable();
            $table->string('arv_dose')->nullable(); // e.g. Dose 1, Dose 2
            $table->date('arv_date')->nullable();
            $table->string('rig_administered')->nullable(); // Yes/No
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animal_bite_cases');
    }
};
