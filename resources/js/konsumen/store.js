import Vue from 'vue'
import Vuex from 'vuex'

import auth from './stores/auth.js'

Vue.use(Vuex)

const _user = JSON.parse(localStorage.getItem('user'));
var token = null;
if (_user && _user.token) {
  token = _user.token
}

const store = new Vuex.Store({
    modules: {
        auth,
    },
    state: {
        token: token,
        errors: []
    },
    getters: {
        isAuth: state => {
            return state.token != "null" && state.token != null
        }
    },
    mutations: {
        SET_TOKEN(state, payload) {
            state.token = payload
        },
        SET_ERRORS(state, payload) {
            state.errors = payload
        },
        CLEAR_ERRORS(state) {
            state.errors = []
        }
    }
})

export default store
