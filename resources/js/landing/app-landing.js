require('../bootstrap');
require('../script');
require('./landing');
require('./landing2.min');

import Vue from "vue";

Vue.directive('phone',{
    bind(el){
        el.oninput = function(e){
            if(!e.isTrusted){
                return;
            }
            const x = this.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
            if(!x[2] && x[1] !==''){
                this.value = x[1] === '8' ? x[1]: '8 ' +x[1];
            }else{
                this.value = !x[3] ?x[1]+x[2]: x[1]+' ('+x[2]+') '+x[3]+(x[4]? '-' +x[4]: '')+(x[5]? '-' +x[5]: '');
            }
        }
    },
});
Vue.component('modal-contact', require('../components/ContactModal').default);
Vue.component('register-modal', require('../components/register-form').default);
Vue.component('buy-block', require('../components/buy-block').default);

new Vue({
    el: '#app2',
});