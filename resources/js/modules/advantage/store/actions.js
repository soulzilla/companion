import * as types from './types'
import advantageApi from '../api'

export const actions = {
    async [types.ADVANTAGE_FETCH]({commit}, data = null) {
        commit(types.ADVANTAGE_SET_LOADING, true)
        const response = await advantageApi.all(data)
        commit(types.ADVANTAGE_OBTAIN, response.data.data)
        commit(types.ADVANTAGE_META, response.data.meta)
        commit(types.ADVANTAGE_SET_LOADING, false)
    },
}
