<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Patient Dashboard</h1>

        <div id="patient-booking-app">
            <div class="mb-4">
                <button @click="loadSchedules" class="px-4 py-2 bg-blue-600 text-white rounded">Load Available Schedules</button>
                <a href="{{ route('patient.my-bookings') }}" class="ml-4 px-4 py-2 border rounded">My Bookings</a>
            </div>

            <div v-if="loading" class="text-gray-600">Loading schedules…</div>

            <div v-if="schedules.length === 0 && !loading" class="text-gray-600">No schedules found.</div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div v-for="s in schedules" :key="s.id" class="p-4 border rounded">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="font-bold text-lg" v-text="s.doctor_name"></div>
                            <div class="text-sm text-gray-600" v-text="s.date + ' • ' + s.start_time + ' - ' + s.end_time"></div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-blue-700" v-text="'BDT'+s.fee"></div>
                            <div class="mt-2">
                                <a :href="`/patient/schedules/${s.id}/book`" class="px-3 py-1 bg-green-600 text-white rounded">Book</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    schedules: [],
                    loading: false,
                };
            },
            methods: {
                async loadSchedules() {
                    this.loading = true;
                    try {
                        const res = await fetch('/patient/available-schedules');
                        const data = await res.json();
                        if (data.success) {
                            this.schedules = data.schedules;
                        }
                    } catch (e) {
                        console.error(e);
                    } finally {
                        this.loading = false;
                    }
                }
            },
        }).mount('#patient-booking-app');
    </script>
</x-app-layout>
