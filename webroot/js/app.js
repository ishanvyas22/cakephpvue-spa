import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueSweetalert2 from 'vue-sweetalert2';
import { routes } from './routes';
import App from './views/App.vue';
import Header from './components/Header.vue';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('[name="_csrfToken"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

Vue.use(VueSweetalert2);

Vue.component('app', App);

const router = Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    components: {
        App,
        'top-header': Header
    },
    router: routes
});
