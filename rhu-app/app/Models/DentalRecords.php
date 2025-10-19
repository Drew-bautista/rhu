<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentalRecords extends Model
{
    use HasFactory;
    protected $fillable = [
        'appointment_id',
        'services',
        'tooth_area',
        'findings',
        'prescription',
    ];

    public function appointments()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}
