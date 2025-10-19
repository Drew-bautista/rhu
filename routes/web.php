<?php

use App\Http\Controllers\Doctor\AnimalBiteController;
use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\DoctorCommentsController;
use App\Http\Controllers\Doctor\DoctorDentalController;
use App\Http\Controllers\Doctor\DoctorPrenatalRecordController;
use App\Http\Controllers\Doctor\HealthRecordController;
use App\Http\Controllers\Doctor\TbdotController;
use App\Http\Controllers\Doctor\VaccineController;
use App\Http\Controllers\Doctor\InventoryController;
use App\Http\Controllers\Doctor\ReportController;

use App\Http\Controllers\Doctor\NewbornScreeningController;
use App\Http\Controllers\Doctor\UrinalysisController;
use App\Http\Controllers\Staff\StaffAppointmentController;
use App\Http\Controllers\Staff\StaffCbcResultController;
use App\Http\Controllers\Staff\StaffAnimalBiteController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\StaffDentalController;
use App\Http\Controllers\Staff\StaffFamilyPlanningController;
use App\Http\Controllers\Staff\StaffHealthInformationController;
use App\Http\Controllers\Staff\StaffHealthRecordController;
use App\Http\Controllers\Staff\StaffInfirmaryController;
use App\Http\Controllers\Staff\StaffNewbornScreeningController;
use App\Http\Controllers\Staff\StaffPatientController;
use App\Http\Controllers\Staff\StaffPrenatalController;
use App\Http\Controllers\Staff\StaffTbdotController;
use App\Http\Controllers\Staff\StaffUrinalysisController;
use App\Http\Controllers\Staff\StaffVaccineController;
use App\Http\Controllers\Staff\StaffInventoryController;
use App\Http\Controllers\Staff\StaffReportController;
use App\Http\Middleware\Staff;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Doctor\CBCresultsController;
use App\Http\Controllers\Doctor\PatientController;
use App\Http\Controllers\Doctor\RequestsController;
use App\Http\Controllers\Doctor\DashboardController;
use App\Http\Controllers\Doctor\DoctorTreatmentController;
use App\Http\Controllers\Doctor\FamilyPlanningController;
use App\Http\Controllers\Doctor\HealthInformationController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\Doctor;
use App\Http\Middleware\PreventBackHistory;
use App\Models\Infirmary;
use App\Http\Controllers\Doctor\InfirmaryController;
use App\Http\Middleware\LabAccess;

// Auth routes
Route::middleware(PreventBackHistory::class)->post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware(RedirectIfAuthenticated::class);
Route::post('/register', [RegisterController::class, 'register'])->middleware(PreventBackHistory::class);
Route::middleware('auth')->group(function () {

    Route::post('/send-sms', [SmsController::class, 'sendSms'])->name('send.sms');
    
    // Test route for debugging authentication
    Route::get('/test-auth', [TestController::class, 'testAuth'])->name('test.auth');

    // Doctor routes
    Route::middleware(Doctor::class)->group(function () {
        //Search routes
        Route::prefix('doctor')->name('admin.')->group(function () {
            Route::get('/treatments/search', [DoctorTreatmentController::class, 'search'])->name('treatments.search');
            Route::get('/patients/search', [PatientController::class, 'search'])->name('patient.search');
            Route::get('/health-record/search', [HealthRecordController::class, 'search'])->name('health-record.search');
        });

        //Infirmary
        Route::get('/doctor/health-assessment', [InfirmaryController::class, 'index'])->name('admin.infirmary.index');
        Route::get('/doctor/create-health-assessment', [InfirmaryController::class, 'create'])->name('admin.infirmary.create');
        Route::post('/doctor/health-assessment/store', [InfirmaryController::class, 'store'])->name('admin.infirmary.store');
        Route::get('/doctor/health-assessment/{id}', [InfirmaryController::class, 'show'])->name('admin.infirmary.show');
        Route::get('/doctor/health-assessment/{id}/edit', [InfirmaryController::class, 'edit'])->name('admin.infirmary.edit');
        Route::put('/doctor/health-assessment/{id}', [InfirmaryController::class, 'update'])->name('admin.infirmary.update');
        Route::delete('/doctor/health-assessment/{user}', [InfirmaryController::class, 'destroy'])->name('admin.infirmary.destroy');

        // Animal Bite Management
        Route::get('/doctor/animal-bite', [AnimalBiteController::class, 'index'])->name('admin.animal-bite.index');
        Route::get('/doctor/animal-bite/create', [AnimalBiteController::class, 'create'])->name('admin.animal-bite.create');
        Route::post('/doctor/animal-bite/store', [AnimalBiteController::class, 'store'])->name('admin.animal-bite.store');
        Route::get('/doctor/animal-bite/{animalBiteCase}', [AnimalBiteController::class, 'show'])->name('admin.animal-bite.show');
        Route::get('/doctor/animal-bite/{animalBiteCase}/edit', [AnimalBiteController::class, 'edit'])->name('admin.animal-bite.edit');
        Route::put('/doctor/animal-bite/{animalBiteCase}', [AnimalBiteController::class, 'update'])->name('admin.animal-bite.update');
        Route::delete('/doctor/animal-bite/{animalBiteCase}', [AnimalBiteController::class, 'destroy'])->name('admin.animal-bite.destroy');

        // TB-DOTS Management
        Route::get('/doctor/tbdots', [TbdotController::class, 'index'])->name('admin.tbdots.index');
        Route::get('/doctor/tbdots/create', [TbdotController::class, 'create'])->name('admin.tbdots.create');
        Route::post('/doctor/tbdots/store', [TbdotController::class, 'store'])->name('admin.tbdots.store');
        Route::get('/doctor/tbdots/{tbdot}', [TbdotController::class, 'show'])->name('admin.tbdots.show');
        Route::get('/doctor/tbdots/{tbdot}/edit', [TbdotController::class, 'edit'])->name('admin.tbdots.edit');
        Route::put('/doctor/tbdots/{tbdot}', [TbdotController::class, 'update'])->name('admin.tbdots.update');
        Route::delete('/doctor/tbdots/{tbdot}', [TbdotController::class, 'destroy'])->name('admin.tbdots.destroy');

        // Vaccine Management
        Route::get('/doctor/vaccines', [VaccineController::class, 'index'])->name('admin.vaccines.index');
        Route::get('/doctor/vaccines/create', [VaccineController::class, 'create'])->name('admin.vaccines.create');
        Route::post('/doctor/vaccines/store', [VaccineController::class, 'store'])->name('admin.vaccines.store');
        Route::get('/doctor/vaccines/{vaccine}', [VaccineController::class, 'show'])->name('admin.vaccines.show');
        Route::get('/doctor/vaccines/{vaccine}/edit', [VaccineController::class, 'edit'])->name('admin.vaccines.edit');
        Route::put('/doctor/vaccines/{vaccine}', [VaccineController::class, 'update'])->name('admin.vaccines.update');
        Route::delete('/doctor/vaccines/{vaccine}', [VaccineController::class, 'destroy'])->name('admin.vaccines.destroy');

        // Inventory Management
        Route::get('/doctor/inventory', [InventoryController::class, 'index'])->name('admin.inventory.index');
        Route::get('/doctor/inventory/create', [InventoryController::class, 'create'])->name('admin.inventory.create');
        Route::post('/doctor/inventory/store', [InventoryController::class, 'store'])->name('admin.inventory.store');
        Route::get('/doctor/inventory/{inventory}', [InventoryController::class, 'show'])->name('admin.inventory.show');
        Route::get('/doctor/inventory/{inventory}/edit', [InventoryController::class, 'edit'])->name('admin.inventory.edit');
        Route::put('/doctor/inventory/{inventory}', [InventoryController::class, 'update'])->name('admin.inventory.update');
        Route::delete('/doctor/inventory/{inventory}', [InventoryController::class, 'destroy'])->name('admin.inventory.destroy');
        Route::post('/doctor/inventory/prescribe', [InventoryController::class, 'prescribe'])->name('admin.inventory.prescribe');

        // Report Generation
        Route::get('/doctor/reports', [ReportController::class, 'index'])->name('admin.reports.index');
        Route::get('/doctor/reports/patient/{patientName}', [ReportController::class, 'patientHistory'])->name('admin.reports.patient-history');
        Route::get('/doctor/reports/monthly/{month}/{year}', [ReportController::class, 'generateMonthlyReport'])->name('admin.reports.monthly');
        Route::get('/doctor/reports/export', [ReportController::class, 'exportReport'])->name('admin.reports.export');

        //Patient management routes
        Route::get('/doctor/patients', [PatientController::class, 'index'])->name('admin.patient.index');
        Route::get('/doctor/patients/create', [PatientController::class, 'create'])->name('admin.patient.create');
        Route::post('/doctor/patients/store', [PatientController::class, 'store'])->name('admin.patient.store');
        Route::get('/doctor/patients/{id}', [PatientController::class, 'show'])->name('patients.show');
        Route::get('/doctor/patient-info/{id}', [PatientController::class, 'edit'])->name('admin.patient.edit');
        Route::post('/doctor/patient-info/{id}/update', [PatientController::class, 'update'])->name('admin.patient.update');
        Route::delete('/doctor/patients/{user}', [PatientController::class, 'destroy'])->name('admin.patient.destroy');

        //Treatment management routes
        // Route::get('/doctor/treatment', [DoctorTreatmentController::class, 'index'])->name('admin.treatment.index');
        // Route::get('doctor/treatment-create', [DoctorTreatmentController::class, 'create'])->name('admin.treatment.create');
        // Route::get('/doctor/treatment/{id}', [DoctorTreatmentController::class, 'show'])->name('admin.treatment.show');
        // Route::post('/store', [DoctorTreatmentController::class, 'store'])->name('admin.treatment.store');
        // Route::get('/edit/{id}', [DoctorTreatmentController::class, 'edit'])->name('admin.treatment.edit');
        // Route::put('/update/{id}', [DoctorTreatmentController::class, 'update'])->name('admin.treatment.update');
        // Route::delete('/delete/{id}', [DoctorTreatmentController::class, 'destroy'])->name('admin.treatment.delete');
        // Route::get('/get-health-assessment/{patientId}', [DoctorTreatmentController::class, 'getHealthAssessment']);

        //Health Assessment
        // Route::get('/doctor/health-record', [HealthRecordController::class, 'index'])->name('admin.health-record.index');
        // Route::get('/patient/health-record-history/{id}', [HealthRecordController::class, 'show'])->name('admin.health-record.show');
        // Route::get('/doctor/health-record/create', [HealthRecordController::class, 'create'])->name('admin.health-record.create');
        // Route::post('/doctor/health-record/store', [HealthRecordController::class, 'store'])->name('admin.health-record.store');
        // Route::get('/doctor/health-record/{id}/edit', [HealthRecordController::class, 'edit'])->name('admin.health-record.edit');
        // Route::put('/doctor/health-record/{id}', [HealthRecordController::class, 'update'])->name('admin.health-record.update');
        // Route::delete('/doctor/health-record/{id}', [HealthRecordController::class, 'destroy'])->name('admin.health-record.destroy');

        // Birthing Station routes

        //Appointment management routes
        Route::get('/doctor/appointments', [AppointmentController::class, 'index'])->name('admin.appointments.index');
        Route::get('/doctor/appointments/create', [AppointmentController::class, 'create'])->name('admin.appointments.create');
        Route::post('/doctor/appointments/store', [AppointmentController::class, 'store'])->name('admin.appointments.store');
        Route::get('/doctor/appointments/{id}', [AppointmentController::class, 'show'])->name('admin.appointments.show');
        Route::get('/doctor/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('admin.appointments.edit');
        Route::put('/doctor/appointments/{id}', [AppointmentController::class, 'update'])->name('admin.appointments.update');
        Route::delete('/doctor/appointments/{id}', [AppointmentController::class, 'destroy'])->name('admin.appointments.destroy');

        // Prenatal Records
        Route::get('/doctor/prenatal-record', [DoctorPrenatalRecordController::class, 'index'])->name('admin.prenatal-record.index');
        Route::get('/doctor/prenatal-record/create', [DoctorPrenatalRecordController::class, 'create'])->name('admin.prenatal-record.create');
        Route::post('/doctor/prenatal-record/store', [DoctorPrenatalRecordController::class, 'store'])->name('admin.prenatal-record.store');
        Route::get('/doctor/prenatal-record/{id}', [DoctorPrenatalRecordController::class, 'show'])->name('admin.prenatal-record.show');
        Route::get('/doctor/prenatal-record/{id}/edit', [DoctorPrenatalRecordController::class, 'edit'])->name('admin.prenatal-record.edit');
        Route::put('/doctor/prenatal-record/{id}', [DoctorPrenatalRecordController::class, 'update'])->name('admin.prenatal-record.update');
        Route::delete('/doctor/prenatal-record/{id}', [DoctorPrenatalRecordController::class, 'destroy'])->name('admin.prenatal-record.destroy');

        //Family Planning
        Route::get('/doctor/family-planning', [FamilyPlanningController::class, 'index'])->name('admin.family-planning.index');
        Route::get('/doctor/family-planning/create', [FamilyPlanningController::class, 'create'])->name('admin.family-planning.create');
        Route::post('/doctor/family-planning/store', [FamilyPlanningController::class, 'store'])->name('admin.family-planning.store');
        Route::get('/doctor/family-planning/{id}', [FamilyPlanningController::class, 'show'])->name('admin.family-planning.show');
        Route::get('/doctor/family-planning/{id}/edit', [FamilyPlanningController::class, 'edit'])->name('admin.family-planning.edit');
        Route::put('/doctor/family-planning/{id}', [FamilyPlanningController::class, 'update'])->name('admin.family-planning.update');
        Route::delete('/doctor/family-planning/{id}', [FamilyPlanningController::class, 'destroy'])->name('admin.family-planning.destroy');

        //Dental Records
        Route::get('/doctor/dental-record', [DoctorDentalController::class, 'index'])->name('admin.dental-record.index');
        Route::get('/doctor/dental-record/create', [DoctorDentalController::class, 'create'])->name('admin.dental-record.create');
        Route::post('/doctor/dental-record/store', [DoctorDentalController::class, 'store'])->name('admin.dental-record.store');
        Route::get('/doctor/dental-record/{id}', [DoctorDentalController::class, 'show'])->name('admin.dental-record.show');
        Route::get('/doctor/dental-record/{id}/edit', [DoctorDentalController::class, 'edit'])->name('admin.dental-record.edit');
        Route::put('/doctor/dental-record/{id}', [DoctorDentalController::class, 'update'])->name('admin.dental-record.update');
        Route::delete('/doctor/dental-record/{id}', [DoctorDentalController::class, 'destroy'])->name('admin.dental-record.destroy');
        
    });

    // Laboratory modules accessible to Doctor and Medtech
    Route::middleware(LabAccess::class)->group(function () {
        // Dashboard access for medtech (uses same dashboard as doctor)
        Route::get('/doctor-dashboard', [DashboardController::class, 'index'])->name('doctor.index');
        
        // CBC Results
        Route::get('/doctor/cbc-results', [CBCresultsController::class, 'index'])->name('admin.cbc-results.index');
        Route::get('/doctor/cbc-results/create', [CBCresultsController::class, 'create'])->name('admin.cbc-results.create');
        Route::post('/doctor/cbc-results/store', [CBCresultsController::class, 'store'])->name('admin.cbc-results.store');
        Route::get('/doctor/cbc-results/{id}', [CBCresultsController::class, 'show'])->name('admin.cbc-results.show');
        Route::get('/doctor/cbc-results/{id}/edit', [CBCresultsController::class, 'edit'])->name('admin.cbc-results.edit');
        Route::put('/doctor/cbc-results/{id}', [CBCresultsController::class, 'update'])->name('admin.cbc-results.update');
        Route::delete('/doctor/cbc-results/{id}', [CBCresultsController::class, 'destroy'])->name('admin.cbc-results.destroy');

        // Urinalysis Results
        Route::get('/doctor/urinalysis-results', [UrinalysisController::class, 'index'])->name('admin.urinalysis-results.index');
        Route::get('/doctor/urinalysis-results/create', [UrinalysisController::class, 'create'])->name('admin.urinalysis-results.create');
        Route::post('/doctor/urinalysis-results/store', [UrinalysisController::class, 'store'])->name('admin.urinalysis-results.store');
        Route::get('/doctor/urinalysis-results/{id}', [UrinalysisController::class, 'show'])->name('admin.urinalysis-results.show');
        Route::get('/doctor/urinalysis-results/{id}/edit', [UrinalysisController::class, 'edit'])->name('admin.urinalysis-results.edit');
        Route::put('/doctor/urinalysis-results/{id}', [UrinalysisController::class, 'update'])->name('admin.urinalysis-results.update');
        Route::delete('/doctor/urinalysis-results/{id}', [UrinalysisController::class, 'destroy'])->name('admin.urinalysis-results.destroy');

        // Newborn Screening
        Route::get('admin-newborn_screenings', [NewbornScreeningController::class, 'index'])->name('admin.newborn_screenings.index');
        Route::get('admin-newborn_screenings/create', [NewbornScreeningController::class, 'create'])->name('admin.newborn_screenings.create');
        Route::post('admin-newborn_screenings', [NewbornScreeningController::class, 'store'])->name('admin.newborn_screenings.store');
        Route::get('admin-newborn_screenings/{newborn_screening}', [NewbornScreeningController::class, 'show'])->name('admin.newborn_screenings.show');
        Route::get('admin-newborn_screenings/{newborn_screening}/edit', [NewbornScreeningController::class, 'edit'])->name('admin.newborn_screenings.edit');
        Route::put('admin-newborn_screenings/{newborn_screening}', [NewbornScreeningController::class, 'update'])->name('admin.newborn_screenings.update');
        Route::delete('admin-newborn_screenings/{newborn_screening}', [NewbornScreeningController::class, 'destroy'])->name('admin.newborn_screenings.destroy');
    });


    // Staff routes
    Route::middleware(Staff::class)->group(function () {
        //Dashboard routes
        Route::get('/staff-dashboard', [StaffDashboardController::class, 'index'])->name('staff.index');
        
        // Report Generation for Staff
        Route::get('/staff/reports', [StaffReportController::class, 'index'])->name('staff.reports.index');
        Route::get('/staff/reports/patient/{patientName}', [StaffReportController::class, 'patientHistory'])->name('staff.reports.patient-history');
        Route::get('/staff/reports/monthly/{month}/{year}', [StaffReportController::class, 'generateMonthlyReport'])->name('staff.reports.monthly');
        Route::get('/staff/reports/export', [StaffReportController::class, 'exportReport'])->name('staff.reports.export');
        
        // Inventory Management for Staff
        Route::get('/staff/inventory', [StaffInventoryController::class, 'index'])->name('staff.inventory.index');
        Route::get('/staff/inventory/create', [StaffInventoryController::class, 'create'])->name('staff.inventory.create');
        Route::post('/staff/inventory/store', [StaffInventoryController::class, 'store'])->name('staff.inventory.store');
        Route::get('/staff/inventory/{inventory}', [StaffInventoryController::class, 'show'])->name('staff.inventory.show');
        Route::get('/staff/inventory/{inventory}/edit', [StaffInventoryController::class, 'edit'])->name('staff.inventory.edit');
        Route::put('/staff/inventory/{inventory}', [StaffInventoryController::class, 'update'])->name('staff.inventory.update');
        Route::delete('/staff/inventory/{inventory}', [StaffInventoryController::class, 'destroy'])->name('staff.inventory.destroy');
        Route::post('/staff/inventory/prescribe', [StaffInventoryController::class, 'prescribe'])->name('staff.inventory.prescribe');
        
        // Animal Bite Management for Staff
        Route::get('/staff/animal-bite', [StaffAnimalBiteController::class, 'index'])->name('staff.animal-bite.index');
        Route::get('/staff/animal-bite/create', [StaffAnimalBiteController::class, 'create'])->name('staff.animal-bite.create');
        Route::post('/staff/animal-bite/store', [StaffAnimalBiteController::class, 'store'])->name('staff.animal-bite.store');
        Route::get('/staff/animal-bite/{animalBiteCase}', [StaffAnimalBiteController::class, 'show'])->name('staff.animal-bite.show');
        Route::get('/staff/animal-bite/{animalBiteCase}/edit', [StaffAnimalBiteController::class, 'edit'])->name('staff.animal-bite.edit');
        Route::put('/staff/animal-bite/{animalBiteCase}', [StaffAnimalBiteController::class, 'update'])->name('staff.animal-bite.update');
        Route::delete('/staff/animal-bite/{animalBiteCase}', [StaffAnimalBiteController::class, 'destroy'])->name('staff.animal-bite.destroy');

        // TB-DOTS Management for Staff
        Route::get('/staff/tbdots', [StaffTbdotController::class, 'index'])->name('staff.tbdots.index');
        Route::get('/staff/tbdots/create', [StaffTbdotController::class, 'create'])->name('staff.tbdots.create');
        Route::post('/staff/tbdots/store', [StaffTbdotController::class, 'store'])->name('staff.tbdots.store');
        Route::get('/staff/tbdots/{tbdot}', [StaffTbdotController::class, 'show'])->name('staff.tbdots.show');
        Route::get('/staff/tbdots/{tbdot}/edit', [StaffTbdotController::class, 'edit'])->name('staff.tbdots.edit');
        Route::put('/staff/tbdots/{tbdot}', [StaffTbdotController::class, 'update'])->name('staff.tbdots.update');
        Route::delete('/staff/tbdots/{tbdot}', [StaffTbdotController::class, 'destroy'])->name('staff.tbdots.destroy');

        // Vaccine Management for Staff
        Route::get('/staff/vaccines', [StaffVaccineController::class, 'index'])->name('staff.vaccines.index');
        Route::get('/staff/vaccines/create', [StaffVaccineController::class, 'create'])->name('staff.vaccines.create');
        Route::post('/staff/vaccines/store', [StaffVaccineController::class, 'store'])->name('staff.vaccines.store');
        Route::get('/staff/vaccines/{vaccine}', [StaffVaccineController::class, 'show'])->name('staff.vaccines.show');
        Route::get('/staff/vaccines/{vaccine}/edit', [StaffVaccineController::class, 'edit'])->name('staff.vaccines.edit');
        Route::put('/staff/vaccines/{vaccine}', [StaffVaccineController::class, 'update'])->name('staff.vaccines.update');
        Route::delete('/staff/vaccines/{vaccine}', [StaffVaccineController::class, 'destroy'])->name('staff.vaccines.destroy');

        // Health Assessment (Infirmary) for Staff
        Route::get('/staff/health-assessment', [StaffInfirmaryController::class, 'index'])->name('staff.infirmary.index');
        Route::get('/staff/create-health-assessment', [StaffInfirmaryController::class, 'create'])->name('staff.infirmary.create');
        Route::post('/staff/health-assessment/store', [StaffInfirmaryController::class, 'store'])->name('staff.infirmary.store');
        Route::get('/staff/health-assessment/{id}', [StaffInfirmaryController::class, 'show'])->name('staff.infirmary.show');
        Route::get('/staff/health-assessment/{id}/edit', [StaffInfirmaryController::class, 'edit'])->name('staff.infirmary.edit');
        Route::post('/staff/health-assessment/{id}/update', [StaffInfirmaryController::class, 'update'])->name('staff.infirmary.update');
        Route::delete('/staff/health-assessment/{user}', [StaffInfirmaryController::class, 'destroy'])->name('staff.infirmary.destroy');

        // Dental Records for Staff
        Route::get('/staff/dental-record', [StaffDentalController::class, 'index'])->name('staff.dental-record.index');
        Route::get('/staff/dental-record/create', [StaffDentalController::class, 'create'])->name('staff.dental-record.create');
        Route::post('/staff/dental-record/store', [StaffDentalController::class, 'store'])->name('staff.dental-record.store');
        Route::get('/staff/dental-record/{id}', [StaffDentalController::class, 'show'])->name('staff.dental-record.show');
        Route::get('/staff/dental-record/{id}/edit', [StaffDentalController::class, 'edit'])->name('staff.dental-record.edit');
        Route::put('/staff/dental-record/{id}', [StaffDentalController::class, 'update'])->name('staff.dental-record.update');
        Route::delete('/staff/dental-record/{id}', [StaffDentalController::class, 'destroy'])->name('staff.dental-record.destroy');

        // Appointment Management for Staff
        Route::get('/staff/appointments', [StaffAppointmentController::class, 'index'])->name('staff.appointments.index');
        Route::get('/staff/appointments/create', [StaffAppointmentController::class, 'create'])->name('staff.appointments.create');
        Route::post('/staff/appointments/store', [StaffAppointmentController::class, 'store'])->name('staff.appointments.store');
        Route::get('/staff/appointments/{id}', [StaffAppointmentController::class, 'show'])->name('staff.appointments.show');
        Route::get('/staff/appointments/{id}/edit', [StaffAppointmentController::class, 'edit'])->name('staff.appointments.edit');
        Route::put('/staff/appointments/{id}', [StaffAppointmentController::class, 'update'])->name('staff.appointments.update');
        Route::delete('/staff/appointments/{id}', [StaffAppointmentController::class, 'destroy'])->name('staff.appointments.destroy');

        // Prenatal Records for Staff
        Route::get('/staff/prenatal-record', [StaffPrenatalController::class, 'index'])->name('staff.prenatal-record.index');
        Route::get('/staff/prenatal-record/create', [StaffPrenatalController::class, 'create'])->name('staff.prenatal-record.create');
        Route::post('/staff/prenatal-record/store', [StaffPrenatalController::class, 'store'])->name('staff.prenatal-record.store');
        Route::get('/staff/prenatal-record/{id}', [StaffPrenatalController::class, 'show'])->name('staff.prenatal-record.show');
        Route::get('/staff/prenatal-record/{id}/edit', [StaffPrenatalController::class, 'edit'])->name('staff.prenatal-record.edit');
        Route::put('/staff/prenatal-record/{id}', [StaffPrenatalController::class, 'update'])->name('staff.prenatal-record.update');
        Route::delete('/staff/prenatal-record/{id}', [StaffPrenatalController::class, 'destroy'])->name('staff.prenatal-record.destroy');

        // Family Planning for Staff
        Route::get('/staff/family-planning', [StaffFamilyPlanningController::class, 'index'])->name('staff.family-planning.index');
        Route::get('/staff/family-planning/create', [StaffFamilyPlanningController::class, 'create'])->name('staff.family-planning.create');
        Route::post('/staff/family-planning/store', [StaffFamilyPlanningController::class, 'store'])->name('staff.family-planning.store');
        Route::get('/staff/family-planning/{id}', [StaffFamilyPlanningController::class, 'show'])->name('staff.family-planning.show');
        Route::get('/staff/family-planning/{id}/edit', [StaffFamilyPlanningController::class, 'edit'])->name('staff.family-planning.edit');
        Route::put('/staff/family-planning/{id}', [StaffFamilyPlanningController::class, 'update'])->name('staff.family-planning.update');
        Route::delete('/staff/family-planning/{id}', [StaffFamilyPlanningController::class, 'destroy'])->name('staff.family-planning.destroy');

        // CBC Results for Staff
        Route::get('/staff/cbc-results', [StaffCbcResultController::class, 'index'])->name('staff.cbc-results.index');
        Route::get('/staff/cbc-results/create', [StaffCbcResultController::class, 'create'])->name('staff.cbc-results.create');
        Route::post('/staff/cbc-results/store', [StaffCbcResultController::class, 'store'])->name('staff.cbc-results.store');
        Route::get('/staff/cbc-results/{id}', [StaffCbcResultController::class, 'show'])->name('staff.cbc-results.show');
        Route::get('/staff/cbc-results/{id}/edit', [StaffCbcResultController::class, 'edit'])->name('staff.cbc-results.edit');
        Route::put('/staff/cbc-results/{id}', [StaffCbcResultController::class, 'update'])->name('staff.cbc-results.update');
        Route::delete('/staff/cbc-results/{id}', [StaffCbcResultController::class, 'destroy'])->name('staff.cbc-results.destroy');

        // Urinalysis Results for Staff
        Route::get('/staff/urinalysis-results', [StaffUrinalysisController::class, 'index'])->name('staff.urinalysis-results.index');
        Route::get('/staff/urinalysis-results/create', [StaffUrinalysisController::class, 'create'])->name('staff.urinalysis-results.create');
        Route::post('/staff/urinalysis-results/store', [StaffUrinalysisController::class, 'store'])->name('staff.urinalysis-results.store');
        Route::get('/staff/urinalysis-results/{id}', [StaffUrinalysisController::class, 'show'])->name('staff.urinalysis-results.show');
        Route::get('/staff/urinalysis-results/{id}/edit', [StaffUrinalysisController::class, 'edit'])->name('staff.urinalysis-results.edit');
        Route::put('/staff/urinalysis-results/{id}', [StaffUrinalysisController::class, 'update'])->name('staff.urinalysis-results.update');
        Route::delete('/staff/urinalysis-results/{id}', [StaffUrinalysisController::class, 'destroy'])->name('staff.urinalysis-results.destroy');

        // Newborn Screening for Staff
        Route::get('/staff/newborn-screenings', [StaffNewbornScreeningController::class, 'index'])->name('staff.newborn_screenings.index');
        Route::get('/staff/newborn-screenings/create', [StaffNewbornScreeningController::class, 'create'])->name('staff.newborn_screenings.create');
        Route::post('/staff/newborn-screenings/store', [StaffNewbornScreeningController::class, 'store'])->name('staff.newborn_screenings.store');
        Route::get('/staff/newborn-screenings/{newborn_screening}', [StaffNewbornScreeningController::class, 'show'])->name('staff.newborn_screenings.show');
        Route::get('/staff/newborn-screenings/{newborn_screening}/edit', [StaffNewbornScreeningController::class, 'edit'])->name('staff.newborn_screenings.edit');
        Route::put('/staff/newborn-screenings/{newborn_screening}', [StaffNewbornScreeningController::class, 'update'])->name('staff.newborn_screenings.update');
        Route::delete('/staff/newborn-screenings/{newborn_screening}', [StaffNewbornScreeningController::class, 'destroy'])->name('staff.newborn_screenings.destroy');
    });

    //Patient management routes
    // Route::get('/staff/patients', [StaffPatientController::class, 'index'])->name('staff.patient.index');
    // Route::get('/staff/patients/{id}', [StaffPatientController::class, 'show'])->name('staff.patients.show');





    // //Health record management routes
    // Route::get('/staff/health-record', [StaffHealthRecordController::class, 'index'])->name('staff.health-record.index');
    // Route::get('/staff/health-record-history/{id}', [StaffHealthRecordController::class, 'show'])->name('staff.health-record.show');
    // Route::get('/staff/health-record/create', [StaffHealthRecordController::class, 'create'])->name('staff.health-record.create');
    // Route::post('/staff/health-record/store', [StaffHealthRecordController::class, 'store'])->name('staff.health-record.store');
    // Route::get('/staff/health-record/{id}/edit', [StaffHealthRecordController::class, 'edit'])->name('staff.health-record.edit');
    // Route::put('/staff/health-record/{id}', [StaffHealthRecordController::class, 'update'])->name('staff.health-record.update');
    // Route::delete('/staff/health-record/{id}', [StaffHealthRecordController::class, 'destroy'])->name('staff.health-record.destroy');


    //Treatment management routes
    // Route::get('/staff/treatment', [StaffDashboardController::class, 'index'])->name('staff.treatment.index');
    // Route::get('/staff/treatment/{id}', [StaffDashboardController::class, 'show'])->name('staff.treatment.show');


    //INFIRMARY
    //Appointment management routes for staff
    // Route::get('/staff/appointments', [StaffAppointmentController::class, 'index'])->name('staff.appointments.index');
    // Route::get('/staff/appointments/{id}', [StaffAppointmentController::class, 'show'])->name('staff.appointments.show');
    // Route::get('/staff/appointments/create', [AppointmentController::class, 'create'])->name('staff.appointments.create');
    // Route::post('/staff/appointments/store', [AppointmentController::class, 'store'])->name('staff.appointments.store');
    // Route::get('/staff/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('staff.appointments.edit');
    // Route::put('/staff/appointments/{id}', [AppointmentController::class, 'update'])->name('staff.appointments.update');
    // Route::delete('/staff/appointments/{id}', [AppointmentController::class, 'destroy'])->name('staff.appointments.destroy');

    // Health Information Management for staff
    // Route::get('/staff/patient-record', [StaffHealthInformationController::class, 'index'])->name('staff.patient-record.index');
    // Route::get('/staff/patient-record/{id}', [StaffHealthInformationController::class, 'show'])->name('staff.patient-record.show');
    // Route::post('/staff/patient-record/store', [HealthInformationController::class, 'store'])->name('staff.patient-record.store');
    // Route::get('/staff/patient-record/{id}/edit', [StaffHealthInformationController::class, 'edit'])->name('staff.patient-record.edit');
    // Route::put('/staff/patient-record/{id}', [StaffHealthInformationController::class, 'update'])->name('staff.patient-record.update');
    // Route::delete('/staff/patient-record/{id}', [StaffHealthInformationController::class, 'destroy'])->name('staff.patient-record.destroy');
});

// RedirectIfAuthenticated
Route::get('/', function () {
    return response(view('auth.login'))->withHeaders([
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        'Pragma' => 'no-cache',
    ]);
})->middleware(RedirectIfAuthenticated::class);
Route::get('/login', function () {
    return response(view('auth.login'))->withHeaders([
        'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        'Pragma' => 'no-cache',
    ]);
})->middleware(RedirectIfAuthenticated::class);

// Error 404 Not Found
Route::get('/error', function () {
    return view('error');
})->name('error');
