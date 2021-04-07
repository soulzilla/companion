import * as types from './types'
import {actions} from './actions'

export const store = {
    state: {
        interviews: [],
        interviewsMeta: [],
        interviewsLoading: true,
    },
    getters: {
        interviews: state => state.interviews,
        interviewsMeta: state => state.interviewsMeta,
        interviewsLoading: state => state.interviewsLoading,
    },
    mutations: {
        [types.INTERVIEW_OBTAIN](state, interviews) {
            state.interviews = interviews
        },
        [types.INTERVIEW_CLEAR](state) {
            state.interviews = []
        },
        [types.INTERVIEW_SET_LOADING](state, loading) {
            state.interviewsLoading = loading
        },
        [types.INTERVIEW_META](state, meta) {
            state.interviewsMeta = meta
        },
    },
    actions
}
