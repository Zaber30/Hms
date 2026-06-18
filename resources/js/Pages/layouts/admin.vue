<template>
  <!-- Single root element -->
  <div class="flex min-h-screen bg-gray-100">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white p-4">
      <h2 class="text-lg font-bold mb-4">Admin Sidebar</h2>
      <ul>
        <li><Link href="/dashboard" class="block py-1">Dashboard</Link></li>
        <li><Link href="/users" class="block py-1">Users</Link></li>
        <li><Link href="/settings" class="block py-1">Settings</Link></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6">
      <!-- Navbar -->
      <header class="mb-4 bg-white shadow p-4 rounded">
        <h1 class="text-xl font-bold">Admin Panel</h1>
      </header>

      <!-- Page content injected here -->
      <main>
        <slot />
      </main>
    </div>

  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>