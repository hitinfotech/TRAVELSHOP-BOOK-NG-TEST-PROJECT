/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
window.Vue = require('vue').default;
import App from './components/App.vue';
import VueTheMask from 'vue-the-mask'

Vue.use(VueTheMask)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

const app = new Vue({
    el: '#app',
    render: h => h(App),
});
