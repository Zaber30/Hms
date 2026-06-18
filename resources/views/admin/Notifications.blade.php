@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto mt-6">

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">
        Notifications
    </h2>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">

        <ul class="divide-y divide-gray-200">

            @forelse($notifications as $notification)

            <li class="p-4 hover:bg-gray-50 transition duration-200">
                
                <a href="{{ $notification->data['url'] ?? '#' }}" 
                   class="flex justify-between items-start">

                    <div>
                        <p class="text-gray-800 font-medium">
                            {{ $notification->data['message'] ?? 'Notification' }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $notification->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">
                        New
                    </span>

                </a>

            </li>

            @empty

            <li class="p-6 text-center text-gray-500">
                No notifications found
            </li>

            @endforelse

        </ul>

    </div>
</div>

@endsection