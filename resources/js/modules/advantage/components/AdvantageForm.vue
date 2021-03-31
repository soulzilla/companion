<template>
    <section id="advantage-form">
        <el-form
            :model="form"
            label-width="120px"
            ref="form"
            :rules="rules"
            size="small"
            @submit.native.prevent="saveSubmit">
            <el-form-item label="Name" prop="name" :error="errors.get('name')">
                <el-input
                    v-model="form.name"
                    @change="errors.clear('name')"
                    suffix-icon="el-icon-edit">
                </el-input>
            </el-form-item>
            <el-form-item label="Description" prop="description" :error="errors.get('description')">
                <el-input
                    v-model="form.description"
                    @change="errors.clear('description')"
                    suffix-icon="el-icon-edit">
                </el-input>
            </el-form-item>
            <el-form-item label="Video" prop="video_url" :error="errors.get('video_url')">
                <el-input
                    v-model="form.video_url"
                    @change="errors.clear('video_url')"
                    suffix-icon="el-icon-edit">
                </el-input>
            </el-form-item>
            <el-form-item label="Type" prop="type" :error="errors.get('type')">
                <el-select
                    v-model="form.type"
                    @change="errors.clear('type')">
                    <el-option v-for="type of types" v-bind:key="type.key" :label="type.label" :value="type.key">
                        {{ type.label }}
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Map" prop="map_id" :error="errors.get('map_id')">
                <el-select
                    v-model="form.map_id"
                    @change="errors.clear('map_id')">
                    <el-option v-for="map of maps" v-bind:key="map.id" :label="map.name" :value="map.id">
                        {{ map.name }}
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Group" prop="group_type" :error="errors.get('group_type')">
                <el-select
                    v-model="form.group_type"
                    @change="errors.clear('group_type')">
                    <el-option v-for="group of groups" v-bind:key="group.key" :label="group.label" :value="group.key">
                        {{ group.label }}
                    </el-option>
                </el-select>
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
    import advantageApi from '../api'
    import mapApi from '../../map/api'

    export default {
        name: "AdvantageForm",
        props: {
            initialForm: {
                default: () => ({})
            },
        },
        data() {
            return {
                errors: new Errors(),
                formLoading: false,
                formTitle: 'New Advantage',
                form: {},
                rules: {
                    name: [
                        {required: true, message: 'advantage name is required'},
                    ],
                    description: [
                    ],
                    type: [
                        {required: true}
                    ],
                    group_type: [
                    ],
                    video_url: [
                        {required: true}
                    ],
                    map_id: [
                        {required: true}
                    ]
                },
                maps: [],
                types: [],
                groups: [],
            }
        },
        methods: {
            saveSubmit() {
                this.$refs['form'].validate((valid) => {
                    if (valid) {
                        this.formLoading = true
                        this.errors.clear()
                        let action = this.form.id ? advantageApi.update : advantageApi.create

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
            let that = this
            this.form = Object.assign({}, this.initialForm)
            mapApi.all().then(function (response) {
                that.maps = response.data.data
            })
            that.types = [
                {key: 1, label: 'Grenades'},
                {key: 2, label: 'Boosts'},
                {key: 3, label: 'Tips and tricks'},
                {key: 4, label: 'Wall bangs'},
            ]
            that.groups = [
                {key: 1, label: 'HE'},
                {key: 2, label: 'Smoke'},
                {key: 3, label: 'Flashbang'},
                {key: 4, label: 'Molotov'},
                {key: 5, label: 'Self-boost'},
                {key: 6, label: 'Double boost'},
                {key: 7, label: 'Team boost'},
                {key: 8, label: 'Positions'},
                {key: 9, label: 'Grenades'}
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
