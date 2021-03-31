import * as types from './types'
import galleryApi from '../api'

export const actions = {
    async [types.GALLERY_FETCH]({commit}, data = null) {
        commit(types.GALLERY_SET_LOADING, true)
        const response = await galleryApi.all(data)
        commit(types.GALLERY_OBTAIN, response.data.data)
        commit(types.GALLERY_META, response.data.meta)
        commit(types.GALLERY_SET_LOADING, false)
    },
}
