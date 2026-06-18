@extends('layouts.doctor')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="mb-8">
            <a href="{{ route('doctor.schedules.index') }}"
                class="text-blue-600 hover:text-blue-800 font-semibold mb-4 inline-block">← Back to Schedules</a>
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Edit Schedule</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Update your appointment availability</p>
        </div>
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
            <form action="{{ route('doctor.schedules.update', $schedule) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="schedule_date" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Schedule Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="schedule_date" id="schedule_date" required
                            value="{{ $schedule->schedule_date->format('Y-m-d') }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20"
                            min="{{ now()->toDateString() }}">
                        @error('schedule_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div></div>

                    <div>
                        <label for="start_time" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Start Time <span class="text-red-500">*</span>
                        </label>
                        <input type="time" name="start_time" id="start_time" required value="{{ $schedule->start_time }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20">
                        @error('start_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_time" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            End Time <span class="text-red-500">*</span>
                        </label>
                        <input type="time" name="end_time" id="end_time" required value="{{ $schedule->end_time }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20">
                        @error('end_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="max_patients_per_day"
                            class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Max Patients Per Day <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="max_patients_per_day" id="max_patients_per_day" required
                            value="{{ $schedule->max_patients_per_day }}" min="1" max="20"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Between 1-20 patients</p>
                        @error('max_patients_per_day')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="consultation_fee" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Consultation Fee (Optional)
                        </label>
                        <input type="number" name="consultation_fee" id="consultation_fee"
                            value="{{ $schedule->consultation_fee }}" min="0" step="0.01"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20">
                        @error('consultation_fee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        Notes (Optional)
                    </label>
                    <textarea name="notes" id="notes" rows="4"
                        placeholder="Add any special instructions or details about this schedule..."
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20">{{ $schedule->notes }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 rounded-lg shadow-md transition">
                        Update Schedule
                    </button>
                    <a href="{{ route('doctor.schedules.index') }}"
                        class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition text-center">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
@endsection
