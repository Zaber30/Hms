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
                </a>

                <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-md text-gray-700 hover:bg-blue-100 hover:text-blue-700 font-medium">
                    Profile
                </a> --}}

                <!-- Notifications -->
                <a href="{{route('admin.notification')}}" class="relative px-4 py-2 rounded-md text-gray-700 hover:bg-blue-100 hover:text-blue-700 font-medium" id="notificationLink">
                    Notifications
                    <span id="notificationBadge" class="absolute -top-1 -right-3 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full font-bold">
                        {{ auth()->user()->unreadNotifications()->count()??0}}
                    </span>
                </a>

                <!-- User Dropdown -->
                <div class="relative">
                    <button id="userDropdownBtn" class="flex items-center px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-medium">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="ml-2 h-4 w-4 transition-transform duration-200" id="userDropdownIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-100 hover:text-red-600">Log Out</button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Mobile Hamburger -->
            <div class="sm:hidden flex items-center space-x-2">
                <!-- Notifications Icon -->
                <a href="" class="relative p-2 text-gray-700 hover:text-blue-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V11a6 6 0 00-5-5.917V4a2 2 0 10-4 0v1.083A6 6 0 004 11v3c0 .386-.149.735-.395 1.01L2 17h5m5 0v1a3 3 0 11-6 0v-1h6z" />
                    </svg>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1 rounded-full">
                        {{ auth()->user()->unreadNotifications()->count() ?? 0 }}
                    </span>
                </a>

                <!-- Hamburger -->
                <button id="mobileMenuBtn" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg id="mobileIcon" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden sm:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 rounded-md font-medium">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 rounded-md font-medium">Profile</a>
            <a href="" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 rounded-md font-medium">
                Notifications
                <span class="ml-2 bg-red-500 text-white text-xs px-1 rounded-full">{{ auth()->user()->unreadNotifications()->count() ?? 0 }}</span>
            </a>
        </div>
        <div class="border-t border-gray-200 pt-4 pb-1">
            <div class="px-4">
                <div class="font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-gray-500 text-sm">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-red-100 hover:text-red-600 rounded-md">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
// User dropdown toggle
const userDropdownBtn = document.getElementById('userDropdownBtn');
const userDropdown = document.getElementById('userDropdown');
const userDropdownIcon = document.getElementById('userDropdownIcon');

if (userDropdownBtn && userDropdown) {
    userDropdownBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        userDropdown.classList.toggle('hidden');
        userDropdownIcon.style.transform = userDropdown.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!userDropdownBtn.contains(e.target) && !userDropdown.contains(e.target)) {
            userDropdown.classList.add('hidden');
            userDropdownIcon.style.transform = 'rotate(0deg)';
        }
    });
}

// Mobile menu toggle
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const mobileIcon = document.getElementById('mobileIcon');

if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        mobileMenu.classList.toggle('hidden');
    });

    // Close menu when clicking a link
    const mobileMenuLinks = mobileMenu.querySelectorAll('a, form button');
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
        });
    });
}

// Poll for notifications every 5 seconds
setInterval(function() {
    fetch("{{ route('admin.notification.count') }}")
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('notificationBadge');
            if (badge && data.count !== undefined) {
                badge.textContent = data.count;
                if (data.count > 0) {
                    badge.style.display = 'block';
                } else {
                    badge.style.display = 'none';
                }
            }
        })
        .catch(error => console.log('Notification fetch error:', error));
}, 5000);
</script>

