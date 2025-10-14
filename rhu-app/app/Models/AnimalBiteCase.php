<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalBiteCase extends Model
{
    use HasFactory;

    // Table name (optional kung match naman sa plural ng model name)
    protected $table = 'animal_bite_cases';

    // Mass assignable fields
    protected $fillable = [
        'appointment_id',
        'date_of_incident',
        'animal_type',
        'animal_ownership',
        'animal_vaccination_status',
        'animal_behavior',
        'bite_site',
        'bite_category',
        'wound_description',
        'first_consultation_date',
        'arv_dose',
        'arv_date',
        'rig_administered',
        'remarks',
    ];

    /**
     * Relationship to appointments (if you have an App\Models\Appointment)
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
