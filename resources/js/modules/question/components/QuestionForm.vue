<template>
    <section id="question-form">
        <el-form
            :model="form"
            label-width="120px"
            ref="form"
            :rules="rules"
            size="small"
            @submit.native.prevent="saveSubmit">
            <el-form-item label="Question Name" prop="name" :error="errors.get('name')">
                <el-input
                    v-model="form.name"
                    @change="errors.clear('name')"
                    suffix-icon="el-icon-edit">
                </el-input>
            </el-form-item>
            <el-form-item label="Interview" prop="interview_id">
                <el-select v-model="form.interview_id">
                    <el-option v-for="interview of interviews"
                               v-bind:key="interview.id"
                               :value="interview.id"
                               :label="interview.name">
                        {{ interview.name }}
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Answer" prop="answer" :error="errors.get('answer')">
                <el-input
                    v-model="form.answer"
                    type="textarea"
                    @change="errors.clear('answer')"
                    suffix-icon="el-icon-edit">
                </el-input>
            </el-form-item>
            <el-form-item label="Weight" prop="weight" :error="errors.get('weight')">
                <el-input-number
                    v-model="form.weight"
                    @change="errors.clear('weight')">
                </el-input-number>
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
    import questionApi from '../api'
    import interviewApi from '../../../modules/interview/api'

    export default {
        name: "QuestionForm",
        props: {
            initialForm: {
                default: () => ({})
            },
        },
        data() {
            return {
                errors: new Errors(),
                formLoading: false,
                formTitle: 'New Question',
                form: {},
                interviews: [],
                rules: {
                    name: [
                        {required: true, message: 'question name is required'},
                    ],
                    interview_id: [
                        {required: true}
                    ],
                    answer: [
                        {required: true}
                    ]
                },
            }
        },
        methods: {
            saveSubmit() {
                this.$refs['form'].validate((valid) => {
                    if (valid) {
                        this.formLoading = true
                        this.errors.clear()
                        let action = this.form.id ? questionApi.update : questionApi.create

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

            interviewApi.all().then(response => (this.interviews = response.data.data))
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
