<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbdots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments');
            $table->string('patient_name');
            $table->date('date_of_birth');
            $table->integer('age');
            $table->enum('sex', ['male', 'female', 'other']);
            $table->string('contact_number');
            $table->string('address');
            $table->date('date_of_diagnosis');
            $table->enum('tb_type', ['pulmonary', 'extra_pulmonary']);
            $table->enum('treatment_category', ['category_1', 'category_2', 'category_3']);
            $table->date('treatment_start_date');
            $table->date('treatment_end_date')->nullable();
            $table->enum('treatment_status', ['ongoing', 'completed', 'defaulted', 'failed', 'died', 'transferred_out'])->default('ongoing');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbdots');
    }
};
