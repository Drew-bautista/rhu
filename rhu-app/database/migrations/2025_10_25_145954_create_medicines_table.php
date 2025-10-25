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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            
            // Medicine Information
            $table->string('medicine_name');
            $table->string('generic_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->text('description')->nullable();
            
            // Medicine Details
            $table->string('dosage_form'); // tablet, capsule, syrup, injection, etc.
            $table->string('strength'); // 500mg, 250mg/5ml, etc.
            $table->string('unit'); // pieces, bottles, vials, etc.
            
            // Inventory Management
            $table->integer('current_stock')->default(0);
            $table->integer('minimum_stock')->default(10);
            $table->integer('maximum_stock')->default(1000);
            $table->decimal('unit_price', 10, 2)->default(0);
            
            // Medicine Classification
            $table->string('category')->nullable(); // Antibiotic, Analgesic, etc.
            $table->string('classification')->nullable(); // Prescription, OTC
            
            // Expiry and Batch
            $table->date('expiry_date')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('manufacturer')->nullable();
            
            // Status and Notes
            $table->enum('status', ['Active', 'Inactive', 'Expired', 'Out of Stock'])->default('Active');
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('medicine_name');
            $table->index('status');
            $table->index('expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
