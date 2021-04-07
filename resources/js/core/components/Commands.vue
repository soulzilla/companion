<template>
    <section id="Training" class="p-3">
        <div class="banner-top">
            <template v-if="loading">
                <b-skeleton-img height="300px" no-aspect></b-skeleton-img>
            </template>
            <template v-else>
                <template v-if="topBanner">
                    <b-link :href="topBanner.url" target="_blank">
                        <b-img-lazy :src="topBanner.image"></b-img-lazy>
                    </b-link>
                </template>
                <template v-else>
                    <div class="banner-placeholder">
                        Здесь могла быть Ваша реклама
                    </div>
                </template>
            </template>
        </div>

        <div class="row mb-3">
            <div class="col-md-8">
                <template v-if="loading">
                    <b-skeleton width="20%" height="45px" no-aspect></b-skeleton>
                    <div class="row">
                        <div class="col-md-4 my-3" v-for="i in 9" v-bind:key="'map-placeholder-' + i">
                            <b-card class="shadow">
                                <p><b-skeleton width="100%"></b-skeleton></p>
                                <b-skeleton width="100%"></b-skeleton>
                            </b-card>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <h1>Полезные команды</h1>
                    <div class="row">
                        <div class="col-md-4 my-3" v-for="command of commands" v-bind:key="'command-' + command.id">
                            <b-card class="shadow">
                                <p>{{ command.description }}</p>
                                <div class="alert alert-secondary">
                                    <em>{{ command.name }}</em>
                                </div>
                            </b-card>
                        </div>
                    </div>
                </template>
            </div>
            <div class="col-md-4">
                <div class="banner-giveaway">
                    <template v-if="loading">
                        <b-skeleton-img height="200px" no-aspect></b-skeleton-img>
                    </template>
                    <template v-else>
                        <div v-if="giveawayBanner">
                            <b-link :href="giveawayBanner.url" target="_blank">
                                <b-img-lazy :src="giveawayBanner.image" height="200px"></b-img-lazy>
                            </b-link>
                        </div>
                    </template>
                </div>

                <div class="banner-side">
                    <template v-if="loading">
                        <b-skeleton-img height="780px" no-aspect></b-skeleton-img>
                    </template>
                    <template v-else>
                        <template v-if="sideBanner">
                            <b-link :href="giveawayBanner.url" target="_blank">
                                <b-img-lazy :src="giveawayBanner.image" height="200px"></b-img-lazy>
                            </b-link>
                        </template>
                        <template v-else>
                            <div class="banner-placeholder">
                                Здесь могла быть Ваша реклама
                            </div>
                        </template>
                    </template>
                </div>
            </div>
        </div>

        <div class="banner-bottom">
            <template v-if="loading">
                <b-skeleton-img height="300px" no-aspect></b-skeleton-img>
            </template>
            <template v-else>
                <template v-if="bottomBanner">
                    <b-link :href="bottomBanner.url" target="_blank">
                        <b-img-lazy :src="bottomBanner.image"></b-img-lazy>
                    </b-link>
                </template>
                <template v-else>
                    <div class="banner-placeholder">
                        Здесь могла быть Ваша реклама
                    </div>
                </template>
            </template>
        </div>
    </section>
</template>

<script>
import axios from "axios";

export default {
    name: "Commands",
    data: () => ({
        title: window.config.appName,
        loading: true,
        topBanner: null,
        sideBanner: null,
        bottomBanner: null,
        giveawayBanner: null,
        commands: []
    }),
    methods: {
        embedUrl: function (url) {
            let ID = '';
            url = url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
            if(url[2] !== undefined) {
                ID = url[2].split(/[^0-9a-z_\-]/i);
                ID = ID[0];
            }
            else {
                ID = url;
            }

            return '//www.youtube.com/embed/' + ID;
        }
    },
    mounted() {
        let that = this

        document.title = 'Полезные команды'

        axios.get('/command').then(function (response) {
            that.maps = response.data.maps

            for (let ad of response.data.ads) {
                switch (ad.type) {
                    case 1:
                        that.giveawayBanner = ad
                        break
                    case 2:
                        that.topBanner = ad
                        break
                    case 3:
                        that.bottomBanner = ad
                        break
                    case 4:
                        that.sideBanner = ad
                        break
                }
            }
            that.commands = response.data.data

            that.loading = false
        })
    }
}
</script>

<style scoped>
h1 {
    font-weight: bold;
    font-size: xxx-large;
}

h2 {
    font-weight: bold;
    font-size: x-large;
}

h3 {
    font-weight: bold;
    font-size: large;
}

h4 {
    font-weight: bold;
    font-size: medium;
}

.banner-top {
    height: 300px;
    margin-top: 1rem;
    margin-bottom: 1rem;
}

.banner-giveaway {
    height: 200px;
    margin-top: 1rem;
    margin-bottom: 1rem;
}

.banner-side {
    height: 780px;
    margin-top: 2rem;
}

.banner-bottom {
    height: 300px;
    margin-bottom: 1rem;
}

.banner-placeholder {
    height: inherit;
    background-color: #E4E8F0;
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: xxx-large;
    font-weight: bold;
    text-align: center;
}
</style>
