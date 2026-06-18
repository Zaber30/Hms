@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Doctor: {{ $doctor->user?->name }}</h1>
        <p class="text-gray-600 mt-2">Update doctor specialization and details</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Name (Read-only) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Doctor Name</label>
                <div class="px-4 py-2 bg-gray-100 rounded-lg text-gray-900">
                    {{ $doctor->user?->name }}
                </div>
            </div>

            <!-- Specialization -->
            <div>
                <label for="specialist" class="block text-sm font-medium text-gray-700 mb-2">Specialization</label>
                <select
                    name="specialist"
                    id="specialist"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('specialist') border-red-500 @enderror"
                    required
                >
                    <option value="">-- Select Specialization --</option>
                    @foreach($specializations as $spec)
                    <option value="{{ $spec }}" {{ old('specialist', $doctor->specialist) === $spec ? 'selected' : '' }}>
                        {{ $spec }}
                    </option>
                    @endforeach
                </select>
                @error('specialist')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    value="{{ old('phone', $doctor->phone) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                    required
                >
                @error('phone')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Consultation Fee -->
            <div>
                <label for="consultation_fee" class="block text-sm font-medium text-gray-700 mb-2">Consultation Fee (৳)</label>
                <input
                    type="number"
                    name="consultation_fee"
                    id="consultation_fee"
                    value="{{ old('consultation_fee', $doctor->consultation_fee) }}"
                    step="0.01"
                    min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('consultation_fee') border-red-500 @enderror"
                    required
                >
                @error('consultation_fee')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bio -->
            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Professional Bio</label>
                <textarea
                    name="bio"
                    id="bio"
                    rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('bio') border-red-500 @enderror"
                    placeholder="Enter doctor's professional bio..."
                >{{ old('bio', $doctor->bio) }}</textarea>
                @error('bio')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Additional Info (Read-only) -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-900 mb-3">Additional Information</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Experience</p>
                        <p class="text-gray-900 font-medium">{{ $doctor->experience_years }} years</p>
                    </div>
                    <div>
                        <p class="text-gray-600">BMDC Registration</p>
                        <p class="text-gray-900 font-medium">{{ $doctor->bmdc_registration_number ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                    Save Changes
                </button>
                <a href="{{ route('admin.specializations.show', $doctor->specialist) }}" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
