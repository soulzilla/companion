import * as types from './types'
import {actions} from './actions'

export const store = {
    state: {
        trainings: [],
        trainingsMeta: [],
        trainingsLoading: true,
    },
    getters: {
        trainings: state => state.trainings,
        trainingsMeta: state => state.trainingsMeta,
        trainingsLoading: state => state.trainingsLoading,
    },
    mutations: {
        [types.TRAINING_OBTAIN](state, trainings) {
            state.trainings = trainings
        },
        [types.TRAINING_CLEAR](state) {
            state.trainings = []
        },
        [types.TRAINING_SET_LOADING](state, loading) {
            state.trainingsLoading = loading
        },
        [types.TRAINING_META](state, meta) {
            state.trainingsMeta = meta
        },
    },
    actions
}
