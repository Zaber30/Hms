@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Appointment</h1>
        <p class="text-gray-600 mt-2">Update appointment status and notes</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Patient Info (Read-only) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Patient</label>
                <div class="px-4 py-2 bg-gray-100 rounded-lg text-gray-900">
                    {{ $appointment->patient->name ?? 'N/A' }}
                </div>
            </div>

            <!-- Doctor Info (Read-only) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Doctor</label>
                <div class="px-4 py-2 bg-gray-100 rounded-lg text-gray-900">
                    {{ $appointment->schedule->doctor->name ?? 'N/A' }}
                </div>
            </div>

            <!-- Schedule Info (Read-only) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Appointment Date & Time</label>
                <div class="px-4 py-2 bg-gray-100 rounded-lg text-gray-900">
                    {{ $appointment->schedule->schedule_date->format('F d, Y') ?? 'N/A' }}
                    {{ $appointment->schedule->start_time ?? '' }} - {{ $appointment->schedule->end_time ?? '' }}
                </div>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select
                    name="status"
                    id="status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror"
                    required
                >
                    <option value="">-- Select Status --</option>
                    @foreach($statuses as $s)
                    <option value="{{ $s }}" {{ old('status', $appointment->status) === $s ? 'selected' : '' }}>
                        {{ ucfirst($s) }}
                    </option>
                    @endforeach
                </select>
                @error('status')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Patient Notes -->
            <div>
                <label for="patient_notes" class="block text-sm font-medium text-gray-700 mb-2">Patient Notes</label>
                <textarea
                    name="patient_notes"
                    id="patient_notes"
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('patient_notes') border-red-500 @enderror"
                    placeholder="Any additional notes for this appointment..."
                >{{ old('patient_notes', $appointment->patient_notes) }}</textarea>
                @error('patient_notes')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                    Save Changes
                </button>
                <a href="{{ route('admin.appointments.index') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
