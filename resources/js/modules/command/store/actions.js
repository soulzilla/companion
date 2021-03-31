import * as types from './types'
import commandApi from '../api'

export const actions = {
    async [types.COMMAND_FETCH]({commit}, data = null) {
        commit(types.COMMAND_SET_LOADING, true)
        const response = await commandApi.all(data)
        commit(types.COMMAND_OBTAIN, response.data.data)
        commit(types.COMMAND_META, response.data.meta)
        commit(types.COMMAND_SET_LOADING, false)
    },
}
