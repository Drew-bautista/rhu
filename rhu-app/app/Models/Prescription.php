<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql';

    protected $fillable = [
        'appointment_id',
        'inventory_id',
        'patient_name',
        'patient_age',
        'patient_contact',
        'prescription_number',
        'prescription_date',
        'doctor_name',
        'prescribed_by',
        'diagnosis',
        'symptoms',
        'medical_history',
        'status',
        'notes',
        'follow_up_date',
        'follow_up_notes',
        'quantity_prescribed',
        'dosage_instructions',
        'duration_days',
    ];

    protected $casts = [
        'prescription_date' => 'date',
        'follow_up_date' => 'date',
    ];

    // Relationships
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function prescriptionItems()
    {
        return $this->hasMany(PrescriptionItem::class);
    }

    public function prescribedBy()
    {
        return $this->belongsTo(User::class, 'prescribed_by');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function dispensedBy()
    {
        return $this->belongsTo(User::class, 'dispensed_by');
    }

    // Generate prescription number
    public static function generatePrescriptionNumber()
    {
        $year = date('Y');
        $month = date('m');
        $lastRecord = self::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('id', 'desc')
            ->first();
        
        $nextNumber = $lastRecord ? (intval(substr($lastRecord->prescription_number, -4)) + 1) : 1;
        
        return 'RX-' . $year . $month . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
