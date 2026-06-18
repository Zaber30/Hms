@extends('layouts.doctor')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-sm text-gray-500">Today's Appointments</div>
            <div class="text-2xl font-bold">{{ $todayCount ?? 0 }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-sm text-gray-500">Upcoming Slots</div>
            <div class="text-2xl font-bold">{{ optional($upcomingAppointments)->count() ?? 0 }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-sm text-gray-500">Max Per Day</div>
            <div class="text-2xl font-bold">10</div>
        </div>
    </div>

    <section class="bg-white rounded-lg shadow p-6">
        <h2 class="font-semibold mb-4">Upcoming Appointments</h2>
        @if (isset($upcomingAppointments) && $upcomingAppointments->count())
            <div class="space-y-3">
                @foreach ($upcomingAppointments as $appt)
                    <div class="flex justify-between items-center border rounded p-3">
                        <div>
                            <div class="font-medium">{{ $appt->appointment_date->format('Y-m-d') }}@if ($appt->appointment_time)
                                    {{ ' ' . $appt->appointment_time }}
                                @endif
                            </div>
                            <div class="text-sm text-gray-600">Patient: {{ $appt->patient?->name ?? 'N/A' }}</div>
                        </div>
                        <div class="text-sm text-gray-500">Status: {{ $appt->status }}</div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-gray-600">No upcoming appointments.</div>
        @endif
    </section>
@endsection
