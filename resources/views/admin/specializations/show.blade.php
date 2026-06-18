@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ $specialization }}</h1>
        <p class="text-gray-600 mt-2">Manage doctors in this specialization</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif

    <!-- Doctors Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Doctor Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Experience</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Consultation Fee</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Schedules</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($doctors as $doctor)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                        {{ $doctor->user?->name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $doctor->phone }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $doctor->experience_years }} years
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                        ৳{{ $doctor->consultation_fee }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $doctor->schedules?->count() ?? 0 }} schedules
                    </td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('admin.doctors.edit', $doctor) }}" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 font-medium">
                            Edit
                        </a>
                        <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 font-medium">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        No doctors found in this specialization.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $doctors->links() }}
    </div>

    <!-- Back Button -->
    <div class="mt-8">
        <a href="{{ route('admin.specializations.index') }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium">
            Back to Specializations
        </a>
    </div>
</div>
@endsection
