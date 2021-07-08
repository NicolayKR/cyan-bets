require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import 'bootstrap-vue/dist/bootstrap-vue.css';

import Vue from "vue";

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.component('header-component', require('./components/header').default);
Vue.component('table-component', require('./components/table').default);

new Vue({
    el: '#app',
});
