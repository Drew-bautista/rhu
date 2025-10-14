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
        Schema::create('family_planning', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('contact');
            $table->string('address');
            // $table->date('date_of_visit');
            $table->text('fp_counseling')->nullable(); // Family Planning Counseling
            $table->text('fp_commodity')->nullable(); // Family Planning Commodity
            $table->date('date_of_follow_up')->nullable();
            $table->string('facility')->nullable(); // Facility where the service was provided
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_planning');
    }
};
