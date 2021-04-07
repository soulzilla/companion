<template>
    <section id="question_show">
        <div class="text-center">{{ question.name }}</div>
    </section>
</template>

<script>

    import questionApi from "../api"

    export default {
        name: "QuestionView",
        components: {},
        data() {
            return {
                question: {},
            }
        },
        methods: {
            async fetchQuestion() {
                const response = await questionApi.find(this.$route.params.id)
                this.question = response.data.data
            },
        },
        mounted() {
            this.fetchQuestion()
        },
    }
</script>

<style lang="scss" scoped>

</style>
