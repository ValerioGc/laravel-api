<template>
    <li class="post parent">
        <div class="pr-2 d-inline-block" style="    vertical-align: top;">
            <img style="vertical-align: unset; height: 50px" :src="post.cover" :alt="`Copertina ${post.title}`">
        </div>
        <div class=" d-inline-block">
            <div class="div3">
                <h3 class="d-inline-block post-title">{{ post.title }}</h3>
                <button>Vedi Post</button>
                <hr class="my-3"/>
                <p>{{ truncateText(post.content, 100) }}</p>
            </div>
            <div class="info-post">
                <div class="post-category d-inline-block">
                    <p>{{ post.category.title }}</p>
                    <p v-if="post.category.length = 0">Nessuna Categoria</p>
                </div>
                <div class="post-date d-inline-block">
                    <p>{{post.created_at}}</p>
                </div>
            </div>
        </div>

    </li>
</template>

<script>


export default {
    name:'blogPost',
    props:{
        post: Object,
    },
    data() {
        return {
            date: '',
            convertedDate: '',
        }
    },
    methods:{
        convertDate(date) {
            return date.toUTCString();
        },
        truncateText(text, maxLength) {
            if (text.length < maxLength) {
                return text;
            } else {
                return text.substring(0, maxLength) + '...';
            }

        }
    }
}
</script>

<style lang="scss" scoped>
    .post {
        background-color: #ffffff;
        margin: 3rem auto;
        position: relative;
        padding: 1rem;
        box-shadow: 0 0 6px black;
        border-radius: 10px;
        width: 50vw;

hr {
    color: #a1cbef;
}
        .info-post {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
        }

        .post-title {
            font-weight: bold;
            font-size: 20px;
            text-transform: capitalize;
        }

        .post-category {
            padding: 1rem 0;

            p {
                font-style: italic;
                font-weight: 500;
            }

        }
        .post-date {
            text-align: right;
            padding: 1rem 0;
            font-style: italic;
            font-weight: 500;
        }
    }
    button   {
        position: absolute;
        right: 3rem;
        border-radius: 5px;
        background-color: rgba(89, 164, 238, 0.8);
        border: 1px solid black;
        box-shadow: 0 0 5px #000;
        width: 90px;

            @media screen and (max-width: 978px){
                right: 50%;
                transform: translateX(50%);
                bottom: 20px;
            }
    }
</style>
