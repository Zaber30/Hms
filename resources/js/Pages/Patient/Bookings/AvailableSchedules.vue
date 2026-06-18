<template>
    <AppLayout>
        <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Book an Appointment</h1>
                    <p class="text-lg text-gray-600">Browse available doctor schedules and book your appointment</p>
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

                <!-- Filters -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Filters</h2>
                    <form @submit.prevent="applyFilters" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Specialty</label>
                            <select v-model="filters.specialty" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">All Specialties</option>
                                <option v-for="spec in specialists" :key="spec" :value="spec">{{ spec }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <input v-model="filters.date" type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="flex items-end gap-2">
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                                Apply Filters
                            </button>
                            <button type="button" @click="resetFilters" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Schedules Grid -->
                <div v-if="schedules.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div v-for="schedule in schedules.data" :key="schedule.id" class="bg-white rounded-lg shadow-lg hover:shadow-xl transition overflow-hidden">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-4 text-white">
                            <h3 class="text-xl font-bold">Dr. {{ schedule.doctor_name }}</h3>
                            <p class="text-blue-100">{{ schedule.specialist }}</p>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Location -->
                            <div class="mb-4 flex items-start gap-3">
                                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm text-gray-600">{{ schedule.clinic_address }}</p>
                            </div>

                            <!-- Date & Time -->
                            <div class="mb-4 flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h12a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                <div class="text-sm text-gray-600">
                                    <p class="font-medium">{{ formatDate(schedule.schedule_date) }}</p>
                                    <p class="text-xs">{{ schedule.start_time }} - {{ schedule.end_time }}</p>
                                </div>
                            </div>

                            <!-- Available Slots -->
                            <div class="mb-4 flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                                <p class="text-sm">
                                    <span class="font-semibold text-green-600">{{ schedule.available_slots }}</span>
                                    <span class="text-gray-600"> slots available</span>
                                </p>
                            </div>

                            <!-- Consultation Fee -->
                            <div class="mb-6 text-center">
                                <p class="text-3xl font-bold text-blue-600">৳{{ schedule.consultation_fee }}</p>
                                <p class="text-sm text-gray-500">Consultation Fee</p>
                            </div>

                            <!-- Book Button -->
                            <Link :href="route('patient.book-schedule-form', schedule.id)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition text-center block">
                                Book Appointment
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- No Results -->
                <div v-else class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No schedules available</h3>
                    <p class="text-gray-600">Try adjusting your filters to find available appointments.</p>
                </div>

                <!-- Pagination -->
                <div v-if="schedules.last_page > 1" class="flex justify-center gap-2">
                    <Link v-if="schedules.current_page > 1" :href="schedules.first_page_url" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        First
                    </Link>
                    <Link v-if="schedules.prev_page_url" :href="schedules.prev_page_url" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Previous
                    </Link>

                    <span class="px-4 py-2 text-gray-700">
                        Page {{ schedules.current_page }} of {{ schedules.last_page }}
                    </span>

                    <Link v-if="schedules.next_page_url" :href="schedules.next_page_url" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Next
                    </Link>
                    <Link v-if="schedules.current_page < schedules.last_page" :href="schedules.last_page_url" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Last
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    schedules: Object,
    specialists: Array,
    filters: Object,
});

const filters = ref({
    specialty: props.filters?.specialty || '',
    date: props.filters?.date || '',
    doctor_id: props.filters?.doctor_id || '',
});

const applyFilters = () => {
    router.get(route('patient.available-schedules'), {
        specialty: filters.value.specialty,
        date: filters.value.date,
        doctor_id: filters.value.doctor_id,
    });
};

const resetFilters = () => {
    filters.value = {
        specialty: '',
        date: '',
        doctor_id: '',
    };
    router.get(route('patient.available-schedules'));
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
