<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql';

    protected $fillable = [
        'medicine_name',
        'generic_name',
        'brand_name',
        'description',
        'dosage_form',
        'strength',
        'unit',
        'current_stock',
        'minimum_stock',
        'maximum_stock',
        'unit_price',
        'category',
        'classification',
        'expiry_date',
        'batch_number',
        'manufacturer',
        'status',
        'notes',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'unit_price' => 'decimal:2',
    ];

    // Relationships
    public function prescriptionItems()
    {
        return $this->hasMany(PrescriptionItem::class);
    }

    // Accessors
    public function getIsLowStockAttribute()
    {
        return $this->current_stock <= $this->minimum_stock;
    }

    public function getIsExpiredAttribute()
    {
        return $this->expiry_date && $this->expiry_date->isPast();
    }

    public function getStockStatusAttribute()
    {
        if ($this->current_stock <= 0) {
            return 'Out of Stock';
        } elseif ($this->is_low_stock) {
            return 'Low Stock';
        } elseif ($this->is_expired) {
            return 'Expired';
        } else {
            return 'In Stock';
        }
    }

    // Scopes
    public function scopeLowStock($query)
    {
        return $query->whereRaw('current_stock <= minimum_stock');
    }

    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now());
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
}
