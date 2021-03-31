<template>
    <section id="gallery_show">
        <div class="text-center">{{ gallery.name }}</div>
    </section>
</template>

<script>

    import galleryApi from "../api"

    export default {
        name: "GalleryView",
        components: {},
        data() {
            return {
                gallery: {},
            }
        },
        methods: {
            async fetchGallery() {
                const response = await galleryApi.find(this.$route.params.id)
                this.gallery = response.data.data
            },
        },
        mounted() {
            this.fetchGallery()
        },
    }
</script>

<style lang="scss" scoped>

</style>
