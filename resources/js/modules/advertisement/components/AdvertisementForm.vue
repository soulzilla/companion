<template>
    <section id="advertisement-form">
        <el-form
            :model="form"
            label-width="120px"
            ref="form"
            :rules="rules"
            size="small"
            @submit.native.prevent="saveSubmit">
            <el-form-item label="Url" prop="url" :error="errors.get('url')">
                <el-input
                    v-model="form.url"
                    @change="errors.clear('url')"
                    suffix-icon="el-icon-edit">
                </el-input>
            </el-form-item>
            <el-form-item label="Image" prop="image">
                <el-upload
                    action="/api/v1/file/upload"
                    v-model="form.image"
                    :before-remove="handleRemove"
                    :on-success="handleSuccess"
                    accept="image/*">
                    <el-button size="small" type="primary">Upload</el-button>
                </el-upload>
                <template v-if="form.image">
                    <el-image :src="form.image"></el-image>
                </template>
            </el-form-item>
            <el-form-item label="Position" prop="position" :error="errors.get('position')">
                <el-select
                    v-model="form.position"
                    @change="errors.clear('position')">
                    <el-option v-for="position of positions" v-bind:key="position.key" :label="position.label" :value="position.key">
                        {{ position.label }}
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Starts At" prop="starts_at">
                <el-date-picker v-model="form.starts_at"></el-date-picker>
            </el-form-item>
            <el-form-item label="Ends At" prop="ends_at">
                <el-date-picker v-model="form.ends_at"></el-date-picker>
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
    import advertisementApi from '../api'
    import axios from "axios";

    export default {
        name: "AdvertisementForm",
        props: {
            initialForm: {
                default: () => ({})
            },
        },
        data() {
            return {
                errors: new Errors(),
                formLoading: false,
                formTitle: 'New Advertisement',
                form: {},
                rules: {
                    url: [
                        {required: true, message: 'advertisement name is required'},
                    ],
                    starts_at: [
                        {required: true}
                    ],
                    ends_at: [
                        {required: true}
                    ]
                },
                positions: []
            }
        },
        methods: {
            saveSubmit() {
                this.$refs['form'].validate((valid) => {
                    if (valid) {
                        this.formLoading = true
                        this.errors.clear()
                        let action = this.form.id ? advertisementApi.update : advertisementApi.create

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
            handleRemove: function (file, filesList) {
                axios.delete('/file/delete', {
                    params: {
                        name: file.response[0]
                    }
                })
            },
            handleSuccess: function (response) {
                this.form.image = response[0]
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
            this.positions = [
                {key: 1, label: 'Giveaway'},
                {key: 2, label: 'Top'},
                {key: 3, label: 'Bottom'},
                {key: 4, label: 'Side'},
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
