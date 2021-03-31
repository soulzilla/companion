import * as types from './types'
import {actions} from './actions'

export const store = {
    state: {
        advantages: [],
        advantagesMeta: [],
        advantagesLoading: true,
    },
    getters: {
        advantages: state => state.advantages,
        advantagesMeta: state => state.advantagesMeta,
        advantagesLoading: state => state.advantagesLoading,
    },
    mutations: {
        [types.ADVANTAGE_OBTAIN](state, advantages) {
            state.advantages = advantages
        },
        [types.ADVANTAGE_CLEAR](state) {
            state.advantages = []
        },
        [types.ADVANTAGE_SET_LOADING](state, loading) {
            state.advantagesLoading = loading
        },
        [types.ADVANTAGE_META](state, meta) {
            state.advantagesMeta = meta
        },
    },
    actions
}
