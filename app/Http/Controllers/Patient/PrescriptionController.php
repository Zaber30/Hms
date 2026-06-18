<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * List all prescriptions for the patient
     */
    public function index(Request $request)
    {
        $prescriptions = Prescription::with(['doctor', 'appointmentBooking.schedule'])
            ->where('patient_id', $request->user()->id)
            ->where('status', 'completed')
            ->latest('issued_at')
            ->paginate(10);

        return view('patient.prescription.index', [
            'prescriptions' => $prescriptions,
        ]);
    }

    /**
     * View a specific prescription
     */
    public function show(Prescription $prescription)
    {
        if ($prescription->patient_id !== auth()->id()) {
            abort(403);
        }

        return view('patient.prescription.show', [
            'prescription' => $prescription,
        ]);
    }

    /**
     * Download prescription as PDF
     */
    public function download(Prescription $prescription)
    {
        if ($prescription->patient_id !== auth()->id()) {
            abort(403);
        }

        // Generate PDF content
        $html = view('patient.prescription.pdf', ['prescription' => $prescription])->render();

        // Return as downloadable HTML
        return response()->streamDownload(function () use ($html) {
            echo $html;
        }, 'prescription-'.$prescription->id.'-'.now()->format('Y-m-d').'.html');
    }
}
