<?php
/**
 * Security Check Script for Laravel Application
 * Run this to check for common security issues
 */

echo "=== Laravel Security Check ===\n\n";

// Check 1: Look for suspicious PHP files
echo "[1] Checking for suspicious PHP files...\n";
$suspicious_patterns = [
    'eval(base64_decode',
    'eval(gzinflate',
    'eval(str_rot13',
    'shell_exec',
    'system(',
    'exec(',
    'passthru(',
    'eval($_',
    'assert($_',
    'preg_replace.*\/e',
    'create_function'
];

$files_to_check = [
    'public/index.php',
    'public/.htaccess',
    'bootstrap/app.php',
    'artisan'
];

foreach ($files_to_check as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        foreach ($suspicious_patterns as $pattern) {
            if (stripos($content, $pattern) !== false) {
                echo "⚠️  WARNING: Suspicious pattern '$pattern' found in $file\n";
            }
        }
    }
}

// Check 2: Check file permissions
echo "\n[2] Checking file permissions...\n";
$dirs_to_check = [
    'storage' => '775',
    'bootstrap/cache' => '775',
    'public' => '755'
];

foreach ($dirs_to_check as $dir => $expected) {
    if (is_dir($dir)) {
        $perms = substr(sprintf('%o', fileperms($dir)), -3);
        if ($perms !== $expected) {
            echo "⚠️  $dir has permissions $perms (expected $expected)\n";
        } else {
            echo "✓ $dir permissions OK\n";
        }
    }
}

// Check 3: Check for exposed .env file
echo "\n[3] Checking .env file exposure...\n";
if (file_exists('public/.env')) {
    echo "⚠️  CRITICAL: .env file found in public directory!\n";
} else {
    echo "✓ .env file not exposed\n";
}

// Check 4: Check for debug mode in production
echo "\n[4] Checking debug mode...\n";
if (file_exists('.env')) {
    $env = file_get_contents('.env');
    if (preg_match('/APP_DEBUG\s*=\s*true/i', $env)) {
        echo "⚠️  WARNING: Debug mode is enabled (APP_DEBUG=true)\n";
    } else {
        echo "✓ Debug mode disabled\n";
    }
}

// Check 5: Check for default Laravel key
echo "\n[5] Checking APP_KEY...\n";
if (file_exists('.env')) {
    $env = file_get_contents('.env');
    if (preg_match('/APP_KEY\s*=\s*base64:(.+)/i', $env, $matches)) {
        if ($matches[1] === 'SomeRandomString') {
            echo "⚠️  CRITICAL: Using default APP_KEY!\n";
        } else {
            echo "✓ Custom APP_KEY is set\n";
        }
    }
}

// Check 6: Check for recently modified files
echo "\n[6] Recently modified files (last 7 days):\n";
$recent_files = [];
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator('.', RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$seven_days_ago = time() - (7 * 24 * 60 * 60);
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getMTime() > $seven_days_ago) {
        $path = $file->getPathname();
        // Skip expected directories
        if (strpos($path, 'storage/') === false && 
            strpos($path, 'bootstrap/cache/') === false &&
            strpos($path, '.git/') === false &&
            strpos($path, 'node_modules/') === false &&
            strpos($path, 'vendor/') === false) {
            $recent_files[] = $path . ' (' . date('Y-m-d H:i', $file->getMTime()) . ')';
        }
    }
}

if (count($recent_files) > 0) {
    foreach (array_slice($recent_files, 0, 10) as $file) {
        echo "  - $file\n";
    }
    if (count($recent_files) > 10) {
        echo "  ... and " . (count($recent_files) - 10) . " more files\n";
    }
}

// Check 7: Check for backup files
echo "\n[7] Checking for backup files...\n";
$backup_patterns = ['*.bak', '*.backup', '*.old', '*.save', '*~', '*.swp'];
$found_backups = false;
foreach ($backup_patterns as $pattern) {
    $files = glob($pattern);
    if (!empty($files)) {
        foreach ($files as $file) {
            echo "⚠️  Found backup file: $file\n";
            $found_backups = true;
        }
    }
}
if (!$found_backups) {
    echo "✓ No backup files found\n";
}

// Check 8: Check composer packages for known vulnerabilities
echo "\n[8] Checking composer dependencies...\n";
if (file_exists('composer.lock')) {
    echo "✓ composer.lock exists\n";
    // You can run: composer audit
    echo "  Run 'composer audit' to check for vulnerabilities\n";
} else {
    echo "⚠️  composer.lock not found\n";
}

// Summary
echo "\n=== Security Check Complete ===\n";
echo "Review any warnings above and take appropriate action.\n";
echo "After fixing issues:\n";
echo "1. Clear all caches: php artisan cache:clear\n";
echo "2. Request Google review at: https://search.google.com/search-console\n";
