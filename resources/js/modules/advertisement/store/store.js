import * as types from './types'
import {actions} from './actions'

export const store = {
    state: {
        advertisements: [],
        advertisementsMeta: [],
        advertisementsLoading: true,
    },
    getters: {
        advertisements: state => state.advertisements,
        advertisementsMeta: state => state.advertisementsMeta,
        advertisementsLoading: state => state.advertisementsLoading,
    },
    mutations: {
        [types.ADVERTISEMENT_OBTAIN](state, advertisements) {
            state.advertisements = advertisements
        },
        [types.ADVERTISEMENT_CLEAR](state) {
            state.advertisements = []
        },
        [types.ADVERTISEMENT_SET_LOADING](state, loading) {
            state.advertisementsLoading = loading
        },
        [types.ADVERTISEMENT_META](state, meta) {
            state.advertisementsMeta = meta
        },
    },
    actions
}
