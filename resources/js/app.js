/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('vue-flash-message/dist/vue-flash-message.min.css');
import VueRouter from 'vue-router';
import Vuelidate from "vuelidate";
import VueFlashMessage from 'vue-flash-message';

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(VueFlashMessage);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

const contactlist = Vue.component(
  'contactlist',
  require('./components/contactList.vue').default
);

Vue.component(
  'sidebar',
  require('./components/sidebar.vue').default
);

const newContact = Vue.component('newcontact', require('./components/newContact.vue').default);
const updateContact = Vue.component('updatecontact', require('./components/updateContact.vue').default);
const register = Vue.component('register', require('./components/register.vue').default);
const login = Vue.component('login', require('./components/login.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
  { path: '/', component: contactlist },
  { path: '/register', component: register },
  { path: '/login', component: login },
  { path: '/new', component: newContact },
  { path: '/update/:id', component: updateContact, props: true }
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  //mode: 'history',
  routes // short for `routes: routes`
})

const app = new Vue({
  data() {
    return {
      authenticated: false,
      token: false
    }
  },
  mounted() {
    if (localStorage.token && localStorage.token !== null) {
      this.token = localStorage.token;
      this.authenticated = true;
    }
    if (!this.authenticated) {
      this.$router.replace("/login");
    }

    this.$on("authed", function () {
      this.setAuthenticated(true);
    });

    this.$on("logoutEvent", function () {
      this.logout();
    });

  },
  methods: {
    setAuthenticated(status) {
      this.authenticated = status;
      this.flash("Login ok", "success", { timeout: 3000 });
      this.$router.push("/");
      this.$forceUpdate();
    },
    logout() {
      this.authenticated = false;
      localStorage.removeItem('token');
      this.flash("Logout ok", "success", { timeout: 3000 });
      this.$router.replace("/login");
      this.$forceUpdate();
    }
  },
  router
}).$mount('#app');