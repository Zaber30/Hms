<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;

class AppointmentController extends Controller
{
    // max appointments per doctor per day
    private const MAX_PER_DAY = 10;

    public function index(Request $request)
    {
        $doctorId = auth()->id();

        $date = $request->input('date');

        $query = Appointment::where('doctor_id', $doctorId)->orderBy('appointment_date')->orderBy('appointment_time');

        if ($date) {
            $query->whereDate('appointment_date', $date);
        }

        $appointments = $query->get();

        return view('doctor.appointments', compact('appointments', 'date'));
    }

    public function store(Request $request)
    {
        $doctorId = auth()->id();

        $data = $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'nullable|date_format:H:i',
            'patient_id' => 'nullable|exists:users,id',
            'notes' => 'nullable|string',
        ]);

        $count = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $data['appointment_date'])
            ->count();

        if ($count >= self::MAX_PER_DAY) {
            return redirect()->back()->with('error', "Maximum appointments (" . self::MAX_PER_DAY . ") reached for this day.");
        }

        $appointment = Appointment::create(array_merge($data, ['doctor_id' => $doctorId, 'status' => 'scheduled']));

        return redirect()->back()->with('success', 'Appointment created.');
    }
}
