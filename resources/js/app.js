require('./bootstrap');
require('./script');
require('./landing/landing');
require('./landing/landing.min');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import store from '../vuex/store';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import VueCharts from 'vue-chartjs';
import Vue from "vue";
import VTooltip from 'v-tooltip';

Vue.use(VTooltip, { 
    defaultHtml : false , 
  });
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueCharts);

Vue.component('header-component', require('./components/header').default);
Vue.component('table-component', require('./components/table').default);
Vue.component('table-errors-component', require('./components/table_errors').default);

new Vue({
    el: '#app',
    store,
});
