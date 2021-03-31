<template>
    <section id="map_show">
        <div class="text-center">{{ map.name }} #{{ map.weight }}</div>
        <el-image :src="map.logo"></el-image>
        <el-image :src="map.background_image"></el-image>
        <el-image :src="map.positions_image"></el-image>
        <el-link :href="map.practice_map">{{ map.practice_map }}</el-link>
        <el-image :src="map.practice_preview"></el-image>
    </section>
</template>

<script>

    import mapApi from "../api"

    export default {
        name: "MapView",
        components: {},
        data() {
            return {
                map: {},
            }
        },
        methods: {
            async fetchMap() {
                const response = await mapApi.find(this.$route.params.id)
                this.map = response.data.data
            },
        },
        mounted() {
            this.fetchMap()
        },
    }
</script>

<style lang="scss" scoped>

</style>
