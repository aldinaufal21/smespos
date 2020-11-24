require('./bootstrap');

require('./store')

window.$helper = require('./helper');

// call helper functions
window.$ui = require('./../ui');

// mandatory authentication configuration
window.$auth = require('./authentication');

import Vue from 'vue'

Vue.component('breadcrumb', () => import('./components/Breadcrumb.vue'))

window.Vue = Vue;
