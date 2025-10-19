<?php

namespace App\Models;

// use App\Http\Middleware\Patient;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    public $primaryKey = 'id';

    public $fillable = [
        'patient_id',
        // 'health_assessment_id',
        'consultation_date_time',
        'chief_complaint',
        'laboratory_findings',
        'assessment_diagnosis',
        'medical_history',
        'medication_treatment',
        'personal_social_history',
        'pregnancy_history'
        // 'interpretation_comments',
        // 'recommendations',
        // 'prescriptions',
        // 'result_summary'
    ];
    public function patient()
    {
        return $this->belongsTo(Patients::class);
    }
    public function health_assessment()
    {
        return $this->belongsTo(HealthAssessment::class);
    }
}
