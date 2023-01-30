<script>

import axios from 'axios';

export default {
    name: 'App',
    data(){
        return{
            baseUrl: 'http://127.0.0.1:8000/api/',
            projects: [],
            contentMaxLength: 150
        }
    },
    methods:{
        getApi(){
            axios.get(this.baseUrl + 'projects')
                .then(res => {
                    this.projects = res.data.projects;
                })
        }

    },
    mounted(){
        this.getApi();
    }
}
</script>

<template>

</template>

<style lang="scss">

@use '../scss/appVue.scss';

</style>
