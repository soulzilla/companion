import * as types from './types'
import tipApi from '../api'

export const actions = {
    async [types.TIP_FETCH]({commit}, data = null) {
        commit(types.TIP_SET_LOADING, true)
        const response = await tipApi.all(data)
        commit(types.TIP_OBTAIN, response.data.data)
        commit(types.TIP_META, response.data.meta)
        commit(types.TIP_SET_LOADING, false)
    },
}
