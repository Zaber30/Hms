<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'patient_id',
        'status',
        'patient_notes',
        'doctor_notes',
        'approved_at',
        'rejected_at',
        'completed_at',
    ];

    protected $dates = [
        'approved_at',
        'rejected_at',
        'completed_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function schedule()
    {
        return $this->belongsTo(AppointmentSchedule::class, 'schedule_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->schedule->doctor();
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class, 'appointment_booking_id');
    }
}
