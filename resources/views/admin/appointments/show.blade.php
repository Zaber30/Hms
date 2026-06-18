@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8 flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Appointment Details</h1>
            <p class="text-gray-600 mt-2">View complete appointment information</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.appointments.edit', $appointment) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                Edit
            </a>
            <a href="{{ route('admin.appointments.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium">
                Back
            </a>
        </div>
    </div>

    <!-- Appointment Information -->
    <div class="bg-white rounded-lg shadow p-8 space-y-6">
        <!-- Status Badge -->
        <div>
            <p class="text-sm text-gray-600 mb-2">Status</p>
            <span class="px-4 py-2 rounded-lg text-sm font-semibold
                {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $appointment->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                {{ $appointment->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                {{ $appointment->status === 'cancelled' ? 'bg-gray-100 text-gray-800' : '' }}
            ">
                {{ ucfirst($appointment->status) }}
            </span>
        </div>

        <hr>

        <!-- Patient Information -->
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Patient Information</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600">Name</p>
                    <p class="text-lg font-medium text-gray-900">{{ $appointment->patient->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="text-lg font-medium text-gray-900">{{ $appointment->patient->email ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <hr>

        <!-- Doctor Information -->
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Doctor Information</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600">Name</p>
                    <p class="text-lg font-medium text-gray-900">{{ $appointment->schedule->doctor->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Specialization</p>
                    <p class="text-lg font-medium text-gray-900">
                        {{ $appointment->schedule->doctor->doctor?->specialist ?? 'N/A' }}
                    </p>
                </div>
            </div>
        </div>

        <hr>

        <!-- Appointment Schedule -->
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Appointment Schedule</h2>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600">Date</p>
                    <p class="text-lg font-medium text-gray-900">{{ $appointment->schedule->schedule_date->format('F d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Time</p>
                    <p class="text-lg font-medium text-gray-900">{{ $appointment->schedule->start_time }} - {{ $appointment->schedule->end_time }}</p>
                </div>
            </div>
        </div>

        <hr>

        <!-- Patient Notes -->
        @if($appointment->patient_notes)
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Patient Notes</h2>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-900">{{ $appointment->patient_notes }}</p>
            </div>
        </div>

        <hr>
        @endif

        <!-- Metadata -->
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Metadata</h2>
            <div class="grid grid-cols-2 gap-6 text-sm">
                <div>
                    <p class="text-gray-600">Booked On</p>
                    <p class="text-gray-900 font-medium">{{ $appointment->created_at->format('F d, Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Last Updated</p>
                    <p class="text-gray-900 font-medium">{{ $appointment->updated_at->format('F d, Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Section -->
    <div class="mt-8 bg-red-50 rounded-lg shadow p-8 border border-red-200">
        <h2 class="text-xl font-semibold text-red-900 mb-2">Danger Zone</h2>
        <p class="text-red-700 mb-4">Permanently delete this appointment record.</p>
        <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('This action cannot be undone. Are you sure?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">
                Delete Appointment
            </button>
        </form>
    </div>
</div>
@endsection
