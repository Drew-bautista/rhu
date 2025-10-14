<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infirmary extends Model
{
    protected $table = 'infirmary'; // Specify the table name if it differs from the model name
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'birthdate',
        'sex',
        'contact_no',
        'emergency_contact',
        'address',
        //physical examination
        'height',
        'weight',
        'blood_pressure',
        'heart_rate',
        'respiratory_rate',
        'visual_acuity',
        'temperature',
        //treatment
        'consultation_date_time',
        'chief_complaint',
        'laboratory_findings',
        'assessment_diagnosis',
        'medical_history',
        'medication_treatment',
        'personal_social_history',
        'pregnancy_history'

    ];
}
