<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbdot extends Model
{
    use HasFactory;

    protected $table = 'tbdots';

    protected $fillable = [
        'appointment_id',
        'patient_name',
        'date_of_birth',
        'age',
        'sex',
        'contact_number',
        'address',
        'date_of_diagnosis',
        'tb_type',
        'treatment_category',
        'treatment_start_date',
        'treatment_end_date',
        'treatment_status',
        'remarks'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_diagnosis' => 'date',
        'treatment_start_date' => 'date',
        'treatment_end_date' => 'date',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
