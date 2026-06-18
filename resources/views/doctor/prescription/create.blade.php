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

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-2">Write Prescription</h1>
                <p class="text-lg text-slate-600 dark:text-slate-400">
                    Create prescription for: <span class="font-semibold">{{ $booking->patient->name }}</span>
                </p>
            </div>

            <!-- Appointment Details -->
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 border border-slate-200 dark:border-slate-700 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Patient</p>
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">
                            {{ $booking->patient->name }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Appointment Date</p>
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">
                            {{ $booking->schedule->schedule_date->format('M d, Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">Time Slot</p>
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">
                            {{ $booking->schedule->start_time }} - {{ $booking->schedule->end_time }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Prescription Form -->
            <form action="{{ route('doctor.prescription.store', $booking) }}" method="POST"
                class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                @csrf
                <input type="hidden" id="medicines-input" name="medicines" value='{}'>

                <!-- Medicines Section -->
                <div class="p-8 border-b border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            Medicines
                        </h2>
                        <button type="button" id="add-medicine-btn"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                            + Add Medicine
                        </button>
                    </div>

                    <div id="medicines-container" class="space-y-4">
                        @if ($prescription->medicines && count($prescription->medicines) > 0)
                            @foreach ($prescription->medicines as $index => $medicine)
                                <div
                                    class="medicine-item bg-slate-50 dark:bg-slate-700/50 p-4 rounded-lg border border-slate-200 dark:border-slate-600 relative">
                                    <button type="button"
                                        class="remove-medicine absolute top-4 right-4 text-red-600 hover:text-red-700">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                                Medicine Name *
                                            </label>
                                            <input type="text"
                                                class="medicine-name w-full px-4 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none"
                                                value="{{ $medicine['name'] ?? '' }}" placeholder="e.g., Paracetamol">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                                Dosage *
                                            </label>
                                            <input type="text"
                                                class="medicine-dosage w-full px-4 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none"
                                                value="{{ $medicine['dosage'] ?? '' }}" placeholder="e.g., 500mg">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                                Frequency *
                                            </label>
                                            <select
                                                class="medicine-frequency w-full px-4 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none">
                                                <option value="">Select frequency</option>
                                                <option value="Once daily"
                                                    {{ $medicine['frequency'] === 'Once daily' ? 'selected' : '' }}>Once
                                                    daily</option>
                                                <option value="Twice daily"
                                                    {{ $medicine['frequency'] === 'Twice daily' ? 'selected' : '' }}>
                                                    Twice daily</option>
                                                <option value="Three times daily"
                                                    {{ $medicine['frequency'] === 'Three times daily' ? 'selected' : '' }}>
                                                    Three times daily</option>
                                                <option value="Four times daily"
                                                    {{ $medicine['frequency'] === 'Four times daily' ? 'selected' : '' }}>
                                                    Four times daily</option>
                                                <option value="As needed"
                                                    {{ $medicine['frequency'] === 'As needed' ? 'selected' : '' }}>As
                                                    needed</option>
                                                <option value="Every 4 hours"
                                                    {{ $medicine['frequency'] === 'Every 4 hours' ? 'selected' : '' }}>
                                                    Every 4 hours</option>
                                                <option value="Every 6 hours"
                                                    {{ $medicine['frequency'] === 'Every 6 hours' ? 'selected' : '' }}>
                                                    Every 6 hours</option>
                                                <option value="Every 8 hours"
                                                    {{ $medicine['frequency'] === 'Every 8 hours' ? 'selected' : '' }}>
                                                    Every 8 hours</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                                Duration *
                                            </label>
                                            <input type="text"
                                                class="medicine-duration w-full px-4 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none"
                                                value="{{ $medicine['duration'] ?? '' }}" placeholder="e.g., 5 days">
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <label
                                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            Additional Notes
                                        </label>
                                        <textarea
                                            class="medicine-notes w-full px-4 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none"
                                            rows="2" placeholder="e.g., Take with food, avoid dairy">{{ $medicine['notes'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    @if (count($prescription->medicines ?? []) === 0)
                        <div class="text-center py-8 text-slate-600 dark:text-slate-400">
                            <p>No medicines added yet. Click "Add Medicine" to get started.</p>
                        </div>
                    @endif
                </div>

                <!-- Doctor Notes & Instructions -->
                <div class="p-8 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Doctor Notes & Instructions
                    </h2>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Doctor Notes
                            </label>
                            <textarea name="notes" rows="4"
                                class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none"
                                placeholder="Add any clinical notes or observations...">{{ $prescription->notes ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Patient Instructions
                            </label>
                            <textarea name="instructions" rows="4"
                                class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none"
                                placeholder="Provide instructions for the patient (e.g., dietary restrictions, lifestyle changes)...">{{ $prescription->instructions ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-8 bg-slate-50 dark:bg-slate-700/50 flex gap-4 justify-end">
                    <a href="{{ route('doctor.appointments') }}"
                        class="px-6 py-3 text-slate-700 dark:text-slate-300 bg-slate-200 dark:bg-slate-600 hover:bg-slate-300 dark:hover:bg-slate-500 font-semibold rounded-lg transition">
                        Cancel
                    </a>
                    <button type="submit" name="action" value="save"
                        class="px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg transition">
                        Save as Draft
                    </button>
                    <button type="submit" name="action" value="complete"
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                        Complete & Issue
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateMedicinesInput() {
            const container = document.getElementById('medicines-container');
            const items = container.querySelectorAll('.medicine-item');
            const medicines = [];

            items.forEach(item => {
                const name = item.querySelector('.medicine-name').value.trim();
                if (name) {
                    medicines.push({
                        name,
                        dosage: item.querySelector('.medicine-dosage').value.trim(),
                        frequency: item.querySelector('.medicine-frequency').value,
                        duration: item.querySelector('.medicine-duration').value.trim(),
                        notes: item.querySelector('.medicine-notes').value.trim(),
                    });
                }
            });

            document.getElementById('medicines-input').value = JSON.stringify(medicines);
        }

        document.getElementById('add-medicine-btn').addEventListener('click', function(e) {
            e.preventDefault();
            const container = document.getElementById('medicines-container');
            const template = `
        <div class="medicine-item bg-slate-50 dark:bg-slate-700/50 p-4 rounded-lg border border-slate-200 dark:border-slate-600 relative">
            <button type="button" class="remove-medicine absolute top-4 right-4 text-red-600 hover:text-red-700">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Medicine Name *</label>
                    <input type="text" class="medicine-name w-full px-4 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none" placeholder="e.g., Paracetamol">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Dosage *</label>
                    <input type="text" class="medicine-dosage w-full px-4 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none" placeholder="e.g., 500mg">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Frequency *</label>
                    <select class="medicine-frequency w-full px-4 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none">
                        <option value="">Select frequency</option>
                        <option value="Once daily">Once daily</option>
                        <option value="Twice daily">Twice daily</option>
                        <option value="Three times daily">Three times daily</option>
                        <option value="Four times daily">Four times daily</option>
                        <option value="As needed">As needed</option>
                        <option value="Every 4 hours">Every 4 hours</option>
                        <option value="Every 6 hours">Every 6 hours</option>
                        <option value="Every 8 hours">Every 8 hours</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Duration *</label>
                    <input type="text" class="medicine-duration w-full px-4 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none" placeholder="e.g., 5 days">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Additional Notes</label>
                <textarea class="medicine-notes w-full px-4 py-2 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none" rows="2" placeholder="e.g., Take with food, avoid dairy"></textarea>
            </div>
        </div>
        `;
            container.insertAdjacentHTML('beforeend', template);
            attachRemoveListeners();
        });

        function attachRemoveListeners() {
            document.querySelectorAll('.remove-medicine').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    this.closest('.medicine-item').remove();
                    updateMedicinesInput();
                });
            });
        }

        document.querySelector('form').addEventListener('submit', function() {
            updateMedicinesInput();
        });

        document.querySelectorAll('input, select, textarea').forEach(el => {
            el.addEventListener('change', updateMedicinesInput);
        });

        attachRemoveListeners();
    </script>
</x-app-layout>
