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
        const confirm = window.confirm('Are you sure you want to delete this posts?');
        if(confirm) {
            await axios.delete(`http://localhost/belajar-api/delete-data.php?id=${postId}`);
            router.push('/');
            
        }
    } catch (error) {
        console.error("Error deleting post: ", error);
    }
}
</script>
<template>
    <tr>
        <td>{{ post.student_no }}</td>
        <td>{{ post.student_name }}</td>
        <td>{{ post.student_class }}</td>
        <td>
            <RouterLink :to="`/posts/${post.student_id}`" class="btn btn-green">O</RouterLink>
            <RouterLink :to="`/posts/edit/${post.student_id}`"class="btn btn-blue">/</RouterLink>
            <button @click="deletePost(post.student_id)" class="btn btn-red">X</button>
        </td>
    </tr>
</template>