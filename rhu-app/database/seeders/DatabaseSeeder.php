<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\DentalRecords;
use App\Models\PrenatalRecords;
use App\Models\User;
use App\Models\Treatment;
use Illuminate\Database\Seeder;
use App\Models\HealthAssessment;
use App\Models\HealthInformation;
use App\Models\Patients;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        User::updateOrCreate(
            ['email' => 'doctor@gmail.com'],
            [
                'firstname' => 'John',
                'middlename' => 'Az',
                'lastname' => 'Smith',
                'password' => bcrypt('12345678'),
                'role' => 'doctor',
                'birthdate' => '1990-01-01',
                'sex' => 'male',
                'contact_no' => '09123456789',
                'emergency_contact' => '09123456789',
                'address' => '123 Main St, City, Country',
            ]
        );

        User::updateOrCreate(
            ['email' => 'medtech@gmail.com'],
            [
                'firstname' => 'Mia',
                'middlename' => 'T.',
                'lastname' => 'Dela Cruz',
                'password' => bcrypt('12345678'),
                'role' => 'medtech',
                'birthdate' => '1995-06-15',
                'sex' => 'female',
                'contact_no' => '09170000000',
                'emergency_contact' => '09179999999',
                'address' => 'Lab Street, Sample City',
            ]
        );

        // User::create([
        //     'firstname' => 'Chi',
        //     'middlename' => 'T.',
        //     'lastname' => 'Lee',
        //     'email' => 'staff@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'role' => 'staff',
        //     'birthdate' => '2000-02-02',
        //     'sex' => 'female',
        //     // 'year' => '2nd Year',
        //     // 'section' => 'B',
        //     'contact_no' => '09876543210',
        //     'emergency_contact' => '09876543210',
        //     'address' => '456 Another St, City, Country',
        // ]);

        // Patients::create([
        //     'firstname' => 'Juan',
        //     'middlename' => 'Del',
        //     'lastname' => 'Cruz',
        //     // 'email' => 's21010792',
        //     // 'password' => bcrypt('12345678'),
        //     // 'role' => 'patient',
        //     'birthdate' => '2003-10-02',
        //     'sex' => 'male',
        //     // 'year' => '2nd Year',
        //     // 'section' => 'B',
        //     'contact_no' => '09735426267',
        //     'emergency_contact' => '09578290134',
        //     'address' => '456 Another St, City, Country',
        // ]);

        // Patients::create([
        //     'firstname' => 'Maan',
        //     'middlename' => 'C',
        //     'lastname' => 'Dee',
        //     // 'email' => 'teacher1@gmail.com',
        //     // 'password' => bcrypt('s21010795'),
        //     // 'role' => 'patient',
        //     'birthdate' => '2000-02-02',
        //     'sex' => 'female',
        //     // 'year' => '2nd Year',
        //     // 'section' => 'B',
        //     'contact_no' => '09876543210',
        //     'emergency_contact' => '09876543210',
        //     'address' => '456 Another St, City, Country',
        // ]);

        // PrenatalRecords::create([
        //     'appointment_id' => 1, // Assuming there is an appointment with ID 1
        //     'weight' => 65.5, // Weight in kg
        //     'height' => 1.75, // Height in meters
        //     'age_of_gestation' => 12, // Age of gestation in weeks
        //     'blood_pressure' => '120/80', // Blood pressure
        //     'nutritional_status' => 'normal', // Nutritional status
        //     'birth_plan' => 'Plan for normal delivery at local hospital.', // Birth plan
        //     'dental_checkup' => 'Last dental checkup was 6 months ago, no issues reported.', // Dental checkup
        // ]);

        DentalRecords::create([
            'appointment_id' => 1, // Assuming there is an appointment with ID 1
            'services' => 'Teeth cleaning and checkup',
            'tooth_area' => 'Upper right quadrant',
            'findings' => 'No cavities, gums healthy',
            'prescription' => 'Fluoride treatment recommended',
        ]);

        // Treatment::create([
        //     'patient_id' => 2, // Assuming there is a user with id 2
        //     // 'health_assessment_id' => 2, // Assuming there is a health assessment with id 2
        //     'consultation_date_time' => now()->format('Y-m-d H:i:s'),
        //     'chief_complaint' => 'Chest pain and shortness of breath',
        //     'laboratory_findings' => 'Normal ECG, no signs of ischemia',
        //     'assessment_diagnosis' => 'Musculoskeletal chest pain',
        //     'medical_history' => 'History of hypertension',
        //     'medication_treatment' => 'Ibuprofen 400mg as needed for pain',
        //     'personal_social_history' => 'Smoker, 1 pack per day',
        //     'pregnancy_history' => 'Not applicable',

        // ]);


        // HealthInformation::create([
        //     'patient_appointment_id' => 1, // Assuming there is a patient appointment with ID 1
        //     'weight' => 65.5, // Weight in kg
        //     'height' => 1.75, // Height in meters
        //     'age_of_gestation' => 12, // Age of gestation in weeks
        //     'blood_pressure' => '120/80', // Blood pressure
        //     'nutritional_status' => 'normal', // Nutritional status
        //     'birth_plan' => 'Plan for normal delivery at local hospital.', // Birth plan
        //     'dental_checkup' => 'Last dental checkup was 6 months ago, no issues reported.', // Dental checkup
        // ]);



        // HealthInformation::create([
        //     'patient_appointment_id' => 2,
        //     'weight' => 70.25,
        //     'height' => 1.68,
        //     'age_of_gestation' => 20,
        //     'blood_pressure' => '110/70',
        //     'nutritional_status' => 'underweight',
        //     'birth_plan' => 'Planned C-section due to previous complications.',
        //     'dental_checkup' => 'Dental checkup scheduled for next month.',
        // ]);

        // HealthInformation::create([
        //     'patient_appointment_id' => 3,
        //     'weight' => 80.00,
        //     'height' => 1.80,
        //     'age_of_gestation' => null,
        //     'blood_pressure' => '130/85',
        //     'nutritional_status' => 'overweight',
        //     'birth_plan' => null,
        //     'dental_checkup' => 'No dental issues reported in last checkup.',
        // ]);

        // Treatment::create([
        //     'user_id' => 1,
        //     'health_assessment_id' => 1, 
        //     'interpretation_comments' => 'All tests are within normal limits.',
        //     'recommendations' => 'Continue regular exercise and maintain a balanced diet.',
        //     'prescriptions' => 'Some prescriptions here...',
        //     'result_summary' => 'Overall health is good, minor concerns with cholesterol levels.',
        // ]);

        // Treatment::create([
        //     'user_id' => 2, // Assuming user with ID 2 exists
        //     // 'medical_id' => 1, // Assuming medical with ID 1 exists
        //     'health_assessment_id' => 1, // Assuming health assessment with ID 1 exists
        //     'interpretation_comments' => 'Elevated blood pressure noted.',
        //     'recommendations' => 'Monitor blood pressure and consider dietary changes.',
        //     'prescriptions' => 'Some prescriptions here...',
        //     'result_summary' => 'Health shows some concerns, specifically with blood pressure.',
        // ]);
    }
}
