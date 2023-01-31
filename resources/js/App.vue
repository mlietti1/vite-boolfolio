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

                        <p v-if="project.type" class="type mb-3">{{ project.type.name }}</p>
                        <p class="user">Author: {{ project.user.name }}</p>
                        <span><strong>Client: </strong></span>
                        <p>{{ project.client_name }}</p>

                        <p v-html="truncateText(project.summary)" class="card-text"></p>
                        <div class="d-flex justify-content-between">
                            <div class="tech" v-if="project.technologies.length">
                                <span v-for="technology in project.technologies" :key="technology.id">#{{ technology.name }} </span>
                            </div>
                        <div class="tech" v-else>NA</div>
                            <a class="info-btn" href="#">more info...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center paginator my-3">

            <button :disabled="pagination.current === 1"
            class="me-3 btn btn-secondary"
            @click="getApi(1)">
                <i class="fa-solid fa-angles-left"></i>
            </button>

            <button :disabled="pagination.current === 1"
            class="me-3 btn btn-secondary"
            @click="getApi(pagination.current - 1)">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <button
            v-for="i in pagination.last" :key="i"
            class="me-3 btn btn-secondary"
            :disabled="pagination.current === i"
            @click="getApi(i)">{{ i }}</button>

            <button :disabled="pagination.current === pagination.last" class="me-3 btn btn-secondary"
            @click="getApi(pagination.current + 1)">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <button :disabled="pagination.current === pagination.last" class="me-3 btn btn-secondary"
            @click="getApi(pagination.last)">
                <i class="fa-solid fa-angles-right"></i>
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

.type {
    font-size: 0.8rem;
    color: rgb(15, 176, 123);
}

.user{
    font-size: 0.8rem;
}

.info-btn{
    text-decoration: none;
    color: #c187ff;
    font-size: 0.8rem;
    font-weight: 600;
    &:hover{
        color: #8d58c6;
    }
}

.tech{
    font-size: 0.8rem;
    color: grey;
    display: inline-block;
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
