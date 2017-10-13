import Vue from 'vue';
import VueRouter from 'vue-router'
import VueResource from 'vue-resource';
import routes from './vue/routes';
import VeeValidate from 'vee-validate';

Vue.use(VueRouter);
Vue.use(VueResource);
Vue.use(VeeValidate, {
	classes: true,
	classNames: {
		touched: 'touched', // the control has been blurred
		untouched: 'untouched', // the control hasn't been blurred
		valid: 'is-valid', // model is valid
		invalid: 'is-invalid', // model is invalid
		pristine: 'pristine', // control has not been interacted with
		dirty: 'dirty' // control has been interacted with
	},
});

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