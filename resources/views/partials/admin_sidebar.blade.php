<aside
    class="fixed top-16 bottom-0 left-0 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 shadow-2xl z-30 transform transition-all duration-300 overflow-y-auto"
    :class="sidebarOpen ? 'w-64' : 'w-20'"
>
    <style>
        .sidebar-toggle {
            transition: all 0.3s ease;
        }

        .sidebar-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .sidebar-item:hover {
            transform: translateX(4px);
        }

        .sidebar-item.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .sidebar-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 0 4px 4px 0;
        }

        .sidebar-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1) 50%, transparent);
        }

        .user-profile-section {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slide-in {
            animation: slideInLeft 0.3s ease-out;
        }
    </style>

    <!-- Sidebar Header -->
    <div class="p-4 border-b border-gray-700 sticky top-0 bg-gray-900 z-10">
        <div class="flex items-center justify-between">
            <div x-show="sidebarOpen" class="animate-slide-in flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm">Admin Panel</p>
                    <p class="text-gray-400 text-xs">Management</p>
                </div>
            </div>
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="sidebar-toggle p-2 rounded-lg hover:bg-gray-700 transition text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" x-show="sidebarOpen" />
                    <path fill-rule="evenodd" d="M7.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L10.586 10 7.293 6.707a1 1 0 010-1.414z" clip-rule="evenodd" x-show="!sidebarOpen" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="px-3 py-6 flex-1">
        <div x-show="sidebarOpen" class="mb-4 px-2">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Main</p>
        </div>

        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-300 hover:text-white font-medium {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3 truncate animate-slide-in">Dashboard</span>
                </a>
            </li>

            <!-- Users -->
            <li>
                <a href="{{ route('admin.users.index') }}"
                   class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-300 hover:text-white font-medium {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM8 7a1 1 0 100-2H1a1 1 0 100 2h7zM3 13a6 6 0 1112 0v1H3v-1z" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3 truncate animate-slide-in">Users</span>
                </a>
            </li>

            <!-- Appointments -->
            <li>
                <a href="{{ route('admin.appointments.index') }}"
                   class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-300 hover:text-white font-medium {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 002 2h8a2 2 0 002-2H6z" clip-rule="evenodd" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3 truncate animate-slide-in">Appointments</span>
                </a>
            </li>

            <!-- Specializations -->
            <li>
                <a href="{{ route('admin.specializations.index') }}"
                   class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-300 hover:text-white font-medium {{ request()->routeIs('admin.specializations.*', 'admin.doctors.*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.5 1.5H5.75A2.75 2.75 0 003 4.25v11.5A2.75 2.75 0 005.75 18.5h8.5a2.75 2.75 0 002.75-2.75V6.5m-12-2h10m-10 4h10m-10 4h10m-10 4h6" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3 truncate animate-slide-in">Specializations</span>
                </a>
            </li>
        </ul>

        <!-- Divider -->
        <div class="my-6 sidebar-divider"></div>

        <!-- Settings Section -->
        <div x-show="sidebarOpen" class="mb-4 px-2 animate-slide-in">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Settings</p>
        </div>

        <ul class="space-y-2">
            <!-- Notifications -->
            <li>
                <a href="{{ route('admin.notification') }}"
                   class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-300 hover:text-white font-medium {{ request()->routeIs('admin.notification') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 100 12A6 6 0 0010 2zM0 10a10 10 0 1120 0 10 10 0 01-20 0z" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3 truncate animate-slide-in">Notifications</span>
                </a>
            </li>

            <!-- Logout -->
            <li>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                            class="sidebar-item w-full flex items-center px-4 py-3 rounded-lg text-gray-300 hover:text-white font-medium hover:bg-red-500/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                        </svg>
                        <span x-show="sidebarOpen" class="ml-3 truncate animate-slide-in">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- User Profile Section -->
    <div class="user-profile-section p-4" x-show="sidebarOpen">
        <div class="animate-slide-in flex items-center gap-3 px-2">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-white font-bold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
</aside>
