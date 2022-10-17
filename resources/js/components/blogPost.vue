<template>
    <li class="post">
            <img :src="post.cover" :alt="`Copertina ${post.title}`">
           <p>Titolo</p>
           <p>{{ post.title }}</p>
           <p>Categoria</p>
           <p>{{ post.category.name }}</p>
<!--           <p>Tags</p>-->
<!--           <p>{{ post.tags.name }}</p>-->
    </li>
</template>

<script>


export default {
    name:'blogPost',
    props:{
        post: Array,
    }
}
</script>

<style lang="scss">

</style>
