<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildImmunization extends Model
{
    use HasFactory;

    protected $table = 'child_immunizations';

    protected $fillable = [
        'child_name',
        'date_of_birth',
        'gender',
        'parent_name',
        'address',
        'vaccine_name',
        'immunization_date',
        'dose_number',
        'administered_by',
        'remarks',
    ];
}
