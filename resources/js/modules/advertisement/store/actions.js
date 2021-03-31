import * as types from './types'
import advertisementApi from '../api'

export const actions = {
    async [types.ADVERTISEMENT_FETCH]({commit}, data = null) {
        commit(types.ADVERTISEMENT_SET_LOADING, true)
        const response = await advertisementApi.all(data)
        commit(types.ADVERTISEMENT_OBTAIN, response.data.data)
        commit(types.ADVERTISEMENT_META, response.data.meta)
        commit(types.ADVERTISEMENT_SET_LOADING, false)
    },
}
