<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthConnect - Find Your Doctor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1d4ed8;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glow-card {
            transition: all 0.3s ease;
        }

        .glow-card:hover {
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
            transform: translateY(-8px);
        }
    </style>
</head>

<body class="bg-white text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50 border-b border-gray-100">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5z" />
                </svg>
                <span
                    class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">HealthConnect</span>
            </div>

            <!-- Desktop Menu -->
            <ul class="hidden md:flex space-x-8">
                <li><a href="{{ url('/') }}"
                        class="text-gray-700 hover:text-blue-600 font-medium transition">Home</a></li>
                <li><a href="#doctors" class="text-gray-700 hover:text-blue-600 font-medium transition">Doctors</a>
                </li>
                <li><a href="#specialties"
                        class="text-gray-700 hover:text-blue-600 font-medium transition">Specialties</a></li>
                <li><a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium transition">Contact</a></li>
            </ul>

            <div class="hidden md:flex space-x-3">
                <a href="{{ route('login') }}"
                    class="px-5 py-2 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 transition font-medium">Login</a>
                <a href="{{ route('register') }}"
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium shadow-md">Register</a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="menu-btn" class="md:hidden text-blue-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg">
            <ul class="flex flex-col space-y-2 py-4 px-6 font-medium">
                <li><a href="{{ url('/') }}"
                        class="text-gray-700 hover:text-blue-600 block py-2 transition">Home</a></li>
                <li><a href="#doctors" class="text-gray-700 hover:text-blue-600 block py-2 transition">Specialists</a>
                </li>
                <li><a href="#specialties"
                        class="text-gray-700 hover:text-blue-600 block py-2 transition">Specialties</a></li>
                <li><a href="#contact" class="text-gray-700 hover:text-blue-600 block py-2 transition">Contact</a></li>
                <li class="py-2 border-t border-gray-100"><a href="{{ route('login') }}"
                        class="text-blue-600 block py-2 transition">Login</a></li>
                <li><a href="{{ route('register') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg block text-center hover:bg-blue-700 transition">Register</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient text-white pt-24 pb-20 fade-in">
        <div class="container mx-auto px-6 max-w-5xl">
            <!-- Hero Content -->
            <div class="text-center mb-12">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Your Health, Our <span class="text-blue-200">Priority</span>
                </h1>
                <p class="text-lg md:text-xl text-blue-100 mb-8 leading-relaxed max-w-3xl mx-auto">
                    Connect with verified specialists and book appointments instantly. Quality healthcare at your fingertips, 24/7.
                </p>
            </div>

            <!-- Professional Search Section -->
            <div class="bg-white rounded-2xl p-6 md:p-10 shadow-2xl">
                <!-- Search Tabs -->
                <div class="flex gap-6 mb-8 border-b border-gray-200">
                    <button id="manual-tab"
                        class="pb-4 px-2 font-semibold text-blue-600 border-b-2 border-blue-600 transition whitespace-nowrap flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Find Doctor
                    </button>
                    <a href="{{ url('/predict') }}" id="symptom-tab"
                        class="pb-4 px-2 font-semibold text-gray-600 hover:text-blue-600 transition inline-flex items-center gap-2 border-b-2 border-transparent hover:border-blue-300 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Symptoms
                    </a>
                </div>

                <!-- Manual Search Tab -->
                <div id="manual-content" class="space-y-6">
                    <form action="" method="GET" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Doctor Name Search -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Doctor Name</label>
                                <input type="text" name="search" placeholder="Search by doctor's name..."
                                    class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-gray-900 placeholder-gray-500"
                                    required>
                            </div>

                            <!-- Specialty Filter -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Specialty</label>
                                <select name="specialty"
                                    class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-white text-gray-900">
                                    <option value="">All Specialties</option>
                                    <option value="cardiology">Cardiology</option>
                                    <option value="neurology">Neurology</option>
                                    <option value="orthopedic">Orthopedic</option>
                                    <option value="general">General Medicine</option>
                                    <option value="dermatology">Dermatology</option>
                                    <option value="pediatrics">Pediatrics</option>
                                    <option value="gynecology">Gynecology</option>
                                    <option value="psychiatry">Psychiatry</option>
                                </select>
                            </div>

                            <!-- Search Button -->
                            <div class="flex items-end">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold py-3 rounded-xl hover:from-blue-700 hover:to-blue-800 transition flex items-center justify-center gap-2 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-10">
                <a href="#doctors"
                    class="px-8 py-3 bg-white text-blue-600 font-bold rounded-xl hover:bg-blue-50 transition shadow-lg text-center">
                    Browse All Doctors
                </a>
                <a href="{{ route('login') }}"
                    class="px-8 py-3 border-2 border-white text-white font-bold rounded-xl hover:bg-white hover:text-blue-600 transition text-center">
                    Book Now
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose HealthConnect?</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Experience the best healthcare booking platform with trust, quality, and convenience.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="glow-card bg-white p-8 rounded-2xl">
                    <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5H4v6a2 2 0 002 2h12a2 2 0 002-2V7h-2v1a1 1 0 11-2 0V7H9v1a1 1 0 11-2 0V7H6v1a1 1 0 11-2 0V7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Instant Scheduling</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Book your appointments in seconds with our intelligent scheduling system. Real-time availability
                        at your convenience.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="glow-card bg-white p-8 rounded-2xl">
                    <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V8m-10-5.5h7m-7 3h7m-9 4h16M3 16.5h16" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Verified Doctors</h3>
                    <p class="text-gray-600 leading-relaxed">
                        All healthcare professionals are thoroughly vetted, licensed, and verified by our dedicated
                        medical team.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="glow-card bg-white p-8 rounded-2xl">
                    <div class="flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">24/7 Support</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Our dedicated support team is always available to help you with any questions or concerns, round
                        the clock.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Specialties Section -->
    <section id="specialties" class="py-24">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Explore Medical Specialties</h2>
                <p class="text-xl text-gray-600">Find doctors across various medical specialties</p>
            </div>

            <!-- Specialties Grid -->
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Specialty Card 1 -->
                <div class="glow-card bg-white p-8 rounded-xl border border-gray-100">
                    <div
                        class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-red-100 to-red-50 rounded-full mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 2a1 1 0 00-1 1v1.323l-3.954-3.954a1 1 0 10-1.414 1.414L7.323 5H6a1 1 0 000 2h.323l-3.954 3.954a1 1 0 101.414 1.414L8 8.677V10a1 1 0 102 0v-.323l3.954 3.954a1 1 0 001.414-1.414L12.677 9H14a1 1 0 100-2h-.323l3.954-3.954a1 1 0 00-1.414-1.414L12 6.677V3a1 1 0 00-1-1h-1z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Cardiology</h3>
                    <p class="text-gray-600 text-center text-sm">Heart & cardiovascular health</p>
                </div>

                <!-- Specialty Card 2 -->
                <div class="glow-card bg-white p-8 rounded-xl border border-gray-100">
                    <div
                        class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 1 1 0 000 2H4a1 1 0 00-1 1v10a1 1 0 001 1h12a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 000-2 2 2 0 00-2 2v2H6V5zm9 7a1 1 0 100-2 1 1 0 000 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Dentistry</h3>
                    <p class="text-gray-600 text-center text-sm">Dental care & oral health</p>
                </div>

                <!-- Specialty Card 3 -->
                <div class="glow-card bg-white p-8 rounded-xl border border-gray-100">
                    <div
                        class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-green-100 to-green-50 rounded-full mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                            <path
                                d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 text-center mb-2">General Medicine</h3>
                    <p class="text-gray-600 text-center text-sm">Primary healthcare</p>
                </div>

                <!-- Specialty Card 4 -->
                <div class="glow-card bg-white p-8 rounded-xl border border-gray-100">
                    <div
                        class="flex items-center justify-center w-20 h-20 bg-gradient-to-br from-yellow-100 to-yellow-50 rounded-full mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-yellow-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Pediatrics</h3>
                    <p class="text-gray-600 text-center text-sm">Children's health & care</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Specialists Section -->
    <section id="doctors" class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Meet Our Top Specialists</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Connect with highly experienced doctors across various specialties. All verified and qualified.
                </p>
            </div>

            <!-- Specialists Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($topSpecialists as $specialist)
                    <div class="glow-card bg-white rounded-2xl shadow-lg overflow-hidden">
                        <!-- Header with Gradient -->
                        <div
                            class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 relative flex items-center justify-center">
                            <div class="absolute inset-0 opacity-10">
                                <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="20" cy="20" r="20" fill="white" opacity="0.1" />
                                    <circle cx="80" cy="80" r="30" fill="white" opacity="0.1" />
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-8">
                            <!-- Doctor Info Header -->
                            <div class="text-center mb-6">
                                <div class="flex justify-center -mt-24 mb-4">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($specialist->user->name) }}&size=120&background=667eea&color=fff&rounded=true"
                                        alt="{{ $specialist->user->name }}"
                                        class="w-24 h-24 rounded-full border-4 border-white shadow-lg">
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $specialist->user->name }}</h3>
                                <p class="text-blue-600 font-semibold text-lg mt-1">{{ $specialist->qualification }}
                                </p>
                            </div>

                            <!-- Rating -->
                            <div class="flex items-center justify-center gap-1 mb-6">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                                <span class="text-sm text-gray-500 ml-2">(4.8)</span>
                            </div>

                            <!-- Details -->
                            <div class="space-y-4 mb-6">
                                <div class="flex items-start gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6.267 3.455a3.066 3.066 0 001.745-2.77 3.066 3.066 0 00-3.58 3.03A6.124 6.124 0 1012.82 16.22a3.066 3.066 0 012.746-4.568.75.75 0 00-.772-1.55 4.566 4.566 0 01-4.08-6.827.75.75 0 10-1.063-1.063A6.124 6.124 0 016.267 3.455z" />
                                    </svg>
                                    <div class="text-sm">
                                        <p class="text-gray-600">Experience</p>
                                        <p class="font-semibold text-gray-900">{{ $specialist->experience_years }}
                                            years</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                    </svg>
                                    <div class="text-sm">
                                        <p class="text-gray-600">Consultation Fee</p>
                                        <p class="font-semibold text-gray-900">Rs.
                                            {{ number_format($specialist->consultation_fee) }}</p>
                                    </div>
                                </div>

                                @if ($specialist->bio)
                                    <div class="flex items-start gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0L10 9.586l3.293-3.293a1 1 0 111.414 1.414L11.414 11l3.293 3.293a1 1 0 01-1.414 1.414L10 12.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 11 5.293 7.707a1 1 0 010-1.414z" />
                                        </svg>
                                        <div class="text-sm">
                                            <p class="text-gray-600 text-xs">About</p>
                                            <p class="text-gray-600 italic">{{ Str::limit($specialist->bio, 70) }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Button -->
                            <button
                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg hover:shadow-lg transition font-semibold">
                                Book Appointment
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300 mx-auto mb-4"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-600 text-lg">No specialists available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Book Your Appointment?</h2>
                <p class="text-xl text-blue-100 mb-8">
                    Join thousands of patients who trust HealthConnect for their healthcare needs.
                    Get started today and experience quality healthcare at your fingertips.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}"
                        class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-blue-50 transition shadow-lg">
                        Get Started
                    </a>
                    <a href="#contact"
                        class="px-8 py-4 border-2 border-white text-white font-bold rounded-lg hover:bg-white hover:text-blue-600 transition">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Get In Touch</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Have questions? Our dedicated support team is here to help you 24/7
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Phone Support -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 text-center hover:shadow-lg transition">
                    <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.8c.151.767.359 1.57.606 2.343a1 1 0 01-.604 1.215l-2.16 1.08a14.05 14.05 0 002.4 3.557 14.051 14.051 0 003.557 2.4l1.08-2.16a1 1 0 011.215-.604c.774.247 1.577.455 2.343.606a1 1 0 01.8.986v2.153a1 1 0 01-1 1h-2C7.82 20 4 16.18 4 11.5V5a1 1 0 011-1h2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Phone Support</h3>
                    <p class="text-gray-600 mb-4">Call us during business hours</p>
                    <a href="tel:+1234567890" class="text-blue-600 font-semibold text-lg hover:underline">
                        +1 (234) 567-890
                    </a>
                </div>

                <!-- Email Support -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 text-center hover:shadow-lg transition">
                    <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Email Support</h3>
                    <p class="text-gray-600 mb-4">We'll respond within 24 hours</p>
                    <a href="mailto:support@healthconnect.com"
                        class="text-blue-600 font-semibold hover:underline break-all">
                        support@healthconnect.com
                    </a>
                </div>

                <!-- Live Chat -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100 text-center hover:shadow-lg transition">
                    <div class="flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-600" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M2 5a2 2 0 012-2h12a2 2 0 012 2v6a2 2 0 01-2 2H9.414l-4.293 4.293A1 1 0 014 16v-2.414A2 2 0 012 12V5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Live Chat</h3>
                    <p class="text-gray-600 mb-4">Chat with our team instantly</p>
                    <button class="text-blue-600 font-semibold hover:underline">
                        Start Chat Now
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <!-- Main Footer Content -->
        <div class="container mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-12">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-2 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5z" />
                        </svg>
                        <span
                            class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">HealthConnect</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Connecting patients with verified healthcare professionals for quality medical care and wellness.
                    </p>
                    <!-- Social Media Links -->
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23 3a10.9 10.9 0 11-3.14 1.53 4.48 4.48 0 00.33-2.82v-.5a5.14 5.14 0 00-.1-.64M1 10.5h22M1 14h22M2.5 2.5h19M2.5 19.5h19" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.475-2.236-1.986-2.236-1.081 0-1.722.735-2.004 1.42-.103.249-.129.597-.129.946v5.439h-3.554s.05-8.82 0-9.737h3.554v1.378c-.009.015-.023.029-.032.044h.032v-.044c.43-.664 1.2-1.61 2.919-1.61 2.135 0 3.734 1.393 3.734 4.385v5.584zM5.337 9.433c-1.144 0-1.915-.758-1.915-1.705 0-.951.77-1.71 1.964-1.71 1.194 0 1.926.759 1.955 1.71 0 .947-.761 1.705-1.965 1.705zm1.946-9.229H3.391v9.737h3.892V.204zM22.225 0H.002v24h22.223V0z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C5.4 0 0 5.4 0 12c0 5.3 3.438 9.8 8.207 11.387.6.11.793-.26.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.6-5.4-12-12-12z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ url('/') }}"
                                class="text-gray-400 hover:text-blue-400 transition">Home</a></li>
                        <li><a href="#doctors"
                                class="text-gray-400 hover:text-blue-400 transition">Browse Doctors</a></li>
                        <li><a href="#specialties"
                                class="text-gray-400 hover:text-blue-400 transition">Specialties</a></li>
                        <li><a href="#contact"
                                class="text-gray-400 hover:text-blue-400 transition">Contact Us</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">Blog</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">FAQ</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6">Services</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">Book Appointment</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">Online Consultation</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">Find Specialists</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">Health Records</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">Prescription</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">Lab Tests</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">About Us</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">Careers</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">Press</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">Partners</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-blue-400 transition">Testimonials</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6">Newsletter</h3>
                    <p class="text-gray-400 text-sm mb-4">
                        Subscribe to get health tips and updates directly to your inbox.
                    </p>
                    <form class="space-y-3">
                        <input type="email" placeholder="Enter your email"
                            class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition"
                            required>
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-800 pt-12">
                <!-- Bottom Row -->
                <div class="grid md:grid-cols-3 gap-8 mb-8">
                    <!-- Payment Methods -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">We Accept</h4>
                        <div class="flex gap-3">
                            <div class="px-3 py-2 bg-gray-800 rounded-lg">
                                <span class="text-xs font-bold text-blue-400">VISA</span>
                            </div>
                            <div class="px-3 py-2 bg-gray-800 rounded-lg">
                                <span class="text-xs font-bold text-red-400">Mastercard</span>
                            </div>
                            <div class="px-3 py-2 bg-gray-800 rounded-lg">
                                <span class="text-xs font-bold text-orange-400">PayPal</span>
                            </div>
                        </div>
                    </div>

                    <!-- Security & Compliance -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Security & Trust</h4>
                        <div class="flex gap-3 flex-wrap">
                            <div class="px-3 py-1 bg-gray-800 rounded text-xs text-gray-400">
                                🔒 SSL Encrypted
                            </div>
                            <div class="px-3 py-1 bg-gray-800 rounded text-xs text-gray-400">
                                ✓ HIPAA Compliant
                            </div>
                        </div>
                    </div>

                    <!-- Legal Links -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Legal</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Privacy Policy</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Terms of Service</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="bg-gray-950 border-t border-gray-800 py-6">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">
                    <p>&copy; 2025 HealthConnect. All rights reserved. | Empowering Healthcare Through Technology</p>
                    <p>Made with <span class="text-red-500">❤</span> for better healthcare</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('menu-btn').addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

</body>

</html>
