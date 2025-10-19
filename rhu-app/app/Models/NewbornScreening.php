<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewbornScreening extends Model
{
    use HasFactory;

    /**
     * Table name (optional, kasi by default plural na).
     */
    protected $table = 'newborn_screenings';

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        // 🍼 Newborn Info
        'first_name',
        'middle_name',
        'last_name',
        'sex',
        'date_of_birth',
        'time_of_birth',
        'birth_weight',
        'gestational_age',
        'place_of_birth',

        // 👩‍🍼 Mother Info
        'mother_name',
        'mother_age',
        'mother_address',
        'mother_contact',

        // 🧾 Screening Details
        'screening_date',
        'facility',
        'kit_no',
        'sample_collection_at',
        'specimen_type',

        // 🧪 Screening Results
        'conditions_tested',
        'result_status',
        'remarks',

        // 👨‍⚕️ Provider
        'provider_name',
        'provider_role',
    ];

    /**
     * Cast attributes.
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'time_of_birth' => 'datetime:H:i',
        'screening_date' => 'date',
        'sample_collection_at' => 'datetime',
        'conditions_tested' => 'array', // since naka-JSON
    ];
}
