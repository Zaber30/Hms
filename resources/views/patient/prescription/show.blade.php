<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-950 dark:to-slate-900 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('patient.prescription.index') }}"
                    class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Prescriptions
                </a>
            </div>

            <!-- Download Button -->
            <div class="mb-6 flex justify-end">
                <a href="{{ route('patient.prescription.download', $prescription) }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition transform hover:scale-105 active:scale-95">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                        </path>
                    </svg>
                    Download as PDF
                </a>
            </div>

            <!-- Prescription Content -->
            <div
                class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 text-white">
                    <h1 class="text-3xl font-bold mb-2">Prescription #{{ $prescription->id }}</h1>
                    @if ($prescription->issued_at)
                        <p class="text-blue-100">Issued on {{ $prescription->issued_at->format('F d, Y') }}</p>
                    @else
                        <p class="text-blue-100">Status: Draft</p>
                    @endif
                </div>

                <!-- Patient & Doctor Info -->
                <div class="p-8 border-b border-slate-200 dark:border-slate-700">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Patient Info -->
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Patient Information
                            </h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Name</p>
                            <p class="font-semibold text-slate-900 dark:text-white mb-3">
                                {{ $prescription->patient->name }}</p>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Email</p>
                            <p class="text-slate-900 dark:text-white">{{ $prescription->patient->email }}</p>
                        </div>

                        <!-- Doctor Info -->
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 10h-2m0 0H10m2 0h2m-2-2v2m0 0v2m0-5v2m-4 0h4"></path>
                                </svg>
                                Doctor Information
                            </h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Name</p>
                            <p class="font-semibold text-slate-900 dark:text-white mb-3">Dr.
                                {{ $prescription->doctor->name }}</p>
                            @if ($prescription->doctor->doctor)
                                <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Specialization</p>
                                <p class="text-slate-900 dark:text-white">
                                    {{ $prescription->doctor->doctor->specialist ?? ($prescription->doctor->doctor->qualification ?? 'Specialist') }}
                                </p>
                            @endif
                        </div>

                        <!-- Appointment Info -->
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Appointment Details
                            </h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Date</p>
                            <p class="font-semibold text-slate-900 dark:text-white mb-3">
                                {{ $prescription->appointmentBooking->schedule->schedule_date->format('F d, Y') }}
                            </p>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Time</p>
                            <p class="text-slate-900 dark:text-white">
                                {{ $prescription->appointmentBooking->schedule->start_time }} -
                                {{ $prescription->appointmentBooking->schedule->end_time }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Medicines Section -->
                @if ($prescription->medicines && count($prescription->medicines) > 0)
                    <div class="p-8 border-b border-slate-200 dark:border-slate-700">
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Prescribed Medicines
                        </h3>
                        <div class="space-y-4">
                            @foreach ($prescription->medicines as $medicine)
                                <div
                                    class="bg-blue-50 dark:bg-slate-700/50 p-4 rounded-lg border border-blue-200 dark:border-slate-600">
                                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-3">
                                        {{ $medicine['name'] }}
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-slate-600 dark:text-slate-400 font-semibold">Dosage
                                            </p>
                                            <p class="text-slate-900 dark:text-white">{{ $medicine['dosage'] }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-slate-600 dark:text-slate-400 font-semibold">
                                                Frequency</p>
                                            <p class="text-slate-900 dark:text-white">{{ $medicine['frequency'] }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-slate-600 dark:text-slate-400 font-semibold">Duration
                                            </p>
                                            <p class="text-slate-900 dark:text-white">{{ $medicine['duration'] }}</p>
                                        </div>
                                        @if ($medicine['notes'])
                                            <div>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 font-semibold">
                                                    Additional Notes</p>
                                                <p class="text-slate-900 dark:text-white">{{ $medicine['notes'] }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Doctor Notes -->
                @if ($prescription->notes)
                    <div class="p-8 border-b border-slate-200 dark:border-slate-700 bg-yellow-50 dark:bg-slate-700/50">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                            <svg class="h-5 w-5 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Doctor's Notes
                        </h3>
                        <p class="text-slate-700 dark:text-slate-300 whitespace-pre-wrap">{{ $prescription->notes }}
                        </p>
                    </div>
                @endif

                <!-- Instructions -->
                @if ($prescription->instructions)
                    <div class="p-8 bg-green-50 dark:bg-slate-700/50">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Instructions for Patient
                        </h3>
                        <p class="text-slate-700 dark:text-slate-300 whitespace-pre-wrap">
                            {{ $prescription->instructions }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
