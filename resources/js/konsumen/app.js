require('./bootstrap');

// app data stores
// require('./stores');

// mandatory authentication configuration
window.$auth = require('./authentication');

import Vue from 'vue'

Vue.component('breadcrumb', () => import('./components/Breadcrumb.vue'))

window.Vue = Vue;
