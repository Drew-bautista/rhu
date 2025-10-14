<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('child_immunizations', function (Blueprint $table) {
            $table->id();

            // Basic child info
            $table->string('child_name');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('parent_name')->nullable();
            $table->string('address')->nullable();

            // Immunization details
            $table->string('vaccine_name');
            $table->date('immunization_date');
            $table->string('dose_number')->nullable(); // e.g. 1st dose, 2nd dose
            $table->string('administered_by')->nullable(); // doctor/nurse name
            $table->string('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('child_immunizations');
    }
};
