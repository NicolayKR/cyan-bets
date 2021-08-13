require('../bootstrap');
require('../script');
require('./landing');
require('./landing2.min');

import Vue from "vue";

Vue.component('modal-contact', require('../components/ContactModal').default);

new Vue({
    el: '#app2',
});
