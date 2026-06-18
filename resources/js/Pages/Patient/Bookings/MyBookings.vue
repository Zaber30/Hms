<template>
    <AppLayout>
        <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">My Appointments</h1>
                    <p class="text-lg text-gray-600">Manage and track all your medical appointments</p>
                </div>

                <!-- Alerts -->
                <div v-if="$page.props.flash.success" class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ $page.props.flash.success }}
                </div>

                <div v-if="$page.props.flash.error" class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    {{ $page.props.flash.error }}
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div
                        v-for="(count, status) in stats"
                        :key="status"
                        class="bg-white rounded-lg shadow p-6 text-center cursor-pointer hover:shadow-lg transition"
                        @click="filterByStatus(status)"
                    >
                        <p class="text-3xl font-bold text-blue-600">{{ count }}</p>
                        <p class="text-gray-600 text-sm capitalize mt-2">{{ formatStatus(status) }}</p>
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="bg-white rounded-lg shadow mb-6 overflow-x-auto">
                    <div class="flex">
                        <button
                            @click="currentFilter = ''"
                            :class="[
                                'flex-1 px-4 py-4 font-semibold text-sm transition border-b-2',
                                currentFilter === ''
                                    ? 'border-blue-600 text-blue-600 bg-blue-50'
                                    : 'border-transparent text-gray-600 hover:text-gray-900'
                            ]"
                        >
                            All
                        </button>
                        <button
                            v-for="status in ['pending', 'approved', 'completed', 'cancelled']"
                            :key="status"
                            @click="currentFilter = status"
                            :class="[
                                'flex-1 px-4 py-4 font-semibold text-sm transition border-b-2 capitalize',
                                currentFilter === status
                                    ? 'border-blue-600 text-blue-600 bg-blue-50'
                                    : 'border-transparent text-gray-600 hover:text-gray-900'
                            ]"
                        >
                            {{ formatStatus(status) }}
                        </button>
                    </div>
                </div>

                <!-- Appointments List -->
                <div v-if="filteredBookings.length > 0" class="space-y-4">
                    <div
                        v-for="booking in filteredBookings"
                        :key="booking.id"
                        class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden"
                    >
                        <div class="flex flex-col md:flex-row">
                            <!-- Status Indicator -->
                            <div
                                :class="[
                                    'w-full md:w-2 flex-shrink-0',
                                    getStatusColor(booking.status)
                                ]"
                            ></div>

                            <!-- Content -->
                            <div class="flex-1 p-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Doctor Info -->
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-1">Dr. {{ booking.doctor_name }}</h3>
                                        <p class="text-blue-600 font-semibold mb-2">{{ booking.specialist }}</p>
                                        <p class="text-sm text-gray-600 flex items-start gap-2">
                                            <svg class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                            {{ booking.clinic_address }}
                                        </p>
                                    </div>

                                    <!-- Date & Time -->
                                    <div>
                                        <p class="text-gray-500 text-sm font-semibold uppercase mb-2">Schedule</p>
                                        <p class="text-lg font-bold text-gray-900 mb-1">{{ formatDate(booking.schedule_date) }}</p>
                                        <p class="text-gray-700 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00-.447.894l1.005 5.027a1 1 0 001.973 0l1.005-5.027A1 1 0 0011 10V6z" clip-rule="evenodd" />
                                            </svg>
                                            {{ booking.start_time }} - {{ booking.end_time }}
                                        </p>
                                    </div>

                                    <!-- Status & Fee -->
                                    <div class="flex flex-col justify-between">
                                        <div>
                                            <p class="text-gray-500 text-sm font-semibold uppercase mb-2">Status</p>
                                            <span :class="[
                                                'inline-block px-4 py-2 rounded-full font-semibold text-sm capitalize',
                                                {
                                                    'bg-yellow-100 text-yellow-800': booking.status === 'pending',
                                                    'bg-green-100 text-green-800': booking.status === 'approved',
                                                    'bg-blue-100 text-blue-800': booking.status === 'completed',
                                                    'bg-red-100 text-red-800': booking.status === 'cancelled',
                                                }
                                            ]">
                                                {{ formatStatus(booking.status) }}
                                            </span>
                                        </div>
                                        <div class="mt-4">
                                            <p class="text-gray-500 text-sm font-semibold uppercase mb-1">Fee</p>
                                            <p class="text-2xl font-bold text-blue-600">৳{{ booking.consultation_fee }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notes -->
                                <div v-if="booking.patient_notes || booking.doctor_notes" class="mt-4 pt-4 border-t border-gray-200">
                                    <div v-if="booking.patient_notes" class="mb-3">
                                        <p class="text-sm font-semibold text-gray-700 mb-1">Your Notes:</p>
                                        <p class="text-gray-600 text-sm">{{ booking.patient_notes }}</p>
                                    </div>
                                    <div v-if="booking.doctor_notes" class="bg-blue-50 rounded p-3">
                                        <p class="text-sm font-semibold text-blue-900 mb-1">Doctor's Notes:</p>
                                        <p class="text-blue-800 text-sm">{{ booking.doctor_notes }}</p>
                                    </div>
                                </div>

                                <!-- Timeline -->
                                <div class="mt-4 pt-4 border-t border-gray-200 flex gap-6 text-sm">
                                    <div>
                                        <p class="text-gray-500">Booked on</p>
                                        <p class="font-semibold text-gray-900">{{ booking.created_at }}</p>
                                    </div>
                                    <div v-if="booking.approved_at">
                                        <p class="text-gray-500">Approved on</p>
                                        <p class="font-semibold text-gray-900">{{ booking.approved_at }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="md:w-32 p-6 flex flex-col justify-between items-center gap-3">
                                <Link
                                    :href="route('patient.available-schedules')"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition text-center text-sm"
                                >
                                    Book Another
                                </Link>

                                <button
                                    v-if="booking.status !== 'cancelled' && booking.status !== 'completed'"
                                    @click="cancelBooking(booking.id)"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition text-sm"
                                >
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- No Bookings -->
                <div v-else class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7 12a5 5 0 1110 0A5 5 0 017 12z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No appointments found</h3>
                    <p class="text-gray-600 mb-6">You haven't booked any appointments yet.</p>
                    <Link
                        href="/patient/available-schedules"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition"
                    >
                        Browse Available Schedules
                    </Link>
                </div>

                <!-- Pagination -->
                <div v-if="bookings.last_page > 1" class="mt-8 flex justify-center gap-2">
                    <Link v-if="bookings.current_page > 1" :href="bookings.first_page_url" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        First
                    </Link>
                    <Link v-if="bookings.prev_page_url" :href="bookings.prev_page_url" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Previous
                    </Link>

                    <span class="px-4 py-2 text-gray-700">
                        Page {{ bookings.current_page }} of {{ bookings.last_page }}
                    </span>

                    <Link v-if="bookings.next_page_url" :href="bookings.next_page_url" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Next
                    </Link>
                    <Link v-if="bookings.current_page < bookings.last_page" :href="bookings.last_page_url" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Last
                    </Link>
                </div>
            </div>

            <!-- Cancel Modal -->
            <div v-if="showCancelModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
                <div class="bg-white rounded-lg max-w-md w-full p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Cancel Appointment?</h3>
                    <p class="text-gray-600 mb-6">Are you sure you want to cancel this appointment? This action cannot be undone.</p>

                    <div class="flex gap-3">
                        <button
                            @click="showCancelModal = false"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition"
                        >
                            Keep Appointment
                        </button>
                        <form
                            method="post"
                            :action="route('patient.cancel-booking', pendingCancelId)"
                            class="flex-1"
                        >
                            <button
                                type="submit"
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition"
                            >
                                Yes, Cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    bookings: Object,
    stats: Object,
    currentFilter: String,
});

const currentFilter = ref(props.currentFilter || '');
const showCancelModal = ref(false);
const pendingCancelId = ref(null);

const filteredBookings = computed(() => {
    if (!currentFilter.value) {
        return props.bookings.data;
    }
    return props.bookings.data.filter(b => b.status === currentFilter.value);
});

const formatDate = (dateString) => {
    return new Intl.DateTimeFormat('en-US', {
        weekday: 'short',
        year: 'numeric',
        month: 'short',
        day: 'numeric',
    }).format(new Date(dateString));
};

const formatStatus = (status) => {
    return status.charAt(0).toUpperCase() + status.slice(1);
};

const getStatusColor = (status) => {
    const colors = {
        pending: 'bg-yellow-400',
        approved: 'bg-green-400',
        completed: 'bg-blue-400',
        cancelled: 'bg-red-400',
    };
    return colors[status] || 'bg-gray-400';
};

const filterByStatus = (status) => {
    currentFilter.value = status;
};

const cancelBooking = (bookingId) => {
    pendingCancelId.value = bookingId;
    showCancelModal.value = true;
};
</script>
