<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">My Bookings</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        @if ($bookings->isEmpty())
            <div class="text-gray-600">You have no bookings.</div>
        @else
            <div class="space-y-4">
                @foreach ($bookings as $b)
                    <div class="p-4 border rounded flex justify-between items-center">
                        <div>
                            <div class="font-bold">{{ optional($b->schedule->doctorUser)->name ?? 'Dr. Unknown' }}</div>
                            <div class="text-sm text-gray-600">
                                {{ optional($b->schedule)->schedule_date?->toDateString() }} •
                                {{ optional($b->schedule)->start_time }} - {{ optional($b->schedule)->end_time }}</div>
                            <div class="text-sm text-gray-600">Status: {{ $b->status }}</div>
                        </div>
                        <div>
                            @if ($b->status === 'pending')
                                <form action="{{ route('patient.cancel-booking', $b) }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded">Cancel</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
