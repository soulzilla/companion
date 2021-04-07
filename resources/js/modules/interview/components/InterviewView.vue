<template>
    <section id="interview_show">
        <div class="text-center">{{ interview.name }}</div>
    </section>
</template>

<script>

    import interviewApi from "../api"

    export default {
        name: "InterviewView",
        components: {},
        data() {
            return {
                interview: {},
            }
        },
        methods: {
            async fetchInterview() {
                const response = await interviewApi.find(this.$route.params.id)
                this.interview = response.data.data
            },
        },
        mounted() {
            this.fetchInterview()
        },
    }
</script>

<style lang="scss" scoped>

</style>
