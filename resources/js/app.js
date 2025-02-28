/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
 
 /**
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */
 
 // const files = require.context('./', true, /\.vue$/i)
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
 
 
 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
import { createApp } from 'vue';
//import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';
import VueLoading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
 
const app = createApp();
app.use(Ziggy);
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
app.use(VueLoading);
 
app.component('CardElement', require('./components/stripe/CardElement.vue').default);
app.component('mainForm', require('./components/stripe/mainForm.vue').default);
app.component('pageSidebar', require('./components/stripe/pageSidebar.vue').default);
app.component('StripePayment', require('./pages/StripePayment.vue').default);
app.mount("#app");
  