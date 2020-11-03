require('./bootstrap');

// app data stores
require('./store');

// mandatory authentication configuration
window.$auth = require('./authenticate');

// call helper functions
window.$helper = require('./helper');
