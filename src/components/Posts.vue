<script setup>
import { RouterLink } from 'vue-router';
import Post from '@/components/Post.vue';
import { onMounted, reactive } from 'vue';
import axios from 'axios';

const state = reactive({
    posts: []
})

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost/belajar-api/get-all-data.php');
    state.posts = response.data;
  } catch (error) {
    console.error('Error fetching jobs:', error);
  }
});
</script>
<template>
    <div class="center-container">
        <h1>All Post</h1>
        <RouterLink :to="`/`" class="btn btn-blue">Go to Home</RouterLink>
        <RouterLink :to="`/posts/add`" class="btn btn-green">Add Post</RouterLink>
        <br />
        <br />
        <table id="posts">
            <tr>
                <th>ID</th>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
            </tr>
            <Post v-for="post in state.posts" :key="post.id" :post="post"/>
        </table>
    </div>
</template>