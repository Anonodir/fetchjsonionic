<script>
import { RouterLink } from 'vue-router';
</script>
<template> 
    <div class="center-container">
        <h1>Welcome to Crud</h1>
        <RouterLink :to="`/posts`" class="btn btn-green">Go To Posts</RouterLink>
    </div>
</template>