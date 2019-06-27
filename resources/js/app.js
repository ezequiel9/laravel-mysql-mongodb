require('./bootstrap');

window.Vue = require('vue');

/**
 * Imports
 */
import BootstrapVue from 'bootstrap-vue'
import { store } from './store';


/**
 * Uses
 */
Vue.use(BootstrapVue);
Vue.use(require('vue-moment'));


/**
 * Add components
 */
Vue.component('home', require('./components/Pages/Home').default);
Vue.component('post', require('./components/Pages/Post').default);
Vue.component('post-form', require('./components/Common/PostForm').default);
Vue.component('admin-dashboard', require('./components/Pages/AdminDashboard').default);

/**
 * Init Vue App.
 */
let app = new Vue({
    el: '#app',
    data: {},
    store
});

