<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_birth',
        'age',
        'contact_number',
        'date_of_appointment',
        'time',
        'address',
        'service',
        'emergency_contact',
        'status',
    ];
    // protected $fillable = [
    //     'patient_name',
    //     // 'contact_info',
    //     'date_of_appointment',
    //     'weight',
    //     'age_of_gestation',
    //     'blood_pressure',
    //     'nutritional_status',
    //     'number_of_checkup',
    //     'status',
    //     'birth_plan',
    //     'dental_checkup',
    // ];
    // public function healthInformation()
    // {
    //     return $this->hasMany(HealthInformation::class, 'patient_appointment_id');
    // }
    public function prenatalRecords()
    {
        return $this->hasMany(PrenatalRecords::class, 'appointment_id'); // Explicitly specify the foreign key
    }

    public function dentalRecords()
    {
        return $this->hasMany(DentalRecords::class, 'appointment_id'); // Explicitly specify the foreign key
    }

    public function cbcResults()
    {
        return $this->hasMany(CBC_Results::class, 'appointment_id'); // Explicitly specify the foreign key
    }

    public function urinalysisResults()
    {
        return $this->hasMany(UrinalysisResult::class, 'appointment_id'); // Explicitly specify the foreign key
    }

    public function animalBiteCase()
    {
        return $this->hasMany(AnimalBiteCase::class, 'appointment_id'); // Explicitly specify the foreign key
    }
    public function urinalysisResult()
    {
        return $this->hasOne(UrinalysisResult::class);
    }
}
