@extends('layouts.doctor')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-indigo-50 to-white p-6">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl p-8 border border-indigo-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Reset Password</h2>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                       class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-1">New Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-6 rounded-lg font-semibold shadow-md transition-all">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
