<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentBooking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $doctorId = auth()->id();
        $date = $request->input('date');

        $query = AppointmentSchedule::where('doctor_id', $doctorId)->orderBy('schedule_date')->orderBy('start_time');

        if ($date) {
            $query->whereDate('schedule_date', $date);
        }

        $schedules = $query->get();

        return view('doctor.schedules.index', compact('schedules', 'date'));
    }

    public function create()
    {
        return view('doctor.schedules.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_patients_per_day' => 'required|integer|min:1|max:20',
            'consultation_fee' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        $validated['doctor_id'] = auth()->id();
        $validated['status'] = 'available';

        AppointmentSchedule::create($validated);

        return redirect()->route('doctor.schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function show(AppointmentSchedule $schedule)
    {
        if ($schedule->doctor_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $bookings = $schedule->bookings()->get();

        return view('doctor.schedules.show', compact('schedule', 'bookings'));
    }

    public function edit(AppointmentSchedule $schedule)
    {
        if ($schedule->doctor_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('doctor.schedules.edit', compact('schedule'));
    }

    public function update(Request $request, AppointmentSchedule $schedule)
    {
        if ($schedule->doctor_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'schedule_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_patients_per_day' => 'required|integer|min:1|max:20',
            'consultation_fee' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        $schedule->update($validated);

        return redirect()->route('doctor.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(AppointmentSchedule $schedule)
    {
        if ($schedule->doctor_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $schedule->delete();

        return redirect()->route('doctor.schedules.index')->with('success', 'Schedule deleted successfully.');
    }

    public function approveBooking(AppointmentBooking $booking)
    {
        $schedule = $booking->schedule;

        if ($schedule->doctor_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if ($schedule->current_bookings >= $schedule->max_patients_per_day) {
            return redirect()->back()->with('error', 'Maximum patients reached for this slot.');
        }

        $booking->update(['status' => 'approved', 'approved_at' => now()]);
        $schedule->increment('current_bookings');

        return redirect()->back()->with('success', 'Booking approved.');
    }

    public function rejectBooking(AppointmentBooking $booking)
    {
        $schedule = $booking->schedule;

        if ($schedule->doctor_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $booking->update(['status' => 'rejected', 'rejected_at' => now()]);

        return redirect()->back()->with('success', 'Booking rejected.');
    }
}
