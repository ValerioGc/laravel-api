<template>
    <body>
        <appHeader />
        <appMain />
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

<style lang="scss"></style>
