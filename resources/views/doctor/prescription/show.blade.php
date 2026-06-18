<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-950 dark:to-slate-900 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('doctor.appointments') }}"
                    class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Appointments
                </a>
            </div>

            <!-- Action Buttons -->
            <div class="mb-6 flex justify-end gap-3">
                <a href="{{ route('doctor.prescription.download', $prescription) }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                        </path>
                    </svg>
                    Download
                </a>
                <a href="{{ route('doctor.prescription.create', $prescription->appointmentBooking) }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit
                </a>
            </div>

            <!-- Prescription Content -->
            <div
                class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 text-white">
                    <h1 class="text-3xl font-bold mb-2">Prescription #{{ $prescription->id }}</h1>
                    <p class="text-blue-100">
                        Status:
                        @if ($prescription->status === 'completed')
                            <span class="bg-green-500 px-3 py-1 rounded-full text-sm font-bold">Completed</span>
                        @else
                            <span class="bg-yellow-500 px-3 py-1 rounded-full text-sm font-bold">Draft</span>
                        @endif
                    </p>
                </div>

                <!-- Patient & Doctor Info -->
                <div class="p-8 border-b border-slate-200 dark:border-slate-700">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Patient Info -->
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3">Patient Information</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Name</p>
                            <p class="font-semibold text-slate-900 dark:text-white mb-3">
                                {{ $prescription->patient->name }}</p>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Email</p>
                            <p class="text-slate-900 dark:text-white">{{ $prescription->patient->email }}</p>
                        </div>

                        <!-- Appointment Info -->
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3">Appointment Details</h3>
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
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Prescribed Medicines</h3>
                        <div class="space-y-4">
                            @foreach ($prescription->medicines as $medicine)
                                <div
                                    class="bg-blue-50 dark:bg-slate-700/50 p-4 rounded-lg border border-blue-200 dark:border-slate-600">
                                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-3">
                                        {{ $medicine['name'] }}
                                    </h4>
                                    <div class="grid grid-cols-2 gap-4">
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
                                                    Notes</p>
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
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Doctor's Notes</h3>
                        <p class="text-slate-700 dark:text-slate-300 whitespace-pre-wrap">{{ $prescription->notes }}
                        </p>
                    </div>
                @endif

                <!-- Instructions -->
                @if ($prescription->instructions)
                    <div class="p-8 bg-green-50 dark:bg-slate-700/50">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Patient Instructions</h3>
                        <p class="text-slate-700 dark:text-slate-300 whitespace-pre-wrap">
                            {{ $prescription->instructions }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
