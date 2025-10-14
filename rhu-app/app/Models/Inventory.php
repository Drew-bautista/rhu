<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = [
        'medicine_name',
        'generic_name',
        'brand_name',
        'medicine_type',
        'dosage_strength',
        'quantity_in_stock',
        'reorder_level',
        'unit_of_measure',
        'expiry_date',
        'batch_number',
        'supplier',
        'unit_cost',
        'storage_location',
        'notes'
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'unit_cost' => 'decimal:2',
    ];

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function isLowStock()
    {
        return $this->quantity_in_stock <= $this->reorder_level;
    }
}
