<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthAssessment extends Model
{
    public $primaryKey = 'id';

    public $fillable = [
        'patient_id',
        'height',
        'weight',
        'blood_pressure',
        'heart_rate',
        'respiratory_rate',
        'visual_acuity',
        'temperature',
        // 'symptoms',
        // 'medical_conditions',
        // 'medical_history',
        // 'allergies'
    ];
    /**
     * Get the patient associated with the health assessment.
     */
    public function patient()
    {
        return $this->belongsTo(Patients::class);
    }
}
