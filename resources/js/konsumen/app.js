import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './router.js'
import store from './store.js'

Vue.use(VueRouter)

import App from './App.vue'

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    stpre,
});
