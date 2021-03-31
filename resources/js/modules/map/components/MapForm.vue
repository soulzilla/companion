<template>
    <section id="map-form">
        <el-form
            :model="form"
            label-width="130px"
            ref="form"
            :rules="rules"
            size="small"
            @submit.native.prevent="saveSubmit">
            <el-form-item label="Map Name" prop="name" :error="errors.get('name')">
                <el-input
                    v-model="form.name"
                    @change="errors.clear('name')"
                    suffix-icon="el-icon-edit">
                </el-input>
            </el-form-item>
            <el-form-item label="Canonical" prop="canonical" :error="errors.get('canonical')">
                <el-input
                    v-model="form.canonical"
                    @change="errors.clear('canonical')"
                    suffix-icon="el-icon-edit">
                </el-input>
            </el-form-item>
            <el-form-item label="Weight" prop="weight" :error="errors.get('weight')">
                <el-input-number
                    v-model="form.weight"
                    @change="errors.clear('weight')">
                </el-input-number>
            </el-form-item>
            <el-form-item label="Logo" prop="logo" :error="errors.get('logo')">
                <el-select v-model="form.logo">
                    <el-option v-for="logo of icons" v-bind:key="logo" :value="logo">
                        {{ logo }}
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Background" prop="background_image" :error="errors.get('background_image')">
                <el-select v-model="form.background_image">
                    <el-option v-for="image of backgrounds" v-bind:key="image" :value="image">
                        {{ image }}
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Positions" prop="positions_image" :error="errors.get('positions_image')">
                <el-select v-model="form.positions_image">
                    <el-option v-for="image of positions" v-bind:key="image" :value="image">
                        {{ image }}
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Practice map" prop="practice_map" :error="errors.get('practice_map')">
                <el-input
                    v-model="form.practice_map"
                    @change="errors.clear('practice_map')"
                    suffix-icon="el-icon-edit">
                </el-input>
            </el-form-item>
            <el-form-item label="Practice preview" prop="practice_preview" :error="errors.get('practice_preview')">
                <el-input
                    v-model="form.practice_preview"
                    @change="errors.clear('practice_preview')"
                    suffix-icon="el-icon-edit">
                </el-input>
            </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
            <el-button @click.native="cancel" size="small">{{$t('global.cancel')}}</el-button>
            <el-button type="success"
                       @click.native="saveSubmit"
                       :loading="formLoading"
                       size="small"
                       class="float-right">{{$t('global.save')}}</el-button>
        </div>
    </section>
</template>

<script>
    import {Errors} from "../../../includes/Errors";
    import mapApi from '../api'

    export default {
        name: "MapForm",
        props: {
            initialForm: {
                default: () => ({})
            },
        },
        data() {
            return {
                errors: new Errors(),
                formLoading: false,
                formTitle: 'New Map',
                form: {},
                rules: {
                    name: [
                        {required: true, message: 'map name is required'},
                    ],
                    canonical: [
                        {required: true, message: 'canonical name is required'},
                    ],
                    weight: [
                        {required: true, message: 'weight is required'},
                    ],
                    logo: [
                        {required: true, message: 'logo is required'},
                    ],
                    background_image: [
                        {required: true, message: 'background_image is required'},
                    ],
                    positions_image: [
                        {required: true, message: 'positions_image is required'},
                    ],
                    practice_map: [
                        {required: true, message: 'practice_map is required'},
                    ],
                    practice_preview: [
                        {required: true, message: 'practice_preview is required'},
                    ],
                },
                icons: [],
                backgrounds: [],
                positions: []
            }
        },
        methods: {
            saveSubmit() {
                this.$refs['form'].validate((valid) => {
                    if (valid) {
                        this.formLoading = true
                        this.errors.clear()
                        let action = this.form.id ? mapApi.update : mapApi.create

                        action(this.form).then((response) => {
                            this.$message({
                                message: response.data.message,
                                type: response.data.type
                            })
                            if(response.data.type === 'success')
                                this.$emit('saved')
                        }).catch((error) => {
                            if (error.response.data.errors)
                                this.errors.record(error.response.data.errors)
                        }).finally(() => this.formLoading = false)
                    }
                });
            },
            cancel() {
                this.clearForm()
                this.$emit('cancel')
            },
            clearForm() {
                this.errors.clear()
                if (this.$refs['form'])
                    this.$refs['form'].resetFields()
            }
        },
        mounted() {
            this.form = Object.assign({}, this.initialForm)
            this.icons = [
                '/icons/map_icon_de_cache.svg',
                '/icons/map_icon_de_dust2.svg',
                '/icons/map_icon_de_inferno.svg',
                '/icons/map_icon_de_mirage.svg',
                '/icons/map_icon_de_nuke.svg',
                '/icons/map_icon_de_overpass.svg',
                '/icons/map_icon_de_train.svg',
                '/icons/map_icon_de_vertigo.svg',
            ]
            this.backgrounds = [
                '/images/backgrounds/de_cache.jpg',
                '/images/backgrounds/de_dust2.jpg',
                '/images/backgrounds/de_inferno.jpg',
                '/images/backgrounds/de_mirage.jpg',
                '/images/backgrounds/de_nuke.jpg',
                '/images/backgrounds/de_overpass.jpg',
                '/images/backgrounds/de_train.jpg',
                '/images/backgrounds/de_vertigo.jpg',
            ]
            this.positions = [
                '/images/positions/de_cache.jpg',
                '/images/positions/de_dust2.jpg',
                '/images/positions/de_inferno.jpg',
                '/images/positions/de_mirage.jpg',
                '/images/positions/de_nuke.jpg',
                '/images/positions/de_overpass.jpg',
                '/images/positions/de_train.jpg',
                '/images/positions/de_vertigo.jpg',
            ]
        },
        watch: {
            initialForm: function(formData) {
                if(_.isEmpty(formData)) this.clearForm()
                this.form = Object.assign({}, formData)
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
