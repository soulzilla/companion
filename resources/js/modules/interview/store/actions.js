import * as types from './types'
import interviewApi from '../api'

export const actions = {
    async [types.INTERVIEW_FETCH]({commit}, data = null) {
        commit(types.INTERVIEW_SET_LOADING, true)
        const response = await interviewApi.all(data)
        commit(types.INTERVIEW_OBTAIN, response.data.data)
        commit(types.INTERVIEW_META, response.data.meta)
        commit(types.INTERVIEW_SET_LOADING, false)
    },
}
