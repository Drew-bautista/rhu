<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'inventory_id',
        'prescribed_by',
        'patient_name',
        'quantity_prescribed',
        'dosage_instructions',
        'duration_days',
        'special_instructions',
        'status',
        'dispensed_at',
        'dispensed_by'
    ];

    protected $casts = [
        'dispensed_at' => 'datetime',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function prescribedBy()
    {
        return $this->belongsTo(User::class, 'prescribed_by');
    }

    public function dispensedBy()
    {
        return $this->belongsTo(User::class, 'dispensed_by');
    }
}
