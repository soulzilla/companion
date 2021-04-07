import * as types from './types'
import questionApi from '../api'

export const actions = {
    async [types.QUESTION_FETCH]({commit}, data = null) {
        commit(types.QUESTION_SET_LOADING, true)
        const response = await questionApi.all(data)
        commit(types.QUESTION_OBTAIN, response.data.data)
        commit(types.QUESTION_META, response.data.meta)
        commit(types.QUESTION_SET_LOADING, false)
    },
}
