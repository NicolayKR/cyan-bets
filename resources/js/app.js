require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import 'bootstrap-vue/dist/bootstrap-vue.css';

import Vue from "vue";

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.component('example-component', require('./components/ExampleComponent').default);
Vue.component('header-component', require('./components/header').default);
Vue.component('table-component', require('./components/table').default);
Vue.component('account-component', require('./components/account').default);
Vue.component('form-add-company', require('./components/form-add-company').default);

new Vue({
    el: '#app',
});
