<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql';

    protected $fillable = [
        'prescription_id',
        'medicine_id',
        'quantity',
        'dosage',
        'frequency',
        'duration',
        'instructions',
        'dispensed_quantity',
        'status',
        'dispensing_notes',
    ];

    // Relationships
    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    // Accessors
    public function getRemainingQuantityAttribute()
    {
        return $this->quantity - $this->dispensed_quantity;
    }

    public function getIsFullyDispensedAttribute()
    {
        return $this->dispensed_quantity >= $this->quantity;
    }

    public function getDispensedPercentageAttribute()
    {
        return $this->quantity > 0 ? ($this->dispensed_quantity / $this->quantity) * 100 : 0;
    }
}
