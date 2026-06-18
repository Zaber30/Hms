<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-950 dark:to-slate-900 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('patient.my-bookings') }}"
                    class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to My Bookings
                </a>
            </div>

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-2">My Prescriptions</h1>
                <p class="text-lg text-slate-600 dark:text-slate-400">
                    View and download your prescriptions from approved appointments
                </p>
            </div>

            @if ($prescriptions->count() > 0)
                <!-- Prescriptions Table -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-lg overflow-hidden border border-slate-200 dark:border-slate-700">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead
                                class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-slate-700 dark:to-slate-600 border-b-2 border-slate-200 dark:border-slate-600">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-slate-900 dark:text-white">
                                        Doctor</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-slate-900 dark:text-white">
                                        Appointment Date</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-slate-900 dark:text-white">
                                        Issued Date</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-slate-900 dark:text-white">
                                        Medicines</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-slate-900 dark:text-white">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                @foreach ($prescriptions as $prescription)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                        <td class="px-6 py-4">
                                            <div>
                                                <p class="font-semibold text-slate-900 dark:text-white">
                                                    Dr. {{ $prescription->doctor->name }}
                                                </p>
                                                @if ($prescription->doctor->doctor)
                                                    <p class="text-sm text-slate-600 dark:text-slate-400">
                                                        {{ $prescription->doctor->doctor->specialist ?? ($prescription->doctor->doctor->qualification ?? 'Specialist') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-900 dark:text-white">
                                            {{ $prescription->appointmentBooking->schedule->schedule_date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-slate-900 dark:text-white">
                                            {{ $prescription->issued_at?->format('M d, Y') ?? 'Pending' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($prescription->medicines && count($prescription->medicines) > 0)
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach (array_slice($prescription->medicines, 0, 2) as $medicine)
                                                        <span
                                                            class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs rounded-full font-semibold">
                                                            {{ $medicine['name'] }}
                                                        </span>
                                                    @endforeach
                                                    @if (count($prescription->medicines) > 2)
                                                        <span
                                                            class="px-3 py-1 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs rounded-full font-semibold">
                                                            +{{ count($prescription->medicines) - 2 }} more
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-slate-500 dark:text-slate-400 text-sm">No
                                                    medicines</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex gap-2 justify-center">
                                                <a href="{{ route('patient.prescription.show', $prescription) }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    View
                                                </a>
                                                <a href="{{ route('patient.prescription.download', $prescription) }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                        </path>
                                                    </svg>
                                                    Download
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                @if ($prescriptions->hasPages())
                    <div class="mt-8">
                        {{ $prescriptions->links('pagination::tailwind') }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-12 text-center border border-slate-200 dark:border-slate-700">
                    <svg class="h-16 w-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">No Prescriptions Yet</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-6">
                        You don't have any prescriptions available yet. Once your doctor approves an appointment and
                        creates a prescription, it will appear here.
                    </p>
                    <a href="{{ route('patient.my-bookings') }}"
                        class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition">
                        View My Appointments
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
