@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8 flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
            <p class="text-gray-600 mt-2">User Details & Information</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.users.edit', $user) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                Edit
            </a>
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium">
                Back
            </a>
        </div>
    </div>

    <!-- User Information -->
    <div class="bg-white rounded-lg shadow p-8 space-y-6">
        <!-- Basic Info -->
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Basic Information</h2>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600">Full Name</p>
                    <p class="text-lg font-medium text-gray-900">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="text-lg font-medium text-gray-900">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <hr>

        <!-- Role & Status -->
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Status</h2>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600">Role</p>
                    <p class="mt-1">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $user->role === 'doctor' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $user->role === 'patient' ? 'bg-green-100 text-green-800' : '' }}
                        ">
                            {{ ucfirst($user->role) }}
                        </span>
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    <p class="mt-1">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $user->status === 'inactive' ? 'bg-gray-100 text-gray-800' : '' }}
                            {{ $user->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $user->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                        ">
                            {{ ucfirst($user->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <hr>

        <!-- Timestamps -->
        <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Metadata</h2>
            <div class="grid grid-cols-2 gap-6 text-sm">
                <div>
                    <p class="text-gray-600">Member Since</p>
                    <p class="text-gray-900 font-medium">{{ $user->created_at->format('F d, Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Last Updated</p>
                    <p class="text-gray-900 font-medium">{{ $user->updated_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Section -->
    <div class="mt-8 bg-red-50 rounded-lg shadow p-8 border border-red-200">
        <h2 class="text-xl font-semibold text-red-900 mb-2">Danger Zone</h2>
        <p class="text-red-700 mb-4">Permanently delete this user account and all associated data.</p>
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('This action cannot be undone. Are you sure?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">
                Delete User
            </button>
        </form>
    </div>
</div>
@endsection
