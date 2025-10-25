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
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->id();
            
            // Relationships
            $table->unsignedBigInteger('prescription_id');
            $table->unsignedBigInteger('medicine_id');
            
            // Prescription Details
            $table->integer('quantity');
            $table->string('dosage'); // "1 tablet", "2 capsules", "5ml"
            $table->string('frequency'); // "3 times a day", "Every 8 hours"
            $table->string('duration'); // "7 days", "2 weeks"
            $table->text('instructions')->nullable(); // "Take after meals", "Take with water"
            
            // Dispensing Information
            $table->integer('dispensed_quantity')->default(0);
            $table->enum('status', ['Pending', 'Partially Dispensed', 'Fully Dispensed'])->default('Pending');
            $table->text('dispensing_notes')->nullable();
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            
            // Indexes
            $table->index(['prescription_id', 'medicine_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_items');
    }
};
