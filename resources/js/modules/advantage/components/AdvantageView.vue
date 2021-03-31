<template>
    <section id="advantage_show">
        <div class="text-center">{{ advantage.name }}</div>
    </section>
</template>

<script>

    import advantageApi from "../api"

    export default {
        name: "AdvantageView",
        components: {},
        data() {
            return {
                advantage: {},
            }
        },
        methods: {
            async fetchAdvantage() {
                const response = await advantageApi.find(this.$route.params.id)
                this.advantage = response.data.data
            },
        },
        mounted() {
            this.fetchAdvantage()
        },
    }
</script>

<style lang="scss" scoped>

</style>
