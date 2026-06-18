<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-950 dark:to-slate-900 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Search
                </a>
            </div>

            <!-- Doctor Profile Section -->
            <div
                class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden border border-slate-200 dark:border-slate-700 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-8">
                    <!-- Doctor Image -->
                    <div class="flex justify-center md:col-span-1">
                        <div class="relative inline-block">
                            @if ($doctor->profile_image)
                                <img src="{{ asset('storage/' . $doctor->profile_image) }}"
                                    alt="{{ $doctor->user->name }}"
                                    class="w-40 h-40 rounded-full object-cover border-4 border-blue-600 shadow-lg">
                            @else
                                <div
                                    class="w-40 h-40 rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center border-4 border-blue-600 shadow-lg">
                                    <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                            <div
                                class="absolute bottom-2 right-2 bg-green-500 w-4 h-4 rounded-full border-2 border-white shadow-md">
                            </div>
                        </div>
                    </div>

                    <!-- Doctor Info -->
                    <div class="md:col-span-2">
                        <div class="mb-6">
                            <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-2">
                                Dr. {{ $doctor->user->name }}
                            </h1>
                            <p class="text-xl text-blue-600 dark:text-blue-400 font-semibold mb-4">
                                {{ $doctor->specialist ?? ($doctor->qualification ?? 'Specialist') }}
                            </p>
                        </div>

                        <!-- Doctor Details -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 10a6 6 0 00-12 0v1h12v-1z" />
                                </svg>
                                <div>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">Experience</p>
                                    <p class="font-semibold text-slate-900 dark:text-white">
                                        {{ $doctor->experience_years ?? 10 }} years
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                <div>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">Consultation Fee</p>
                                    <p class="font-semibold text-slate-900 dark:text-white">
                                        BDT {{ $doctor->consultation_fee ?? 50 }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Location & Phone -->
                        <div class="space-y-2">
                            <div class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-slate-600 dark:text-slate-400 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Clinic Address</p>
                                    <p class="text-slate-900 dark:text-white font-medium">
                                        {{ $doctor->clinic_address ?? 'Not specified' }}
                                    </p>
                                </div>
                            </div>
                            @if ($doctor->user->phone)
                                <div class="flex items-start gap-3">
                                    <svg class="h-5 w-5 text-slate-600 dark:text-slate-400 mt-0.5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 00.948.684l1.498 4.493a1 1 0 00.502.609l2.01 1.042a1 1 0 001.082-1.629l-1.264-.316a1 1 0 00-.878.134l-2.114-1.101A2 2 0 0010.28 4H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2h-2.5" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-slate-600 dark:text-slate-400">Phone</p>
                                        <p class="text-slate-900 dark:text-white font-medium">{{ $doctor->user->phone }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Bio Section -->
                @if ($doctor->bio)
                    <div class="border-t border-slate-200 dark:border-slate-700 p-8 bg-slate-50 dark:bg-slate-700/50">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-3">About</h3>
                        <p class="text-slate-700 dark:text-slate-300 leading-relaxed">{{ $doctor->bio }}</p>
                    </div>
                @endif
            </div>

            <!-- Available Schedules Section -->
            <div>
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Available Dates & Times
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 mt-2">
                        Select a date and time that works best for you
                    </p>
                </div>

                @if ($schedules->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($schedules as $schedule)
                            <div
                                class="bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 rounded-xl p-6 hover:border-blue-500 dark:hover:border-blue-500 transition group cursor-pointer hover:shadow-lg">
                                <!-- Date -->
                                <div class="flex items-center gap-3 mb-4">
                                    <div
                                        class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-lg group-hover:bg-blue-200 dark:group-hover:bg-blue-900/50 transition">
                                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">Date</p>
                                        <p class="text-lg font-bold text-slate-900 dark:text-white">
                                            {{ $schedule->schedule_date->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Time -->
                                <div class="flex items-center gap-3 mb-4">
                                    <div
                                        class="bg-purple-100 dark:bg-purple-900/30 p-3 rounded-lg group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition">
                                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">Time</p>
                                        <p class="text-lg font-bold text-slate-900 dark:text-white">
                                            {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Availability Info -->
                                <div class="mb-4 flex items-center gap-2">
                                    @php
                                        $availableSlots = $schedule->max_patients_per_day - $schedule->current_bookings;
                                    @endphp
                                    @if ($availableSlots > 0)
                                        <span
                                            class="inline-flex items-center gap-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-3 py-1 rounded-full text-xs font-bold">
                                            <span class="w-2 h-2 bg-green-600 dark:bg-green-400 rounded-full"></span>
                                            {{ $availableSlots }} {{ $availableSlots === 1 ? 'slot' : 'slots' }}
                                            available
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 px-3 py-1 rounded-full text-xs font-bold">
                                            <span class="w-2 h-2 bg-red-600 dark:bg-red-400 rounded-full"></span>
                                            Fully Booked
                                        </span>
                                    @endif
                                </div>

                                <!-- Fee -->
                                <div
                                    class="flex items-center justify-between py-3 border-t border-slate-200 dark:border-slate-700 mb-4">
                                    <span class="text-slate-600 dark:text-slate-400 font-medium">Consultation
                                        Fee</span>
                                    <span class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                        BDT{{ $schedule->consultation_fee ?? ($doctor->consultation_fee ?? 50) }}
                                    </span>
                                </div>

                                <!-- Book Button -->
                                @if ($availableSlots > 0)
                                    <a href="{{ route('patient.book-schedule-form', $schedule) }}"
                                        class="w-full block text-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 rounded-lg transition transform hover:scale-105 active:scale-95 shadow-lg">
                                        Book Appointment
                                    </a>
                                @else
                                    <button disabled
                                        class="w-full bg-slate-300 dark:bg-slate-600 text-slate-600 dark:text-slate-400 font-bold py-3 rounded-lg cursor-not-allowed opacity-50">
                                        No Slots Available
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 rounded-xl p-12 text-center">
                        <svg class="h-16 w-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">No Available Slots</h3>
                        <p class="text-slate-600 dark:text-slate-400">
                            Unfortunately, this doctor has no available appointments at the moment. Please try again
                            later
                            or choose another doctor.
                        </p>
                        <a href="{{ route('dashboard') }}"
                            class="inline-block mt-6 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition">
                            Back to Doctor Search
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
