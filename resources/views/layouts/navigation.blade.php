<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <h1 class="text-2xl font-bold text-blue-600">HealthConnect</h1>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">

                {{-- <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-md text-gray-700 hover:bg-blue-100 hover:text-blue-700 font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700' : '' }}">
                    Dashboard
                </a> --}}

                {{-- <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-md text-gray-700 hover:bg-blue-100 hover:text-blue-700 font-medium">
                    Profile
                </a> --}}

                <!-- User Dropdown -->
                @auth
                    <div class="relative">
                        <button id="userDropdownBtn"
                            class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-medium">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-2 h-4 w-4 transition-transform duration-200" id="userDropdownIcon" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-100 hover:text-red-600">Log
                                    Out</button>
                            </form>
                        </div>
                    </div>
                @endauth

            </div>

            <!-- Mobile Hamburger -->
            <div class="sm:hidden flex items-center">
                <button id="mobileMenuBtn"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg id="mobileIcon" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden sm:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 rounded-md font-medium">Dashboard</a>
            <a href="{{ route('profile.edit') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 rounded-md font-medium">Profile</a>
        </div>
        @auth
            <div class="border-t border-gray-200 pt-4 pb-1">
                <div class="px-4">
                    <div class="font-medium text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-gray-500 text-sm">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-red-100 hover:text-red-600 rounded-md">Log
                            Out</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>

<script>
    // Desktop Dropdown
    const dropdownBtn = document.getElementById('userDropdownBtn');
    const dropdown = document.getElementById('userDropdown');
    const dropdownIcon = document.getElementById('userDropdownIcon');

    dropdownBtn.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
        dropdownIcon.classList.toggle('rotate-180');
    });

    document.addEventListener('click', (event) => {
        if (!dropdownBtn.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
            dropdownIcon.classList.remove('rotate-180');
        }
    });

    // Mobile Menu Toggle
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileIcon = document.getElementById('mobileIcon');

    mobileBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        const paths = mobileIcon.querySelectorAll('path');
        paths[0].classList.toggle('hidden');
        paths[1].classList.toggle('hidden');
    });
</script>
