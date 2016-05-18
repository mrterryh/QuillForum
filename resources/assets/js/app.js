// Import the core libraries (jQuery, Vue, etc.)
// Tether is a Bootstrap JS dependency.
window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');
window.Tether = require('tether');
window.moment = require('moment');
window.history = require('history').createHistory();

// Require Vue Resource so we can make HTTP requests.
require('vue-resource');

// Set the CSRF token so we can make POST requests.
Vue.http.headers.common['X-CSRF-TOKEN'] = $('#token').attr('value');

// Enable VueJS debug mode.
Vue.config.debug = true;

// Set some filters (will extract to separate file eventually)
Vue.filter('moment', function(date) {
    return moment(date).fromNow();
});

// Require additional libraries/classes.
require('./form/form.js');
require('./paginator/paginator.js');

// Require the bootstrap files for the application components.
require('./vue-components/bootstrap.js');
require('./components/bootstrap.js');

// Require Twitter Bootstrap.
require('bootstrap');

// Instantiate Vue.
var app = new Vue({
    el: 'body'
});