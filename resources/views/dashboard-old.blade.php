<x-app-layout>
    <div x-data="dashboardApp()" class="min-h-screen bg-gradient-to-br from-slate-950 via-blue-950 to-slate-950">
        <!-- Animated Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse">
            </div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"
                style="animation-delay: 2s;"></div>
        </div>

        <div class="relative z-10">
            <!-- Premium Hero Section -->
            <section class="pt-20 pb-16 overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <!-- Hero Content -->
                        <div class="space-y-8">
                            <div class="space-y-4">
                                <div
                                    class="inline-flex items-center gap-3 bg-blue-500/10 border border-blue-400/30 rounded-full px-4 py-2">
                                    <span class="flex h-2 w-2 rounded-full bg-green-400 animate-pulse"></span>
                                    <span class="text-sm font-semibold text-blue-300">Connected with 10,000+
                                        doctors</span>
                                </div>
                                <h1 class="text-6xl lg:text-7xl font-black text-white leading-tight">
                                    Your Health,<br>
                                    <span
                                        class="bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-400 bg-clip-text text-transparent">Our
                                        Priority</span>
                                </h1>
                            </div>
                            <p class="text-xl text-slate-300 max-w-md leading-relaxed">
                                Access qualified healthcare professionals, book appointments instantly, and receive
                                expert consultations—all in one secure platform.
                            </p>
                            <div class="flex gap-4 pt-4">
                                <button @click="scrollToSearch()"
                                    class="px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition transform hover:scale-105 active:scale-95 shadow-xl hover:shadow-2xl">
                                    Find a Doctor
                                </button>
                                <a href="{{ route('doctor.request.form') }}"
                                    class="px-8 py-4 border-2 border-blue-400/50 text-blue-300 hover:text-blue-200 font-bold rounded-xl transition hover:border-blue-400 hover:bg-blue-400/10">
                                    Become a Doctor
                                </a>
                            </div>
                        </div>

                        <!-- Stats Cards -->
                        <div class="grid grid-cols-2 gap-4">
                            <div
                                class="bg-gradient-to-br from-blue-500/20 to-blue-500/5 border border-blue-400/20 rounded-2xl p-6 backdrop-blur hover:border-blue-400/50 transition group">
                                <div
                                    class="text-3xl font-black text-transparent bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                    10K+
                                </div>
                                <p class="text-slate-300 font-semibold">Verified Doctors</p>
                            </div>
                            <div
                                class="bg-gradient-to-br from-emerald-500/20 to-emerald-500/5 border border-emerald-400/20 rounded-2xl p-6 backdrop-blur hover:border-emerald-400/50 transition group">
                                <div
                                    class="text-3xl font-black text-transparent bg-gradient-to-r from-emerald-400 to-green-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                    50K+
                                </div>
                                <p class="text-slate-300 font-semibold">Happy Patients</p>
                            </div>
                            <div
                                class="bg-gradient-to-br from-purple-500/20 to-purple-500/5 border border-purple-400/20 rounded-2xl p-6 backdrop-blur hover:border-purple-400/50 transition group">
                                <div
                                    class="text-3xl font-black text-transparent bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                    98%
                                </div>
                                <p class="text-slate-300 font-semibold">Satisfaction Rate</p>
                            </div>
                            <div
                                class="bg-gradient-to-br from-yellow-500/20 to-yellow-500/5 border border-yellow-400/20 rounded-2xl p-6 backdrop-blur hover:border-yellow-400/50 transition group">
                                <div
                                    class="text-3xl font-black text-transparent bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                    24/7
                                </div>
                                <p class="text-slate-300 font-semibold">Support Available</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Advanced Search Panel -->
            <section class="py-8" x-ref="searchSection">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div
                        class="bg-gradient-to-br from-white/95 to-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 border border-white/20">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">Find Your Doctor</h2>
                        <form @submit.prevent="performSearch" class="space-y-6">
                            <!-- Main Search -->
                            <div class="flex gap-3">
                                <div class="flex-1 relative group">
                                    <svg class="absolute left-4 top-4 h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <input type="text" x-model="search.query" placeholder="Search by doctor name..."
                                        class="w-full pl-12 pr-4 py-4 border-2 border-slate-200 rounded-2xl focus:border-blue-500 focus:outline-none transition text-lg bg-white">
                                </div>
                                <button type="submit" :disabled="isLoading"
                                    class="px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-2xl transition transform hover:scale-105 active:scale-95 shadow-lg disabled:opacity-50">
                                    <svg v-if="!isLoading" class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <svg v-else class="h-5 w-5 animate-spin" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                        </path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Advanced Filters -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="group">
                                    <label class="block text-sm font-bold text-slate-700 mb-3">Specialization</label>
                                    <select x-model="search.specialization" @change="performSearch"
                                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                                        <option value="">All Specializations</option>
                                        <option value="cardiology">💚 Cardiology</option>
                                        <option value="dermatology">🩹 Dermatology</option>
                                        <option value="pediatrics">👶 Pediatrics</option>
                                        <option value="dentistry">😁 Dentistry</option>
                                        <option value="neurology">🧠 Neurology</option>
                                        <option value="orthopedics">🦴 Orthopedics</option>
                                        <option value="general">🏥 General Practice</option>
                                    </select>
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-bold text-slate-700 mb-3">Location</label>
                                    <input type="text" x-model="search.location" @change="performSearch"
                                        placeholder="City or area..."
                                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-bold text-slate-700 mb-3">Availability</label>
                                    <select x-model="search.availability" @change="performSearch"
                                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                                        <option value="">All Times</option>
                                        <option value="today">📅 Available Today</option>
                                        <option value="tomorrow">📆 Tomorrow</option>
                                        <option value="week">📊 This Week</option>
                                        <option value="month">📈 This Month</option>
                                    </select>
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-bold text-slate-700 mb-3">Max Price</label>
                                    <input type="number" x-model="search.maxPrice" @change="performSearch"
                                        placeholder="Max price..."
                                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Search Results Section -->
            <section class="py-16" x-show="hasSearched">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Results Header -->
                    <div class="mb-12">
                        <h2 class="text-4xl font-black text-white mb-2">Search Results</h2>
                        <p class="text-lg text-slate-400">Found <span x-text="totalResults"></span> doctors matching
                            your criteria</p>
                        <button @click="clearSearch()"
                            class="mt-4 text-blue-400 hover:text-blue-300 font-bold flex items-center gap-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear Search
                        </button>
                    </div>

                    <!-- Loading State -->
                    <div v-if="isLoading" class="flex justify-center items-center py-20">
                        <div class="text-center">
                            <svg class="h-12 w-12 animate-spin text-blue-400 mx-auto mb-4" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            <p class="text-slate-300">Searching for doctors...</p>
                        </div>
                    </div>

                    <!-- No Results -->
                    <div v-else-if="!isLoading && searchResults.length === 0 && hasSearched"
                        class="text-center py-20">
                        <svg class="h-16 w-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-white mb-2">No doctors found</h3>
                        <p class="text-slate-400 mb-6">Try adjusting your search filters or specialization</p>
                    </div>

                    <!-- Results Grid -->
                    <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <template x-for="doc in searchResults" :key="doc.id">
                            <div class="group h-full">
                                <div
                                    class="relative bg-gradient-to-br from-white/10 to-white/5 border border-white/20 rounded-2xl overflow-hidden hover:border-blue-400/50 transition transform hover:-translate-y-3 hover:shadow-2xl h-full flex flex-col cursor-pointer">
                                    <!-- Image Section -->
                                    <div
                                        class="relative overflow-hidden h-56 bg-gradient-to-br from-blue-400 to-purple-600">
                                        <img :src="doc.img" :alt="doc.name"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                        <!-- Rating Badge -->
                                        <div
                                            class="absolute top-4 left-4 bg-black/40 backdrop-blur border border-white/20 rounded-full px-3 py-1 flex items-center gap-1">
                                            <svg class="h-4 w-4 fill-yellow-400" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            <span class="text-white font-bold text-sm" x-text="doc.rating"></span>
                                        </div>

                                        <!-- Favorite Button -->
                                        <button
                                            class="absolute top-4 right-4 bg-white/90 hover:bg-white rounded-full p-3 shadow-lg transition transform hover:scale-110 active:scale-95">
                                            <svg class="h-5 w-5 text-red-500 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Content Section -->
                                    <div class="p-6 flex-1 flex flex-col">
                                        <h3 class="text-xl font-bold text-white mb-1" x-text="doc.name"></h3>
                                        <p class="text-blue-400 font-semibold text-sm mb-2" x-text="doc.spec"></p>
                                        <p class="text-slate-400 text-sm mb-4" x-text="doc.experience"></p>

                                        <!-- Reviews -->
                                        <div class="flex items-center gap-2 mb-4 text-sm">
                                            <span class="text-slate-300" x-text="doc.reviews + ' reviews'"></span>
                                        </div>

                                        <!-- Status & Price -->
                                        <div
                                            class="flex justify-between items-center py-4 border-t border-white/10 mb-4 flex-1">
                                            <span
                                                class="inline-flex items-center gap-1 bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs font-bold">
                                                <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                                <span x-text="doc.status"></span>
                                            </span>
                                            <span class="text-white font-bold"><span
                                                    x-text="doc.price"></span></span>
                                        </div>

                                        <!-- CTA Button -->
                                        <button
                                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg">
                                            Book Appointment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Pagination -->
                    <div v-if="lastPage > 1 && searchResults.length > 0" class="flex justify-center gap-2 mt-12">
                        <button @click="previousPage()" :disabled="currentPage === 1"
                            class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg disabled:opacity-50">Previous</button>
                        <template x-for="page in pages" :key="page">
                            <button @click="goToPage(page)"
                                :class="currentPage === page ? 'bg-blue-600' : 'bg-white/10 hover:bg-white/20'"
                                class="px-4 py-2 text-white rounded-lg transition">
                                <span x-text="page"></span>
                            </button>
                        </template>
                        <button @click="nextPage()" :disabled="currentPage === lastPage"
                            class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg disabled:opacity-50">Next</button>
                    </div>
                </div>
            </section>

            <!-- Featured Doctors Section (when not searching) -->
            <section class="py-20 bg-white/5 backdrop-blur-sm" x-show="!hasSearched">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-end mb-12">
                        <div>
                            <h2 class="text-4xl font-black text-white mb-2">Top Recommended Doctors</h2>
                            <p class="text-lg text-slate-400">Highly rated professionals verified by our platform</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @php
                            $doctors = [
                                [
                                    'img' => 'https://randomuser.me/api/portraits/men/32.jpg',
                                    'name' => 'Dr. John Doe',
                                    'spec' => 'Cardiologist',
                                    'status' => 'Available',
                                    'rating' => 4.8,
                                    'reviews' => 245,
                                    'price' => 50,
                                    'experience' => '15 years',
                                ],
                                [
                                    'img' => 'https://randomuser.me/api/portraits/women/44.jpg',
                                    'name' => 'Dr. Jane Smith',
                                    'spec' => 'Dermatologist',
                                    'status' => 'Available',
                                    'rating' => 4.9,
                                    'reviews' => 312,
                                    'price' => 45,
                                    'experience' => '12 years',
                                ],
                                [
                                    'img' => 'https://randomuser.me/api/portraits/men/56.jpg',
                                    'name' => 'Dr. Robert Lee',
                                    'spec' => 'Pediatrician',
                                    'status' => 'Available',
                                    'rating' => 4.7,
                                    'reviews' => 189,
                                    'price' => 40,
                                    'experience' => '10 years',
                                ],
                                [
                                    'img' => 'https://randomuser.me/api/portraits/women/23.jpg',
                                    'name' => 'Dr. Sarah Wilson',
                                    'spec' => 'Neurologist',
                                    'status' => 'Available',
                                    'rating' => 4.9,
                                    'reviews' => 267,
                                    'price' => 60,
                                    'experience' => '18 years',
                                ],
                            ];
                        @endphp

                        @foreach ($doctors as $doc)
                            <div class="group h-full">
                                <div
                                    class="relative bg-gradient-to-br from-white/10 to-white/5 border border-white/20 rounded-2xl overflow-hidden hover:border-blue-400/50 transition transform hover:-translate-y-3 hover:shadow-2xl h-full flex flex-col cursor-pointer">
                                    <div
                                        class="relative overflow-hidden h-56 bg-gradient-to-br from-blue-400 to-purple-600">
                                        <img src="{{ $doc['img'] }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        <div
                                            class="absolute top-4 left-4 bg-black/40 backdrop-blur border border-white/20 rounded-full px-3 py-1 flex items-center gap-1">
                                            <svg class="h-4 w-4 fill-yellow-400" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            <span class="text-white font-bold text-sm">{{ $doc['rating'] }}</span>
                                        </div>
                                        <button
                                            class="absolute top-4 right-4 bg-white/90 hover:bg-white rounded-full p-3 shadow-lg transition transform hover:scale-110 active:scale-95">
                                            <svg class="h-5 w-5 text-red-500 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-6 flex-1 flex flex-col">
                                        <h3 class="text-xl font-bold text-white mb-1">{{ $doc['name'] }}</h3>
                                        <p class="text-blue-400 font-semibold text-sm mb-2">{{ $doc['spec'] }}</p>
                                        <p class="text-slate-400 text-sm mb-4">{{ $doc['experience'] }} experience</p>
                                        <div class="flex items-center gap-2 mb-4 text-sm">
                                            <span class="text-slate-300">{{ $doc['reviews'] }} reviews</span>
                                        </div>
                                        <div
                                            class="flex justify-between items-center py-4 border-t border-white/10 mb-4 flex-1">
                                            <span
                                                class="inline-flex items-center gap-1 bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs font-bold">
                                                <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                                {{ $doc['status'] }}
                                            </span>
                                            <span class="text-white font-bold">BDT {{ $doc['price'] }}</span>
                                        </div>
                                        <button
                                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg">
                                            Book Appointment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Final CTA -->
            <section class="py-20">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div
                        class="relative bg-gradient-to-br from-blue-600/40 to-purple-600/40 border border-blue-400/30 rounded-3xl p-12 text-center overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10 backdrop-blur-xl">
                        </div>
                        <div class="relative z-10">
                            <h2 class="text-4xl font-black text-white mb-4">Ready to Grow?</h2>
                            <p class="text-xl text-slate-200 mb-8 max-w-2xl mx-auto">
                                Join thousands of healthcare professionals earning more by connecting with patients on
                                our platform.
                            </p>
                            <a href="{{ route('doctor.request.form') }}"
                                class="inline-block px-10 py-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold text-lg rounded-xl transition transform hover:scale-105 active:scale-95 shadow-xl hover:shadow-2xl">
                                Register as a Doctor
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        function dashboardApp() {
            return {
                isLoading: false,
                hasSearched: false,
                search: {
                    query: '',
                    specialization: '',
                    location: '',
                    availability: '',
                    type: '',
                    maxPrice: ''
                },
                searchResults: [],
                totalResults: 0,
                currentPage: 1,
                lastPage: 1,

                async performSearch() {
                    this.isLoading = true;
                    this.hasSearched = true;
                    this.currentPage = 1;

                    try {
                        const params = new URLSearchParams();
                        if (this.search.query) params.append('query', this.search.query);
                        if (this.search.specialization) params.append('specialization', this.search.specialization);
                        if (this.search.location) params.append('location', this.search.location);
                        if (this.search.availability) params.append('availability', this.search.availability);
                        if (this.search.maxPrice) params.append('maxPrice', this.search.maxPrice);
                        params.append('page', this.currentPage);

                        const response = await fetch(`/doctors/search?${params}`);
                        const data = await response.json();

                        if (data.success) {
                            this.searchResults = data.doctors;
                            this.totalResults = data.total;
                            this.lastPage = data.last_page;
                            this.currentPage = data.current_page;
                        }
                    } catch (error) {
                        console.error('Search error:', error);
                        this.searchResults = [];
                    } finally {
                        this.isLoading = false;
                    }
                },

                clearSearch() {
                    this.hasSearched = false;
                    this.search = {
                        query: '',
                        specialization: '',
                        location: '',
                        availability: '',
                        type: '',
                        maxPrice: ''
                    };
                    this.searchResults = [];
                    this.currentPage = 1;
                },

                scrollToSearch() {
                    this.$refs.searchSection.scrollIntoView({
                        behavior: 'smooth'
                    });
                },

                nextPage() {
                    if (this.currentPage < this.lastPage) {
                        this.currentPage++;
                        this.performSearch();
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }
                },

                previousPage() {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                        this.performSearch();
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }
                },

                goToPage(page) {
                    this.currentPage = page;
                    this.performSearch();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                },

                get pages() {
                    const pages = [];
                    for (let i = 1; i <= this.lastPage; i++) {
                        pages.push(i);
                    }
                    return pages;
                }
            }
        }
    </script>
</x-app-layout>
<x-app-layout>
    <div x-data="dashboardApp()" class="min-h-screen bg-gradient-to-br from-slate-950 via-blue-950 to-slate-950">
        <!-- Animated Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse">
            </div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"
                style="animation-delay: 2s;"></div>
        </div>

        <div class="relative z-10">
            <!-- Premium Hero Section -->
            <section class="pt-20 pb-16 overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <!-- Hero Content -->
                        <div class="space-y-8">
                            <div class="space-y-4">
                                <div
                                    class="inline-flex items-center gap-3 bg-blue-500/10 border border-blue-400/30 rounded-full px-4 py-2">
                                    <span class="flex h-2 w-2 rounded-full bg-green-400 animate-pulse"></span>
                                    <span class="text-sm font-semibold text-blue-300">Connected with 10,000+
                                        doctors</span>
                                </div>
                                <h1 class="text-6xl lg:text-7xl font-black text-white leading-tight">
                                    Your Health,<br>
                                    <span
                                        class="bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-400 bg-clip-text text-transparent">Our
                                        Priority</span>
                                </h1>
                            </div>
                            <p class="text-xl text-slate-300 max-w-md leading-relaxed">
                                Access qualified healthcare professionals, book appointments instantly, and receive
                                expert consultations—all in one secure platform.
                            </p>
                            <div class="flex gap-4 pt-4">
                                <button @click="scrollToSearch()"
                                    class="px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition transform hover:scale-105 active:scale-95 shadow-xl hover:shadow-2xl">
                                    Find a Doctor
                                </button>
                                <a href="{{ route('doctor.request.form') }}"
                                    class="px-8 py-4 border-2 border-blue-400/50 text-blue-300 hover:text-blue-200 font-bold rounded-xl transition hover:border-blue-400 hover:bg-blue-400/10">
                                    Become a Doctor
                                </a>
                            </div>
                        </div>

                        <!-- Stats Cards -->
                        <div class="grid grid-cols-2 gap-4">
                            <div
                                class="bg-gradient-to-br from-blue-500/20 to-blue-500/5 border border-blue-400/20 rounded-2xl p-6 backdrop-blur hover:border-blue-400/50 transition group">
                                <div
                                    class="text-3xl font-black text-transparent bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                    10K+
                                </div>
                                <p class="text-slate-300 font-semibold">Verified Doctors</p>
                            </div>
                            <div
                                class="bg-gradient-to-br from-emerald-500/20 to-emerald-500/5 border border-emerald-400/20 rounded-2xl p-6 backdrop-blur hover:border-emerald-400/50 transition group">
                                <div
                                    class="text-3xl font-black text-transparent bg-gradient-to-r from-emerald-400 to-green-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                    50K+
                                </div>
                                <p class="text-slate-300 font-semibold">Happy Patients</p>
                            </div>
                            <div
                                class="bg-gradient-to-br from-purple-500/20 to-purple-500/5 border border-purple-400/20 rounded-2xl p-6 backdrop-blur hover:border-purple-400/50 transition group">
                                <div
                                    class="text-3xl font-black text-transparent bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                    98%
                                </div>
                                <p class="text-slate-300 font-semibold">Satisfaction Rate</p>
                            </div>
                            <div
                                class="bg-gradient-to-br from-yellow-500/20 to-yellow-500/5 border border-yellow-400/20 rounded-2xl p-6 backdrop-blur hover:border-yellow-400/50 transition group">
                                <div
                                    class="text-3xl font-black text-transparent bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                    24/7
                                </div>
                                <p class="text-slate-300 font-semibold">Support Available</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Advanced Search Panel -->
            <section class="py-8" x-ref="searchSection">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div
                        class="bg-gradient-to-br from-white/95 to-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 border border-white/20">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">Find Your Doctor</h2>
                        <form @submit.prevent="performSearch" class="space-y-6">
                            <!-- Main Search -->
                            <div class="flex gap-3">
                                <div class="flex-1 relative group">
                                    <svg class="absolute left-4 top-4 h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <input type="text" x-model="search.query"
                                        placeholder="Search by doctor name..."
                                        class="w-full pl-12 pr-4 py-4 border-2 border-slate-200 rounded-2xl focus:border-blue-500 focus:outline-none transition text-lg bg-white">
                                </div>
                                <button type="submit" :disabled="isLoading"
                                    class="px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-2xl transition transform hover:scale-105 active:scale-95 shadow-lg disabled:opacity-50">
                                    <svg v-if="!isLoading" class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <svg v-else class="h-5 w-5 animate-spin" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                        </path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Advanced Filters -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="group">
                                    <label class="block text-sm font-bold text-slate-700 mb-3">Specialization</label>
                                    <select x-model="search.specialization" @change="performSearch"
                                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                                        <option value="">All Specializations</option>
                                        <option value="cardiology">💚 Cardiology</option>
                                        <option value="dermatology">🩹 Dermatology</option>
                                        <option value="pediatrics">👶 Pediatrics</option>
                                        <option value="dentistry">😁 Dentistry</option>
                                        <option value="neurology">🧠 Neurology</option>
                                        <option value="orthopedics">🦴 Orthopedics</option>
                                    </select>
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-bold text-slate-700 mb-3">Location</label>
                                    <input type="text" x-model="search.location" @change="performSearch"
                                        placeholder="City or area..."
                                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-bold text-slate-700 mb-3">Availability</label>
                                    <select x-model="search.availability" @change="performSearch"
                                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                                        <option value="">All Times</option>
                                        <option value="today">📅 Available Today</option>
                                        <option value="tomorrow">📆 Tomorrow</option>
                                        <option value="week">📊 This Week</option>
                                        <option value="month">📈 This Month</option>
                                    </select>
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-bold text-slate-700 mb-3">Max Price</label>
                                    <input type="number" x-model="search.maxPrice" @change="performSearch"
                                        placeholder="Max price..."
                                        class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Search Results Section -->
            <section class="py-16" x-show="hasSearched">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Results Header -->
                    <div class="mb-12">
                        <h2 class="text-4xl font-black text-white mb-2">Search Results</h2>
                        <p class="text-lg text-slate-400">Found <span x-text="totalResults"></span> doctors matching
                            your criteria</p>
                        <button @click="clearSearch()"
                            class="mt-4 text-blue-400 hover:text-blue-300 font-bold flex items-center gap-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear Search
                        </button>
                    </div>

                    <!-- Loading State -->
                    <div v-if="isLoading" class="flex justify-center items-center py-20">
                        <div class="text-center">
                            <svg class="h-12 w-12 animate-spin text-blue-400 mx-auto mb-4" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            <p class="text-slate-300">Searching for doctors...</p>
                        </div>
                    </div>

                    <!-- No Results -->
                    <div v-else-if="!isLoading && searchResults.length === 0 && hasSearched"
                        class="text-center py-20">
                        <svg class="h-16 w-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-white mb-2">No doctors found</h3>
                        <p class="text-slate-400 mb-6">Try adjusting your search filters or specialization</p>
                    </div>

                    <!-- Results Grid -->
                    <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <template x-for="doc in searchResults" :key="doc.id">
                            <div class="group h-full">
                                <div
                                    class="relative bg-gradient-to-br from-white/10 to-white/5 border border-white/20 rounded-2xl overflow-hidden hover:border-blue-400/50 transition transform hover:-translate-y-3 hover:shadow-2xl h-full flex flex-col cursor-pointer">
                                    <!-- Image Section -->
                                    <div
                                        class="relative overflow-hidden h-56 bg-gradient-to-br from-blue-400 to-purple-600">
                                        <img :src="doc.img" :alt="doc.name"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                        <!-- Rating Badge -->
                                        <div
                                            class="absolute top-4 left-4 bg-black/40 backdrop-blur border border-white/20 rounded-full px-3 py-1 flex items-center gap-1">
                                            <svg class="h-4 w-4 fill-yellow-400" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            <span class="text-white font-bold text-sm" x-text="doc.rating"></span>
                                        </div>

                                        <!-- Favorite Button -->
                                        <button
                                            class="absolute top-4 right-4 bg-white/90 hover:bg-white rounded-full p-3 shadow-lg transition transform hover:scale-110 active:scale-95">
                                            <svg class="h-5 w-5 text-red-500 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Content Section -->
                                    <div class="p-6 flex-1 flex flex-col">
                                        <h3 class="text-xl font-bold text-white mb-1" x-text="doc.name"></h3>
                                        <p class="text-blue-400 font-semibold text-sm mb-2" x-text="doc.spec"></p>
                                        <p class="text-slate-400 text-sm mb-4" x-text="doc.experience"></p>

                                        <!-- Reviews -->
                                        <div class="flex items-center gap-2 mb-4 text-sm">
                                            <span class="text-slate-300" x-text="doc.reviews + ' reviews'"></span>
                                        </div>

                                        <!-- Status & Price -->
                                        <div
                                            class="flex justify-between items-center py-4 border-t border-white/10 mb-4 flex-1">
                                            <span
                                                class="inline-flex items-center gap-1 bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs font-bold">
                                                <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                                <span x-text="doc.status"></span>
                                            </span>
                                            <span class="text-white font-bold"><span
                                                    x-text="doc.price"></span></span>
                                        </div>

                                        <!-- CTA Button -->
                                        <button
                                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg">
                                            Book Appointment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Pagination -->
                    <div v-if="lastPage > 1 && searchResults.length > 0" class="flex justify-center gap-2 mt-12">
                        <button @click="previousPage()" :disabled="currentPage === 1"
                            class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg disabled:opacity-50">Previous</button>
                        <template x-for="page in pages" :key="page">
                            <button @click="goToPage(page)"
                                :class="currentPage === page ? 'bg-blue-600' : 'bg-white/10 hover:bg-white/20'"
                                class="px-4 py-2 text-white rounded-lg transition">
                                <span x-text="page"></span>
                            </button>
                        </template>
                        <button @click="nextPage()" :disabled="currentPage === lastPage"
                            class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg disabled:opacity-50">Next</button>
                    </div>
                </div>
            </section>

            <!-- Featured Doctors Section (when not searching) -->
            <section class="py-20 bg-white/5 backdrop-blur-sm" x-show="!hasSearched">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-end mb-12">
                        <div>
                            <h2 class="text-4xl font-black text-white mb-2">Top Recommended Doctors</h2>
                            <p class="text-lg text-slate-400">Highly rated professionals verified by our platform</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @php
                            $doctors = [
                                [
                                    'img' => 'https://randomuser.me/api/portraits/men/32.jpg',
                                    'name' => 'Dr. John Doe',
                                    'spec' => 'Cardiologist',
                                    'status' => 'Available',
                                    'rating' => 4.8,
                                    'reviews' => 245,
                                    'price' => 50,
                                    'experience' => '15 years',
                                ],
                                [
                                    'img' => 'https://randomuser.me/api/portraits/women/44.jpg',
                                    'name' => 'Dr. Jane Smith',
                                    'spec' => 'Dermatologist',
                                    'status' => 'Available',
                                    'rating' => 4.9,
                                    'reviews' => 312,
                                    'price' => 45,
                                    'experience' => '12 years',
                                ],
                                [
                                    'img' => 'https://randomuser.me/api/portraits/men/56.jpg',
                                    'name' => 'Dr. Robert Lee',
                                    'spec' => 'Pediatrician',
                                    'status' => 'Available',
                                    'rating' => 4.7,
                                    'reviews' => 189,
                                    'price' => 40,
                                    'experience' => '10 years',
                                ],
                                [
                                    'img' => 'https://randomuser.me/api/portraits/women/23.jpg',
                                    'name' => 'Dr. Sarah Wilson',
                                    'spec' => 'Neurologist',
                                    'status' => 'Available',
                                    'rating' => 4.9,
                                    'reviews' => 267,
                                    'price' => 60,
                                    'experience' => '18 years',
                                ],
                            ];
                        @endphp

                        @foreach ($doctors as $doc)
                            <div class="group h-full">
                                <div
                                    class="relative bg-gradient-to-br from-white/10 to-white/5 border border-white/20 rounded-2xl overflow-hidden hover:border-blue-400/50 transition transform hover:-translate-y-3 hover:shadow-2xl h-full flex flex-col cursor-pointer">
                                    <!-- Image Section -->
                                    <div
                                        class="relative overflow-hidden h-56 bg-gradient-to-br from-blue-400 to-purple-600">
                                        <img src="{{ $doc['img'] }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                        <!-- Rating Badge -->
                                        <div
                                            class="absolute top-4 left-4 bg-black/40 backdrop-blur border border-white/20 rounded-full px-3 py-1 flex items-center gap-1">
                                            <svg class="h-4 w-4 fill-yellow-400" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            <span class="text-white font-bold text-sm">{{ $doc['rating'] }}</span>
                                        </div>

                                        <!-- Favorite Button -->
                                        <button
                                            class="absolute top-4 right-4 bg-white/90 hover:bg-white rounded-full p-3 shadow-lg transition transform hover:scale-110 active:scale-95">
                                            <svg class="h-5 w-5 text-red-500 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Content Section -->
                                    <div class="p-6 flex-1 flex flex-col">
                                        <h3 class="text-xl font-bold text-white mb-1">{{ $doc['name'] }}</h3>
                                        <p class="text-blue-400 font-semibold text-sm mb-2">{{ $doc['spec'] }}</p>
                                        <p class="text-slate-400 text-sm mb-4">{{ $doc['experience'] }} experience</p>

                                        <!-- Reviews -->
                                        <div class="flex items-center gap-2 mb-4 text-sm">
                                            <span class="text-slate-300">{{ $doc['reviews'] }} reviews</span>
                                        </div>

                                        <!-- Status & Price -->
                                        <div
                                            class="flex justify-between items-center py-4 border-t border-white/10 mb-4 flex-1">
                                            <span
                                                class="inline-flex items-center gap-1 bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs font-bold">
                                                <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                                {{ $doc['status'] }}
                                            </span>
                                            <span class="text-white font-bold">BDT {{ $doc['price'] }}</span>
                                        </div>

                                        <!-- CTA Button -->
                                        <button
                                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg">
                                            Book Appointment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Final CTA -->
            <section class="py-20">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div
                        class="relative bg-gradient-to-br from-blue-600/40 to-purple-600/40 border border-blue-400/30 rounded-3xl p-12 text-center overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10 backdrop-blur-xl">
                        </div>
                        <div class="relative z-10">
                            <h2 class="text-4xl font-black text-white mb-4">Ready to Grow?</h2>
                            <p class="text-xl text-slate-200 mb-8 max-w-2xl mx-auto">
                                Join thousands of healthcare professionals earning more by connecting with patients on
                                our platform.
                            </p>
                            <a href="{{ route('doctor.request.form') }}"
                                class="inline-block px-10 py-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold text-lg rounded-xl transition transform hover:scale-105 active:scale-95 shadow-xl hover:shadow-2xl">
                                Register as a Doctor
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        function dashboardApp() {
            return {
                isLoading: false,
                hasSearched: false,
                search: {
                    query: '',
                    specialization: '',
                    location: '',
                    availability: '',
                    type: '',
                    maxPrice: ''
                },
                searchResults: [],
                totalResults: 0,
                currentPage: 1,
                lastPage: 1,

                async performSearch() {
                    this.isLoading = true;
                    this.hasSearched = true;

                    try {
                        const params = new URLSearchParams();
                        if (this.search.query) params.append('query', this.search.query);
                        if (this.search.specialization) params.append('specialization', this.search.specialization);
                        if (this.search.location) params.append('location', this.search.location);
                        if (this.search.availability) params.append('availability', this.search.availability);
                        if (this.search.maxPrice) params.append('maxPrice', this.search.maxPrice);
                        params.append('page', this.currentPage);

                        const response = await fetch(`/doctors/search?${params}`);
                        const data = await response.json();

                        if (data.success) {
                            this.searchResults = data.doctors;
                            this.totalResults = data.total;
                            this.lastPage = data.last_page;
                            this.currentPage = data.current_page;
                        }
                    } catch (error) {
                        console.error('Search error:', error);
                        this.searchResults = [];
                    } finally {
                        this.isLoading = false;
                    }
                },

                clearSearch() {
                    this.hasSearched = false;
                    this.search = {
                        query: '',
                        specialization: '',
                        location: '',
                        availability: '',
                        type: '',
                        maxPrice: ''
                    };
                    this.searchResults = [];
                    this.currentPage = 1;
                },

                scrollToSearch() {
                    this.$refs.searchSection.scrollIntoView({
                        behavior: 'smooth'
                    });
                },

                nextPage() {
                    if (this.currentPage < this.lastPage) {
                        this.currentPage++;
                        this.performSearch();
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }
                },

                previousPage() {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                        this.performSearch();
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }
                },

                goToPage(page) {
                    this.currentPage = page;
                    this.performSearch();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                },

                get pages() {
                    const pages = [];
                    for (let i = 1; i <= this.lastPage; i++) {
                        pages.push(i);
                    }
                    return pages;
                }
            }
        }
    </script>
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div
            class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse">
        </div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"
            style="animation-delay: 2s;"></div>
    </div>

    <div class="relative z-10">
        <!-- Premium Hero Section -->
        <section class="pt-20 pb-16 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Hero Content -->
                    <div class="space-y-8">
                        <div class="space-y-4">
                            <div
                                class="inline-flex items-center gap-3 bg-blue-500/10 border border-blue-400/30 rounded-full px-4 py-2">
                                <span class="flex h-2 w-2 rounded-full bg-green-400 animate-pulse"></span>
                                <span class="text-sm font-semibold text-blue-300">Connected with 10,000+
                                    doctors</span>
                            </div>
                            <h1 class="text-6xl lg:text-7xl font-black text-white leading-tight">
                                Your Health,<br>
                                <span
                                    class="bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-400 bg-clip-text text-transparent">Our
                                    Priority</span>
                            </h1>
                        </div>
                        <p class="text-xl text-slate-300 max-w-md leading-relaxed">
                            Access qualified healthcare professionals, book appointments instantly, and receive
                            expert consultations—all in one secure platform.
                        </p>
                        <div class="flex gap-4 pt-4">
                            <button @click="searchActive = true"
                                class="px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl transition transform hover:scale-105 active:scale-95 shadow-xl hover:shadow-2xl">
                                Find a Doctor
                            </button>
                            <a href="{{ route('doctor.request.form') }}"
                                class="px-8 py-4 border-2 border-blue-400/50 text-blue-300 hover:text-blue-200 font-bold rounded-xl transition hover:border-blue-400 hover:bg-blue-400/10">
                                Become a Doctor
                            </a>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="bg-gradient-to-br from-blue-500/20 to-blue-500/5 border border-blue-400/20 rounded-2xl p-6 backdrop-blur hover:border-blue-400/50 transition group">
                            <div
                                class="text-3xl font-black text-transparent bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                10K+
                            </div>
                            <p class="text-slate-300 font-semibold">Verified Doctors</p>
                        </div>
                        <div
                            class="bg-gradient-to-br from-emerald-500/20 to-emerald-500/5 border border-emerald-400/20 rounded-2xl p-6 backdrop-blur hover:border-emerald-400/50 transition group">
                            <div
                                class="text-3xl font-black text-transparent bg-gradient-to-r from-emerald-400 to-green-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                50K+
                            </div>
                            <p class="text-slate-300 font-semibold">Happy Patients</p>
                        </div>
                        <div
                            class="bg-gradient-to-br from-purple-500/20 to-purple-500/5 border border-purple-400/20 rounded-2xl p-6 backdrop-blur hover:border-purple-400/50 transition group">
                            <div
                                class="text-3xl font-black text-transparent bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                98%
                            </div>
                            <p class="text-slate-300 font-semibold">Satisfaction Rate</p>
                        </div>
                        <div
                            class="bg-gradient-to-br from-yellow-500/20 to-yellow-500/5 border border-yellow-400/20 rounded-2xl p-6 backdrop-blur hover:border-yellow-400/50 transition group">
                            <div
                                class="text-3xl font-black text-transparent bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text mb-2 group-hover:scale-110 transition">
                                24/7
                            </div>
                            <p class="text-slate-300 font-semibold">Support Available</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Advanced Search Panel -->
        <section class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-gradient-to-br from-white/95 to-white/90 backdrop-blur rounded-3xl shadow-2xl p-8 border border-white/20">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Find Your Doctor</h2>
                    <form @submit.prevent="performSearch" class="space-y-6">
                        <!-- Main Search -->
                        <div class="flex gap-3">
                            <div class="flex-1 relative group">
                                <svg class="absolute left-4 top-4 h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input type="text" x-model="search.query"
                                    placeholder="Search by doctor name, specialty, or location..."
                                    class="w-full pl-12 pr-4 py-4 border-2 border-slate-200 rounded-2xl focus:border-blue-500 focus:outline-none transition text-lg bg-white">
                            </div>
                            <button type="submit"
                                class="px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-2xl transition transform hover:scale-105 active:scale-95 shadow-lg">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Advanced Filters -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 mb-3">Specialization</label>
                                <select x-model="search.specialization"
                                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                                    <option value="">All Specializations</option>
                                    <option value="cardiology">💚 Cardiology</option>
                                    <option value="dermatology">🩹 Dermatology</option>
                                    <option value="pediatrics">👶 Pediatrics</option>
                                    <option value="dentistry">😁 Dentistry</option>
                                    <option value="neurology">🧠 Neurology</option>
                                    <option value="orthopedics">🦴 Orthopedics</option>
                                </select>
                            </div>

                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 mb-3">Availability</label>
                                <select x-model="search.availability"
                                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                                    <option value="">All Times</option>
                                    <option value="today">📅 Available Today</option>
                                    <option value="tomorrow">📆 Tomorrow</option>
                                    <option value="week">📊 This Week</option>
                                    <option value="month">📈 This Month</option>
                                </select>
                            </div>

                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 mb-3">Consultation Type</label>
                                <select x-model="search.type"
                                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                                    <option value="">All Types</option>
                                    <option value="online">🎥 Video Call</option>
                                    <option value="clinic">🏥 In-Clinic</option>
                                    <option value="home">🏠 Home Visit</option>
                                </select>
                            </div>

                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 mb-3">Price Range</label>
                                <input type="number" x-model="search.maxPrice" placeholder="Max price..."
                                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:border-blue-500 focus:outline-none transition bg-white font-medium">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Specializations Grid -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-4xl font-black text-white mb-2">Browse Specializations</h2>
                        <p class="text-lg text-slate-400">Find doctors by medical specialty</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @php
                        $specialties = [
                            ['icon' => '❤️', 'title' => 'Cardiology', 'count' => '234 docs'],
                            ['icon' => '🧬', 'title' => 'Dermatology', 'count' => '189 docs'],
                            ['icon' => '👶', 'title' => 'Pediatrics', 'count' => '156 docs'],
                            ['icon' => '😁', 'title' => 'Dentistry', 'count' => '312 docs'],
                            ['icon' => '🧠', 'title' => 'Neurology', 'count' => '142 docs'],
                            ['icon' => '👁️', 'title' => 'Ophthalmology', 'count' => '98 docs'],
                        ];
                    @endphp

                    @foreach ($specialties as $specialty)
                        <button
                            @click="search.specialization='{{ strtolower($specialty['title']) }}'; performSearch()"
                            class="group bg-gradient-to-br from-white/10 to-white/5 hover:from-blue-600/30 hover:to-blue-500/20 border border-white/20 hover:border-blue-400/50 rounded-2xl p-6 text-center transition transform hover:-translate-y-2 hover:shadow-xl cursor-pointer">
                            <div class="text-5xl mb-3 group-hover:scale-125 transition duration-300">
                                {{ $specialty['icon'] }}</div>
                            <h3 class="font-bold text-white text-base mb-1 group-hover:text-blue-300 transition">
                                {{ $specialty['title'] }}</h3>
                            <p class="text-sm text-slate-400 group-hover:text-slate-300 transition">
                                {{ $specialty['count'] }}</p>
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Top Recommended Doctors -->
        <section class="py-20 bg-white/5 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-4xl font-black text-white mb-2">Top Recommended Doctors</h2>
                        <p class="text-lg text-slate-400">Highly rated professionals verified by our platform</p>
                    </div>
                    <button @click="viewAll='doctors'"
                        class="hidden md:flex text-blue-400 hover:text-blue-300 font-bold items-center gap-2 group">
                        View All <svg class="h-5 w-5 group-hover:translate-x-2 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $doctors = [
                            [
                                'img' => 'https://randomuser.me/api/portraits/men/32.jpg',
                                'name' => 'Dr. John Doe',
                                'spec' => 'Cardiologist',
                                'status' => 'Available',
                                'rating' => 4.8,
                                'reviews' => 245,
                                'price' => 50,
                                'experience' => '15 years',
                            ],
                            [
                                'img' => 'https://randomuser.me/api/portraits/women/44.jpg',
                                'name' => 'Dr. Jane Smith',
                                'spec' => 'Dermatologist',
                                'status' => 'Available',
                                'rating' => 4.9,
                                'reviews' => 312,
                                'price' => 45,
                                'experience' => '12 years',
                            ],
                            [
                                'img' => 'https://randomuser.me/api/portraits/men/56.jpg',
                                'name' => 'Dr. Robert Lee',
                                'spec' => 'Pediatrician',
                                'status' => 'Available',
                                'rating' => 4.7,
                                'reviews' => 189,
                                'price' => 40,
                                'experience' => '10 years',
                            ],
                            [
                                'img' => 'https://randomuser.me/api/portraits/women/23.jpg',
                                'name' => 'Dr. Sarah Wilson',
                                'spec' => 'Neurologist',
                                'status' => 'Available',
                                'rating' => 4.9,
                                'reviews' => 267,
                                'price' => 60,
                                'experience' => '18 years',
                            ],
                        ];
                    @endphp

                    @foreach ($doctors as $doc)
                        <div class="group h-full">
                            <div
                                class="relative bg-gradient-to-br from-white/10 to-white/5 border border-white/20 rounded-2xl overflow-hidden hover:border-blue-400/50 transition transform hover:-translate-y-3 hover:shadow-2xl h-full flex flex-col cursor-pointer">
                                <!-- Image Section -->
                                <div
                                    class="relative overflow-hidden h-56 bg-gradient-to-br from-blue-400 to-purple-600">
                                    <img src="{{ $doc['img'] }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                    <!-- Rating Badge -->
                                    <div
                                        class="absolute top-4 left-4 bg-black/40 backdrop-blur border border-white/20 rounded-full px-3 py-1 flex items-center gap-1">
                                        <svg class="h-4 w-4 fill-yellow-400" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <span class="text-white font-bold text-sm">{{ $doc['rating'] }}</span>
                                    </div>

                                    <!-- Favorite Button -->
                                    <button
                                        class="absolute top-4 right-4 bg-white/90 hover:bg-white rounded-full p-3 shadow-lg transition transform hover:scale-110 active:scale-95">
                                        <svg class="h-5 w-5 text-red-500 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Content Section -->
                                <div class="p-6 flex-1 flex flex-col">
                                    <h3 class="text-xl font-bold text-white mb-1">{{ $doc['name'] }}</h3>
                                    <p class="text-blue-400 font-semibold text-sm mb-2">{{ $doc['spec'] }}</p>
                                    <p class="text-slate-400 text-sm mb-4">{{ $doc['experience'] }} experience</p>

                                    <!-- Reviews -->
                                    <div class="flex items-center gap-2 mb-4 text-sm">
                                        <span class="text-slate-300">{{ $doc['reviews'] }} reviews</span>
                                    </div>

                                    <!-- Status & Price -->
                                    <div
                                        class="flex justify-between items-center py-4 border-t border-white/10 mb-4 flex-1">
                                        <span
                                            class="inline-flex items-center gap-1 bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs font-bold">
                                            <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                            {{ $doc['status'] }}
                                        </span>
                                        <span class="text-white font-bold">BDT {{ $doc['price'] }}</span>
                                    </div>

                                    <!-- CTA Button -->
                                    <button
                                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg">
                                        Book Appointment
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Services Grid -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12">
                    <h2 class="text-4xl font-black text-white mb-2">Our Services</h2>
                    <p class="text-lg text-slate-400">Complete healthcare solutions at your fingertips</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        $services = [
                            [
                                'icon' => '💬',
                                'title' => 'Video Consultation',
                                'desc' => 'Face-to-face consultations with certified doctors',
                            ],
                            [
                                'icon' => '🧪',
                                'title' => 'Lab Tests',
                                'desc' => 'Order tests with home sample collection',
                            ],
                            [
                                'icon' => '💊',
                                'title' => 'E-Prescription',
                                'desc' => 'Digital prescriptions delivered instantly',
                            ],
                            [
                                'icon' => '📊',
                                'title' => 'Health Records',
                                'desc' => 'Secure cloud storage for medical records',
                            ],
                            [
                                'icon' => '📱',
                                'title' => 'Appointment Sync',
                                'desc' => 'Calendar sync and smart reminders',
                            ],
                            [
                                'icon' => '🎯',
                                'title' => 'Health Tracking',
                                'desc' => 'Monitor your vitals and health metrics',
                            ],
                        ];
                    @endphp

                    @foreach ($services as $service)
                        <div
                            class="group bg-gradient-to-br from-white/10 to-white/5 border border-white/20 hover:border-blue-400/50 rounded-2xl p-8 transition transform hover:-translate-y-2 hover:shadow-xl cursor-pointer">
                            <div class="text-5xl mb-4 group-hover:scale-125 transition duration-300">
                                {{ $service['icon'] }}</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-blue-300 transition">
                                {{ $service['title'] }}</h3>
                            <p class="text-slate-400 leading-relaxed">{{ $service['desc'] }}</p>
                            <div
                                class="mt-4 flex items-center text-blue-400 opacity-0 group-hover:opacity-100 transition gap-2">
                                <span class="font-semibold">Learn more</span>
                                <svg class="h-4 w-4 group-hover:translate-x-2 transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-20 bg-white/5 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-black text-white mb-2">What Our Patients Say</h2>
                    <p class="text-lg text-slate-400">Real stories from satisfied users</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $testimonials = [
                            [
                                'name' => 'Sarah Johnson',
                                'role' => 'Patient',
                                'text' =>
                                    'Amazing service! Found the perfect doctor within minutes and got my consultation scheduled instantly.',
                                'rating' => 5,
                                'img' => 'https://randomuser.me/api/portraits/women/1.jpg',
                            ],
                            [
                                'name' => 'Mike Chen',
                                'role' => 'Patient',
                                'text' =>
                                    'The platform is incredibly user-friendly. Customer support is responsive and helpful.',
                                'rating' => 5,
                                'img' => 'https://randomuser.me/api/portraits/men/2.jpg',
                            ],
                            [
                                'name' => 'Dr. Emma Wilson',
                                'role' => 'Doctor',
                                'text' =>
                                    'As a healthcare provider, this platform has transformed how I connect with patients and manage my practice.',
                                'rating' => 5,
                                'img' => 'https://randomuser.me/api/portraits/women/3.jpg',
                            ],
                        ];
                    @endphp

                    @foreach ($testimonials as $testimonial)
                        <div
                            class="bg-gradient-to-br from-white/10 to-white/5 border border-white/20 rounded-2xl p-8 hover:border-blue-400/50 transition transform hover:-translate-y-2">
                            <div class="flex gap-1 mb-4">
                                @for ($i = 0; $i < $testimonial['rating']; $i++)
                                    <svg class="h-5 w-5 fill-yellow-400" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-white leading-relaxed mb-6 italic">"{{ $testimonial['text'] }}"</p>
                            <div class="flex items-center gap-4">
                                <img src="{{ $testimonial['img'] }}"
                                    class="h-12 w-12 rounded-full object-cover border-2 border-blue-400/50">
                                <div>
                                    <p class="font-bold text-white">{{ $testimonial['name'] }}</p>
                                    <p class="text-sm text-slate-400">{{ $testimonial['role'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="py-20">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="relative bg-gradient-to-br from-blue-600/40 to-purple-600/40 border border-blue-400/30 rounded-3xl p-12 text-center overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10 backdrop-blur-xl">
                    </div>
                    <div class="relative z-10">
                        <h2 class="text-4xl font-black text-white mb-4">Ready to Grow?</h2>
                        <p class="text-xl text-slate-200 mb-8 max-w-2xl mx-auto">
                            Join thousands of healthcare professionals earning more by connecting with patients on
                            our platform.
                        </p>
                        <a href="{{ route('doctor.request.form') }}"
                            class="inline-block px-10 py-4 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold text-lg rounded-xl transition transform hover:scale-105 active:scale-95 shadow-xl hover:shadow-2xl">
                            Register as a Doctor
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>

    <script>
        function dashboardApp() {
            return {
                searchActive: false,
                search: {
                    query: '',
                    specialization: '',
                    availability: '',
                    type: '',
                    maxPrice: ''
                },
                viewAll: '',
                favorites: [],

                performSearch() {
                    console.log('Searching with:', this.search);
                    // Add your search logic here
                },

                toggleFavorites() {
                    this.viewAll = this.viewAll === 'favorites' ? '' : 'favorites';
                },

                toggleFavDoctor(index) {
                    if (this.favorites.includes(index)) {
                        this.favorites = this.favorites.filter(i => i !== index);
                    } else {
                        this.favorites.push(index);
                    }
                }
            }
        }
    </script>
</x-app-layout>
