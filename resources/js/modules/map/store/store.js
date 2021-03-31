import * as types from './types'
import {actions} from './actions'

export const store = {
    state: {
        maps: [],
        mapsMeta: [],
        mapsLoading: true,
    },
    getters: {
        maps: state => state.maps,
        mapsMeta: state => state.mapsMeta,
        mapsLoading: state => state.mapsLoading,
    },
    mutations: {
        [types.MAP_OBTAIN](state, maps) {
            state.maps = maps
        },
        [types.MAP_CLEAR](state) {
            state.maps = []
        },
        [types.MAP_SET_LOADING](state, loading) {
            state.mapsLoading = loading
        },
        [types.MAP_META](state, meta) {
            state.mapsMeta = meta
        },
    },
    actions
}
