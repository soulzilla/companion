import * as types from './types'
import {actions} from './actions'

export const store = {
    state: {
        tips: [],
        tipsMeta: [],
        tipsLoading: true,
    },
    getters: {
        tips: state => state.tips,
        tipsMeta: state => state.tipsMeta,
        tipsLoading: state => state.tipsLoading,
    },
    mutations: {
        [types.TIP_OBTAIN](state, tips) {
            state.tips = tips
        },
        [types.TIP_CLEAR](state) {
            state.tips = []
        },
        [types.TIP_SET_LOADING](state, loading) {
            state.tipsLoading = loading
        },
        [types.TIP_META](state, meta) {
            state.tipsMeta = meta
        },
    },
    actions
}
