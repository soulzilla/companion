import * as types from './types'
import trainingApi from '../api'

export const actions = {
    async [types.TRAINING_FETCH]({commit}, data = null) {
        commit(types.TRAINING_SET_LOADING, true)
        const response = await trainingApi.all(data)
        commit(types.TRAINING_OBTAIN, response.data.data)
        commit(types.TRAINING_META, response.data.meta)
        commit(types.TRAINING_SET_LOADING, false)
    },
}
