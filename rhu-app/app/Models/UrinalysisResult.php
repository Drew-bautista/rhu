<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrinalysisResult extends Model
{
    use HasFactory;

    protected $table = 'urinalysis_results';

    protected $fillable = [
        'appointment_id',
        // 'test_date',
        'color',
        'transparency',
        'specific_gravity',
        'ph',
        'protein',
        'glucose',
        'ketones',
        'bilirubin',
        'urobilinogen',
        'nitrite',
        'leukocyte_esterase',
        'rbc',
        'wbc',
        'epithelial_cells',
        'bacteria',
        'crystals',
        'casts',
        'remarks',
    ];

    /**
     * Relation: UrinalysisResult belongs to Appointment
     */
    public function appointments()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}
