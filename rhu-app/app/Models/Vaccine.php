<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'patient_name',
        'date_of_birth',
        'age',
        'age_group',
        'sex',
        'contact_number',
        'address',
        'vaccine_type',
        'dose_number',
        'date_administered',
        'next_dose_date',
        'administered_by',
        'batch_number',
        'expiry_date',
        'adverse_reactions',
        'remarks'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_administered' => 'date',
        'next_dose_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
