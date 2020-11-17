require('./bootstrap');

// app data stores
// require('./stores');

import Vue from 'vue'

Vue.component('breadcrumb',
    () => import('./components/Breadcrumb.vue')
)

window.Vue = Vue;
