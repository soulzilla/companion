import * as types from './types'
import mapApi from '../api'

export const actions = {
    async [types.MAP_FETCH]({commit}, data = null) {
        commit(types.MAP_SET_LOADING, true)
        const response = await mapApi.all(data)
        commit(types.MAP_OBTAIN, response.data.data)
        commit(types.MAP_META, response.data.meta)
        commit(types.MAP_SET_LOADING, false)
    },
}
