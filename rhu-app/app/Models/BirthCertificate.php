<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthCertificate extends Model
{
    use HasFactory;

    protected $table = 'birth_certificates';

    protected $fillable = [
        // Child Information
        'child_first_name',
        'child_middle_name',
        'child_last_name',
        'child_sex',
        'date_of_birth',
        'time_of_birth',
        'place_of_birth',
        'birth_weight',
        'birth_length',
        'type_of_birth',
        'birth_order',
        
        // Mother Information
        'mother_first_name',
        'mother_middle_name',
        'mother_last_name',
        'mother_maiden_name',
        'mother_date_of_birth',
        'mother_age_at_birth',
        'mother_citizenship',
        'mother_religion',
        'mother_occupation',
        'mother_address',
        
        // Father Information
        'father_first_name',
        'father_middle_name',
        'father_last_name',
        'father_date_of_birth',
        'father_age_at_birth',
        'father_citizenship',
        'father_religion',
        'father_occupation',
        'father_address',
        
        // Marriage Information
        'parents_marriage_date',
        'parents_marriage_place',
        
        // Birth Attendant Information
        'attendant_name',
        'attendant_type',
        'attendant_title',
        
        // Registration Information
        'registry_number',
        'date_registered',
        'registered_by',
        'registrar_name',
        
        // Additional Information
        'remarks',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'time_of_birth' => 'datetime:H:i',
        'mother_date_of_birth' => 'date',
        'father_date_of_birth' => 'date',
        'parents_marriage_date' => 'date',
        'date_registered' => 'date',
    ];

    // Accessor to get full child name
    public function getChildFullNameAttribute()
    {
        return trim($this->child_first_name . ' ' . $this->child_middle_name . ' ' . $this->child_last_name);
    }

    // Accessor to get full mother name
    public function getMotherFullNameAttribute()
    {
        return trim($this->mother_first_name . ' ' . $this->mother_middle_name . ' ' . $this->mother_last_name);
    }

    // Accessor to get full father name
    public function getFatherFullNameAttribute()
    {
        return trim($this->father_first_name . ' ' . $this->father_middle_name . ' ' . $this->father_last_name);
    }

    // Generate registry number
    public static function generateRegistryNumber()
    {
        $year = date('Y');
        $lastRecord = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();
        
        $nextNumber = $lastRecord ? (intval(substr($lastRecord->registry_number, -4)) + 1) : 1;
        
        return $year . '-BC-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
