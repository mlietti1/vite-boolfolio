
<script>
export default {
    name: 'ProjectCard',
    data(){
        return{
            thumb: 'https://northphoenixprep.greatheartsamerica.org/wp-content/uploads/sites/21/2016/11/default-placeholder.png'
        }
    },
    props: {
        project: Object
    },
    methods:{
        truncateText(text){
            if(text.length > this.contentMaxLength){
                return text.substring(0, this.contentMaxLength) + '...';

            }
            return text;
        },

        getPlaceholder(){
            if(this.project.cover_image === null){
                this.project.cover_image = this.thumb;
            }
            return this.project.cover_image
        }

    }
}
</script>

<template>

<div class="card" style="width: 18rem;">
  <img class="card-img-top" :src="this.getPlaceholder()" :alt="project.name">
  <div class="card-body">
    <h5 class="card-title">{{ project.name }}</h5>
    <p><strong>{{ project.client_name }}</strong></p>
    <p class="card-text">{{project.summary}}</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

</template>

<style lang="scss" scoped>

</style>
