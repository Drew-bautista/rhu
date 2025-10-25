# Birth Certificates Deployment Fix

## Problem
The `birth_certificates` table doesn't exist in your deployment database, causing the error:
```
SQLSTATE[42S02]: Base table or view not found: 1146 Table 'default.birth_certificates' doesn't exist
```

## Solution

### Option 1: Run Migration Command (Recommended)
1. Access your server terminal/command line
2. Navigate to your Laravel project directory
3. Run the migration:
```bash
php artisan migrate
```

### Option 2: Manual Database Creation
If you can't run artisan commands, create the table manually in your database:

```sql
CREATE TABLE `birth_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `child_first_name` varchar(255) NOT NULL,
  `child_middle_name` varchar(255) DEFAULT NULL,
  `child_last_name` varchar(255) NOT NULL,
  `child_sex` enum('Male','Female') NOT NULL,
  `date_of_birth` date NOT NULL,
  `time_of_birth` time DEFAULT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `birth_weight` decimal(5,2) DEFAULT NULL,
  `birth_length` int(11) DEFAULT NULL,
  `type_of_birth` enum('Single','Twin','Triplet','Multiple') DEFAULT 'Single',
  `birth_order` enum('1st','2nd','3rd','4th','5th','Other') DEFAULT NULL,
  `mother_first_name` varchar(255) NOT NULL,
  `mother_middle_name` varchar(255) DEFAULT NULL,
  `mother_last_name` varchar(255) NOT NULL,
  `mother_maiden_name` varchar(255) DEFAULT NULL,
  `mother_date_of_birth` date DEFAULT NULL,
  `mother_age_at_birth` int(11) DEFAULT NULL,
  `mother_citizenship` varchar(255) DEFAULT NULL,
  `mother_religion` varchar(255) DEFAULT NULL,
  `mother_occupation` varchar(255) DEFAULT NULL,
  `mother_address` varchar(255) NOT NULL,
  `father_first_name` varchar(255) DEFAULT NULL,
  `father_middle_name` varchar(255) DEFAULT NULL,
  `father_last_name` varchar(255) DEFAULT NULL,
  `father_date_of_birth` date DEFAULT NULL,
  `father_age_at_birth` int(11) DEFAULT NULL,
  `father_citizenship` varchar(255) DEFAULT NULL,
  `father_religion` varchar(255) DEFAULT NULL,
  `father_occupation` varchar(255) DEFAULT NULL,
  `father_address` varchar(255) DEFAULT NULL,
  `parents_marriage_date` date DEFAULT NULL,
  `parents_marriage_place` varchar(255) DEFAULT NULL,
  `attendant_name` varchar(255) DEFAULT NULL,
  `attendant_type` enum('Doctor','Midwife','Nurse','Hilot','Others') DEFAULT NULL,
  `attendant_title` varchar(255) DEFAULT NULL,
  `registry_number` varchar(255) DEFAULT NULL,
  `date_registered` date DEFAULT NULL,
  `registered_by` varchar(255) DEFAULT NULL,
  `registrar_name` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` enum('Draft','Registered','Issued') DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `birth_certificates_registry_number_unique` (`registry_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### Option 3: Temporary Fix (Disable Birth Certificates)
If you need a quick temporary fix, comment out the birth certificate routes in `routes/web.php`:

```php
// Temporarily disable birth certificates
/*
Route::get('/staff/birth-certificates', [StaffBirthCertificateController::class, 'index'])->name('staff.birth-certificates.index');
Route::get('/staff/birth-certificates/create', [StaffBirthCertificateController::class, 'create'])->name('staff.birth-certificates.create');
Route::post('/staff/birth-certificates/store', [StaffBirthCertificateController::class, 'store'])->name('staff.birth-certificates.store');
*/
```

## Recommended Steps
1. Try Option 1 first (run `php artisan migrate`)
2. If that doesn't work, use Option 2 (manual SQL)
3. Option 3 is only for emergency temporary fix

## After Fix
Once the table is created, the birth certificates module will work properly for both admin and staff users.
