import * as types from './types'
import {actions} from './actions'

export const store = {
    state: {
        galleries: [],
        galleriesMeta: [],
        galleriesLoading: true,
    },
    getters: {
        galleries: state => state.galleries,
        galleriesMeta: state => state.galleriesMeta,
        galleriesLoading: state => state.galleriesLoading,
    },
    mutations: {
        [types.GALLERY_OBTAIN](state, galleries) {
            state.galleries = galleries
        },
        [types.GALLERY_CLEAR](state) {
            state.galleries = []
        },
        [types.GALLERY_SET_LOADING](state, loading) {
            state.galleriesLoading = loading
        },
        [types.GALLERY_META](state, meta) {
            state.galleriesMeta = meta
        },
    },
    actions
}
