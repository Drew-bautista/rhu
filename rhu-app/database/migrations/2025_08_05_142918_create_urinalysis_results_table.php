<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('urinalysis_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->date('test_date');
            $table->string('color')->nullable();
            $table->string('transparency')->nullable();
            $table->decimal('specific_gravity', 4, 3)->nullable();
            $table->decimal('ph', 3, 1)->nullable();
            $table->string('protein')->nullable();
            $table->string('glucose')->nullable();
            $table->string('ketones')->nullable();
            $table->string('bilirubin')->nullable();
            $table->string('urobilinogen')->nullable();
            $table->string('nitrite')->nullable();
            $table->string('leukocyte_esterase')->nullable();
            $table->string('rbc')->nullable();
            $table->string('wbc')->nullable();
            $table->string('epithelial_cells')->nullable();
            $table->string('bacteria')->nullable();
            $table->string('crystals')->nullable();
            $table->string('casts')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('urinalysis_results');
    }
};
