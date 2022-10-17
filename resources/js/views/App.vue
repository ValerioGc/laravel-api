<template>
    <body>
        <appHeader />
        <div class="wrapper">
            <appMain />
        </div>
    </body>
</template>

<script>

    import appHeader from "../components/appHeader";
    import appMain from "../components/appMain";

    export default {
        name: 'App',
        components: {
            appHeader,
            appMain,
        }
    }
</script>

<style lang="scss">

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    ul {
        list-style: none;


        li:hover,
        a:hover {
            text-decoration: none!important;


        }
    }
    body {
        font-family: 'Open Sans', sans-serif;
        overflow-y: hidden;
    }

    .wrapper {
        scroll-behavior: smooth;
        width: 100vw;
        height: 100vh;
        overflow-y: scroll;
    }

    .show {
        display: inline-block!important;
    }

</style>
