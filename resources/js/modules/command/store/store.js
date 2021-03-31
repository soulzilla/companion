import * as types from './types'
import {actions} from './actions'

export const store = {
    state: {
        commands: [],
        commandsMeta: [],
        commandsLoading: true,
    },
    getters: {
        commands: state => state.commands,
        commandsMeta: state => state.commandsMeta,
        commandsLoading: state => state.commandsLoading,
    },
    mutations: {
        [types.COMMAND_OBTAIN](state, commands) {
            state.commands = commands
        },
        [types.COMMAND_CLEAR](state) {
            state.commands = []
        },
        [types.COMMAND_SET_LOADING](state, loading) {
            state.commandsLoading = loading
        },
        [types.COMMAND_META](state, meta) {
            state.commandsMeta = meta
        },
    },
    actions
}
