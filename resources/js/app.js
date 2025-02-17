/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
const Vuex = require('vuex');

window.store = new Vuex.Store({
    state: {
        productsCount: 0
    },
    mutations: {
        increment(state) {
            return state.productsCount++;
        },
        set(state, value) {
            return state.productsCount = value;
        }
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('products-component', require('./components/products/ProductsComponent.vue').default);
Vue.component('product-card-component', require('./components/products/ProductCardComponent.vue').default);
Vue.component('material-transition-group', require('./components/animations/MaterialCollectionComponent.vue').default);
Vue.component('add-product-button', require('./components/products/AddToCartComponent.vue').default);
Vue.component('products-counter-component', require('./components/shopping_cart/CounterComponent.vue').default);
Vue.component('products-shopping-component', require('./components/shopping_cart/ProductsShoppingCardComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
