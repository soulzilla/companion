<template>
    <section id="Index" class="p-3">
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

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <template v-if="loading">
                        <div class="col-md-4 my-3" v-for="i in 8" v-bind:key="'map-' + i">
                            <b-card class="shadow">
                                <b-skeleton-img card-img="top" height="255px" no-aspect></b-skeleton-img>
                            </b-card>
                        </div>
                    </template>
                    <template v-else>
                        <div class="col-md-4 my-3" v-for="map of maps" v-bind:key="'map-' + map.id">
                            <b-card class="shadow">
                                <router-link :to="{name: 'map', params: {canonical: map.canonical}}">
                                    <b-card-img :src="map.logo"></b-card-img>
                                </router-link>
                            </b-card>
                        </div>
                    </template>
                </div>
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

        <div class="row mb-3">
            <template v-if="loading">
                <div class="col-md-4 my-3" v-for="i in 3" v-bind:key="'video-' + i">
                    <b-skeleton-img height="260px" no-aspect></b-skeleton-img>
                </div>
            </template>
            <template v-else>
                <div class="col-md-4 my-3" v-for="video of videos" v-bind:key="'video-' + video.id">
                    <b-embed
                        type="iframe"
                        aspect="16by9"
                        :src="embedUrl(video.url)"
                        allowfullscreen></b-embed>
                </div>
            </template>
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
        name: "Index",
        data: () => ({
            title: window.config.appName,
            loading: true,
            maps: [],
            topBanner: null,
            sideBanner: null,
            bottomBanner: null,
            giveawayBanner: null,
            videos: []
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

            document.title = that.title

            axios.get('/main').then(function (response) {
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
                that.videos = response.data.gallery

                that.loading = false
            })
        }
    }
</script>

<style lang="scss" scoped>
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
