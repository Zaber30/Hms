@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Specialization Management</h1>
        <p class="text-gray-600 mt-2">Manage doctors by specialization and update their details</p>
    </div>

    <!-- Specializations Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($specializations as $spec)
        <a href="{{ route('admin.specializations.show', $spec) }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $spec }}</h3>
                    <p class="text-gray-600 text-sm mt-1">
                        {{ count($doctorsBySpecialization[$spec] ?? []) }} doctor(s)
                    </p>
                </div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-bold">
                    {{ count($doctorsBySpecialization[$spec] ?? []) }}
                </div>
            </div>

            <!-- Doctor List -->
            <div class="space-y-2 mt-4">
                @foreach($doctorsBySpecialization[$spec] ?? [] as $doctor)
                <div class="text-sm text-gray-600 flex items-center justify-between">
                    <span>{{ $doctor->user?->name }}</span>
                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">৳{{ $doctor->consultation_fee }}</span>
                </div>
                @endforeach
            </div>

            <!-- View More -->
            <div class="mt-4 text-blue-600 text-sm font-medium hover:text-blue-700">
                View & Manage →
            </div>
        </a>
        @empty
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500 text-lg">No specializations found.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
