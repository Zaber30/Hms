@extends('layouts.doctor')

@section('content')
    <main class="max-w-5xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-4">Appointments</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <form method="get" class="mb-6 flex gap-2 items-center">
            <input type="date" name="date" value="{{ $date ?? '' }}" class="border rounded p-2" />
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
            <a href="{{ route('doctor.appointments') }}" class="ml-2 text-sm text-gray-600">Show all</a>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="font-semibold mb-2">Create Appointment</h2>
                <form method="post" action="{{ route('doctor.appointments.store') }}" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-sm">Date</label>
                        <input type="date" name="appointment_date" required class="border rounded p-2 w-full" />
                    </div>
                    <div>
                        <label class="block text-sm">Time</label>
                        <input type="time" name="appointment_time" class="border rounded p-2 w-full" />
                    </div>
                    <div>
                        <label class="block text-sm">Patient (optional: user id)</label>
                        <input type="number" name="patient_id" class="border rounded p-2 w-full" />
                    </div>
                    <div>
                        <label class="block text-sm">Notes</label>
                        <textarea name="notes" class="border rounded p-2 w-full"></textarea>
                    </div>
                    <button class="bg-green-600 text-white px-4 py-2 rounded">Create</button>
                </form>
            </div>

            <div>
                <h2 class="font-semibold mb-2">Appointments List</h2>
                <div class="space-y-3">
                    @forelse($appointments as $appt)
                        <div class="bg-white rounded p-3 shadow">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="font-medium">{{ $appt->appointment_date->format('Y-m-d') }}
                                        {{ $appt->appointment_time ?? '' }}</div>
                                    <div class="text-sm text-gray-600">Patient: {{ $appt->patient?->name ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500">Status: {{ $appt->status }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-600">No appointments found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
@endsection
