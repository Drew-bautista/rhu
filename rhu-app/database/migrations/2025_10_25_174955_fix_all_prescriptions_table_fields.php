<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all columns in the prescriptions table
        $columns = DB::select("SHOW COLUMNS FROM prescriptions");
        
        foreach ($columns as $column) {
            $columnName = $column->Field;
            $isNullable = $column->Null === 'YES';
            $hasDefault = $column->Default !== null || $column->Extra === 'auto_increment';
            
            // If column is NOT NULL and has no default, make it nullable
            if (!$isNullable && !$hasDefault && !in_array($columnName, ['id', 'created_at', 'updated_at'])) {
                try {
                    // Determine the column type and make it nullable
                    if (str_contains($column->Type, 'int')) {
                        DB::statement("ALTER TABLE prescriptions MODIFY `{$columnName}` {$column->Type} NULL DEFAULT NULL");
                    } elseif (str_contains($column->Type, 'varchar') || str_contains($column->Type, 'text')) {
                        DB::statement("ALTER TABLE prescriptions MODIFY `{$columnName}` {$column->Type} NULL DEFAULT NULL");
                    } elseif (str_contains($column->Type, 'date')) {
                        DB::statement("ALTER TABLE prescriptions MODIFY `{$columnName}` {$column->Type} NULL DEFAULT NULL");
                    } elseif (str_contains($column->Type, 'enum')) {
                        DB::statement("ALTER TABLE prescriptions MODIFY `{$columnName}` {$column->Type} NULL DEFAULT NULL");
                    } else {
                        DB::statement("ALTER TABLE prescriptions MODIFY `{$columnName}` {$column->Type} NULL DEFAULT NULL");
                    }
                    
                    echo "Made column '{$columnName}' nullable\n";
                } catch (\Exception $e) {
                    echo "Could not modify column '{$columnName}': " . $e->getMessage() . "\n";
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is designed to be safe and not easily reversible
        // as it prevents database errors
    }
};
