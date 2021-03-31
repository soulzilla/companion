<template>
    <section id="command_show">
        <div class="text-center">{{ command.name }}</div>
    </section>
</template>

<script>

    import commandApi from "../api"

    export default {
        name: "CommandView",
        components: {},
        data() {
            return {
                command: {},
            }
        },
        methods: {
            async fetchCommand() {
                const response = await commandApi.find(this.$route.params.id)
                this.command = response.data.data
            },
        },
        mounted() {
            this.fetchCommand()
        },
    }
</script>

<style lang="scss" scoped>

</style>
