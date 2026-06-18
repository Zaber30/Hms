<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'schedule_date',
        'start_time',
        'end_time',
        'max_patients_per_day',
        'current_bookings',
        'consultation_fee',
        'status',
        'notes',
    ];

    protected $dates = [
        'schedule_date',
    ];

    protected $casts = [
        'schedule_date' => 'date',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'user_id');
    }

    public function doctorUser()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function bookings()
    {
        return $this->hasMany(AppointmentBooking::class, 'schedule_id');
    }

    public function approvedBookings()
    {
        return $this->bookings()->where('status', 'approved');
    }

    public function pendingBookings()
    {
        return $this->bookings()->where('status', 'pending');
    }

    public function isAvailable(): bool
    {
        return $this->status === 'available' && $this->current_bookings < $this->max_patients_per_day;
    }
}
