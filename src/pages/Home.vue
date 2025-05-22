<script>
import { RouterLink } from 'vue-router';
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-green-100 via-blue-100 to-purple-200 p-4">
    <div class="bg-white shadow-2xl rounded-2xl p-10 text-center max-w-md w-full animate-fade-in">
      <h1 class="text-4xl font-bold mb-6 text-gray-800">Welcome to Crud</h1>
      <p class="mb-6 text-gray-600">Manage your posts easily with our simple CRUD interface.</p>
      <RouterLink
        :to="`/posts`"
        class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-md"
      >
        🚀 Go To Posts
      </RouterLink>
    </div>
  </div>
</template>

<style scoped>
@keyframes fade-in {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
  animation: fade-in 0.6s ease-out forwards;
}
</style>
