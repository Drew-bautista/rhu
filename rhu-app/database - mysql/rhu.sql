-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 04:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rhu`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal_bite_cases`
--

CREATE TABLE `animal_bite_cases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_of_incident` date DEFAULT NULL,
  `animal_type` varchar(255) DEFAULT NULL,
  `animal_ownership` enum('Owned','Stray') DEFAULT NULL,
  `animal_vaccination_status` enum('Vaccinated','Unvaccinated','Unknown') DEFAULT NULL,
  `animal_behavior` enum('Normal','Aggressive','Rabid Signs') DEFAULT NULL,
  `bite_site` varchar(255) DEFAULT NULL,
  `bite_category` enum('I','II','III') DEFAULT NULL,
  `wound_description` text DEFAULT NULL,
  `first_consultation_date` date DEFAULT NULL,
  `arv_dose` varchar(255) DEFAULT NULL,
  `arv_date` date DEFAULT NULL,
  `rig_administered` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `animal_bite_cases`
--

INSERT INTO `animal_bite_cases` (`id`, `appointment_id`, `date_of_incident`, `animal_type`, `animal_ownership`, `animal_vaccination_status`, `animal_behavior`, `bite_site`, `bite_category`, `wound_description`, `first_consultation_date`, `arv_dose`, `arv_date`, `rig_administered`, `remarks`, `created_at`, `updated_at`) VALUES
(2, 3, '2025-10-02', 'Dog', 'Stray', 'Unvaccinated', 'Normal', 'left hand', 'I', 'Scratch', '2025-10-02', '100mg', '2025-10-02', 'yes', 'observed the dog for 14 days', '2025-10-03 04:27:53', '2025-10-03 04:27:53'),
(3, 2, NULL, 'dadsa', 'Stray', NULL, 'Aggressive', 'asda', 'II', 'asda', '2025-10-23', 'adsa', '2025-10-22', 'asda', 'adsad', '2025-10-13 09:37:55', '2025-10-13 09:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(11) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `date_of_appointment` date NOT NULL,
  `time` time NOT NULL,
  `address` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `emergency_contact` varchar(255) NOT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `date_of_birth`, `age`, `contact_number`, `date_of_appointment`, `time`, `address`, `service`, `emergency_contact`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Maria Lareza Bizarra', '2025-10-03', 28, '09157631419', '2025-10-02', '09:30:00', 'Gabaldon', 'Urinalysis', '09123456778', 'pending', '2025-10-02 23:51:06', '2025-10-02 23:51:06'),
(3, 'Sandara Park', '1986-08-08', 30, '09134567891', '2025-10-02', '09:30:00', 'Malinao', 'Anti-rabies', '09123456778', 'pending', '2025-10-03 00:03:29', '2025-10-03 00:03:29'),
(7, 'maymay', '2025-10-02', 25, '09157631419', '2025-10-02', '10:30:00', '123', 'Prenatal', '12345678910', 'pending', '2025-10-03 03:44:42', '2025-10-03 03:44:42'),
(10, 'Danilo Baydid Jr.', '1998-02-06', 27, '09454251672', '2025-10-06', '11:06:00', 'South', 'Pregnancy', '09454251672', 'pending', '2025-10-07 01:06:50', '2025-10-07 01:06:50'),
(11, 'Danilo Baydid Jr.', '1998-02-06', 27, '09454251672', '2025-10-06', '11:09:00', 'South', 'Dental', '09454251672', 'pending', '2025-10-07 01:09:42', '2025-10-07 01:09:42'),
(12, 'Theresa', '2001-05-18', 25, '09454251672', '2025-10-06', '13:26:00', 'south', 'Anti-rabies', '09123456778', 'pending', '2025-10-07 03:26:41', '2025-10-07 03:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbc_results`
--

CREATE TABLE `cbc_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hemoglobin` decimal(5,2) DEFAULT NULL,
  `hematocrit` decimal(5,2) DEFAULT NULL,
  `rbc_count` decimal(5,2) DEFAULT NULL,
  `wbc_count` decimal(5,2) DEFAULT NULL,
  `platelet_count` decimal(5,2) DEFAULT NULL,
  `mcv` decimal(5,2) DEFAULT NULL,
  `mch` decimal(5,2) DEFAULT NULL,
  `mchc` decimal(5,2) DEFAULT NULL,
  `neutrophils` decimal(5,2) DEFAULT NULL,
  `lymphocytes` decimal(5,2) DEFAULT NULL,
  `monocytes` decimal(5,2) DEFAULT NULL,
  `eosinophils` decimal(5,2) DEFAULT NULL,
  `basophils` decimal(5,2) DEFAULT NULL,
  `newborn_screening` varchar(255) DEFAULT NULL,
  `hepa_b_screening` varchar(255) DEFAULT NULL,
  `fasting_blood_sugar` decimal(5,2) DEFAULT NULL,
  `cholesterol` decimal(5,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cbc_results`
--

INSERT INTO `cbc_results` (`id`, `appointment_id`, `hemoglobin`, `hematocrit`, `rbc_count`, `wbc_count`, `platelet_count`, `mcv`, `mch`, `mchc`, `neutrophils`, `lymphocytes`, `monocytes`, `eosinophils`, `basophils`, `newborn_screening`, `hepa_b_screening`, `fasting_blood_sugar`, `cholesterol`, `remarks`, `created_at`, `updated_at`) VALUES
(2, 10, 0.26, 0.05, 0.04, 0.04, 0.06, 0.05, 0.04, 0.06, 0.04, 0.04, 0.05, 0.03, 0.15, 'fd', 'b', 0.17, 0.06, 'b', '2025-10-13 08:31:52', '2025-10-13 08:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `child_immunizations`
--

CREATE TABLE `child_immunizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `vaccine_name` varchar(255) NOT NULL,
  `immunization_date` date NOT NULL,
  `dose_number` varchar(255) DEFAULT NULL,
  `administered_by` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dental_records`
--

CREATE TABLE `dental_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `services` text DEFAULT NULL,
  `tooth_area` varchar(255) DEFAULT NULL,
  `findings` text NOT NULL,
  `prescription` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dental_records`
--

INSERT INTO `dental_records` (`id`, `appointment_id`, `services`, `tooth_area`, `findings`, `prescription`, `created_at`, `updated_at`) VALUES
(3, 1, 'Teeth cleaning and checkup', 'Upper right quadrant', 'No cavities, gums healthy', 'Fluoride treatment recommended', '2025-10-13 09:20:03', '2025-10-13 09:20:03'),
(4, 1, 'Teeth cleaning and checkup', 'Upper right quadrant', 'No cavities, gums healthy', 'Fluoride treatment recommended', '2025-10-13 10:02:51', '2025-10-13 10:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family_planning`
--

CREATE TABLE `family_planning` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `fp_counseling` text DEFAULT NULL,
  `fp_commodity` text DEFAULT NULL,
  `date_of_follow_up` date DEFAULT NULL,
  `facility` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `health_assessments`
--

CREATE TABLE `health_assessments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `height` text DEFAULT NULL,
  `weight` text DEFAULT NULL,
  `blood_pressure` text DEFAULT NULL,
  `heart_rate` text DEFAULT NULL,
  `respiratory_rate` text DEFAULT NULL,
  `visual_acuity` text DEFAULT NULL,
  `temperature` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `health_information`
--

CREATE TABLE `health_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_appointment_id` bigint(20) UNSIGNED NOT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `age_of_gestation` int(11) DEFAULT NULL,
  `blood_pressure` varchar(255) DEFAULT NULL,
  `nutritional_status` enum('normal','underweight','overweight') DEFAULT NULL,
  `birth_plan` text DEFAULT NULL,
  `dental_checkup` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infirmary`
--

CREATE TABLE `infirmary` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `birthdate` date NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `emergency_contact` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `blood_pressure` varchar(255) NOT NULL,
  `heart_rate` int(11) NOT NULL,
  `respiratory_rate` int(11) NOT NULL,
  `visual_acuity` varchar(255) NOT NULL,
  `temperature` decimal(4,2) NOT NULL,
  `consultation_date_time` datetime NOT NULL,
  `chief_complaint` varchar(255) DEFAULT NULL,
  `laboratory_findings` varchar(255) DEFAULT NULL,
  `assessment_diagnosis` varchar(255) DEFAULT NULL,
  `medical_history` varchar(255) DEFAULT NULL,
  `medication_treatment` varchar(255) DEFAULT NULL,
  `personal_social_history` varchar(255) DEFAULT NULL,
  `pregnancy_history` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `infirmary`
--

INSERT INTO `infirmary` (`id`, `firstname`, `middlename`, `lastname`, `sex`, `birthdate`, `contact_no`, `emergency_contact`, `address`, `height`, `weight`, `blood_pressure`, `heart_rate`, `respiratory_rate`, `visual_acuity`, `temperature`, `consultation_date_time`, `chief_complaint`, `laboratory_findings`, `assessment_diagnosis`, `medical_history`, `medication_treatment`, `personal_social_history`, `pregnancy_history`, `created_at`, `updated_at`) VALUES
(4, 'Renz', NULL, 'Crisostomo', 'male', '2002-01-21', '096627949692', '099234567891', 'Cuyapa', 173.00, 55.00, '70-90', 110, 95, '10/10', 38.00, '2025-10-06 11:01:00', 'Sakit ang ulo', 'none', 'Fever', 'none', 'Paracetamol', 'none', 'none', '2025-10-07 01:01:32', '2025-10-07 01:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `generic_name` varchar(255) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `medicine_type` enum('tablet','capsule','syrup','injection','cream','drops','inhaler','other') NOT NULL,
  `dosage_strength` varchar(255) NOT NULL,
  `quantity_in_stock` int(11) NOT NULL,
  `reorder_level` int(11) NOT NULL DEFAULT 10,
  `unit_of_measure` varchar(255) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `batch_number` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `unit_cost` decimal(10,2) DEFAULT NULL,
  `storage_location` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_requests`
--

CREATE TABLE `medical_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `request_type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('pending','done') NOT NULL,
  `priority` enum('low','medium','high') NOT NULL,
  `preferred_date` date DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `test_date` date DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_26_025403_create_health_assessments_table', 1),
(5, '2024_10_26_025422_create_treatments_table', 1),
(6, '2024_11_02_102210_create_medical_requests_table', 1),
(7, '2025_03_03_070325_create_appointments_table', 1),
(8, '2025_03_12_040626_create_patients_table', 1),
(9, '2025_03_21_065932_create_health_information_table', 1),
(10, '2025_06_29_040149_create_family_planning_table', 1),
(11, '2025_07_03_002940_create_infirmary_table', 1),
(12, '2025_07_19_064644_create_prenatal-record_table', 1),
(13, '2025_07_27_131247_create_dental_records_table', 1),
(14, '2025_08_05_142356_create_cbc_results_table', 1),
(15, '2025_08_05_142918_create_urinalysis_results_table', 1),
(16, '2025_09_10_142022_create_child_immunizations_table', 1),
(17, '2025_09_16_013222_create_animal_bite_cases_table', 1),
(18, '2025_09_17_141233_create_newborn_screenings_table', 1),
(19, '2025_10_13_000001_add_medtech_role_to_users_table', 2),
(20, '2025_10_14_000001_create_tbdots_table', 3),
(21, '2025_10_14_000002_create_vaccines_table', 3),
(22, '2025_10_14_000003_create_inventory_table', 3),
(23, '2025_10_14_000004_create_prescriptions_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `newborn_screenings`
--

CREATE TABLE `newborn_screenings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `date_of_birth` date NOT NULL,
  `time_of_birth` time DEFAULT NULL,
  `birth_weight` decimal(5,2) DEFAULT NULL,
  `gestational_age` int(11) DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) NOT NULL,
  `mother_age` int(11) DEFAULT NULL,
  `mother_address` varchar(255) DEFAULT NULL,
  `mother_contact` varchar(255) DEFAULT NULL,
  `screening_date` date NOT NULL,
  `facility` varchar(255) DEFAULT NULL,
  `kit_no` varchar(255) DEFAULT NULL,
  `sample_collection_at` datetime DEFAULT NULL,
  `specimen_type` varchar(255) DEFAULT NULL,
  `conditions_tested` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`conditions_tested`)),
  `result_status` enum('Normal','Positive','Retest') NOT NULL DEFAULT 'Normal',
  `remarks` text DEFAULT NULL,
  `provider_name` varchar(255) DEFAULT NULL,
  `provider_role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `birthdate` date NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `emergency_contact` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prenatal_record`
--

CREATE TABLE `prenatal_record` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `age_of_gestation` int(11) DEFAULT NULL,
  `blood_pressure` varchar(255) DEFAULT NULL,
  `nutritional_status` enum('normal','underweight','overweight') DEFAULT NULL,
  `birth_plan` text DEFAULT NULL,
  `dental_checkup` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prenatal_record`
--

INSERT INTO `prenatal_record` (`id`, `appointment_id`, `weight`, `height`, `age_of_gestation`, `blood_pressure`, `nutritional_status`, `birth_plan`, `dental_checkup`, `created_at`, `updated_at`) VALUES
(2, 7, 50.00, 145.00, 38, '120', 'normal', 'implant', NULL, '2025-10-03 04:29:00', '2025-10-03 04:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `prescribed_by` bigint(20) UNSIGNED NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `quantity_prescribed` int(11) NOT NULL,
  `dosage_instructions` varchar(255) NOT NULL,
  `duration_days` int(11) NOT NULL,
  `special_instructions` text DEFAULT NULL,
  `status` enum('pending','dispensed','partially_dispensed','cancelled') NOT NULL DEFAULT 'pending',
  `dispensed_at` timestamp NULL DEFAULT NULL,
  `dispensed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5A07KTzQtBEp0SXnzLxoUCW3uFXoYeaJJDMRCIJL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUhtQXVzcGlKUG1Zb0VzZllyNVR1S2ZIY2VoVWtOS3lWRUNaSmVVdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1760450186),
('uhT6RDVjjFKfS5EwSNvPQ9hcW9Q0DFemZNctZkDk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlJJOGkxUTZSa1Q5ZHRlTjltMkdOdXlsakxvNXNkazZNenFkN2lRbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1760433106);

-- --------------------------------------------------------

--
-- Table structure for table `tbdots`
--

CREATE TABLE `tbdots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `patient_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(11) NOT NULL,
  `sex` enum('male','female','other') NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_diagnosis` date NOT NULL,
  `tb_type` enum('pulmonary','extra_pulmonary') NOT NULL,
  `treatment_category` enum('category_1','category_2','category_3') NOT NULL,
  `treatment_start_date` date NOT NULL,
  `treatment_end_date` date DEFAULT NULL,
  `treatment_status` enum('ongoing','completed','defaulted','failed','died','transferred_out') NOT NULL DEFAULT 'ongoing',
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `consultation_date_time` datetime NOT NULL,
  `chief_complaint` text DEFAULT NULL,
  `laboratory_findings` text DEFAULT NULL,
  `assessment_diagnosis` text DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `medication_treatment` text DEFAULT NULL,
  `personal_social_history` text DEFAULT NULL,
  `pregnancy_history` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `urinalysis_results`
--

CREATE TABLE `urinalysis_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `transparency` varchar(255) DEFAULT NULL,
  `specific_gravity` decimal(4,3) DEFAULT NULL,
  `ph` decimal(3,1) DEFAULT NULL,
  `protein` varchar(255) DEFAULT NULL,
  `glucose` varchar(255) DEFAULT NULL,
  `ketones` varchar(255) DEFAULT NULL,
  `bilirubin` varchar(255) DEFAULT NULL,
  `urobilinogen` varchar(255) DEFAULT NULL,
  `nitrite` varchar(255) DEFAULT NULL,
  `leukocyte_esterase` varchar(255) DEFAULT NULL,
  `rbc` varchar(255) DEFAULT NULL,
  `wbc` varchar(255) DEFAULT NULL,
  `epithelial_cells` varchar(255) DEFAULT NULL,
  `bacteria` varchar(255) DEFAULT NULL,
  `crystals` varchar(255) DEFAULT NULL,
  `casts` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('doctor','nurse','staff','head','patient','medtech') NOT NULL,
  `birthdate` date NOT NULL,
  `sex` enum('male','female','other') NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `emergency_contact` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `email_verified_at`, `password`, `role`, `birthdate`, `sex`, `contact_no`, `emergency_contact`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Az', 'Smith', 'doctor@gmail.com', NULL, '$2y$12$WZhhiIYouf6xNTwjEGttg.qR5pUfWmMsxmED/qnOISwQ3jvpnv.e2', 'doctor', '1990-01-01', 'male', '09123456789', '09123456789', '123 Main St, City, Country', NULL, '2025-10-02 22:01:35', '2025-10-13 10:02:51'),
(2, 'Hannah', '', 'Saludaga', 'staff@gmail.com', NULL, '$2y$12$mqxtgzswN3PcKAqQbX.UTOk/JcsMjGdpz2EA8X.ZKjgzBfiY4lSBK', 'staff', '2003-03-01', 'female', '09123456789', '09123456789', 'Acasia St, Dingalan, Aurora', NULL, '2025-10-02 22:01:35', '2025-10-02 22:01:35'),
(3, 'Alex', 'S.', 'Reyes', 'staff@example.com', NULL, '$2y$12$D5cmTj7hQs6ZG94NrN0.sOpVn71KEWVPwQ0FMMmmv9fTPaLUd/KFu', 'staff', '1998-04-15', 'female', '09171234567', '09179876543', 'Brgy. Sample, Town, Province', NULL, '2025-10-13 08:56:48', '2025-10-13 08:56:48'),
(6, 'Mia', 'T.', 'Dela Cruz', 'medtech@gmail.com', NULL, '$2y$12$xVlxHfHUGZLimu1jZ9t7zuEf7MLwhfc9.Jgu/y.BYCqxziSLG1cxG', 'medtech', '1995-06-15', 'female', '09170000000', '09179999999', 'Lab Street, Sample City', NULL, '2025-10-13 09:20:03', '2025-10-13 10:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `patient_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(11) NOT NULL,
  `age_group` enum('infant','child','adolescent','adult','senior') NOT NULL,
  `sex` enum('male','female','other') NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `vaccine_type` varchar(255) NOT NULL,
  `dose_number` varchar(255) NOT NULL,
  `date_administered` date NOT NULL,
  `next_dose_date` date DEFAULT NULL,
  `administered_by` varchar(255) NOT NULL,
  `batch_number` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `adverse_reactions` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal_bite_cases`
--
ALTER TABLE `animal_bite_cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cbc_results`
--
ALTER TABLE `cbc_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_immunizations`
--
ALTER TABLE `child_immunizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dental_records`
--
ALTER TABLE `dental_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `family_planning`
--
ALTER TABLE `family_planning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_assessments`
--
ALTER TABLE `health_assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_information`
--
ALTER TABLE `health_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infirmary`
--
ALTER TABLE `infirmary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_requests`
--
ALTER TABLE `medical_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medical_requests_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newborn_screenings`
--
ALTER TABLE `newborn_screenings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prenatal_record`
--
ALTER TABLE `prenatal_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_appointment_id_foreign` (`appointment_id`),
  ADD KEY `prescriptions_inventory_id_foreign` (`inventory_id`),
  ADD KEY `prescriptions_prescribed_by_foreign` (`prescribed_by`),
  ADD KEY `prescriptions_dispensed_by_foreign` (`dispensed_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tbdots`
--
ALTER TABLE `tbdots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbdots_appointment_id_foreign` (`appointment_id`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urinalysis_results`
--
ALTER TABLE `urinalysis_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vaccines_appointment_id_foreign` (`appointment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal_bite_cases`
--
ALTER TABLE `animal_bite_cases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cbc_results`
--
ALTER TABLE `cbc_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `child_immunizations`
--
ALTER TABLE `child_immunizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dental_records`
--
ALTER TABLE `dental_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family_planning`
--
ALTER TABLE `family_planning`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `health_assessments`
--
ALTER TABLE `health_assessments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_information`
--
ALTER TABLE `health_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `infirmary`
--
ALTER TABLE `infirmary`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_requests`
--
ALTER TABLE `medical_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `newborn_screenings`
--
ALTER TABLE `newborn_screenings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prenatal_record`
--
ALTER TABLE `prenatal_record`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbdots`
--
ALTER TABLE `tbdots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urinalysis_results`
--
ALTER TABLE `urinalysis_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medical_requests`
--
ALTER TABLE `medical_requests`
  ADD CONSTRAINT `medical_requests_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`),
  ADD CONSTRAINT `prescriptions_dispensed_by_foreign` FOREIGN KEY (`dispensed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `prescriptions_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`),
  ADD CONSTRAINT `prescriptions_prescribed_by_foreign` FOREIGN KEY (`prescribed_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `tbdots`
--
ALTER TABLE `tbdots`
  ADD CONSTRAINT `tbdots_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`);

--
-- Constraints for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD CONSTRAINT `vaccines_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
