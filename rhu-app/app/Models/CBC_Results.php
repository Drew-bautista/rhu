<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CBC_Results extends Model
{
    use HasFactory;

    protected $table = 'cbc_results';

    protected $fillable = [
        'appointment_id',
        'hemoglobin',
        'hematocrit',
        'rbc_count',
        'wbc_count',
        'platelet_count',
        'mcv',
        'mch',
        'mchc',
        'neutrophils',
        'lymphocytes',
        'monocytes',
        'eosinophils',
        'basophils',
        'newborn_screening',
        'hepa_b_screening',
        'fasting_blood_sugar',
        'cholesterol',
        'remarks',
    ];

    public function appointments()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}
