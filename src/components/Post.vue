<script setup>
import axios from 'axios';
import { defineProps } from 'vue';
import { RouterLink, useRouter } from 'vue-router';

const router = useRouter();

const props = defineProps({
  post: Object
});

const deletePost = async (postId) => {
  try {
    const confirmDelete = window.confirm('Are you sure you want to delete this post?');
    if (confirmDelete) {
      await axios.delete(`http://localhost/belajar-api/delete-data.php?id=${postId}`);
      router.push('/');
    }
  } catch (error) {
    console.error("Error deleting post:", error);
  }
};
</script>

<template>
  <tr class="bg-white hover:bg-gray-100 transition duration-200 border-b border-gray-200">
    <td class="px-6 py-4 text-gray-800 font-medium">{{ post.student_no }}</td>
    <td class="px-6 py-4 text-gray-700">{{ post.student_name }}</td>
    <td class="px-6 py-4 text-gray-700">{{ post.student_class }}</td>
    <td class="px-6 py-4 space-x-2">
      <RouterLink
        :to="`/posts/${post.student_id}`"
        class="inline-flex items-center bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded-xl text-sm font-medium shadow transition"
        title="View"
      >
        👁️
      </RouterLink>
      <RouterLink
        :to="`/posts/edit/${post.student_id}`"
        class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-xl text-sm font-medium shadow transition"
        title="Edit"
      >
        ✏️
      </RouterLink>
      <button
        @click="deletePost(post.student_id)"
        class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-xl text-sm font-medium shadow transition"
        title="Delete"
      >
        🗑️
      </button>
    </td>
  </tr>
</template>
