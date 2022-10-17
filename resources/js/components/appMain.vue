<template>
    <main>
        <div class="post-container">
            <ul v-if="(loading !== 'error') && (loading !== true)">
                <blogPost v-for="(post, index) in blogPosts" :key="index" :post="post" />
            </ul>
            <div class="loader" v-else>
                <h1 v-if="loading === true">Caricamento in Corso</h1>
                <h1 v-if="loading === 'error'">Errore, Nessun post Trovato</h1>
            </div>
        </div>
        <nav v-if="(loading !== 'error') || (loading !== true) ">
            <ul class="pagination">
                <li class="page-item" :class="(currentPage===1?'disabled':'')" ><a class="page-link" href="#" @click.prevent="getPosts(currentPage - 1)">Previous</a></li>

                <li v-for="index in lastPage" :key="index" class="page-item" :class="(currentPage === index)?'active':''">
                    <a href="#" @click.prevent="setActivePage(index)" class="page-link disabled">
                        {{index}}
                    </a>
                </li>

                <li class="page-item" :class="(currentPage===lastPage)?'disabled':''"><a class="page-link" href="#" @click.prevent="getPosts(currentPage + 1)">Next</a></li>
            </ul>

        </nav>
    </main>
</template>

<script>

    import blogPost from './blogPost.vue';
    import axios from "axios";

    export default {
        name:'appMain',
        components: {
            blogPost,
        },
        data() {
            return {
                blogPosts: [],
                currentPage: 1,
                lastPage: null,
                loading: true
            }
        },
        mounted() {this.getPosts(1);},
        methods:{
            async getPosts(pageNumber) {
                this.loading = true;
                if (pageNumber == null) {
                    pageNumber = 999;
                }
                try {
                    const resp = await axios.get('api/posts', {params: {page:pageNumber}})
                    this.blogPosts = resp.data.results.data;
                    this.currentPage = resp.data.results.current_page;
                    this.lastPage = resp.data.results.last_page;
                    if (this.blogPosts !== null) {this.loading = false;}
                }
                catch (err) {
                    console.log(err);
                    this.loading = 'error';
                }
            },
            setActivePage(index) {
                this.currentPage = index;
                this.getPosts(this.currentPage);
            }
        }
    }
</script>

<style lang="scss" scoped>

main {
    background-color: #c7c7c7;
    min-height: calc(100vh - 5rem);
    margin-top: 5rem;
}
        .pagination {
            flex-direction: row!important;
            width: 100%;

            .active-page {
                background-color: blue;
                color: #fff;
            }
        }

        ul {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 80%;
            margin: auto;


            li {
                margin: 2rem 0;
            }
        }
.page-item:last-child .page-link {
    border-top-right-radius: 0.25rem;
    border-bottom-right-radius: 0.25rem;
}
.page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #3490dc;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

.pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
    flex-direction: row !important;
    width: 100%;
}

</style>
