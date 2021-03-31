<template>
    <section id="training_show">
        <div class="text-center">{{ training.name }}</div>
    </section>
</template>

<script>

    import trainingApi from "../api"

    export default {
        name: "TrainingView",
        components: {},
        data() {
            return {
                training: {},
            }
        },
        methods: {
            async fetchTraining() {
                const response = await trainingApi.find(this.$route.params.id)
                this.training = response.data.data
            },
        },
        mounted() {
            this.fetchTraining()
        },
    }
</script>

<style lang="scss" scoped>

</style>
