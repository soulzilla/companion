import * as types from './types'
import {actions} from './actions'

export const store = {
    state: {
        questions: [],
        questionsMeta: [],
        questionsLoading: true,
    },
    getters: {
        questions: state => state.questions,
        questionsMeta: state => state.questionsMeta,
        questionsLoading: state => state.questionsLoading,
    },
    mutations: {
        [types.QUESTION_OBTAIN](state, questions) {
            state.questions = questions
        },
        [types.QUESTION_CLEAR](state) {
            state.questions = []
        },
        [types.QUESTION_SET_LOADING](state, loading) {
            state.questionsLoading = loading
        },
        [types.QUESTION_META](state, meta) {
            state.questionsMeta = meta
        },
    },
    actions
}
