<template>
    <section id="command-form">
        <el-form
            :model="form"
            label-width="130px"
            ref="form"
            :rules="rules"
            size="small"
            @submit.native.prevent="saveSubmit">
            <el-form-item label="Command Name" prop="name" :error="errors.get('name')">
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
            <el-form-item label="Weight" prop="weight" :error="errors.get('weight')">
                <el-input-number
                    v-model="form.weight"
                    @change="errors.clear('weight')">
                </el-input-number>
            </el-form-item>
            <el-form-item label="Bindable" prop="bindable" :error="errors.get('bindable')">
                <el-checkbox v-model="form.bindable"></el-checkbox>
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
    import commandApi from '../api'

    export default {
        name: "CommandForm",
        props: {
            initialForm: {
                default: () => ({})
            },
        },
        data() {
            return {
                errors: new Errors(),
                formLoading: false,
                formTitle: 'New Command',
                form: {},
                rules: {
                    name: [
                        {required: true, message: 'command name is required'},
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
                        let action = this.form.id ? commandApi.update : commandApi.create

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
