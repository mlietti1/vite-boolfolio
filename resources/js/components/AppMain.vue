<script>
import ProjectCard from './ProjectCard.vue';

export default {
    name: 'AppMain',
    components: {
        ProjectCard
    },
    data(){
        return{

        }
    }
    // faccio qui chiamata api
}
</script>


<template>

<div class="container my-3">
        <h1 class="mb-3">My Projects</h1>
        <ProjectCard></ProjectCard>
    </div>

</template>


<style>

</style>
