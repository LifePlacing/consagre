require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};

import Toastr from 'vue-toastr';
import vueSlider from 'vue-slider-component';

Vue.use(Toastr);

Vue.component('busca-cep', require('./components/BuscaCep.vue'));
Vue.component('fotos', require('./components/Fotos.vue'));
Vue.component('search-avc', require('./components/SearchAvancado.vue'));
Vue.component('bibliotecaimagens', require('./components/BibliotecaImagens.vue'));
Vue.component('btnbibliotecaimagens', require('./components/BtnBibliotecaImagens.vue'));


const app = new Vue({
    el: '#app'
});
