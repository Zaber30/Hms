@extends('layouts.doctor')

@section('content')
    <div class="max-w-3xl mx-auto py-16 px-4 text-center">
        <h1 class="text-2xl font-bold mb-4">Account Pending Approval</h1>
        <p class="text-gray-600 mb-6">Your doctor registration is under review by an administrator. You will be notified
            once your account is approved.</p>
        <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">Back to Home</a>
    </div>
@endsection
