<script setup>
import AdminLayout from '../layouts/admin.vue';
const { users } = defineProps({
  users: Object
});

</script>

<template>
  <AdminLayout>
    <h1 class="text-2xl font-bold mb-4">User List</h1>

    <ul class="bg-white p-4 rounded shadow">
      <li v-for="user in users.data" :key="user.id" class="py-1 border-b">
        {{ user.name }} - {{ user.email }}
      </li>
    </ul>
  </AdminLayout>
</template>