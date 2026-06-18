<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_booking_id',
        'doctor_id',
        'patient_id',
        'medicines',
        'notes',
        'instructions',
        'status',
        'issued_at',
    ];

    protected $casts = [
        'medicines' => 'json',
        'issued_at' => 'datetime',
    ];

    public function appointmentBooking()
    {
        return $this->belongsTo(AppointmentBooking::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
