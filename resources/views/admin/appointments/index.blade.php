@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Appointment Management</h1>
        <p class="text-gray-600 mt-2">View, edit, and manage all patient appointments</p>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form method="GET" action="{{ route('admin.appointments.index') }}" class="flex gap-4 flex-wrap">
            <input
                type="text"
                name="search"
                placeholder="Search by patient or doctor name..."
                class="flex-1 min-w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                value="{{ $search ?? '' }}"
            >
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">All Status</option>
                <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                Search
            </button>
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif

    <!-- Appointments Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Patient</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Doctor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Date & Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Booked</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($appointments as $appointment)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                        {{ $appointment->patient->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $appointment->schedule->doctor->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $appointment->schedule->schedule_date->format('M d, Y') ?? 'N/A' }}
                        <br>
                        {{ $appointment->schedule->start_time ?? 'N/A' }} - {{ $appointment->schedule->end_time ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $appointment->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $appointment->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $appointment->status === 'cancelled' ? 'bg-gray-100 text-gray-800' : '' }}
                        ">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $appointment->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('admin.appointments.show', $appointment) }}" class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 font-medium">
                            View
                        </a>
                        <a href="{{ route('admin.appointments.edit', $appointment) }}" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 font-medium">
                            Edit
                        </a>
                        <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
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
                        No appointments found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $appointments->links() }}
    </div>
</div>
@endsection
