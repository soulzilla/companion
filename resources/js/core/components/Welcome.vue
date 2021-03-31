<template>
    <div>
        <main>
            <div class="text-center font-weight-bold fa-7x bg-white">
                <router-link to="/" class="text-decoration-none">
                    <span class="text-danger">CS</span><span class="text-dark">Zilla</span>
                </router-link>
            </div>
            <router-view :key="$route.fullPath"></router-view>
        </main>
        <footer class="bg-dark py-3">
            <div class="text-center">
                <span class="text-light text-decoration-none">Посещений всего: {{ total }}</span>
            </div>
            <div class="text-center">
                <span class="text-light text-decoration-none">За последние 24 часа: {{ today }}</span>
            </div>
            <div class="text-center">
                <b-link href="mailto:cszilla@gmail.com" class="text-light text-decoration-none">cszilla@gmail.com</b-link>
            </div>
        </footer>
    </div>
</template>

<script>

    import axios from "axios";

    export default {
        data: () => ({
            total: 0,
            today: 0
        }),

        mounted() {
            let that = this
            axios.get('/visits').then(function (response) {
                that.total = response.data.total
                that.today = response.data.today
            })
        }
    }
</script>

<style lang="scss" scoped>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }
    .full-height {
        height: 100vh;
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .position-ref {
        position: relative;
    }
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }
    .content {
        text-align: center;
    }
    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
    .m-b-md {
        margin-bottom: 30px;
    }
</style>
