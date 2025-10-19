<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrenatalRecords extends Model
{
    public $primaryKey = 'id';
    protected $table = 'prenatal_record';
    public $fillable = [
        'appointment_id',
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
    public function appointments()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }


    // public function health_assessment()
    // {
    //     return $this->belongsTo(HealthAssessment::class);
    // }
}
