/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// import Vuetify from 'vuetify'
import { createApp } from 'vue'
// import { createVuetify } from 'vuetify'
// import VuetifyDialog from 'vuetify-dialog'
// import 'vuetify-dialog/dist/vuetify-dialog.css'
// import 'vuetify/dist/vuetify.min.css'







window.Vue = require('vue').default;

// createApp() 

import App from './components/Makeorder.vue'


// const vuetify = createVuetify()



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('makeorder-component', require('./components/Makeorder.vue').default);
// Vue.component('create-Order-form-component', require('./components/CreateOrderForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 const app = createApp(App)

 app.mount('#app1')

// const app = new Vue({
//     el: '#app',
//     vuetify: new Vuetify(),
// });


// const makeorder = new Vue({
//     el:'#makeorder',
//     componets:{makeorder}

// })
