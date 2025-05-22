<script setup>
import axios from 'axios';
import { reactive } from 'vue';
import router from '@/router';

const form = reactive({
    student_no: '',
    student_name: '',
    student_class: ''
})
const handleSubmit = async () => {
    const newPost = {
        student_no: form.student_no,
        student_name: form.student_name,
        student_class: form.student_class
    }
    try {
        const response = await axios.post('http://localhost/belajar-api/insert-data.php', newPost);
        return router.push('/posts');
    } catch (error) {
        console.error("Error on posting data:", error);
    }
}

</script>

<template>
    <RouterLink :to="`/posts`" class="btn btn-green">Return to Posts</RouterLink>
    <div>
    <form @submit.prevent="handleSubmit">
        <label for="no">No</label>
        <input 
            v-model="form.student_no" 
            type="text" 
            id="no" 
            name="no" 
            placeholder="no" 
        />

        <label for="name">Name</label>
        <textarea 
            v-model="form.student_name" 
            id="name" 
            name="name"
        ></textarea>

        <label for="class">Class</label>
        <textarea 
            v-model="form.student_class" 
            id="class" 
            name="class"
        ></textarea>

        <button type="submit" class="btn btn-green">Submit</button>
    </form>
</div>
</template>