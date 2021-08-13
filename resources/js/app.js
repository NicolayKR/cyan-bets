require('./bootstrap');
require('./script');
require('./landing/landing');
require('./landing/landing2.min');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
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
Vue.component('modal-contact', require('./components/ContactModal').default);

new Vue({
    el: '#app',
});
