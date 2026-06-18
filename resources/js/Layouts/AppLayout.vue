<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Navbar -->
        <nav class="bg-white shadow-sm sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <Link href="/" class="flex items-center gap-2">
                        <div class="flex items-center justify-center w-8 h-8 bg-blue-600 rounded-lg text-white font-bold">
                            H
                        </div>
                        <span class="font-bold text-lg text-gray-900">HMS</span>
                    </Link>

                    <!-- Nav Links -->
                    <div class="hidden md:flex gap-8">
                        <Link href="/patient/available-schedules" class="text-gray-600 hover:text-blue-600 font-medium transition">
                            Book Appointment
                        </Link>
                        <Link href="/patient/my-bookings" class="text-gray-600 hover:text-blue-600 font-medium transition">
                            My Appointments
                        </Link>
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center gap-4">
                        <button @click="toggleUserMenu" class="relative p-2 text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h6m-6 4v6m6-10v10m6-8h4.5m-4.5 0v3m0-3h-3" />
                            </svg>
                        </button>

                        <div v-if="showUserMenu" class="absolute right-4 top-16 bg-white rounded-lg shadow-lg overflow-hidden w-48 z-50">
                            <div class="p-4 border-b border-gray-200">
                                <p class="font-semibold text-gray-900">{{ auth.user.name }}</p>
                                <p class="text-sm text-gray-600">{{ auth.user.email }}</p>
                            </div>
                            <Link href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Profile Settings
                            </Link>
                            <form @submit.prevent="logout" class="w-full">
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-12 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div>
                        <h3 class="text-white font-bold mb-4">HMS - Hospital Management System</h3>
                        <p class="text-sm">Your trusted healthcare partner for quality medical services and expert consultation.</p>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-sm">
                            <li><Link href="/" class="hover:text-white transition">Home</Link></li>
                            <li><Link href="/patient/available-schedules" class="hover:text-white transition">Book Appointment</Link></li>
                            <li><Link href="/patient/my-bookings" class="hover:text-white transition">My Appointments</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-4">Contact Us</h4>
                        <ul class="space-y-2 text-sm">
                            <li>Email: support@hms.com</li>
                            <li>Phone: +880 1700-000-000</li>
                            <li>Address: Dhaka, Bangladesh</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-8 text-center text-sm">
                    <p>&copy; 2026 Hospital Management System. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';

const page = usePage();
const showUserMenu = ref(false);

const auth = computed(() => page.props.auth);

const toggleUserMenu = () => {
    showUserMenu.value = !showUserMenu.value;
};

const logout = () => {
    router.post(route('logout'));
};
</script>
