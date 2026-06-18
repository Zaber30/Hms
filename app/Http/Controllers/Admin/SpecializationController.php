<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class SpecializationController
{
    public function index()
    {
        $specializations = Doctor::distinct('specialist')
            ->pluck('specialist')
            ->sort()
            ->values();

        $doctorsBySpecialization = [];
        foreach ($specializations as $spec) {
            $doctorsBySpecialization[$spec] = Doctor::where('specialist', $spec)
                ->with('user')
                ->get();
        }

        return view('admin.specializations.index', compact('specializations', 'doctorsBySpecialization'));
    }

    public function show($specialization)
    {
        $doctors = Doctor::where('specialist', $specialization)
            ->with('user', 'schedules')
            ->paginate(15);

        return view('admin.specializations.show', compact('specialization', 'doctors'));
    }

    public function edit(Doctor $doctor)
    {
        $specializations = Doctor::distinct('specialist')->pluck('specialist')->sort();
        return view('admin.specializations.edit', compact('doctor', 'specializations'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'specialist' => 'required|string|max:255',
            'consultation_fee' => 'required|numeric|min:0',
            'bio' => 'nullable|string|max:1000',
            'phone' => 'required|string|max:20',
        ]);

        $doctor->update($validated);

        return redirect()->route('admin.specializations.show', $doctor->specialist)
            ->with('success', 'Doctor specialization updated successfully!');
    }

    public function destroy(Doctor $doctor)
    {
        $doctorName = $doctor->user->name ?? 'Unknown';
        $specialist = $doctor->specialist;

        $doctor->delete();

        return redirect()->route('admin.specializations.show', $specialist)
            ->with('success', "Doctor '{$doctorName}' deleted successfully!");
    }
}
