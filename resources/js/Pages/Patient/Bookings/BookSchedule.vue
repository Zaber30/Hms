<template>
    <AppLayout>
        <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button -->
                <Link href="/patient/available-schedules" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Schedules
                </Link>

                <!-- Main Card -->
                <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                    <!-- Doctor Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-white">
                        <div class="flex items-start gap-6">
                            <!-- Doctor Avatar -->
                            <div class="hidden sm:block flex-shrink-0">
                                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg bg-white flex items-center justify-center">
                                    <img v-if="schedule.profile_image"
                                         :src="'/storage/' + schedule.profile_image"
                                         :alt="schedule.doctor_name"
                                         class="w-full h-full object-cover">
                                    <svg v-else class="w-20 h-20 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Doctor Info -->
                            <div class="flex-1">
                                <h1 class="text-4xl font-bold mb-2">Dr. {{ schedule.doctor_name }}</h1>
                                <p class="text-xl text-blue-100 mb-4">{{ schedule.specialist }}</p>

                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-sm">
                                    <div>
                                        <p class="text-blue-100">Qualification</p>
                                        <p class="font-semibold">{{ schedule.qualification }}</p>
                                    </div>
                                    <div>
                                        <p class="text-blue-100">Experience</p>
                                        <p class="font-semibold">{{ schedule.experience }} Years</p>
                                    </div>
                                    <div>
                                        <p class="text-blue-100">Fee</p>
                                        <p class="font-semibold">৳{{ schedule.consultation_fee }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Details -->
                    <div class="p-8 border-b border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Appointment Schedule Details</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Date & Time -->
                            <div class="bg-blue-50 rounded-lg p-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h12a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900">Date & Time</h3>
                                </div>
                                <p class="text-3xl font-bold text-blue-600 mb-2">{{ formatDate(schedule.schedule_date) }}</p>
                                <p class="text-lg text-gray-700">{{ schedule.start_time }} - {{ schedule.end_time }}</p>
                            </div>

                            <!-- Location -->
                            <div class="bg-green-50 rounded-lg p-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900">Clinic Location</h3>
                                </div>
                                <p class="text-gray-700">{{ schedule.clinic_address }}</p>
                            </div>

                            <!-- Available Slots -->
                            <div class="bg-purple-50 rounded-lg p-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900">Available Slots</h3>
                                </div>
                                <p class="text-3xl font-bold text-purple-600">{{ schedule.available_slots }}</p>
                            </div>

                            <!-- Consultation Fee -->
                            <div class="bg-orange-50 rounded-lg p-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.16 5.314l4.897-1.596A1 1 0 0114.25 4.75v.006h2a1 1 0 01.82 1.573l-7.822 10.128a.75.75 0 01-.712.315H6a1 1 0 01-1-1V8.316l3.16-3.002zm5.324 9.12l-2.445 3.178H14.5a1 1 0 001-1v-.006h-2a1 1 0 01-.82-1.573l7.822-10.128a.75.75 0 01.712-.315h1.584a1 1 0 011 1v5.686l-3.16 3.002z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900">Consultation Fee</h3>
                                </div>
                                <p class="text-3xl font-bold text-orange-600">৳{{ schedule.consultation_fee }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <form @submit.prevent="submitBooking" class="p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Complete Your Booking</h2>

                        <!-- Patient Notes -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                Your Medical History / Notes
                                <span class="text-gray-500 font-normal">(Optional)</span>
                            </label>
                            <textarea
                                v-model="form.patient_notes"
                                placeholder="Tell the doctor about your symptoms, previous medical history, or any specific concerns..."
                                rows="6"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            ></textarea>
                            <p class="text-xs text-gray-500 mt-1">Maximum 500 characters</p>
                            <p v-if="form.errors.patient_notes" class="text-red-600 text-sm mt-1">{{ form.errors.patient_notes }}</p>
                        </div>

                        <!-- Confirmation Checkbox -->
                        <div class="mb-6 bg-blue-50 rounded-lg p-4">
                            <label class="flex items-start gap-3 cursor-pointer">
                                <input
                                    v-model="confirmBooking"
                                    type="checkbox"
                                    class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
                                >
                                <div>
                                    <p class="font-semibold text-gray-900">I confirm the appointment details</p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        I understand that I'm booking an appointment for {{ formatDate(schedule.schedule_date) }}
                                        from {{ schedule.start_time }} to {{ schedule.end_time }} at {{ schedule.clinic_address }}
                                        with Dr. {{ schedule.doctor_name }}.
                                    </p>
                                </div>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex gap-4">
                            <Link
                                href="/patient/available-schedules"
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-lg transition text-center"
                            >
                                Cancel
                            </Link>
                            <button
                                type="submit"
                                :disabled="!confirmBooking || form.processing"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-semibold py-3 px-4 rounded-lg transition flex items-center justify-center gap-2"
                            >
                                <svg v-if="form.processing" class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ form.processing ? 'Booking...' : 'Confirm Booking' }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Info Section -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg p-6 shadow">
                        <svg class="w-12 h-12 text-blue-600 mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 010 2v1h1a1 1 0 110 2H6v1a1 1 0 01-2 0v-1H3a1 1 0 110-2h1V9a1 1 0 010-2H3a1 1 0 010-2h1V4a1 1 0 011-1zm0-2a3 3 0 00-3 3v2a3 3 0 003 3h2a3 3 0 003-3V3a3 3 0 00-3-3H5zm6.217 19.424a.5.5 0 00.634.632c1.955-.524 3.812-1.313 5.546-2.556a.5.5 0 10-.632-.78c-1.554 1.161-3.182 1.879-4.934 2.383l.386.321z" clip-rule="evenodd" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Quick Confirmation</h3>
                        <p class="text-gray-600 text-sm">Your booking will be reviewed by the doctor and confirmed within 24 hours.</p>
                    </div>

                    <div class="bg-white rounded-lg p-6 shadow">
                        <svg class="w-12 h-12 text-green-600 mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Instant Notification</h3>
                        <p class="text-gray-600 text-sm">You'll receive an email notification once the doctor approves your appointment.</p>
                    </div>

                    <div class="bg-white rounded-lg p-6 shadow">
                        <svg class="w-12 h-12 text-purple-600 mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 010 2v1h1a1 1 0 110 2H6v1a1 1 0 01-2 0v-1H3a1 1 0 110-2h1V9a1 1 0 010-2H3a1 1 0 010-2h1V4a1 1 0 011-1zm0-2a3 3 0 00-3 3v2a3 3 0 003 3h2a3 3 0 003-3V3a3 3 0 00-3-3H5zm6.217 19.424a.5.5 0 00.634.632c1.955-.524 3.812-1.313 5.546-2.556a.5.5 0 10-.632-.78c-1.554 1.161-3.182 1.879-4.934 2.383l.386.321z" clip-rule="evenodd" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Easy Management</h3>
                        <p class="text-gray-600 text-sm">Manage all your bookings from your profile and cancel anytime if needed.</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    schedule: Object,
});

const form = useForm({
    patient_notes: '',
});

const confirmBooking = ref(false);

const submitBooking = () => {
    if (!confirmBooking.value) {
        alert('Please confirm the appointment details before booking.');
        return;
    }

    form.post(route('patient.book-schedule', props.schedule.id));
};

const formatDate = (dateString) => {
    return new Intl.DateTimeFormat('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    }).format(new Date(dateString));
};
</script>
