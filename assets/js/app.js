import Vue from 'vue';
import VueRouter from 'vue-router'
import VueResource from 'vue-resource';
import routes from './vue/routes';

Vue.use(VueRouter);
Vue.use(VueResource);

Vue.http.options.root = $('#app').data('apiBaseUrl');

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    routes // short for `routes: routes`
})

// 4. Create and mount the root instance.
// Make sure to inject the router with the router option to make the
// whole app router-aware.
const app = new Vue({
    router
}).$mount('#app')