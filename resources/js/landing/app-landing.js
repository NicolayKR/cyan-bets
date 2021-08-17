require('../bootstrap');
require('../script');
require('./landing');
require('./landing2.min');

import Vue from "vue";

Vue.component('modal-contact', require('../components/ContactModal').default);
Vue.component('register-modal', require('../components/register-form').default);
Vue.component('buy-modal', require('../components/buy-form').default);
new Vue({
    el: '#app2',
});
