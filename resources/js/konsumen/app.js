require('./bootstrap');

require('./store')

window.$helper = require('./helper');

// mandatory authentication configuration
window.$auth = require('./authentication');

import Vue from 'vue'

Vue.component('breadcrumb', () => import('./components/Breadcrumb.vue'))

window.Vue = Vue;
