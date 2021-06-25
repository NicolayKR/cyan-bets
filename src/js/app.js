require('./bootstrap');

import Vue from "vue";

// Пример компонента
Vue.component('example-component', require('./components/ExampleComponent').default);
Vue.component('header-component', require('./components/header').default);

new Vue({
    el: '#app',
});
