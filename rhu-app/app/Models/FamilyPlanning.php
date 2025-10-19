<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyPlanning extends Model
{

    protected $table = 'family_planning'; // optional if table name is not plural of model
    protected $fillable = [
        'name',
        'age',
        'contact',
        'address',
        // 'date_of_visit',
        'fp_counseling',
        'fp_commodity',
        'date_of_follow_up',
        'facility',
    ];

    protected $casts = [
        // 'date_of_visit' => 'date',
        'date_of_follow_up' => 'date',
    ];
}
