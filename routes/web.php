<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Doctor\RequestController;
use App\Http\Controllers\Guest\HomePageController;
use App\Http\Controllers\Guest\PredictionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Guest mode - Home page with specialists
Route::get('/', [HomePageController::class, 'index']);
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');
    Route::get('/doctor/appointments', [\App\Http\Controllers\Doctor\AppointmentController::class, 'index'])->name('doctor.appointments');
    Route::post('/doctor/appointments', [\App\Http\Controllers\Doctor\AppointmentController::class, 'store'])->name('doctor.appointments.store');

    // Appointment Schedules
    Route::get('/doctor/schedules', [\App\Http\Controllers\Doctor\ScheduleController::class, 'index'])->name('doctor.schedules.index');
    Route::get('/doctor/schedules/create', [\App\Http\Controllers\Doctor\ScheduleController::class, 'create'])->name('doctor.schedules.create');
    Route::post('/doctor/schedules', [\App\Http\Controllers\Doctor\ScheduleController::class, 'store'])->name('doctor.schedules.store');
    Route::get('/doctor/schedules/{schedule}', [\App\Http\Controllers\Doctor\ScheduleController::class, 'show'])->name('doctor.schedules.show');
    Route::get('/doctor/schedules/{schedule}/edit', [\App\Http\Controllers\Doctor\ScheduleController::class, 'edit'])->name('doctor.schedules.edit');
    Route::patch('/doctor/schedules/{schedule}', [\App\Http\Controllers\Doctor\ScheduleController::class, 'update'])->name('doctor.schedules.update');
    Route::delete('/doctor/schedules/{schedule}', [\App\Http\Controllers\Doctor\ScheduleController::class, 'destroy'])->name('doctor.schedules.destroy');

    // Booking Management
    Route::post('/doctor/bookings/{booking}/approve', [\App\Http\Controllers\Doctor\ScheduleController::class, 'approveBooking'])->name('doctor.bookings.approve');
    Route::post('/doctor/bookings/{booking}/reject', [\App\Http\Controllers\Doctor\ScheduleController::class, 'rejectBooking'])->name('doctor.bookings.reject');

    // Prescription Management
    Route::get('/doctor/prescriptions/{booking}/create', [\App\Http\Controllers\Doctor\PrescriptionController::class, 'create'])->name('doctor.prescription.create');
    Route::post('/doctor/prescriptions/{booking}', [\App\Http\Controllers\Doctor\PrescriptionController::class, 'store'])->name('doctor.prescription.store');
    Route::get('/doctor/prescriptions/{prescription}', [\App\Http\Controllers\Doctor\PrescriptionController::class, 'show'])->name('doctor.prescription.show');
    Route::get('/doctor/prescriptions/{prescription}/download', [\App\Http\Controllers\Doctor\PrescriptionController::class, 'download'])->name('doctor.prescription.download');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user) {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($user->role === 'doctor') {
            if ($user->status === 'approved') {
                return redirect()->route('doctor.dashboard');
            }

            return view('doctor.pending');
        }
    }

    return app(\App\Http\Controllers\Patient\DoctorController::class)->dashboard();
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:doctor,patient'])->group(function () {

    // doctor register-request
    Route::get('/register-doctor', [RequestController::class, 'create'])->name('doctor.request.form');
    Route::post('/register-doctor', [RequestController::class, 'store'])->name('doctor.request.submit');
});

// Patient booking routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [\App\Http\Controllers\Patient\BookingController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/patient/available-schedules', [\App\Http\Controllers\Patient\BookingController::class, 'availableSchedules'])->name('patient.available-schedules');
    Route::get('/patient/doctor/{doctorId}/schedules', [\App\Http\Controllers\Patient\BookingController::class, 'showDoctorSchedules'])->name('patient.doctor-schedules');
    Route::get('/patient/schedules/{schedule}/book', [\App\Http\Controllers\Patient\BookingController::class, 'show'])->name('patient.book-schedule-form');
    Route::post('/patient/schedules/{schedule}/book', [\App\Http\Controllers\Patient\BookingController::class, 'book'])->name('patient.book-schedule');
    Route::get('/patient/my-bookings', [\App\Http\Controllers\Patient\BookingController::class, 'myBookings'])->name('patient.my-bookings');
    Route::post('/patient/bookings/{booking}/cancel', [\App\Http\Controllers\Patient\BookingController::class, 'cancel'])->name('patient.cancel-booking');

    // Patient Prescription Routes
    Route::get('/patient/prescriptions', [\App\Http\Controllers\Patient\PrescriptionController::class, 'index'])->name('patient.prescription.index');
    Route::get('/patient/prescriptions/{prescription}', [\App\Http\Controllers\Patient\PrescriptionController::class, 'show'])->name('patient.prescription.show');
    Route::get('/patient/prescriptions/{prescription}/download', [\App\Http\Controllers\Patient\PrescriptionController::class, 'download'])->name('patient.prescription.download');
});
// Admin route
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/stats-by-date', [DashboardController::class, 'getStatisticsByDate'])->name('admin.dashboard.stats-by-date');
    Route::post('/admin/approve-doctor/{id}', [DashboardController::class, 'approveDoctor'])->name('admin.approveDoctor');
    Route::Delete('/admin/reject-doctor/{id}', [DashboardController::class, 'rejectDoctor'])->name('admin.rejectDoctor');
    Route::get('/admin/notifications', [DashboardController::class, 'notification'])->name('admin.notification');
    Route::get('/admin/notifications/count', [DashboardController::class, 'getNotificationCount'])->name('admin.notification.count');

    // User Management
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Appointment Management
    Route::get('/admin/appointments', [AppointmentController::class, 'index'])->name('admin.appointments.index');
    Route::get('/admin/appointments/{appointment}', [AppointmentController::class, 'show'])->name('admin.appointments.show');
    Route::get('/admin/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('admin.appointments.edit');
    Route::patch('/admin/appointments/{appointment}', [AppointmentController::class, 'update'])->name('admin.appointments.update');
    Route::delete('/admin/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('admin.appointments.destroy');

    // Specialization Management
    Route::get('/admin/specializations', [SpecializationController::class, 'index'])->name('admin.specializations.index');
    Route::get('/admin/specializations/{specialization}', [SpecializationController::class, 'show'])->name('admin.specializations.show');
    Route::get('/admin/doctors/{doctor}/edit', [SpecializationController::class, 'edit'])->name('admin.doctors.edit');
    Route::patch('/admin/doctors/{doctor}', [SpecializationController::class, 'update'])->name('admin.doctors.update');
    Route::delete('/admin/doctors/{doctor}', [SpecializationController::class, 'destroy'])->name('admin.doctors.destroy');
});

// Guest routes - Symptom Predictor
Route::get('/predict', function () {
    return view('guest.form');
});

Route::post('/predict', [PredictionController::class, 'predict']);

// Doctor search routes
Route::get('/doctors/search', [\App\Http\Controllers\Patient\DoctorController::class, 'search'])->name('doctors.search');
Route::get('/doctors', [\App\Http\Controllers\Patient\DoctorController::class, 'index'])->name('doctors.index');

// Doctor autocomplete routes
Route::get('/autocomplete/doctor-names', [\App\Http\Controllers\Patient\DoctorController::class, 'suggestDoctorNames'])->name('autocomplete.doctor-names');
Route::get('/autocomplete/locations', [\App\Http\Controllers\Patient\DoctorController::class, 'suggestLocations'])->name('autocomplete.locations');
Route::get('/autocomplete/specializations', [\App\Http\Controllers\Patient\DoctorController::class, 'suggestSpecializations'])->name('autocomplete.specializations');

Route::view('/test', 'doctor.request');

require __DIR__.'/auth.php';
