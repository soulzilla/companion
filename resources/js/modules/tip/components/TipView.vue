<template>
    <section id="tip_show">
        <div class="text-center">{{ tip.name }}</div>
    </section>
</template>

<script>

    import tipApi from "../api"

    export default {
        name: "TipView",
        components: {},
        data() {
            return {
                tip: {},
            }
        },
        methods: {
            async fetchTip() {
                const response = await tipApi.find(this.$route.params.id)
                this.tip = response.data.data
            },
        },
        mounted() {
            this.fetchTip()
        },
    }
</script>

<style lang="scss" scoped>

</style>
