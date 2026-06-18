<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bmdc_registration_number',
        'phone',
        'gender',
        'qualification',
        'specialist',
        'experience_years',
        'bio',
        'clinic_address',
        'consultation_fee',
        'profile_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules()
    {
        return $this->hasMany(AppointmentSchedule::class, 'doctor_id', 'user_id');
    }
}
