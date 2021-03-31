<template>
    <section id="Map" class="p-3">
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
                <div class="py-3">
                    <template v-if="loading">
                        <b-card>
                            <div class="d-flex">
                                <b-skeleton type="avatar" class="mr-3" no-aspect></b-skeleton>
                                <b-skeleton width="20%" height="45px" no-aspect></b-skeleton>
                            </div>

                            <b-skeleton-img height="780px" no-aspect></b-skeleton-img>

                            <div class="d-flex">
                                <div class="my-3 mx-auto">
                                    <b-skeleton-img height="150px" width="270px" no-aspect></b-skeleton-img>
                                </div>
                            </div>

                            <b-skeleton width="20%" height="30px" no-aspect></b-skeleton>

                            <b-skeleton width="20%" height="20px" no-aspect></b-skeleton>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-md-4" v-for="i in 3" v-bind:key="'hes-skeleton-' + i">
                                        <b-skeleton width="100%" height="20px" no-aspect></b-skeleton>
                                        <b-skeleton-img height="165px" no-aspect></b-skeleton-img>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <b-skeleton type="input"></b-skeleton>
                                </div>
                            </div>

                            <b-skeleton width="20%" height="20px" no-aspect></b-skeleton>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-md-4" v-for="i in 3" v-bind:key="'smokes-skeleton-' + i">
                                        <b-skeleton width="100%" height="20px" no-aspect></b-skeleton>
                                        <b-skeleton-img height="165px" no-aspect></b-skeleton-img>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <b-skeleton type="input"></b-skeleton>
                                </div>
                            </div>

                            <b-skeleton width="20%" height="20px" no-aspect></b-skeleton>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-md-4" v-for="i in 3" v-bind:key="'flashes-skeleton-' + i">
                                        <b-skeleton width="100%" height="20px" no-aspect></b-skeleton>
                                        <b-skeleton-img height="165px" no-aspect></b-skeleton-img>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <b-skeleton type="input"></b-skeleton>
                                </div>
                            </div>

                            <b-skeleton width="20%" height="20px" no-aspect></b-skeleton>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-md-4" v-for="i in 3" v-bind:key="'molotoves-skeleton-' + i">
                                        <b-skeleton width="100%" height="20px" no-aspect></b-skeleton>
                                        <b-skeleton-img height="165px" no-aspect></b-skeleton-img>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <b-skeleton type="input"></b-skeleton>
                                </div>
                            </div>

                            <b-skeleton width="20%" height="30px" no-aspect></b-skeleton>

                            <b-skeleton width="20%" height="20px" no-aspect></b-skeleton>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-md-4" v-for="i in 3" v-bind:key="'self-skeleton-' + i">
                                        <b-skeleton width="100%" height="20px" no-aspect></b-skeleton>
                                        <b-skeleton-img height="165px" no-aspect></b-skeleton-img>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <b-skeleton type="input"></b-skeleton>
                                </div>
                            </div>

                            <b-skeleton width="20%" height="20px" no-aspect></b-skeleton>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-md-4" v-for="i in 3" v-bind:key="'double-skeleton-' + i">
                                        <b-skeleton width="100%" height="20px" no-aspect></b-skeleton>
                                        <b-skeleton-img height="165px" no-aspect></b-skeleton-img>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <b-skeleton type="input"></b-skeleton>
                                </div>
                            </div>

                            <b-skeleton width="20%" height="20px" no-aspect></b-skeleton>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-md-4" v-for="i in 3" v-bind:key="'team-skeleton-' + i">
                                        <b-skeleton width="100%" height="20px" no-aspect></b-skeleton>
                                        <b-skeleton-img height="165px" no-aspect></b-skeleton-img>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <b-skeleton type="input"></b-skeleton>
                                </div>
                            </div>

                            <b-skeleton width="20%" height="30px" no-aspect></b-skeleton>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-md-4" v-for="i in 3" v-bind:key="'wallbangs-skeleton-' + i">
                                        <b-skeleton width="100%" height="20px" no-aspect></b-skeleton>
                                        <b-skeleton-img height="165px" no-aspect></b-skeleton-img>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <b-skeleton type="input"></b-skeleton>
                                </div>
                            </div>

                            <b-skeleton width="20%" height="30px" no-aspect></b-skeleton>

                            <b-skeleton width="20%" height="20px" no-aspect></b-skeleton>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-md-4" v-for="i in 3" v-bind:key="'grenades-skeleton-' + i">
                                        <b-skeleton width="100%" height="20px" no-aspect></b-skeleton>
                                        <b-skeleton-img height="165px" no-aspect></b-skeleton-img>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <b-skeleton type="input"></b-skeleton>
                                </div>
                            </div>

                            <b-skeleton width="20%" height="20px" no-aspect></b-skeleton>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-md-4" v-for="i in 3" v-bind:key="'positions-skeleton-' + i">
                                        <b-skeleton width="100%" height="20px" no-aspect></b-skeleton>
                                        <b-skeleton-img height="165px" no-aspect></b-skeleton-img>
                                    </div>
                                </div>
                                <div class="my-1">
                                    <b-skeleton type="input"></b-skeleton>
                                </div>
                            </div>

                            <b-skeleton width="100%" height="90px"></b-skeleton>
                        </b-card>
                    </template>
                    <template v-else>
                        <template v-if="map">
                            <b-card class="shadow">
                                <h1><b-img-lazy :src="map.logo" class="mr-3"></b-img-lazy> {{ map.name }}</h1>

                                <div class="text-center my-3">
                                    <b-img-lazy :src="map.positions_image" fluid></b-img-lazy>
                                </div>

                                <div class="text-center my-3">
                                    <b-link target="_blank" :href="map.practice_map">
                                        <b-img-lazy :src="map.practice_preview" v-b-tooltip.hover="'Карта для тренировок'">
                                        </b-img-lazy>
                                    </b-link>
                                </div>

                                <template v-if="grenades.hes.length || grenades.smokes.length || grenades.flashes.length || grenades.molotoves.length">
                                    <h2>Раскидки</h2>

                                    <template v-if="grenades.hes.length">
                                        <h3>Осколочные</h3>
                                        <div class="my-3">
                                            <div class="row advantages" id="hes">
                                                <div class="col-md-4 advantage" v-for="item of grenades.hes" v-bind:key="'adv-' + item.id">
                                                    <h4>{{ item.name }}</h4>
                                                    <b-embed
                                                        type="iframe"
                                                        aspect="16by9"
                                                        :src="embedUrl(item.video_url)"
                                                        allowfullscreen></b-embed>
                                                </div>
                                            </div>
                                            <div class="my-1" v-if="grenades.hes.length > 3">
                                                <template v-if="currentExpanded === 'hes'">
                                                    <b-link class="btn btn-block btn-outline-info" @click="hideBlock('hes')">
                                                        Скрыть
                                                    </b-link>
                                                </template>
                                                <template v-else>
                                                    <b-link class="btn btn-block btn-outline-info" @click="expandBlock('hes')">
                                                        Показать все
                                                    </b-link>
                                                </template>
                                            </div>
                                        </div>
                                    </template>

                                    <template v-if="grenades.smokes.length">
                                        <h3>Дымы</h3>
                                        <div class="my-3">
                                            <div class="row advantages" id="smokes">
                                                <div class="col-md-4 advantage" v-for="item of grenades.smokes" v-bind:key="'adv-' + item.id">
                                                    <h4>{{ item.name }}</h4>
                                                    <b-embed
                                                        type="iframe"
                                                        aspect="16by9"
                                                        :src="embedUrl(item.video_url)"
                                                        allowfullscreen></b-embed>
                                                </div>
                                            </div>
                                            <div class="my-1" v-if="grenades.smokes.length > 3">
                                                <template v-if="currentExpanded === 'smokes'">
                                                    <b-link class="btn btn-block btn-outline-info" @click="hideBlock('smokes')">
                                                        Скрыть
                                                    </b-link>
                                                </template>
                                                <template v-else>
                                                    <b-link class="btn btn-block btn-outline-info" @click="expandBlock('smokes')">
                                                        Показать все
                                                    </b-link>
                                                </template>
                                            </div>
                                        </div>
                                    </template>

                                    <template v-if="grenades.flashes.length">
                                        <h3>Флэшки</h3>
                                        <div class="my-3">
                                            <div class="row advantages" id="flashes">
                                                <div class="col-md-4 advantage" v-for="item of grenades.flashes" v-bind:key="'adv-' + item.id">
                                                    <h4>{{ item.name }}</h4>
                                                    <b-embed
                                                        type="iframe"
                                                        aspect="16by9"
                                                        :src="embedUrl(item.video_url)"
                                                        allowfullscreen></b-embed>
                                                </div>
                                            </div>
                                            <div class="my-1" v-if="grenades.flashes.length > 3">
                                                <template v-if="currentExpanded === 'flashes'">
                                                    <b-link class="btn btn-block btn-outline-info" @click="hideBlock('flashes')">
                                                        Скрыть
                                                    </b-link>
                                                </template>
                                                <template v-else>
                                                    <b-link class="btn btn-block btn-outline-info" @click="expandBlock('flashes')">
                                                        Показать все
                                                    </b-link>
                                                </template>
                                            </div>
                                        </div>
                                    </template>

                                    <template v-if="grenades.molotoves.length">
                                        <h3>Молотовы</h3>
                                        <div class="my-3">
                                            <div class="row advantages" id="molotoves">
                                                <div class="col-md-4 advantage" v-for="item of grenades.molotoves" v-bind:key="'adv-' + item.id">
                                                    <h4>{{ item.name }}</h4>
                                                    <b-embed
                                                        type="iframe"
                                                        aspect="16by9"
                                                        :src="embedUrl(item.video_url)"
                                                        allowfullscreen></b-embed>
                                                </div>
                                            </div>
                                            <div class="my-1" v-if="grenades.molotoves.length > 3">
                                                <template v-if="currentExpanded === 'molotoves'">
                                                    <b-link class="btn btn-block btn-outline-info" @click="hideBlock('molotoves')">
                                                        Скрыть
                                                    </b-link>
                                                </template>
                                                <template v-else>
                                                    <b-link class="btn btn-block btn-outline-info" @click="expandBlock('molotoves')">
                                                        Показать все
                                                    </b-link>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </template>

                                <template v-if="boosts.self.length || boosts.double.length || boosts.team.length">
                                    <h2>Подсадки</h2>

                                    <template v-if="boosts.self.length">
                                        <h3>Self-бусты</h3>
                                        <div class="my-3">
                                            <div class="row advantages" id="self">
                                                <div class="col-md-4 advantage" v-for="item of boosts.self" v-bind:key="'adv-' + item.id">
                                                    <h4>{{ item.name }}</h4>
                                                    <b-embed
                                                        type="iframe"
                                                        aspect="16by9"
                                                        :src="embedUrl(item.video_url)"
                                                        allowfullscreen></b-embed>
                                                </div>
                                            </div>
                                            <div class="my-1" v-if="boosts.self.length > 3">
                                                <template v-if="currentExpanded === 'self'">
                                                    <b-link class="btn btn-block btn-outline-info" @click="hideBlock('self')">
                                                        Скрыть
                                                    </b-link>
                                                </template>
                                                <template v-else>
                                                    <b-link class="btn btn-block btn-outline-info" @click="expandBlock('self')">
                                                        Показать все
                                                    </b-link>
                                                </template>
                                            </div>
                                        </div>
                                    </template>

                                    <template v-if="boosts.double.length">
                                        <h3>Двойные бусты</h3>
                                        <div class="my-3">
                                            <div class="row advantages" id="double">
                                                <div class="col-md-4 advantage" v-for="item of boosts.double" v-bind:key="'adv-' + item.id">
                                                    <h4>{{ item.name }}</h4>
                                                    <b-embed
                                                        type="iframe"
                                                        aspect="16by9"
                                                        :src="embedUrl(item.video_url)"
                                                        allowfullscreen></b-embed>
                                                </div>
                                            </div>
                                            <div class="my-1" v-if="boosts.double.length > 3">
                                                <template v-if="currentExpanded === 'double'">
                                                    <b-link class="btn btn-block btn-outline-info" @click="hideBlock('double')">
                                                        Скрыть
                                                    </b-link>
                                                </template>
                                                <template v-else>
                                                    <b-link class="btn btn-block btn-outline-info" @click="expandBlock('double')">
                                                        Показать все
                                                    </b-link>
                                                </template>
                                            </div>
                                        </div>
                                    </template>

                                    <template v-if="boosts.team.length">
                                        <h3>Командные бусты</h3>
                                        <div class="my-3">
                                            <div class="row advantages" id="team">
                                                <div class="col-md-4 advantage" v-for="item of boosts.team" v-bind:key="'adv-' + item.id">
                                                    <h4>{{ item.name }}</h4>
                                                    <b-embed
                                                        type="iframe"
                                                        aspect="16by9"
                                                        :src="embedUrl(item.video_url)"
                                                        allowfullscreen></b-embed>
                                                </div>
                                            </div>
                                            <div class="my-1" v-if="boosts.team.length > 3">
                                                <template v-if="currentExpanded === 'team'">
                                                    <b-link class="btn btn-block btn-outline-info" @click="hideBlock('team')">
                                                        Скрыть
                                                    </b-link>
                                                </template>
                                                <template v-else>
                                                    <b-link class="btn btn-block btn-outline-info" @click="expandBlock('team')">
                                                        Показать все
                                                    </b-link>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </template>

                                <template v-if="wallbangs.length">
                                    <h2>Прострелы</h2>
                                    <div class="my-3">
                                        <div class="row advantages" id="wallbangs">
                                            <div class="col-md-4 advantage" v-for="item of wallbangs" v-bind:key="'adv-' + item.id">
                                                <h4>{{ item.name }}</h4>
                                                <b-embed
                                                    type="iframe"
                                                    aspect="16by9"
                                                    :src="embedUrl(item.video_url)"
                                                    allowfullscreen></b-embed>
                                            </div>
                                        </div>
                                        <div class="my-1" v-if="wallbangs.length > 3">
                                            <template v-if="currentExpanded === 'wallbangs'">
                                                <b-link class="btn btn-block btn-outline-info" @click="hideBlock('wallbangs')">
                                                    Скрыть
                                                </b-link>
                                            </template>
                                            <template v-else>
                                                <b-link class="btn btn-block btn-outline-info" @click="expandBlock('wallbangs')">
                                                    Показать все
                                                </b-link>
                                            </template>
                                        </div>
                                    </div>
                                </template>

                                <template v-if="tricks.grenades.length || tricks.positions.length">
                                    <h2>Фишки</h2>

                                    <template v-if="tricks.grenades.length">
                                        <h3>Гранаты</h3>
                                        <div class="my-3">
                                            <div class="row advantages" id="grenades">
                                                <div class="col-md-4 advantage" v-for="item of tricks.grenades" v-bind:key="'adv-' + item.id">
                                                    <h4>{{ item.name }}</h4>
                                                    <b-embed
                                                        type="iframe"
                                                        aspect="16by9"
                                                        :src="embedUrl(item.video_url)"
                                                        allowfullscreen></b-embed>
                                                </div>
                                            </div>
                                            <div class="my-1" v-if="tricks.grenades.length > 3">
                                                <template v-if="currentExpanded === 'length'">
                                                    <b-link class="btn btn-block btn-outline-info" @click="hideBlock('length')">
                                                        Скрыть
                                                    </b-link>
                                                </template>
                                                <template v-else>
                                                    <b-link class="btn btn-block btn-outline-info" @click="expandBlock('length')">
                                                        Показать все
                                                    </b-link>
                                                </template>
                                            </div>
                                        </div>
                                    </template>

                                    <template v-if="tricks.positions.length">
                                        <h3>Позиции</h3>
                                        <div class="my-3">
                                            <div class="row advantages" id="positions">
                                                <div class="col-md-4 advantage" v-for="item of tricks.positions" v-bind:key="'adv-' + item.id">
                                                    <h4>{{ item.name }}</h4>
                                                    <b-embed
                                                        type="iframe"
                                                        aspect="16by9"
                                                        :src="embedUrl(item.video_url)"
                                                        allowfullscreen></b-embed>
                                                </div>
                                            </div>
                                            <div class="my-1" v-if="tricks.positions.length > 3">
                                                <template v-if="currentExpanded === 'positions'">
                                                    <b-link class="btn btn-block btn-outline-info" @click="hideBlock('positions')">
                                                        Скрыть
                                                    </b-link>
                                                </template>
                                                <template v-else>
                                                    <b-link class="btn btn-block btn-outline-info" @click="expandBlock('positions')">
                                                        Показать все
                                                    </b-link>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </template>

                                <template v-if="tip">
                                    <div class="alert alert-warning">
                                        <h4 class="alert-heading"> <b-icon-exclamation-circle></b-icon-exclamation-circle> {{ tip.name }}</h4>
                                        <p>{{ tip.description }}</p>
                                    </div>
                                </template>
                            </b-card>
                        </template>
                        <template v-else>
                            <h1>Not Found</h1>
                            <div class="not-found">#404</div>
                        </template>
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
    name: "Map",
    data: () => ({
        title: window.config.appName,
        loading: true,
        topBanner: null,
        sideBanner: null,
        bottomBanner: null,
        giveawayBanner: null,
        grenades: [],
        boosts: [],
        tricks: [],
        wallbangs: [],
        tip: null,
        map: null,
        currentExpanded: null
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
        },
        expandBlock: function (name) {
            this.currentExpanded = name

            document.getElementById(name).classList.remove('advantages')
        },
        hideBlock: function (name) {
            this.currentExpanded = null

            document.getElementById(name).classList.add('advantages')
        }
    },
    mounted() {
        let that = this, canonical = this.$route.params.canonical
        axios.get('/map', {
            params: {
                canonical: canonical
            }
        }).then(function (response) {
            that.map = response.data.map
            document.title = that.map.name

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

            that.tip = response.data.tip
            that.grenades = response.data.grenades
            that.boosts = response.data.boosts
            that.tricks = response.data.tricks
            that.wallbangs = response.data.wallbangs

            document.getElementById('Map').style.cssText = "background-image: url('" + that.map.background_image + "');"

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

    #Map {
        background-repeat: no-repeat;
        background-attachment: fixed;
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

    .not-found {
        color: #e3342f;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: xxx-large;
        font-weight: bold;
        text-align: center;
    }

    .advantages .advantage {
        display: none;
    }

    .advantages .advantage:nth-child(1), .advantages .advantage:nth-child(2), .advantages .advantage:nth-child(3){
        display: block;
    }
</style>
