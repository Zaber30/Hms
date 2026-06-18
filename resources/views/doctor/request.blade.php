@extends('layouts.doctor')
@section('content')
    {{-- @include('layouts.doctor_navigation') --}}
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">

            <!-- Header Section -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-3">Doctor Registration</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Join our network of verified healthcare professionals and
                    expand your practice reach</p>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-indigo-100 flex flex-col md:flex-row">

                <!-- Left Side: Illustration & Info -->
                <div
                    class="bg-gradient-to-br from-indigo-600 via-blue-600 to-cyan-500 text-white flex flex-col justify-center items-center p-8 md:p-12 w-full md:w-2/5 relative overflow-hidden">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-16 -mb-16"></div>

                    <div class="relative z-10 text-center">
                        <div
                            class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full mb-6 backdrop-blur-sm">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">Professional Healthcare</h2>
                        <p class="text-blue-100 text-lg leading-relaxed mb-8">
                            Join thousands of verified doctors providing quality healthcare services through our trusted
                            platform.
                        </p>

                        <!-- Benefits List -->
                        <div class="space-y-3 text-left">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-white font-medium">Verified credentials</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-white font-medium">Secure platform</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-white font-medium">Wide patient reach</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Form or Status -->
                <div class="w-full md:w-3/5 p-8 md:p-12 flex flex-col justify-center">

                    {{-- ✅ If status exists (show only status message) --}}
                    @if (Auth::user()->status && Auth::user()->status != 'rejected')
                        <div class="text-center space-y-6">
                            @if (Auth::user()->status == 'pending')
                                <div
                                    class="p-8 bg-gradient-to-br from-amber-50 to-orange-50 border-2 border-amber-200 rounded-2xl shadow-lg">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-amber-400 to-orange-400 rounded-full mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-amber-900 mb-2">Application Under Review</h3>
                                    <p class="text-amber-700 text-lg leading-relaxed">Your registration request is being
                                        carefully reviewed by our admin team. You'll receive an email notification once a
                                        decision has been made.</p>
                                    <p class="text-amber-600 text-sm mt-4 font-medium">Typical review time: 2-3 business
                                        days</p>
                                </div>
                            @elseif(Auth::user()->status == 'approved')
                                <div
                                    class="p-8 bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 rounded-2xl shadow-lg">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-400 rounded-full mb-4">
                                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-green-900 mb-2">Welcome, Doctor!</h3>
                                    <p class="text-green-700 text-lg leading-relaxed mb-4">Congratulations! Your
                                        registration has been approved and you are now a verified healthcare provider on our
                                        platform.</p>
                                    <a href="{{ route('dashboard') }}"
                                        class="inline-block mt-4 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                        Go to Dashboard →
                                    </a>
                                </div>
                            @endif
                        </div>

                        {{-- ✅ If no request submitted OR rejected (show form) --}}
                    @else
                        <div>

                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Complete Your Profile</h3>
                                <p class="text-gray-600 mb-8">Provide your professional information to get verified</p>

                                @if (Auth::user()->status == 'rejected')
                                    <div class="mb-8 p-4 bg-red-50 text-red-800 border-l-4 border-red-500 rounded-lg">
                                        <div class="flex items-start">
                                            <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div>
                                                <p class="font-semibold">Previous request was rejected</p>
                                                <p class="text-sm mt-1">Please review the feedback and resubmit with
                                                    corrected information.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div
                                        class="mb-8 p-4 bg-green-50 text-green-800 border-l-4 border-green-500 rounded-lg flex items-start">
                                        <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ session('success') }}</span>
                                    </div>
                                @endif

                                <form action="{{ route('doctor.request.submit') }}" method="POST"
                                    enctype="multipart/form-data" class="space-y-6">
                                    @csrf

                                    <!-- Row 1: Phone & Gender -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                                <span class="text-red-500">*</span> Phone Number
                                            </label>
                                            <input type="text" name="phone" placeholder="+880 1234567890"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 @error('phone') border-red-500 @enderror"
                                                value="{{ old('phone') }}">
                                            @error('phone')
                                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                                <span class="text-red-500">*</span> Gender
                                            </label>
                                            <select name="gender"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white @error('gender') border-red-500 @enderror">
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                            @error('gender')
                                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Row 1.5: BMDC Registration Number & Qualification -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                                <span class="text-red-500">*</span> BMDC Registration Number
                                            </label>
                                            <input type="text" name="bmdc_registration_number"
                                                placeholder="e.g., D-12345"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 @error('bmdc_registration_number') border-red-500 @enderror"
                                                value="{{ old('bmdc_registration_number') }}">
                                            @error('bmdc_registration_number')
                                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                                <span class="text-red-500">*</span> Qualification
                                            </label>
                                            <input type="text" name="qualification" placeholder="e.g., MBBS, MD, FCPS"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 @error('qualification') border-red-500 @enderror"
                                                value="{{ old('qualification') }}">
                                            @error('qualification')
                                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                                <span class="text-red-500">*</span> Experience (Years)
                                            </label>
                                            <input type="number" name="experience_years" placeholder="e.g., 5"
                                                min="0"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 @error('experience_years') border-red-500 @enderror"
                                                value="{{ old('experience_years') }}">
                                            @error('experience_years')
                                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Clinic Address -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                                            <span class="text-red-500">*</span> Clinic Address
                                        </label>
                                        <input type="text" name="clinic_address"
                                            placeholder="e.g., Road 12, Dhanmondi, Dhaka"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 @error('clinic_address') border-red-500 @enderror"
                                            value="{{ old('clinic_address') }}">
                                        @error('clinic_address')
                                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Row 3: Consultation Fee & Profile Image -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                                <span class="text-red-500">*</span> Consultation Fee (৳)
                                            </label>
                                            <input type="number" name="consultation_fee" placeholder="e.g., 500"
                                                min="0"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 @error('consultation_fee') border-red-500 @enderror"
                                                value="{{ old('consultation_fee') }}">
                                            @error('consultation_fee')
                                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-900 mb-2">
                                                <span class="text-red-500">*</span> Profile Image
                                            </label>
                                            <input type="file" name="profile_image" accept="image/*"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer @error('profile_image') border-red-500 @enderror">
                                            @error('profile_image')
                                                <p class="text-red-600 text-sm mt-2 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Bio -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                                            <span class="text-red-500">*</span> Professional Bio
                                        </label>
                                        <textarea name="bio" rows="4"
                                            placeholder="Write a brief introduction about yourself, your specialization, and experience..."
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 resize-none @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                                        @error('bio')
                                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="pt-4">
                                        <button type="submit"
                                            class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:shadow-lg transition-all duration-300 transform hover:scale-105 active:scale-95 flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            <span>Submit Application</span>
                                        </button>
                                    </div>

                                    <p class="text-xs text-gray-500 text-center">
                                        By submitting, you agree to our terms and certify that all information provided is
                                        accurate.
                                    </p>
                                </form>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
