<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthInformation extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    protected $fillable = [
        'patient_appointment_id',
        'weight',
        'height',
        'age_of_gestation',
        'blood_pressure',
        'nutritional_status',
        // 'number_of_checkup',
        // 'status',
        'birth_plan',
        'dental_checkup',
    ];
    public function patientAppointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
