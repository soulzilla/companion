<template>
    <section id="advertisement_show">
        <div class="text-center">{{ advertisement.name }}</div>
    </section>
</template>

<script>

    import advertisementApi from "../api"

    export default {
        name: "AdvertisementView",
        components: {},
        data() {
            return {
                advertisement: {},
            }
        },
        methods: {
            async fetchAdvertisement() {
                const response = await advertisementApi.find(this.$route.params.id)
                this.advertisement = response.data.data
            },
        },
        mounted() {
            this.fetchAdvertisement()
        },
    }
</script>

<style lang="scss" scoped>

</style>
