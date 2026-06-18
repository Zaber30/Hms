@extends('layouts.doctor')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">
                    {{ $schedule->schedule_date->format('l, F d, Y') }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
            </div>
            <a href="{{ route('doctor.schedules.index') }}" class="text-blue-600 hover:text-blue-800 font-bold text-lg">
                ← Back
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

                {{-- Schedule Details --}}
                <div class="bg-white dark:bg-gray-800 rounded shadow p-6 mb-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded">
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Time</p>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $schedule->start_time }} -
                                {{ $schedule->end_time }}</p>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900 p-4 rounded">
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Slots Filled</p>
                            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                                {{ $schedule->current_bookings }}/{{ $schedule->max_patients_per_day }}</p>
                        </div>
                        <div class="bg-yellow-50 dark:bg-yellow-900 p-4 rounded">
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Status</p>
                            <p
                                class="text-lg font-bold {{ $schedule->status === 'available' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ ucfirst(str_replace('_', ' ', $schedule->status)) }}
                            </p>
                        </div>
                        <div class="bg-indigo-50 dark:bg-indigo-900 p-4 rounded">
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Fee</p>
                            <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                                {{ $schedule->consultation_fee ? 'BDT' . $schedule->consultation_fee : 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Booking Requests --}}
                <div class="bg-white dark:bg-gray-800 rounded shadow p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        Booking Requests ({{ $bookings->count() }})
                    </h2>

                    @if ($bookings->count() > 0)
                        <div class="space-y-4">
                            @foreach ($bookings as $booking)
                                <div
                                    class="border border-gray-300 dark:border-gray-600 rounded p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                {{ $booking->patient->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $booking->patient->email }}
                                            </p>
                                        </div>
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-bold
                                @if ($booking->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                @elseif ($booking->status === 'approved')
                                    bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @elseif ($booking->status === 'rejected')
                                    bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                @elseif ($booking->status === 'completed')
                                    bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                @else
                                    bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif
                            ">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>

                                    @if ($booking->patient_notes)
                                        <div class="mb-3 bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                            <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Patient Notes:
                                            </p>
                                            <p class="text-gray-900 dark:text-white">{{ $booking->patient_notes }}</p>
                                        </div>
                                    @endif

                                    @if ($booking->doctor_notes)
                                        <div class="mb-3 bg-blue-50 dark:bg-blue-900 p-3 rounded">
                                            <p class="text-sm text-blue-600 dark:text-blue-400 font-semibold">Your Notes:
                                            </p>
                                            <p class="text-gray-900 dark:text-white">{{ $booking->doctor_notes }}</p>
                                        </div>
                                    @endif

                                    <div class="text-xs text-gray-600 dark:text-gray-400 mb-3">
                                        Requested: {{ $booking->created_at->format('M d, Y H:i') }}
                                        @if ($booking->approved_at)
                                            | Approved: {{ $booking->approved_at->format('M d, Y H:i') }}
                                        @endif
                                        @if ($booking->rejected_at)
                                            | Rejected: {{ $booking->rejected_at->format('M d, Y H:i') }}
                                        @endif
                                    </div>

                                    @if ($booking->status === 'pending')
                                        <div class="flex gap-2">
                                            <form action="{{ route('doctor.bookings.approve', $booking) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('doctor.bookings.reject', $booking) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 dark:text-gray-400 text-center py-8">No booking requests yet.</p>
                    @endif
                </div>
        </div>
    @endsection
