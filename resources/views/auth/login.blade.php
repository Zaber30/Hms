@extends('layouts.auth')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - HealthConnect</title>
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

            .login-container {
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
                            class="text-gray-700 hover:text-blue-600 transition">Specialists</a></li>
                    <li><a href="{{ url('/#specialties') }}"
                            class="text-gray-700 hover:text-blue-600 transition">Specialties</a></li>
                    <li><a href="{{ url('/#contact') }}" class="text-gray-700 hover:text-blue-600 transition">Contact</a>
                    </li>
                </ul>

                <div class="hidden md:flex gap-3">
                    <a href="{{ route('register') }}"
                        class="px-6 py-2 border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition font-semibold">Register</a>
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
                            class="text-gray-700 hover:text-blue-600 transition block py-2">Doctors</a></li>
                    <li><a href="{{ url('/#specialties') }}"
                            class="text-gray-700 hover:text-blue-600 transition block py-2">Specialties</a></li>
                    <li><a href="{{ url('/#contact') }}"
                            class="text-gray-700 hover:text-blue-600 transition block py-2">Contact</a></li>
                    <li class="py-2 border-t border-gray-100"><a href="{{ route('register') }}"
                            class="text-blue-600 block py-2 font-semibold">Register</a></li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="pt-20 pb-12 min-h-screen bg-gray-50">
            <div class="container mx-auto px-4 lg:px-6">
                <div class="grid md:grid-cols-2 gap-8 items-center min-h-[calc(100vh-120px)]">
                    <!-- Left Side - Illustration/Info -->
                    <div class="hidden md:flex flex-col justify-center">
                        <div class="login-container">
                            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                                Welcome Back to <span
                                    class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">HealthConnect</span>
                            </h1>
                            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                                Access your account to view appointments, manage your health profile, and connect with
                                specialists.
                            </p>

                            <!-- Info Cards -->
                            <div class="space-y-4">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Secure Access</h3>
                                        <p class="text-gray-600 text-sm">Your data is encrypted and protected</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Track Progress</h3>
                                        <p class="text-gray-600 text-sm">Monitor your health journey and appointments</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Easy Booking</h3>
                                        <p class="text-gray-600 text-sm">Schedule appointments with verified specialists</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Login Form -->
                    <div class="login-container">
                        <div class="bg-white rounded-2xl shadow-2xl p-8 lg:p-10 border border-gray-100">
                            <!-- Header -->
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-gray-900 mb-2">Login</h2>
                                <p class="text-gray-600">Access your HealthConnect account</p>
                            </div>

                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-lg"
                                    role="alert">
                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ session('status') }}</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Form -->
                            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                                @csrf

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
                                            required autofocus autocomplete="username"
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
                                            autocomplete="current-password"
                                            class="form-input input-with-icon w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0 outline-none"
                                            placeholder="••••••••">
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

                                <!-- Remember Me & Forgot Password -->
                                <div class="flex items-center justify-between">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input id="remember_me" type="checkbox" name="remember"
                                            class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                                        <span class="text-sm text-gray-700">Remember me</span>
                                    </label>

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}"
                                            class="text-sm text-blue-600 hover:text-blue-800 font-semibold transition">
                                            Forgot password?
                                        </a>
                                    @endif
                                </div>

                                <!-- Login Button -->
                                <button type="submit"
                                    class="btn-gradient w-full text-white py-3 rounded-lg font-bold text-lg shadow-lg hover:shadow-xl transition-all">
                                    Sign In
                                </button>
                            </form>

                            <!-- Divider -->
                            <div class="relative my-8">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-600">Don't have an account?</span>
                                </div>
                            </div>

                            <!-- Sign Up Link -->
                            <a href="{{ route('register') }}"
                                class="block w-full text-center py-3 border-2 border-blue-600 text-blue-600 rounded-lg font-bold hover:bg-blue-50 transition-colors">
                                Create Account
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
        </script>

    </body>

    </html>
@endsection
