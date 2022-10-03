import Vue from 'vue'
import Vuelidate from "vuelidate/src";
import Datepicker from 'js-datepicker'

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.component('order-component', require('./components/orders/HomeComponent.vue').default);
Vue.use(Vuelidate)

new Vue({
    el: '#app',
});
