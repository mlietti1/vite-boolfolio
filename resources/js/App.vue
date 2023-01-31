<script>

import axios from 'axios';

export default {
    name: 'App',
    data(){
        return{
            baseUrl: 'http://127.0.0.1:8000/api/',
            projects: [],
            contentMaxLength: 100,
            pagination:{
                current: null,
                last: null
            }
        }
    },
    methods:{
        getApi(page){
            this.pagination.current = page
            axios.get(this.baseUrl + 'projects', {
                params: {
                    page: this.pagination.current
                }
            })
                .then(res => {
                    this.projects = res.data.projects.data;
                    // this.pagination.current = res.data.projects.current_page;
                    this.pagination.last = res.data.projects.last_page;
                })
        },
        truncateText(text){
            if(text.length > this.contentMaxLength){
                return text.substr(0, this.contentMaxLength) + '...';
            }
            return text;
        }

    },
    mounted(){
        this.getApi(1);
    }

}
</script>

<template>

    <div class="container py-5">

        <h1 class="my-3">My Projects</h1>

        <div class="row row-cols-lg-4 row-cols-1 row-cols-sm-2">
            <div v-for="project in projects" :key="project.id">
                <div class="card my-3">
                    <img class="card-img-top" src="" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ project.name }}</h5>
                        <p><strong>{{ project.client_name }}</strong></p>
                        <p v-html="truncateText(project.summary)" class="card-text"></p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="paginator">
            <button :disabled="pagination.current === 1"
            class="me-3 btn btn-secondary"
            @click="getApi(pagination.current - 1)">
                <i class="fa-solid fa-arrow-left"></i>
            </button>

            <button
            v-for="i in pagination.last" :key="i"
            class="me-3 btn btn-secondary"
            @click="getApi(i)">{{ i }}</button>

            <button :disabled="pagination.current === pagination.last" class="me-3 btn btn-secondary"
            @click="getApi(pagination.current + 1)">
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>




</template>

<style lang="scss">

@use '../scss/appVue.scss';


button{
        display: inline-block;
        min-width: 38px;
    }

@media screen and (min-width: 576px ) {
    .card-text{
        min-height: 120px;
    }
    h5{
        min-height: 48px;
    }
}

@media screen and (min-width: 992px ) {
    .card-text{
        min-height: 144px;
    }
    h5{
        min-height: 48px;
    }

}

</style>
