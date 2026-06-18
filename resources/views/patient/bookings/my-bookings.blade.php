@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">My Bookings</h1>
            <a href="{{ route('patient.available-schedules') }}" class="text-blue-600 hover:text-blue-800 font-bold">
                ← Browse Schedules
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

        @if ($bookings->count() > 0)
            <div class="space-y-4">
                @foreach ($bookings as $booking)
                    <div class="bg-white dark:bg-gray-800 rounded shadow p-6 hover:shadow-lg transition">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                    Dr. {{ $booking->schedule->doctor->name }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ $booking->schedule->schedule_date->format('l, F d, Y') }} •
                                    {{ $booking->schedule->start_time }} - {{ $booking->schedule->end_time }}
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

                        @if ($booking->schedule->consultation_fee)
                            <div class="mb-3 inline-block bg-purple-100 dark:bg-purple-900 px-3 py-1 rounded-full">
                                <p class="text-sm font-bold text-purple-800 dark:text-purple-200">
                                    Fee: ${{ $booking->schedule->consultation_fee }}
                                </p>
                            </div>
                        @endif

                        @if ($booking->patient_notes)
                            <div class="mb-3 bg-blue-50 dark:bg-blue-900 p-3 rounded">
                                <p class="text-sm text-blue-600 dark:text-blue-400 font-semibold">Your Notes:</p>
                                <p class="text-gray-900 dark:text-white">{{ $booking->patient_notes }}</p>
                            </div>
                        @endif

                        @if ($booking->doctor_notes)
                            <div class="mb-3 bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold">Doctor's Notes:</p>
                                <p class="text-gray-900 dark:text-white">{{ $booking->doctor_notes }}</p>
                            </div>
                        @endif

                        <div class="text-xs text-gray-600 dark:text-gray-400 mb-4">
                            Requested: {{ $booking->created_at->format('M d, Y H:i') }}
                            @if ($booking->approved_at)
                                | Approved: {{ $booking->approved_at->format('M d, Y H:i') }}
                            @endif
                            @if ($booking->rejected_at)
                                | Rejected: {{ $booking->rejected_at->format('M d, Y H:i') }}
                            @endif
                            @if ($booking->completed_at)
                                | Completed: {{ $booking->completed_at->format('M d, Y H:i') }}
                            @endif
                        </div>

                        @if ($booking->status === 'pending' || $booking->status === 'approved')
                            <form action="{{ route('patient.cancel-booking', $booking) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                @csrf
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Cancel Booking
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $bookings->links() }}
            </div>
        @else
            <div class="bg-gray-100 dark:bg-gray-800 p-8 rounded text-center">
                <p class="text-gray-600 dark:text-gray-400 text-lg">You don't have any bookings yet.</p>
                <a href="{{ route('patient.available-schedules') }}"
                    class="mt-4 inline-block text-blue-600 hover:text-blue-800 font-bold">
                    Browse available schedules →
                </a>
            </div>
        @endif
    </div>
@endsection
