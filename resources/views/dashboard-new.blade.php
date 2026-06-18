<x-app-layout>
    <div x-data="dashboardApp()"
        class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 dark:from-slate-950 dark:via-blue-950 dark:to-slate-950 relative overflow-hidden">

        <!-- Animated Background Elements -->
        <div class="fixed inset-0 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div
                class="absolute top-1/3 right-0 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse animation-delay-2000">
            </div>
            <div
                class="absolute bottom-0 left-1/2 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl animate-pulse animation-delay-4000">
            </div>
        </div>

        <!-- Content -->
        <div class="relative z-10">
            <!-- Header Section -->
            <section class="pt-20 pb-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-8">
                        <h1 class="text-6xl lg:text-7xl font-black text-white mb-6 leading-tight">
                            Find Your<br>
                            <span
                                class="bg-gradient-to-r from-blue-400 via-cyan-400 to-purple-400 text-transparent bg-clip-text">Perfect
                                Doctor</span>
                        </h1>
                        <p class="text-xl text-blue-200/80 max-w-2xl mx-auto">
                            Discover verified healthcare professionals and schedule your appointment instantly
                        </p>
                    </div>

                    <!-- Quick Action Cards with Glassmorphism -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-12">
                        <div class="group">
                            <div
                                class="h-full bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 hover:border-white/30 transition-all duration-300 cursor-pointer">
                                <div class="text-4xl mb-3">🔍</div>
                                <h3 class="text-white font-bold text-lg">Search Doctors</h3>
                                <p class="text-blue-100/70 text-sm mt-2">Find specialists by name</p>
                            </div>
                        </div>

                        <a href="{{ route('patient.my-bookings') }}" class="group">
                            <div
                                class="h-full bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 hover:border-white/30 transition-all duration-300">
                                <div class="text-4xl mb-3">📅</div>
                                <h3 class="text-white font-bold text-lg">Appointments</h3>
                                <p class="text-blue-100/70 text-sm mt-2">Book consultations</p>
                            </div>
                        </a>

                        <div class="group">
                            <div
                                class="h-full bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 hover:border-white/30 transition-all duration-300 cursor-pointer">
                                <div class="text-4xl mb-3">📋</div>
                                <h3 class="text-white font-bold text-lg">My Bookings</h3>
                                <p class="text-blue-100/70 text-sm mt-2">Manage appointments</p>
                            </div>
                        </div>

                        <div class="group">
                            <div
                                class="h-full bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:bg-white/20 hover:border-white/30 transition-all duration-300 cursor-pointer">
                                <div class="text-4xl mb-3">👤</div>
                                <h3 class="text-white font-bold text-lg">Profile</h3>
                                <p class="text-blue-100/70 text-sm mt-2">Manage your info</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Search Section -->
            <section class="py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl shadow-2xl p-8">
                        <h2 class="text-3xl font-bold text-white mb-8">Find Your Doctor</h2>
                        <form @submit.prevent="performSearch" class="space-y-6">
                            <!-- Main Search Row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Doctor Name -->
                                <div class="relative">
                                    <label class="block text-sm font-semibold text-blue-100 mb-3">Doctor Name</label>
                                    <div class="relative">
                                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-blue-300/50"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <input type="text" x-model="search.query"
                                            @input="fetchDoctorSuggestions(); performSearch()"
                                            @focus="showDoctorSuggestions = true; if (search.query.length >= 2) fetchDoctorSuggestions()"
                                            @blur="setTimeout(() => showDoctorSuggestions = false, 300)"
                                            placeholder="Type doctor name..." autocomplete="off"
                                            class="w-full pl-12 pr-4 py-3 bg-white/5 border border-white/20 text-white placeholder-blue-200/50 rounded-xl focus:bg-white/10 focus:border-blue-400/50 focus:outline-none transition">

                                        <!-- Doctor Suggestions Dropdown -->
                                        <div x-show="showDoctorSuggestions && doctorSuggestions.length > 0"
                                            class="absolute top-full left-0 right-0 mt-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl shadow-xl z-20 max-h-64 overflow-y-auto">
                                            <template x-for="doctor in doctorSuggestions" :key="doctor.id">
                                                <button type="button" @click="selectDoctor(doctor)"
                                                    class="w-full text-left px-4 py-3 hover:bg-white/10 border-b border-white/10 last:border-0 transition text-white">
                                                    <p class="font-semibold text-blue-100" x-text="doctor.name"></p>
                                                    <p class="text-sm text-blue-300/70" x-text="doctor.spec"></p>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <!-- Specialization -->
                                <div class="relative">
                                    <label class="block text-sm font-semibold text-blue-100 mb-3">Specialization</label>
                                    <input type="text" x-model="search.specialization"
                                        @input="fetchSpecializationSuggestions(); performSearch()"
                                        @focus="showSpecSuggestions = true; if (search.specialization.length >= 2) fetchSpecializationSuggestions()"
                                        @blur="setTimeout(() => showSpecSuggestions = false, 300)"
                                        placeholder="Search specialization..." autocomplete="off"
                                        class="w-full px-4 py-3 bg-white/5 border border-white/20 text-white placeholder-blue-200/50 rounded-xl focus:bg-white/10 focus:border-blue-400/50 focus:outline-none transition">

                                    <!-- Specialization Suggestions -->
                                    <div x-show="showSpecSuggestions && specializationSuggestions.length > 0"
                                        class="absolute top-full left-0 right-0 mt-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl shadow-xl z-20 max-h-48 overflow-y-auto">
                                        <template x-for="spec in specializationSuggestions" :key="spec">
                                            <button type="button"
                                                @click="search.specialization = spec; showSpecSuggestions = false; performSearch()"
                                                class="w-full text-left px-4 py-3 hover:bg-white/10 border-b border-white/10 last:border-0 transition text-blue-100">
                                                <span x-text="spec"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Filters -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="relative">
                                    <label class="block text-sm font-semibold text-blue-100 mb-3">Location</label>
                                    <input type="text" x-model="search.location"
                                        @input="fetchLocationSuggestions(); performSearch()"
                                        @focus="showLocationSuggestions = true; if (search.location.length >= 2) fetchLocationSuggestions()"
                                        @blur="setTimeout(() => showLocationSuggestions = false, 300)"
                                        placeholder="City or area..." autocomplete="off"
                                        class="w-full px-4 py-3 bg-white/5 border border-white/20 text-white placeholder-blue-200/50 rounded-xl focus:bg-white/10 focus:border-blue-400/50 focus:outline-none transition">

                                    <!-- Location Suggestions -->
                                    <div x-show="showLocationSuggestions && locationSuggestions.length > 0"
                                        class="absolute top-full left-0 right-0 mt-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl shadow-xl z-20 max-h-48 overflow-y-auto">
                                        <template x-for="location in locationSuggestions" :key="location">
                                            <button type="button"
                                                @click="search.location = location; showLocationSuggestions = false; performSearch()"
                                                class="w-full text-left px-4 py-3 hover:bg-white/10 border-b border-white/10 last:border-0 transition text-blue-100">
                                                <span x-text="location"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-blue-100 mb-3">Availability</label>
                                    <select x-model="search.availability" @change="performSearch()"
                                        class="w-full px-4 py-3 bg-white/5 border border-white/20 text-white rounded-xl focus:bg-white/10 focus:border-blue-400/50 focus:outline-none transition">
                                        <option value="" class="bg-slate-800">All Times</option>
                                        <option value="today" class="bg-slate-800">Today</option>
                                        <option value="tomorrow" class="bg-slate-800">Tomorrow</option>
                                        <option value="week" class="bg-slate-800">This Week</option>
                                        <option value="month" class="bg-slate-800">This Month</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-blue-100 mb-3">Max Price</label>
                                    <input type="number" x-model="search.maxPrice" @change="performSearch()"
                                        placeholder="Max price..."
                                        class="w-full px-4 py-3 bg-white/5 border border-white/20 text-white placeholder-blue-200/50 rounded-xl focus:bg-white/10 focus:border-blue-400/50 focus:outline-none transition">
                                </div>
                            </div>

                            <!-- Search Button -->
                            <div class="flex gap-4">
                                <button type="submit" :disabled="isLoading"
                                    class="flex-1 px-8 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-bold rounded-xl transition transform hover:scale-105 active:scale-95 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span x-show="!isLoading">Search Doctors</span>
                                    <span x-show="isLoading" class="flex items-center justify-center gap-2">
                                        <svg class="h-5 w-5 animate-spin" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                        Searching...
                                    </span>
                                </button>
                                <button type="button" @click="clearSearch()"
                                    class="px-6 py-3 bg-white/10 hover:bg-white/20 border border-white/20 text-blue-100 font-bold rounded-xl transition">
                                    Clear
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <!-- Search Results Section -->
            <section x-show="hasSearched" class="py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Results Header -->
                    <div class="mb-12 flex justify-between items-center">
                        <div>
                            <h2 class="text-4xl font-bold text-white mb-2">Search Results</h2>
                            <p class="text-blue-200/70">Found <span class="font-bold text-cyan-400"
                                    x-text="totalResults"></span> doctors</p>
                        </div>
                        <button @click="clearSearch()"
                            class="text-cyan-400 hover:text-cyan-300 font-bold flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg transition">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Close
                        </button>
                    </div>

                    <!-- Loading State -->
                    <div x-show="isLoading" class="flex justify-center items-center py-20">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center">
                                <div
                                    class="w-16 h-16 border-4 border-white/20 border-t-cyan-400 rounded-full animate-spin">
                                </div>
                            </div>
                            <p class="text-blue-200/70 mt-4">Searching for doctors...</p>
                        </div>
                    </div>

                    <!-- No Results -->
                    <div x-show="!isLoading && searchResults.length === 0" class="text-center py-20">
                        <svg class="h-20 w-20 text-blue-300/30 mx-auto mb-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="text-2xl font-bold text-blue-100 mb-2">No doctors found</h3>
                        <p class="text-blue-300/70">Try adjusting your search filters or try a different search term
                        </p>
                    </div>

                    <!-- Results Grid -->
                    <div x-show="!isLoading && searchResults.length > 0"
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <template x-for="doc in searchResults" :key="doc.id">
                            <div class="group h-full">
                                <div
                                    class="relative h-full bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl overflow-hidden hover:bg-white/20 hover:border-white/40 hover:shadow-2xl transition-all duration-300 flex flex-col">

                                    <!-- Image Section -->
                                    <div
                                        class="relative overflow-hidden h-48 bg-gradient-to-br from-blue-500 to-purple-600">
                                        <img :src="doc.img" :alt="doc.name"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                        <!-- Gradient Overlay -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent">
                                        </div>

                                        <!-- Rating Badge -->
                                        <div
                                            class="absolute top-4 left-4 bg-yellow-400/90 backdrop-blur rounded-full px-3 py-1 flex items-center gap-1 shadow-lg">
                                            <svg class="h-4 w-4 fill-yellow-600" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            <span class="font-bold text-sm" x-text="doc.rating"></span>
                                        </div>
                                    </div>

                                    <!-- Content Section -->
                                    <div class="p-6 flex-1 flex flex-col">
                                        <h3 class="text-xl font-bold text-white mb-1" x-text="doc.name"></h3>
                                        <p class="text-cyan-400 font-semibold text-sm mb-3" x-text="doc.spec"></p>

                                        <p class="text-blue-200/70 text-sm mb-1">
                                            <span x-text="doc.experience"></span>
                                        </p>
                                        <p class="text-blue-300/50 text-xs mb-4" x-text="doc.location"></p>

                                        <!-- Reviews -->
                                        <div class="flex items-center gap-2 mb-4 text-sm text-blue-300/70">
                                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            <span x-text="doc.reviews + ' reviews'"></span>
                                        </div>

                                        <!-- Status & Price -->
                                        <div
                                            class="flex justify-between items-center py-4 border-t border-white/10 mb-6">
                                            <span
                                                class="inline-flex items-center gap-2 bg-green-500/20 text-green-300 px-3 py-1 rounded-full text-xs font-bold border border-green-500/30">
                                                <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                                <span x-text="doc.status"></span>
                                            </span>
                                            <span class="text-white font-bold">
                                                BDT <span x-text="doc.price"></span>
                                            </span>
                                        </div>

                                        <!-- CTA Button -->
                                        <a :href="`/patient/doctor/${doc.id}/schedules`"
                                            class="w-full block text-center bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-bold py-3 rounded-lg transition transform hover:scale-105 active:scale-95 shadow-lg">
                                            View & Book
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </section>

            <!-- Top Doctors Section -->
            <section class="py-20" x-show="!hasSearched">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mb-12">
                        <h2 class="text-4xl font-bold text-white mb-2">Recommended Doctors</h2>
                        <p class="text-blue-200/70">Highly rated healthcare professionals</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($doctors as $doc)
                            <div class="group h-full">
                                <div
                                    class="relative h-full bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl overflow-hidden hover:bg-white/20 hover:border-white/40 hover:shadow-2xl transition-all duration-300 flex flex-col">
                                    <div
                                        class="relative overflow-hidden h-48 bg-gradient-to-br from-blue-500 to-purple-600">
                                        <img src="{{ $doc['img'] }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent">
                                        </div>
                                        <div
                                            class="absolute top-4 left-4 bg-yellow-400/90 backdrop-blur rounded-full px-3 py-1 flex items-center gap-1 shadow-lg">
                                            <svg class="h-4 w-4 fill-yellow-600" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            <span class="font-bold text-sm">{{ $doc['rating'] }}</span>
                                        </div>
                                    </div>
                                    <div class="p-6 flex-1 flex flex-col">
                                        <h3 class="text-xl font-bold text-white mb-1">{{ $doc['name'] }}</h3>
                                        <p class="text-cyan-400 font-semibold text-sm mb-3">{{ $doc['spec'] }}</p>
                                        <p class="text-blue-200/70 text-sm mb-1">{{ $doc['experience'] }}</p>
                                        <p class="text-blue-300/50 text-xs mb-4">{{ $doc['location'] }}</p>
                                        <div class="flex items-center gap-2 mb-4 text-sm text-blue-300/70">
                                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            <span>{{ $doc['reviews'] }} reviews</span>
                                        </div>
                                        <div
                                            class="flex justify-between items-center py-4 border-t border-white/10 mb-6">
                                        <span class="text-white font-bold">BDT {{ $doc['price'] }}</span>
                                        </div>
                                        <button
                                            onclick="window.location.href='{{ route('patient.doctor-schedules', ['doctorId' => 0]) }}'.replace('/0', '/' + this.dataset.doctorId)"
                                            data-doctor-id="{{ $doc['id'] }}"
                                            class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-bold py-3 rounded-lg transition transform hover:scale-105 active:scale-95 shadow-lg">
                                            Book Now
                                        </button>
                                    </div>
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
                            <h2 class="text-4xl font-bold text-white mb-2">Available Today</h2>
                            <p class="text-blue-200/70">Doctors with available time slots</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($availableDoctors as $doc)
                                <div class="group h-full">
                                    <div
                                        class="relative h-full bg-gradient-to-br from-green-500/10 to-emerald-500/10 backdrop-blur-xl border border-green-400/30 rounded-2xl overflow-hidden hover:bg-green-500/20 hover:border-green-400/50 hover:shadow-2xl transition-all duration-300 flex flex-col">
                                        <div
                                            class="relative overflow-hidden h-48 bg-gradient-to-br from-green-500 to-emerald-600">
                                            <img src="{{ $doc['img'] }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent">
                                            </div>
                                            <div
                                                class="absolute top-4 right-4 bg-green-400/90 backdrop-blur text-green-900 px-3 py-1 rounded-full text-xs font-bold">
                                                🟢 Available</div>
                                            <div
                                                class="absolute top-4 left-4 bg-yellow-400/90 backdrop-blur rounded-full px-3 py-1 flex items-center gap-1 shadow-lg">
                                                <svg class="h-4 w-4 fill-yellow-600" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                    </path>
                                                </svg>
                                                <span class="font-bold text-sm">{{ $doc['rating'] }}</span>
                                            </div>
                                        </div>
                                        <div class="p-6 flex-1 flex flex-col">
                                            <h3 class="text-xl font-bold text-white mb-1">{{ $doc['name'] }}</h3>
                                            <p class="text-cyan-400 font-semibold text-sm mb-2">{{ $doc['spec'] }}
                                            </p>
                                            <p class="text-blue-200/70 text-xs mb-2">{{ $doc['location'] }}</p>
                                            <p class="text-blue-200/70 text-sm mb-4">{{ $doc['experience'] }}</p>
                                            <div
                                                class="flex justify-between items-center py-4 border-t border-white/10 mb-6">
                                                <span class="text-white font-bold">BDT {{ $doc['price'] }}</span>
                                            </div>
                                            <button
                                                onclick="window.location.href='{{ route('patient.doctor-schedules', ['doctorId' => 0]) }}'.replace('/0', '/' + this.dataset.doctorId)"
                                                data-doctor-id="{{ $doc['id'] }}"
                                                class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold py-3 rounded-lg transition transform hover:scale-105 active:scale-95 shadow-lg">
                                                Book Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
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
                            }
                        } catch (error) {
                            console.error('Error fetching suggestions:', error);
                            this.doctorSuggestions = [];
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
                            }
                        } catch (error) {
                            this.locationSuggestions = [];
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
                            }
                        } catch (error) {
                            this.specializationSuggestions = [];
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

    <style>
        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</x-app-layout>
