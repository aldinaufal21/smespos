import $axios from '../axios.js'

const state = () => ({

})

const mutations = {

}

const actions = {
    submit({ commit }, payload) {
        localStorage.setItem('user', null)
        commit('SET_TOKEN', null, { root: true })
        return new Promise((resolve, reject) => {
            $axios.post('/login', payload)
            .then((response) => {
                console.log(response);
                console.log(response.data);
                if (response.status == 200) {
                    localStorage.setItem('user', JSON.stringify(response.data))
                    commit('SET_TOKEN', response.data.token, { root: true })
                } else {
                    commit('SET_ERRORS', { invalid: 'Email/Password Salah' }, { root: true })
                }
                resolve(response.data)
            })
            .catch((error) => {
                console.log(error);
            })
        })
    }
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}
