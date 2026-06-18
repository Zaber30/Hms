<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\AppointmentBooking;
use App\Models\AppointmentSchedule;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show a simple patient dashboard for bookings
     */
    public function dashboard()
    {
        return view('patient.dashboard');
    }

    /**
     * Return available schedules as JSON for Vue frontend
     */
    public function availableSchedules(Request $request)
    {
        $schedules = AppointmentSchedule::with(['doctorUser'])
            ->whereDate('schedule_date', '>=', now()->toDateString())
            ->where('status', 'available')
            ->get()
            ->map(function ($s) {
                return [
                    'id' => $s->id,
                    'doctor_id' => $s->doctor_id,
                    'date' => $s->schedule_date->toDateString(),
                    'start_time' => $s->start_time,
                    'end_time' => $s->end_time,
                    'fee' => $s->consultation_fee,
                    'doctor_name' => optional($s->doctorUser)->name ?? 'Dr. Unknown',
                    'is_available' => $s->isAvailable(),
                ];
            });

        return response()->json([
            'success' => true,
            'schedules' => $schedules,
        ]);
    }

    /**
     * Show doctor profile and available schedules for booking
     */
    public function showDoctorSchedules($doctorId)
    {
        $doctor = \App\Models\Doctor::with('user', 'schedules')
            ->findOrFail($doctorId);

        // Get available schedules for this doctor
        $availableSchedules = AppointmentSchedule::where('doctor_id', $doctor->user_id)
            ->whereDate('schedule_date', '>=', now()->toDateString())
            ->where('status', 'available')
            ->orderBy('schedule_date')
            ->orderBy('start_time')
            ->get();

        return view('patient.doctor-schedules', [
            'doctor' => $doctor,
            'schedules' => $availableSchedules,
        ]);
    }

    /**
     * Show booking form for a schedule
     */
    public function show(AppointmentSchedule $schedule)
    {
        return view('patient.booking', ['schedule' => $schedule]);
    }

    /**
     * Create a booking for the authenticated patient
     */
    public function book(Request $request, AppointmentSchedule $schedule)
    {
        $request->validate([
            'patient_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        if (! $schedule->isAvailable()) {
            return back()->withErrors(['schedule' => 'This schedule is no longer available.']);
        }

        $booking = AppointmentBooking::create([
            'schedule_id' => $schedule->id,
            'patient_id' => $request->user()->id,
            'status' => 'pending',
            'patient_notes' => $request->input('patient_notes'),
        ]);

        // increment current bookings safely
        $schedule->increment('current_bookings');

        return redirect()->route('patient.my-bookings')->with('success', 'Booking created successfully.');
    }

    /**
     * List patient's bookings
     */
    public function myBookings(Request $request)
    {
        $bookings = AppointmentBooking::with(['schedule.doctorUser'])
            ->where('patient_id', $request->user()->id)
            ->latest()
            ->get();

        return view('patient.my-bookings', ['bookings' => $bookings]);
    }

    /**
     * Cancel a booking
     */
    public function cancel(Request $request, AppointmentBooking $booking)
    {
        if ($booking->patient_id !== $request->user()->id) {
            abort(403);
        }

        if (in_array($booking->status, ['cancelled', 'rejected', 'completed'])) {
            return back()->with('error', 'Booking cannot be cancelled.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        // decrement current bookings if set
        $schedule = $booking->schedule;
        if ($schedule && $schedule->current_bookings > 0) {
            $schedule->decrement('current_bookings');
        }

        return back()->with('success', 'Booking cancelled.');
    }
}
