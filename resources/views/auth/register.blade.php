@extends('layouts.auth')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register - HealthConnect</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            * {
                scroll-behavior: smooth;
            }

            .hero-gradient {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            .form-input {
                transition: all 0.3s ease;
            }

            .form-input:focus {
                box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
                transform: translateY(-2px);
            }

            .btn-gradient {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                transition: all 0.3s ease;
            }

            .btn-gradient:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            }

            .register-container {
                animation: slideUp 0.5s ease-out;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .input-icon-wrapper {
                position: relative;
            }

            .input-icon {
                position: absolute;
                left: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: #667eea;
                width: 20px;
                height: 20px;
            }

            .input-with-icon {
                padding-left: 2.75rem;
            }

            .password-strength {
                height: 6px;
                background: #e5e7eb;
                border-radius: 3px;
                margin-top: 0.5rem;
                overflow: hidden;
            }

            .password-strength-fill {
                height: 100%;
                width: 0%;
                transition: all 0.3s ease;
                border-radius: 3px;
            }
        </style>
    </head>

    <body class="bg-gray-50">

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
                <ul class="hidden md:flex space-x-8 font-medium">
                    <li><a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 transition">Home</a></li>
                    <li><a href="{{ url('/#doctors') }}"
                            class="text-gray-700 hover:text-blue-600 transition">Doctors</a></li>
                    <li><a href="{{ url('/#specialties') }}"
                            class="text-gray-700 hover:text-blue-600 transition">Specialties</a></li>
                    <li><a href="{{ url('/#contact') }}" class="text-gray-700 hover:text-blue-600 transition">Contact</a>
                    </li>
                </ul>

                <div class="hidden md:flex gap-3">
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition font-semibold">Login</a>
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
                            class="text-gray-700 hover:text-blue-600 transition block py-2">Home</a></li>
                    <li><a href="{{ url('/#doctors') }}"
                            class="text-gray-700 hover:text-blue-600 transition block py-2">Specialists</a></li>
                    <li><a href="{{ url('/#specialties') }}"
                            class="text-gray-700 hover:text-blue-600 transition block py-2">Specialties</a></li>
                    <li><a href="{{ url('/#contact') }}"
                            class="text-gray-700 hover:text-blue-600 transition block py-2">Contact</a></li>
                    <li class="py-2 border-t border-gray-100"><a href="{{ route('login') }}"
                            class="text-blue-600 block py-2 font-semibold">Login</a></li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="pt-20 pb-12 min-h-screen bg-gray-50">
            <div class="container mx-auto px-4 lg:px-6">
                <div class="grid md:grid-cols-2 gap-8 items-start md:items-center min-h-[calc(100vh-160px)]">
                    <!-- Left Side - Benefits -->
                    <div class="hidden md:flex flex-col justify-center">
                        <div class="register-container">
                            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                                Join <span
                                    class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">HealthConnect</span>
                            </h1>
                            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                                Create your account and get instant access to book appointments with verified healthcare
                                specialists.
                            </p>

                            <!-- Benefits List -->
                            <div class="space-y-6">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg">Quick & Easy</h3>
                                        <p class="text-gray-600">Create your account in just 2 minutes</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5 2a1 1 0 011 1v1h1a1 1 0 000-2H6V3a1 1 0 01-1 0V2a1 1 0 010-2h1V0a1 1 0 112 0v1h1a1 1 0 110 2h-1v1a1 1 0 01-1-1V2zm8 0a1 1 0 011 1v1h1a1 1 0 000-2h-1V3a1 1 0 01-1 0V2a1 1 0 010-2h1V0a1 1 0 112 0v1h1a1 1 0 110 2h-1v1a1 1 0 01-1-1V2zm2 9a1 1 0 011 1v1h1a1 1 0 000-2h-1v-1a1 1 0 01-1 0v1a1 1 0 01-1-1v-1a1 1 0 010-2h1V9a1 1 0 110-2v1h1a1 1 0 110 2h-1v1a1 1 0 011 1zm-8 0a7 7 0 100 14 7 7 0 000-14zM9 13a1 1 0 110 2 1 1 0 010-2z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg">Book Instantly</h3>
                                        <p class="text-gray-600">Schedule appointments right away</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg">Verified Doctors</h3>
                                        <p class="text-gray-600">Connect with trusted healthcare professionals</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.5 12a3.5 3.5 0 01.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg">Always Available</h3>
                                        <p class="text-gray-600">24/7 access to schedule and manage appointments</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Registration Form -->
                    <div class="register-container">
                        <div class="bg-white rounded-2xl shadow-2xl p-8 lg:p-10 border border-gray-100">
                            <!-- Header -->
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                                <p class="text-gray-600">Join thousands of satisfied patients</p>
                            </div>

                            <!-- Form -->
                            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                                @csrf

                                <!-- Name Input -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Full
                                        Name</label>
                                    <div class="input-icon-wrapper">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                        </svg>
                                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                                            required autofocus autocomplete="name"
                                            class="form-input input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0 outline-none"
                                            placeholder="John Doe">
                                    </div>
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Email Input -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Email
                                        Address</label>
                                    <div class="input-icon-wrapper">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                                            required autocomplete="username"
                                            class="form-input input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0 outline-none"
                                            placeholder="you@example.com">
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Password Input -->
                                <div>
                                    <label for="password"
                                        class="block text-sm font-semibold text-gray-900 mb-2">Password</label>
                                    <div class="input-icon-wrapper">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <input id="password" type="password" name="password" required
                                            autocomplete="new-password"
                                            class="form-input input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0 outline-none"
                                            placeholder="••••••••" onchange="updatePasswordStrength()">
                                    </div>
                                    <div class="password-strength">
                                        <div id="strength" class="password-strength-fill bg-gray-300"></div>
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Confirm Password Input -->
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-semibold text-gray-900 mb-2">Confirm Password</label>
                                    <div class="input-icon-wrapper">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <input id="password_confirmation" type="password" name="password_confirmation"
                                            required autocomplete="new-password"
                                            class="form-input input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0 outline-none"
                                            placeholder="••••••••">
                                    </div>
                                    @error('password_confirmation')
                                        <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Terms Checkbox -->
                                <div class="flex items-start gap-3">
                                    <input id="terms" type="checkbox" name="terms" required
                                        class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer mt-1">
                                    <label for="terms" class="text-sm text-gray-700 cursor-pointer">
                                        I agree to the <a href="#"
                                            class="text-blue-600 font-semibold hover:underline">Terms of Service</a> and <a
                                            href="#" class="text-blue-600 font-semibold hover:underline">Privacy
                                            Policy</a>
                                    </label>
                                </div>

                                <!-- Register Button -->
                                <button type="submit"
                                    class="btn-gradient w-full text-white py-3 rounded-lg font-bold text-lg shadow-lg hover:shadow-xl transition-all">
                                    Create Account
                                </button>
                            </form>

                            <!-- Divider -->
                            <div class="relative my-8">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-600">Already have an account?</span>
                                </div>
                            </div>

                            <!-- Login Link -->
                            <a href="{{ route('login') }}"
                                class="block w-full text-center py-3 border-2 border-blue-600 text-blue-600 rounded-lg font-bold hover:bg-blue-50 transition-colors">
                                Sign In
                            </a>
                        </div>

                        <!-- Back to Home -->
                        <div class="text-center mt-6">
                            <a href="{{ url('/') }}"
                                class="text-gray-600 hover:text-blue-600 transition flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Script -->
        <script>
            document.getElementById('menu-btn').addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            });

            function updatePasswordStrength() {
                const password = document.getElementById('password').value;
                const strength = document.getElementById('strength');
                let value = 0;
                let color = '#ef4444'; // red

                if (password.length >= 8) value += 25;
                if (password.length >= 12) value += 25;
                if (/[a-z]/.test(password) && /[A-Z]/.test(password)) value += 25;
                if (/\d/.test(password) && /[!@#$%^&*]/.test(password)) value += 25;

                if (value <= 25) {
                    color = '#ef4444'; // red
                } else if (value <= 50) {
                    color = '#f97316'; // orange
                } else if (value <= 75) {
                    color = '#eab308'; // yellow
                } else {
                    color = '#22c55e'; // green
                }

                strength.style.width = value + '%';
                strength.style.backgroundColor = color;
            }
        </script>

    </body>

    </html>
@endsection
