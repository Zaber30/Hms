<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (! $user) {
            abort(403, 'Unauthorized');
        }

        if ($user->role !== 'doctor') {
            abort(403, 'Unauthorized');
        }

        if ($user->status !== 'approved') {
            return view('doctor.pending');
        }

        $today = Carbon::today();
        $upcomingAppointments = Appointment::where('doctor_id', $user->id)
            ->whereDate('appointment_date', '>=', $today)
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->limit(8)
            ->get();

        $todayCount = Appointment::where('doctor_id', $user->id)
            ->whereDate('appointment_date', $today)
            ->count();

        return view('doctor.dashboard', compact('upcomingAppointments', 'todayCount'));
    }
}
