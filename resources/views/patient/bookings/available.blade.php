@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Available Appointment Schedules</h1>
            <a href="{{ route('patient.my-bookings') }}" class="text-blue-600 hover:text-blue-800 font-bold">
                My Bookings →
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ $message }}
            </div>
        @endif

        {{-- Filter Form --}}
        <div class="mb-6 bg-white dark:bg-gray-800 p-4 rounded shadow">
            <form method="GET" action="{{ route('patient.available-schedules') }}" class="flex gap-4">
                <input type="hidden" name="per_page" value="10">
                <select name="doctor"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700 dark:text-white">
                    <option value="">All Doctors</option>
                    @foreach (\App\Models\User::where('role', 'doctor')->where('status', 'approved')->get() as $doctor)
                        <option value="{{ $doctor->id }}" {{ request('doctor') == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Filter
                </button>
                @if (request('doctor'))
                    <a href="{{ route('patient.available-schedules') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        {{-- Schedules List --}}
        @if ($schedules->count() > 0)
            <div class="grid gap-6">
                @foreach ($schedules as $schedule)
                    <div class="bg-white dark:bg-gray-800 rounded shadow p-6 hover:shadow-lg transition">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                    Dr. {{ $schedule->doctor->name }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ $schedule->schedule_date->format('l, F d, Y') }} • {{ $schedule->start_time }} -
                                    {{ $schedule->end_time }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                    {{ $schedule->current_bookings }}/{{ $schedule->max_patients_per_day }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Slots Filled</p>
                            </div>
                        </div>

                        @if ($schedule->consultation_fee)
                            <div class="mb-4 inline-block bg-purple-100 dark:bg-purple-900 px-3 py-1 rounded-full">
                                <p class="text-sm font-bold text-purple-800 dark:text-purple-200">
                                    Fee: ${{ $schedule->consultation_fee }}
                                </p>
                            </div>
                        @endif

                        @if ($schedule->notes)
                            <div class="mb-4 bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Notes:</p>
                                <p class="text-gray-900 dark:text-white">{{ $schedule->notes }}</p>
                            </div>
                        @endif

                        @php
                            $userHasBooking = \App\Models\AppointmentBooking::where('schedule_id', $schedule->id)
                                ->where('patient_id', auth()->id())
                                ->exists();
                        @endphp

                        @if ($userHasBooking)
                            <div class="bg-yellow-100 dark:bg-yellow-900 p-3 rounded text-yellow-800 dark:text-yellow-200">
                                You already have a booking for this schedule.
                            </div>
                        @else
                            <form action="{{ route('patient.book-schedule', $schedule) }}" method="POST"
                                class="space-y-4">
                                @csrf
                                <textarea name="notes" placeholder="Add any notes for the doctor (optional)" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700 dark:text-white"></textarea>
                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Request Booking
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $schedules->links() }}
            </div>
        @else
            <div class="bg-gray-100 dark:bg-gray-800 p-8 rounded text-center">
                <p class="text-gray-600 dark:text-gray-400 text-lg">No available schedules at this time.</p>
            </div>
        @endif
    </div>
@endsection
