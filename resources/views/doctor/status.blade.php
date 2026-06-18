@extends('layouts.doctor')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-200 flex items-center justify-center p-6">
        <div class="bg-white shadow-xl rounded-2xl w-full max-w-3xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Your Profile Submission</h2>

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($doctor)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-gray-600 font-semibold">Phone:</p>
                        <p class="text-gray-800">{{ $doctor->phone }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Gender:</p>
                        <p class="text-gray-800">{{ ucfirst($doctor->gender) }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Qualification:</p>
                        <p class="text-gray-800">{{ $doctor->qualification }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Experience (Years):</p>
                        <p class="text-gray-800">{{ $doctor->experience_years }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-gray-600 font-semibold">Bio:</p>
                        <p class="text-gray-800">{{ $doctor->bio }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-gray-600 font-semibold">Clinic Address:</p>
                        <p class="text-gray-800">{{ $doctor->clinic_address }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold">Consultation Fee:</p>
                        <p class="text-gray-800">BDT {{ $doctor->consultation_fee }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 font-semibold mb-3">Profile Image:</p>
                        <div class="relative inline-block">
                            @if ($doctor->profile_image)
                                <img src="{{ asset('storage/' . $doctor->profile_image) }}" alt="Profile Image"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-blue-600 shadow-lg">
                            @else
                                <div
                                    class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center border-4 border-blue-600 shadow-lg">
                                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="md:col-span-2 text-center mt-6">
                        <p class="font-semibold text-lg">
                            Status:
                            @if ($doctor->status == 'pending')
                                <span class="text-yellow-600 bg-yellow-100 px-3 py-1 rounded-full">Pending</span>
                            @elseif($doctor->status == 'approved')
                                <span class="text-green-600 bg-green-100 px-3 py-1 rounded-full">Approved</span>
                            @endif
                        </p>
                    </div>

                </div>
            @else
                <p class="text-gray-500 text-center">No submission found.</p>
            @endif
        </div>
    </div>
@endsection
