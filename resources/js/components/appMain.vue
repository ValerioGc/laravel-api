<template>
    <main>
        <div class="post-container">
            <ul>
                <blogPost v-for="(post, index) in blogPosts" :key="index" :post="post" />
            </ul>
        </div>
    </main>
</template>

<script>

    import blogPost from './blogPost.vue';

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
        mounted() {

        },
        methods:{

        },

    }
</script>

<style lang="scss">

</style>
