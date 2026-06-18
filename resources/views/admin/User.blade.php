@extends('layouts.admin')

@section('content')
<style>
    .user-table-container {
        transition: all 0.3s ease;
    }

    .user-row {
        transition: all 0.2s ease;
    }

    .user-row:hover {
        background-color: #f9fafb;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .badge {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .badge-patient {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .badge-doctor {
        background-color: #dcfce7;
        color: #166534;
    }

    .badge-admin {
        background-color: #fecaca;
        color: #991b1b;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-in {
        animation: slideInUp 0.5s ease-out;
    }
</style>

<div class="bg-gray-50 min-h-screen p-4 md:p-8">
  <div class="max-w-7xl mx-auto">

    <!-- Header Section -->
    <div class="mb-8 animate-in">
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-6">
        <div>
          <h1 class="text-4xl font-bold text-gray-900 mb-2">Manage Users</h1>
          <p class="text-gray-600 text-lg">View and manage all registered users in the system</p>
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow text-gray-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
          </svg>
          <span class="text-sm font-medium">Total Users: <strong>{{ $users->total() }}</strong></span>
        </div>
      </div>

      <!-- Filter Section -->
      <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
        <form method="GET" action="{{ route('admin.user-list') }}" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search Input -->
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 mb-2">Search Users</label>
              <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search by name or email..." 
                    value="{{ $search }}"
                    class="w-full pl-12 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition">
              </div>
            </div>

            <!-- Type Filter -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Type</label>
              <select 
                  name="type" 
                  class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition">
                <option value="">All Types</option>
                <option value="patient" {{ $type === 'patient' ? 'selected' : '' }}>Patients</option>
                <option value="doctor" {{ $type === 'doctor' ? 'selected' : '' }}>Doctors</option>
                <option value="admin" {{ $type === 'admin' ? 'selected' : '' }}>Admins</option>
              </select>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row sm:items-end gap-3 pt-2">
            <button 
                type="submit" 
                class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl shadow-md hover:shadow-lg hover:from-blue-600 hover:to-blue-700 transition font-semibold flex items-center justify-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
              </svg>
              Filter Users
            </button>
            <a 
                href="{{ route('admin.user-list') }}" 
                class="px-6 py-2.5 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition font-semibold text-center">
              Clear Filters
            </a>
          </div>
        </form>
      </div>
    </div>

    <!-- Users Table/Cards -->
    <div class="user-table-container">
      @if($users->count() > 0)
        <!-- Desktop Table View -->
        <div class="hidden md:block bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
          <table class="w-full">
            <thead>
              <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">User</th>
                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Email</th>
                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Type</th>
                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Joined</th>
                <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr class="user-row border-b border-gray-100 last:border-b-0">
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                        {{ substr($user->name, 0, 1) }}
                      </div>
                      <div>
                        <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                  </td>
                  <td class="px-6 py-4">
                    <span class="badge badge-{{ $user->type }}">
                      {{ ucfirst($user->type) }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <p class="text-gray-600 text-sm">{{ $user->created_at->format('M d, Y') }}</p>
                  </td>
                  <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                      {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                    </span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
          @foreach($users as $user)
            <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100 user-row">
              <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white font-bold">
                    {{ substr($user->name, 0, 1) }}
                  </div>
                  <div>
                    <p class="font-bold text-gray-900">{{ $user->name }}</p>
                    <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                  </div>
                </div>
                <span class="badge badge-{{ $user->type }}">{{ ucfirst($user->type) }}</span>
              </div>
              <div class="space-y-2 text-sm border-t border-gray-100 pt-3">
                <div class="flex justify-between">
                  <span class="text-gray-600">Joined:</span>
                  <span class="font-medium text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-gray-600">Status:</span>
                  <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                  </span>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-lg p-12 border border-gray-100 text-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.488M15 6a3 3 0 11-6 0 3 3 0 016 0zM6 20h12v-2a9 9 0 00-9-9H6v11z" />
          </svg>
          <p class="text-gray-600 text-lg font-medium">No users found</p>
          <p class="text-gray-500 mt-1">Try adjusting your filters or search criteria</p>
        </div>
      @endif

      <!-- Pagination -->
      @if($users->count() > 0)
        <div class="mt-8 flex justify-center">
          {{ $users->appends(request()->query())->links('pagination::tailwind') }}
        </div>
      @endif
    </div>

  </div>
</div>

@endsection