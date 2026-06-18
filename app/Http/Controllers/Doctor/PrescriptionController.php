<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\AppointmentBooking;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Show form to create/edit prescription for an appointment
     */
    public function create(AppointmentBooking $booking)
    {
        // Verify doctor owns this booking
        if ($booking->schedule->doctor->id !== auth()->user()->id) {
            abort(403);
        }

        // Only approved bookings can have prescriptions
        if ($booking->status !== 'approved') {
            abort(403, 'Only approved appointments can have prescriptions.');
        }

        $prescription = $booking->prescription ?? new Prescription;

        return view('doctor.prescription.create', [
            'booking' => $booking,
            'prescription' => $prescription,
        ]);
    }

    /**
     * Store or update prescription
     */
    public function store(Request $request, AppointmentBooking $booking)
    {
        // Verify doctor owns this booking
        if ($booking->schedule->doctor->id !== auth()->user()->id) {
            abort(403);
        }

        $request->validate([
            'medicines' => ['nullable', 'json'],
            'medicines.*.name' => ['required_with:medicines', 'string'],
            'medicines.*.dosage' => ['required_with:medicines', 'string'],
            'medicines.*.duration' => ['required_with:medicines', 'string'],
            'medicines.*.frequency' => ['required_with:medicines', 'string'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'instructions' => ['nullable', 'string', 'max:2000'],
            'action' => ['required', 'in:save,complete'],
        ]);

        // Parse medicines from request
        $medicines = [];
        if ($request->filled('medicines')) {
            $medicinesInput = json_decode($request->input('medicines'), true);
            if (is_array($medicinesInput)) {
                foreach ($medicinesInput as $medicine) {
                    if ($medicine['name'] ?? false) {
                        $medicines[] = [
                            'name' => $medicine['name'],
                            'dosage' => $medicine['dosage'] ?? '',
                            'duration' => $medicine['duration'] ?? '',
                            'frequency' => $medicine['frequency'] ?? '',
                            'notes' => $medicine['notes'] ?? '',
                        ];
                    }
                }
            }
        }

        // Create or update prescription
        $prescription = $booking->prescription ?? new Prescription;
        $prescription->fill([
            'appointment_booking_id' => $booking->id,
            'doctor_id' => auth()->id(),
            'patient_id' => $booking->patient_id,
            'medicines' => $medicines ?: null,
            'notes' => $request->input('notes'),
            'instructions' => $request->input('instructions'),
        ]);

        // Mark as completed if submitted with complete action
        if ($request->input('action') === 'complete') {
            $prescription->status = 'completed';
            $prescription->issued_at = now();
        } else {
            $prescription->status = 'draft';
        }

        $prescription->save();

        $message = $request->input('action') === 'complete'
            ? 'Prescription completed and will be available to the patient.'
            : 'Prescription saved as draft.';

        return redirect()->route('doctor.appointments')
            ->with('success', $message);
    }

    /**
     * View prescription (for doctor to review)
     */
    public function show(Prescription $prescription)
    {
        if ($prescription->doctor_id !== auth()->id() && $prescription->patient_id !== auth()->id()) {
            abort(403);
        }

        return view('doctor.prescription.show', [
            'prescription' => $prescription,
        ]);
    }

    /**
     * Download prescription as PDF
     */
    public function download(Prescription $prescription)
    {
        if ($prescription->patient_id !== auth()->id() && $prescription->doctor_id !== auth()->id()) {
            abort(403);
        }

        // Generate PDF content
        $html = view('doctor.prescription.pdf', ['prescription' => $prescription])->render();

        // Return as downloadable PDF
        return response()->streamDownload(function () use ($html) {
            echo $html;
        }, 'prescription-'.$prescription->id.'.html');
    }
}
