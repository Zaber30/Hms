@extends('layouts.doctor')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-1">My Schedules</h1>
                <p class="text-gray-600 dark:text-gray-400">Manage your appointment availability</p>
            </div>
            <a href="{{ route('doctor.schedules.create') }}"
                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition">
                + Create Schedule
            </a>
        </div>

        @if ($message = Session::get('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ $message }}
            </div>
        @endif

        {{-- Date Filter Form --}}
        <div class="mb-6 bg-white dark:bg-gray-800 p-4 rounded shadow">
            <form method="GET" action="{{ route('doctor.schedules.index') }}" class="flex gap-4">
                <input type="date" name="date" value="{{ request('date') }}"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700 dark:text-white">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Filter
                </button>
                @if (request('date'))
                    <a href="{{ route('doctor.schedules.index') }}"
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
                                    {{ $schedule->schedule_date->format('l, F d, Y') }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                </p>
                            </div>
                            <span
                                class="px-3 py-1 rounded-full text-sm font-bold
                            @if ($schedule->status === 'available') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                            @elseif ($schedule->status === 'fully_booked')
                                bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                            @else
                                bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif
                        ">
                                {{ ucfirst(str_replace('_', ' ', $schedule->status)) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 text-sm">
                            <div class="bg-blue-50 dark:bg-blue-900 p-3 rounded">
                                <p class="text-gray-600 dark:text-gray-400">Slots Filled</p>
                                <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                    {{ $schedule->current_bookings }}/{{ $schedule->max_patients_per_day }}
                                </p>
                            </div>
                            <div class="bg-purple-50 dark:bg-purple-900 p-3 rounded">
                                <p class="text-gray-600 dark:text-gray-400">Consultation Fee</p>
                                <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                                    {{ $schedule->consultation_fee ? 'BDT' . $schedule->consultation_fee : 'N/A' }}
                                </p>
                            </div>
                            <div class="bg-yellow-50 dark:bg-yellow-900 p-3 rounded">
                                <p class="text-gray-600 dark:text-gray-400">Total Bookings</p>
                                <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                                    {{ $schedule->bookings()->count() }}
                                </p>
                            </div>
                            <div class="bg-indigo-50 dark:bg-indigo-900 p-3 rounded">
                                <p class="text-gray-600 dark:text-gray-400">Approved</p>
                                <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                                    {{ $schedule->approvedBookings()->count() }}
                                </p>
                            </div>
                        </div>

                        @if ($schedule->notes)
                            <div class="mb-4 bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Notes:</p>
                                <p class="text-gray-900 dark:text-white">{{ $schedule->notes }}</p>
                            </div>
                        @endif

                        <div class="flex gap-2">
                            <a href="{{ route('doctor.schedules.show', $schedule) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                View Bookings
                            </a>
                            <a href="{{ route('doctor.schedules.edit', $schedule) }}"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('doctor.schedules.destroy', $schedule) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-100 dark:bg-gray-800 p-8 rounded text-center">
                <p class="text-gray-600 dark:text-gray-400 text-lg">No schedules found. Create one to get started!
                </p>
            </div>
        @endif
    </div>
@endsection
