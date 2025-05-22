<script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const postId = route.params.id;

const form = reactive({
    student_no: '',
    student_name: '',
    student_class: ''
})

onMounted( async () => {
    try {
        const response = await axios.get(`http://localhost/belajar-api/get-all-data.php?id=${postId}`);
        form.student_no = response.data.student_no;
        form.student_name = response.data.student_name;
        form.student_class = response.data.student_class;
    } catch (error) {
        console.log("Error fetching post", error);
    }
})

const handleSubmit = async () => {
    const updatePost = {
        student_id: postId,
        student_no: form.student_no,
        student_name: form.student_name,
        student_class: form.student_class
    }

    try {
        const response = await axios.patch(`http://localhost/belajar-api/update-data.php`, updatePost);
        router.push(`/posts`);
    } catch (error) {
        console.error("Error updating post", error);
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