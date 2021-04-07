<template>
    <section id="interview-form">
        <el-form
            :model="form"
            label-width="130px"
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
            <el-form-item label="Respondent" prop="respondent_name" :error="errors.get('respondent_name')">
                <el-input
                    v-model="form.respondent_name"
                    @change="errors.clear('respondent_name')"
                    suffix-icon="el-icon-edit">
                </el-input>
            </el-form-item>
            <el-form-item label="About" prop="respondent_info" :error="errors.get('respondent_info')" style="height: 300px">
                <quill-editor
                    v-model="form.respondent_info" style="height: 200px"
                    @change="errors.clear('respondent_info')"></quill-editor>
            </el-form-item>
            <el-form-item label="Image" prop="respondent_photo">
                <el-upload
                    action="/api/v1/file/upload"
                    v-model="form.respondent_photo"
                    :before-remove="handleRemove"
                    :on-success="handleSuccess"
                    accept="image/*">
                    <el-button size="small" type="primary">Upload</el-button>
                </el-upload>
                <template v-if="form.respondent_photo">
                    <el-image :src="form.respondent_photo"></el-image>
                </template>
            </el-form-item>
            <el-form-item label="Published" prop="published" :error="errors.get('published')">
                <el-checkbox v-model="form.published"></el-checkbox>
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
    import interviewApi from '../api'
    import axios from "axios";

    export default {
        name: "InterviewForm",
        props: {
            initialForm: {
                default: () => ({})
            },
        },
        data() {
            return {
                errors: new Errors(),
                formLoading: false,
                formTitle: 'New Interview',
                form: {},
                rules: {
                    name: [
                        {required: true, message: 'interview name is required'},
                    ],
                    respondent_name: [
                        {required: true, message: 'respondent name is required'},
                    ],
                    respondent_info: [
                        {required: true, message: 'respondent info is required'},
                    ],
                    respondent_photo: [
                        {required: true, message: 'respondent photo is required'},
                    ],
                },
            }
        },
        methods: {
            saveSubmit() {
                this.$refs['form'].validate((valid) => {
                    if (valid) {
                        this.formLoading = true
                        this.errors.clear()
                        let action = this.form.id ? interviewApi.update : interviewApi.create

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
                this.form.respondent_photo = response[0]
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
