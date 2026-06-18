<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <div class="mb-6">
            <a href="{{ route('patient.dashboard') }}"
                class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <h1 class="text-4xl font-bold mb-8 text-gray-900">Confirm Your Appointment</h1>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
            <!-- Doctor Info Card -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-white">
                <div class="flex items-start gap-6">
                    <!-- Doctor Avatar -->
                    <div class="relative inline-block flex-shrink-0">
                        @if ($schedule->doctorUser && $schedule->doctorUser->doctor && $schedule->doctorUser->doctor->profile_image)
                            <img src="{{ asset('storage/' . $schedule->doctorUser->doctor->profile_image) }}"
                                alt="{{ $schedule->doctorUser->name }}"
                                class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                        @else
                            <div
                                class="w-32 h-32 rounded-full bg-white/20 flex items-center justify-center border-4 border-white shadow-lg">
                                <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Doctor Details -->
                    <div class="flex-1">
                        <h2 class="text-3xl font-bold mb-2">Dr. {{ $schedule->doctorUser->name ?? 'Unknown' }}</h2>
                        @if ($schedule->doctorUser->doctor)
                            <p class="text-xl text-blue-100 mb-4 font-semibold">
                                {{ $schedule->doctorUser->doctor->specialist ?? ($schedule->doctorUser->doctor->qualification ?? 'Medical Professional') }}
                            </p>
                            @if ($schedule->doctorUser->doctor->experience_years)
                                <p class="text-blue-100">Experience: <span
                                        class="font-semibold">{{ $schedule->doctorUser->doctor->experience_years }}
                                        years</span></p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Appointment Details -->
            <div class="p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Appointment Details</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Date & Time -->
                    <div class="bg-blue-50 rounded-lg p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h12a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm font-semibold text-gray-700">Date & Time</p>
                        </div>
                        <p class="text-2xl font-bold text-gray-900 mb-1">
                            {{ $schedule->schedule_date->format('M d, Y') }}</p>
                        <p class="text-lg text-gray-700">{{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
                    </div>

                    <!-- Fee -->
                    <div class="bg-green-50 rounded-lg p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M8.16 5.314l4.897-1.596A1 1 0 0114.25 4.75v.006h2a1 1 0 01.82 1.573l-7.822 10.128a.75.75 0 01-.712.315H6a1 1 0 01-1-1V8.316l3.16-3.002zm5.324 9.12l-2.445 3.178H14.5a1 1 0 001-1v-.006h-2a1 1 0 01-.82-1.573l7.822-10.128a.75.75 0 01.712-.315h1.584a1 1 0 011 1v5.686l-3.16 3.002z" />
                            </svg>
                            <p class="text-sm font-semibold text-gray-700">Consultation Fee</p>
                        </div>
                        <p class="text-3xl font-bold text-green-600">৳{{ $schedule->consultation_fee }}</p>
                    </div>
                </div>

                <!-- Clinic Address -->
                @if ($schedule->doctorUser->doctor && $schedule->doctorUser->doctor->clinic_address)
                    <div class="bg-gray-50 rounded-lg p-6 mb-8">
                        <div class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-gray-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-gray-700 mb-1">Clinic Address</p>
                                <p class="text-gray-900">{{ $schedule->doctorUser->doctor->clinic_address }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Booking Form -->
                <form action="{{ route('patient.book-schedule', $schedule) }}" method="post" class="border-t pt-8">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Notes for Doctor
                            (Optional)</label>
                        <textarea name="patient_notes"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-vertical"
                            rows="4" placeholder="Any specific symptoms or concerns you'd like to discuss?">{{ old('patient_notes') }}</textarea>
                        @error('patient_notes')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4">
                        <button type="submit"
                            class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition shadow-md hover:shadow-lg">
                            Confirm Booking
                        </button>
                        <a href="{{ route('patient.dashboard') }}"
                            class="flex-1 px-6 py-3 border border-gray-300 hover:bg-gray-50 text-gray-800 font-semibold rounded-lg transition text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
