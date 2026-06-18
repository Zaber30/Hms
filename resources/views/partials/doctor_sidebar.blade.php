<aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-700 shadow-lg h-screen sticky top-0 text-white">
    <div class="p-6">
        <!-- Sidebar Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold">My Practice</h2>
            <p class="text-blue-100 text-sm mt-1">Doctor Portal</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('doctor.dashboard') }}"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('doctor.dashboard') ? 'bg-white bg-opacity-20 font-semibold text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4"></path>
                </svg>
                Dashboard
            </a>

            <!-- Schedules -->
            <a href="{{ route('doctor.schedules.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('doctor.schedules.*') ? 'bg-white bg-opacity-20 font-semibold text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                My Schedules
            </a>

            <!-- Appointments (Legacy) -->
            <a href="{{ route('doctor.appointments') }}"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('doctor.appointments') ? 'bg-white bg-opacity-20 font-semibold text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
                Appointments
            </a>

            <!-- Profile -->
            <a href="{{ route('profile.edit') }}"
                class="flex items-center px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('profile.edit') ? 'bg-white bg-opacity-20 font-semibold text-white' : 'text-blue-100 hover:bg-white hover:bg-opacity-10' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Profile
            </a>
        </nav>

        <!-- Divider -->
        <div class="my-6 border-t border-blue-500"></div>

        <!-- Doctor Info Section -->
        @auth
            <div class="bg-white bg-opacity-10 rounded-lg p-4">
                <p class="text-xs text-blue-100 uppercase tracking-wider mb-2">Current Doctor</p>
                <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                <span class="inline-block mt-2 px-2 py-1 bg-green-500 text-white text-xs rounded font-medium">
                    {{ ucfirst(auth()->user()->status) }}
                </span>
            </div>
        @endauth
    </div>
</aside>
