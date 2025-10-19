<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_name');
            $table->string('generic_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->enum('medicine_type', ['tablet', 'capsule', 'syrup', 'injection', 'cream', 'drops', 'inhaler', 'other']);
            $table->string('dosage_strength'); // e.g., 500mg, 250mg/5ml
            $table->integer('quantity_in_stock');
            $table->integer('reorder_level')->default(10);
            $table->string('unit_of_measure'); // pieces, bottles, boxes, etc.
            $table->date('expiry_date')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('supplier')->nullable();
            $table->decimal('unit_cost', 10, 2)->nullable();
            $table->text('storage_location')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
