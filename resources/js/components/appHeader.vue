<template>
    <header>
        <nav>
            <div>
                <h3>Boolpress</h3>
            </div>
            <ul>
                <li v-for="(item, index) in navItems" :key="index">
                    <a :href="item.link">{{item.page}}</a>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
    export default {
        name:'appHeader',
        data() {
            return {
                navItems: [
                    {
                        page:'Home',
                        link:'#'
                    },
                    {
                        page:'Post',
                        link:'#'
                    },
                    {
                        page:'Post Recenti',
                        link:'#'
                    },
                    {
                        page:'Categorie',
                        link:'#'
                    }
                ]
            }
        }
    }
</script>

<style lang="scss">

    nav  {
        display: flex;
        justify-content: space-between;

        ul  {
            display: flex;
            justify-content: space-between;
            flex-basis: 80%;
        }
    }

</style>
