require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};

import Toastr from 'vue-toastr';

Vue.use(Toastr);

Vue.component('busca-cep', require('./components/BuscaCep.vue'));
Vue.component('fotos', require('./components/Fotos.vue'));


const app = new Vue({
    el: '#app'
});
