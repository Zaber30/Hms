<x-app-layout>
    <div x-data="dashboardApp()"
        class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-950 dark:to-slate-900">
        <!-- Header Section -->
        <section class="relative overflow-hidden pt-16 pb-20">
            <!-- Background Gradient -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-blue-700 to-purple-700 opacity-95"></div>

            <!-- Animated Shapes with Glassmorphism -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -mr-40 -mt-40 blur-3xl backdrop-blur">
            </div>
            <div
                class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full -ml-40 -mb-40 blur-3xl backdrop-blur">
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-5xl lg:text-6xl font-black text-white mb-6 leading-tight">
                        Welcome to<br>
                        <span class="text-blue-200">Your Health Portal</span>
                    </h1>
                    <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                        Connect with verified healthcare professionals and manage your appointments effortlessly
                    </p>
                </div>

                <!-- Quick Action Cards with Subtle Glassmorphism -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-12">
                    <div
                        class="bg-white/10 backdrop-blur-sm border border-white/30 rounded-xl p-6 hover:bg-white/20 hover:border-white/40 transition-all duration-300 group cursor-pointer shadow-lg">
                        <div class="text-3xl mb-2">🔍</div>
                        <h3 class="text-white font-bold text-lg">Find Doctors</h3>
                        <p class="text-blue-100 text-sm mt-1">Search specialized doctors</p>
                    </div>

                    <a href="{{ route('patient.my-bookings') }}"
                        class="bg-white/10 backdrop-blur-sm border border-white/30 rounded-xl p-6 hover:bg-white/20 hover:border-white/40 transition-all duration-300 group cursor-pointer block shadow-lg">
                        <div class="text-3xl mb-2">📅</div>
                        <h3 class="text-white font-bold text-lg">Appointments</h3>
                        <p class="text-blue-100 text-sm mt-1">Book your consultations</p>
                    </a>

                    <div
                        class="bg-white/10 backdrop-blur-sm border border-white/30 rounded-xl p-6 hover:bg-white/20 hover:border-white/40 transition-all duration-300 group cursor-pointer shadow-lg">
                        <div class="text-3xl mb-2">📋</div>
                        <h3 class="text-white font-bold text-lg">My Bookings</h3>
                        <p class="text-blue-100 text-sm mt-1">Manage your bookings</p>
                    </div>

                    <div
                        class="bg-white/10 backdrop-blur-sm border border-white/30 rounded-xl p-6 hover:bg-white/20 hover:border-white/40 transition-all duration-300 group cursor-pointer shadow-lg">
                        <div class="text-3xl mb-2">👤</div>
                        <h3 class="text-white font-bold text-lg">Profile</h3>
                        <p class="text-blue-100 text-sm mt-1">Manage your profile</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Search Section with Glassmorphism -->
        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-2xl shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-8">Find Your Doctor</h2>
                    <form @submit.prevent="performSearch" class="space-y-6">
                        <!-- Main Search -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative">
                                <label
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Doctor
                                    Name</label>
                                <div class="relative">
                                    <svg class="absolute left-3 top-3 h-5 w-5 text-slate-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <input type="text" x-model="search.query"
                                        @input="fetchDoctorSuggestions(); performSearch()"
                                        @focus="showDoctorSuggestions = true; if (search.query.length >= 2) fetchDoctorSuggestions()"
                                        @blur="setTimeout(() => showDoctorSuggestions = false, 300)"
                                        placeholder="Search by doctor name..." autocomplete="off"
                                        class="w-full pl-10 pr-4 py-3 border-2 border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none transition">

                                    <!-- Doctor Name Suggestions -->
                                    <div x-show="showDoctorSuggestions && doctorSuggestions.length > 0"
                                        class="absolute top-full left-0 right-0 mt-2 bg-white/90 dark:bg-slate-700/90 backdrop-blur-sm border-2 border-slate-200 dark:border-slate-600 rounded-lg shadow-lg z-10 max-h-64 overflow-y-auto">
                                        <template x-for="doctor in doctorSuggestions" :key="doctor.id">
                                            <button type="button" @click="selectDoctor(doctor)"
                                                class="w-full text-left px-4 py-3 hover:bg-blue-50 dark:hover:bg-slate-600 border-b border-slate-100 dark:border-slate-600 last:border-0 transition">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <p class="font-semibold text-slate-900 dark:text-white"
                                                            x-text="doctor.name"></p>
                                                        <p class="text-sm text-slate-600 dark:text-slate-400"
                                                            x-text="doctor.spec"></p>
                                                    </div>
                                                </div>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <div class="relative">
                                <label
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Specialization</label>
                                <input type="text" x-model="search.specialization"
                                    @input="fetchSpecializationSuggestions(); performSearch()"
                                    @focus="showSpecSuggestions = true; if (search.specialization.length >= 2) fetchSpecializationSuggestions()"
                                    @blur="setTimeout(() => showSpecSuggestions = false, 300)"
                                    placeholder="Search specialization..." autocomplete="off"
                                    class="w-full px-4 py-3 border-2 border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none transition">

                                <!-- Specialization Suggestions -->
                                <div x-show="showSpecSuggestions && specializationSuggestions.length > 0"
                                    class="absolute top-full left-0 right-0 mt-2 bg-white/90 dark:bg-slate-700/90 backdrop-blur-sm border-2 border-slate-200 dark:border-slate-600 rounded-lg shadow-lg z-10 max-h-48 overflow-y-auto">
                                    <template x-for="spec in specializationSuggestions" :key="spec">
                                        <button type="button"
                                            @click="search.specialization = spec; showSpecSuggestions = false; performSearch()"
                                            class="w-full text-left px-4 py-3 hover:bg-blue-50 dark:hover:bg-slate-600 border-b border-slate-100 dark:border-slate-600 last:border-0 transition text-slate-900 dark:text-white"
                                            x-text="spec">
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Filters -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="relative">
                                <label
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Location</label>
                                <input type="text" x-model="search.location"
                                    @input="fetchLocationSuggestions(); performSearch()"
                                    @focus="showLocationSuggestions = true; if (search.location.length >= 2) fetchLocationSuggestions()"
                                    @blur="setTimeout(() => showLocationSuggestions = false, 300)"
                                    placeholder="City or area..." autocomplete="off"
                                    class="w-full px-4 py-3 border-2 border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none transition">

                                <!-- Location Suggestions -->
                                <div x-show="showLocationSuggestions && locationSuggestions.length > 0"
                                    class="absolute top-full left-0 right-0 mt-2 bg-white/90 dark:bg-slate-700/90 backdrop-blur-sm border-2 border-slate-200 dark:border-slate-600 rounded-lg shadow-lg z-10 max-h-48 overflow-y-auto">
                                    <template x-for="location in locationSuggestions" :key="location">
                                        <button type="button"
                                            @click="search.location = location; showLocationSuggestions = false; performSearch()"
                                            class="w-full text-left px-4 py-3 hover:bg-blue-50 dark:hover:bg-slate-600 border-b border-slate-100 dark:border-slate-600 last:border-0 transition text-slate-900 dark:text-white"
                                            x-text="location">
                                        </button>
                                    </template>
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Availability</label>
                                <select x-model="search.availability" @change="performSearch()"
                                    class="w-full px-4 py-3 border-2 border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none transition">
                                    <option value="">All Times</option>
                                    <option value="today">Available Today</option>
                                    <option value="tomorrow">Tomorrow</option>
                                    <option value="week">This Week</option>
                                    <option value="month">This Month</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Max
                                    Price</label>
                                <input type="number" x-model="search.maxPrice" @change="performSearch()"
                                    placeholder="Max price..."
                                    class="w-full px-4 py-3 border-2 border-slate-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:border-blue-500 focus:outline-none transition">
                            </div>
                        </div>

                        <!-- Search Button -->
                        <button type="submit" :disabled="isLoading"
                            class="w-full md:w-auto px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-lg transition transform hover:scale-105 active:scale-95 shadow-lg disabled:opacity-50">
                            <span x-show="!isLoading">Search Doctors</span>
                            <span x-show="isLoading" class="flex items-center gap-2 justify-center">
                                <svg class="h-5 w-5 animate-spin" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Searching...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Search Results Section -->
        <section class="py-12" x-show="hasSearched">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Results Header -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">Search Results</h2>
                        <p class="text-slate-600 dark:text-slate-400">Found <span
                                class="font-bold text-blue-600 dark:text-blue-400" x-text="totalResults"></span>
                            doctors</p>
                    </div>
                    <button @click="clearSearch()"
                        class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-bold flex items-center gap-2">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Clear Search
                    </button>
                </div>

                <!-- Loading State -->
                <div x-show="isLoading" class="flex justify-center items-center py-20">
                    <div class="text-center">
                        <svg class="h-12 w-12 animate-spin text-blue-600 mx-auto mb-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        <p class="text-slate-600 dark:text-slate-400">Searching for doctors...</p>
                    </div>
                </div>

                <!-- No Results -->
                <div x-show="!isLoading && searchResults.length === 0" class="text-center py-20">
                    <svg class="h-16 w-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">No doctors found</h3>
                    <p class="text-slate-600 dark:text-slate-400">Try adjusting your search filters</p>
                </div>

                <!-- Results Grid -->
                <div x-show="!isLoading && searchResults.length > 0"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="doc in searchResults" :key="doc.id">
                        <div class="group h-full">
                            <div
                                class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-2xl overflow-hidden hover:shadow-xl transition h-full flex flex-col shadow-lg hover:bg-white dark:hover:bg-slate-800">
                                <!-- Image Section -->
                                <div
                                    class="relative overflow-hidden h-56 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center p-6">
                                    <img :src="doc.img" :alt="doc.name"
                                        class="w-48 h-48 object-cover rounded-full shadow-xl border-4 border-white group-hover:scale-110 transition duration-500">
                                    <!-- Rating Badge -->
                                    <div
                                        class="absolute top-4 left-4 bg-white/90 backdrop-blur rounded-full px-3 py-1 flex items-center gap-1 shadow-lg">
                                        <svg class="h-4 w-4 fill-yellow-400" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <span class="font-bold text-sm" x-text="doc.rating"></span>
                                    </div>
                                </div>

                                <!-- Content Section -->
                                <div class="p-6 flex-1 flex flex-col">
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1"
                                        x-text="doc.name"></h3>
                                    <p class="text-blue-600 dark:text-blue-400 font-semibold text-sm mb-2"
                                        x-text="doc.spec"></p>
                                    <p class="text-slate-600 dark:text-slate-400 text-sm mb-4"
                                        x-text="doc.experience"></p>

                                    <!-- Reviews -->
                                    <div
                                        class="flex items-center gap-2 mb-4 text-sm text-slate-600 dark:text-slate-400">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <span x-text="doc.reviews + ' reviews'"></span>
                                    </div>

                                    <!-- Status & Price -->
                                    <div
                                        class="flex justify-between items-center py-4 border-t border-slate-200 dark:border-slate-700 mb-4">
                                        <span
                                            class="inline-flex items-center gap-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-3 py-1 rounded-full text-xs font-bold">
                                            <span class="w-2 h-2 bg-green-600 dark:bg-green-400 rounded-full"></span>
                                            <span x-text="doc.status"></span>
                                        </span>
                                        <span class="text-slate-900 dark:text-white font-bold"><span
                                                x-text="'BDT ' + doc.price"></span><span
                                                class="text-sm text-slate-600 dark:text-slate-400"></span></span>
                                    </div>

                                    <!-- CTA Button -->
                                    <a :href="`/patient/doctor/${doc.id}/schedules`"
                                        class="w-full block text-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 rounded-lg transition transform hover:scale-105 active:scale-95 shadow-lg">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- Top Doctors Section -->
        <section class="py-20 bg-slate-100 dark:bg-slate-800/50" x-show="!hasSearched">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 dark:text-white mb-2">Top Recommended Doctors</h2>
                    <p class="text-lg text-slate-600 dark:text-slate-400">Highly rated healthcare professionals</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($doctors as $doc)
                        <div
                            class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition hover:bg-white dark:hover:bg-slate-800">
                            <div <div
                                class="h-56 bg-gradient-to-br from-blue-500 to-purple-600 relative overflow-hidden flex items-center justify-center p-6">
                                <img src="{{ $doc['img'] }}"
                                    class="w-48 h-48 object-cover rounded-full shadow-xl border-4 border-white hover:scale-110 transition duration-500">
                                <div
                                    class="absolute top-4 left-4 bg-white/90 backdrop-blur rounded-full px-3 py-1 flex items-center gap-1 shadow-lg">
                                    <svg class="h-4 w-4 fill-yellow-400" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <span class="font-bold text-sm">{{ $doc['rating'] }}</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1">{{ $doc['name'] }}
                                </h3>
                                <p class="text-blue-600 dark:text-blue-400 font-semibold text-sm mb-4">
                                    {{ $doc['spec'] }}</p>
                                <p class="text-slate-600 dark:text-slate-400 text-sm mb-4">{{ $doc['experience'] }}</p>
                                <div class="flex items-center gap-2 mb-4 text-sm text-slate-600 dark:text-slate-400">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <span>{{ $doc['reviews'] }} reviews</span>
                                </div>
                                <div
                                    class="flex justify-between items-center py-4 border-t border-slate-200 dark:border-slate-700 mb-4">
                                    <span
                                        class="text-slate-900 dark:text-white font-bold">BDT {{ $doc['price'] }}</span>
                                </div>
                                <button
                                    onclick="window.location.href='{{ route('patient.doctor-schedules', ['doctorId' => 0]) }}'.replace('/0', '/' + this.dataset.doctorId)"
                                    data-doctor-id="{{ $doc['id'] }}"
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 rounded-lg transition transform hover:scale-105 active:scale-95 shadow-lg">
                                    Book Appointment
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Available Doctors Section -->
        @if ($availableDoctors->count() > 0)
            <section class="py-20" x-show="!hasSearched">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mb-12">
                        <h2 class="text-4xl font-bold text-slate-900 dark:text-white mb-2">Available Doctors Today</h2>
                        <p class="text-lg text-slate-600 dark:text-slate-400">Doctors with available time slots</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($availableDoctors as $doc)
                            <div
                                class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm border-2 border-green-200/50 dark:border-green-900/50 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition hover:bg-white dark:hover:bg-slate-800">
                                <div
                                    class="h-56 bg-gradient-to-br from-green-500 to-emerald-600 relative overflow-hidden flex items-center justify-center p-6">
                                    <img src="{{ $doc['img'] }}"
                                        class="w-48 h-48 object-cover rounded-full shadow-xl border-4 border-white hover:scale-110 transition duration-500">
                                    <div
                                        class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        🟢 Available
                                    </div>
                                    <div
                                        class="absolute top-4 left-4 bg-white/90 backdrop-blur rounded-full px-3 py-1 flex items-center gap-1 shadow-lg">
                                        <svg class="h-4 w-4 fill-yellow-400" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <span class="font-bold text-sm">{{ $doc['rating'] }}</span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1">
                                        {{ $doc['name'] }}
                                    </h3>
                                    <p class="text-blue-600 dark:text-blue-400 font-semibold text-sm mb-2">
                                        {{ $doc['spec'] }}</p>
                                    <p class="text-slate-600 dark:text-slate-400 text-xs mb-2">{{ $doc['location'] }}
                                    </p>
                                    <p class="text-slate-600 dark:text-slate-400 text-sm mb-4">
                                        {{ $doc['experience'] }}</p>
                                    <div
                                        class="flex justify-between items-center py-4 border-t border-slate-200 dark:border-slate-700 mb-4">
                                        <span
                                            class="text-slate-900 dark:text-white font-bold">BDT {{ $doc['price'] }}</span>
                                    </div>
                                    <button
                                        onclick="window.location.href='{{ route('patient.doctor-schedules', ['doctorId' => 0]) }}'.replace('/0', '/' + this.dataset.doctorId)"
                                        data-doctor-id="{{ $doc['id'] }}"
                                        class="w-full bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-bold py-3 rounded-lg transition transform hover:scale-105 active:scale-95 shadow-lg">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Why Choose Us -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-slate-900 dark:text-white mb-4">Why Choose Us?</h2>
                    <p class="text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">We are committed to
                        providing the best healthcare experience</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div
                            class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 dark:bg-blue-900/30 mb-4">
                            <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Verified Professionals</h3>
                        <p class="text-slate-600 dark:text-slate-400">All doctors are certified and verified by medical
                            authorities</p>
                    </div>

                    <div class="text-center">
                        <div
                            class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-green-100 dark:bg-green-900/30 mb-4">
                            <svg class="h-8 w-8 text-green-600 dark:text-green-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Easy Scheduling</h3>
                        <p class="text-slate-600 dark:text-slate-400">Book appointments instantly and manage your
                            schedule effortlessly</p>
                    </div>

                    <div class="text-center">
                        <div
                            class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 dark:bg-purple-900/30 mb-4">
                            <svg class="h-8 w-8 text-purple-600 dark:text-purple-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Secure & Private</h3>
                        <p class="text-slate-600 dark:text-slate-400">Your data is protected with advanced security
                            measures</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-700">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold text-white mb-4">Ready to Get Started?</h2>
                <p class="text-xl text-blue-100 mb-8">Join thousands of patients finding their perfect doctor today</p>
                <div class="flex gap-4 justify-center flex-wrap">
                    <button @click="scrollToSearch()"
                        class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-blue-50 transition transform hover:scale-105 active:scale-95 shadow-lg">
                        Find a Doctor
                    </button>
                    <a href="{{ route('doctor.request.form') }}"
                        class="px-8 py-4 border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition">
                        Register as Doctor
                    </a>
                </div>
            </div>
        </section>
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
                    maxPrice: ''
                },
                searchResults: [],
                totalResults: 0,
                currentPage: 1,
                lastPage: 1,
                doctorSuggestions: [],
                locationSuggestions: [],
                specializationSuggestions: [],
                showDoctorSuggestions: false,
                showLocationSuggestions: false,
                showSpecSuggestions: false,
                doctorTimeout: null,
                locationTimeout: null,
                specTimeout: null,
                searchTimeout: null,

                async fetchDoctorSuggestions() {
                    clearTimeout(this.doctorTimeout);

                    if (this.search.query.length < 2) {
                        this.doctorSuggestions = [];
                        this.showDoctorSuggestions = false;
                        return;
                    }

                    this.doctorTimeout = setTimeout(async () => {
                        try {
                            const url =
                                `/autocomplete/doctor-names?q=${encodeURIComponent(this.search.query)}`;

                            const response = await fetch(url);
                            const data = await response.json();

                            if (data && data.success) {
                                this.doctorSuggestions = Array.isArray(data.suggestions) ? data
                                    .suggestions : [];
                                this.showDoctorSuggestions = this.doctorSuggestions.length > 0;
                            } else {
                                this.doctorSuggestions = [];
                                this.showDoctorSuggestions = false;
                            }
                        } catch (error) {
                            console.error('Error fetching doctor suggestions:', error);
                            this.doctorSuggestions = [];
                            this.showDoctorSuggestions = false;
                        }
                    }, 300);
                },

                async fetchLocationSuggestions() {
                    clearTimeout(this.locationTimeout);

                    if (this.search.location.length < 2) {
                        this.locationSuggestions = [];
                        this.showLocationSuggestions = false;
                        return;
                    }

                    this.locationTimeout = setTimeout(async () => {
                        try {
                            const url =
                                `/autocomplete/locations?q=${encodeURIComponent(this.search.location)}`;

                            const response = await fetch(url);
                            const data = await response.json();

                            if (data && data.success) {
                                this.locationSuggestions = Array.isArray(data.suggestions) ? data
                                    .suggestions : [];
                                this.showLocationSuggestions = this.locationSuggestions.length > 0;
                            } else {
                                this.locationSuggestions = [];
                                this.showLocationSuggestions = false;
                            }
                        } catch (error) {
                            console.error('Error fetching locations:', error);
                            this.locationSuggestions = [];
                            this.showLocationSuggestions = false;
                        }
                    }, 300);
                },

                async fetchSpecializationSuggestions() {
                    clearTimeout(this.specTimeout);

                    if (this.search.specialization.length < 2) {
                        this.specializationSuggestions = [];
                        this.showSpecSuggestions = false;
                        return;
                    }

                    this.specTimeout = setTimeout(async () => {
                        try {
                            const url =
                                `/autocomplete/specializations?q=${encodeURIComponent(this.search.specialization)}`;

                            const response = await fetch(url);
                            const data = await response.json();

                            if (data && data.success) {
                                this.specializationSuggestions = Array.isArray(data.suggestions) ? data
                                    .suggestions : [];
                                this.showSpecSuggestions = this.specializationSuggestions.length > 0;
                            } else {
                                this.specializationSuggestions = [];
                                this.showSpecSuggestions = false;
                            }
                        } catch (error) {
                            console.error('Error fetching specializations:', error);
                            this.specializationSuggestions = [];
                            this.showSpecSuggestions = false;
                        }
                    }, 300);
                },

                selectDoctor(doctor) {
                    this.search.query = doctor.name;
                    this.doctorSuggestions = [];
                    this.showDoctorSuggestions = false;
                    this.performSearch();
                },

                performSearch() {
                    clearTimeout(this.searchTimeout);

                    this.searchTimeout = setTimeout(async () => {
                        this.isLoading = true;
                        this.hasSearched = true;
                        this.currentPage = 1;

                        try {
                            const params = new URLSearchParams();
                            if (this.search.query) params.append('query', this.search.query);
                            if (this.search.specialization) params.append('specialization', this.search
                                .specialization);
                            if (this.search.location) params.append('location', this.search.location);
                            if (this.search.availability) params.append('availability', this.search
                                .availability);
                            if (this.search.maxPrice) params.append('maxPrice', this.search.maxPrice);
                            params.append('page', this.currentPage);

                            const url = `/doctors/search?${params}`;

                            const response = await fetch(url);
                            const data = await response.json();

                            if (data.success) {
                                this.searchResults = data.doctors;
                                this.totalResults = data.total;
                                this.lastPage = data.last_page;
                                this.currentPage = data.current_page;
                            } else {
                                this.searchResults = [];
                            }
                        } catch (error) {
                            console.error('Search error:', error);
                            this.searchResults = [];
                        } finally {
                            this.isLoading = false;
                        }
                    }, 500);
                },

                clearSearch() {
                    this.hasSearched = false;
                    this.search = {
                        query: '',
                        specialization: '',
                        location: '',
                        availability: '',
                        maxPrice: ''
                    };
                    this.searchResults = [];
                    this.currentPage = 1;
                },

                scrollToSearch() {
                    const searchSection = document.querySelector('form');
                    if (searchSection) {
                        searchSection.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            }
        }
    </script>
</x-app-layout>
