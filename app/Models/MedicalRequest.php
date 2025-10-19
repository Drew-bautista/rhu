<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRequest extends Model
{
    // use HasFactory;

    protected $fillable = [
        'patient_id',
        'request_type',
        'description',
        'status',
        'priority',
        'preferred_date',
        'schedule_date',
        'testdate_date',
        'doctor_name',
        'file_path',
    ];

    // Define relationship if needed (assuming 'User' model exists)
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
