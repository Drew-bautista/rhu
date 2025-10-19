<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        // 'role',
        'birthdate',
        'sex',
        'contact_no',
        'emergency_contact',
        'address',
        // 'email',
        // 'password',
        // 'year',
        // 'section',
    ];

    // app/Models/Patient.php
    public function healthAssessments()
    {
        return $this->hasMany(HealthAssessment::class, 'patient_id'); // Explicitly specify the foreign key
    }
}
