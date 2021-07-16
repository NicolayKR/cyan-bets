require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import store from '../vuex/store';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import VueCharts from 'vue-chartjs';
import Vue from "vue";

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueCharts);

Vue.component('header-component', require('./components/header').default);
Vue.component('table-component', require('./components/table').default);

new Vue({
    el: '#app',
    store,
});
