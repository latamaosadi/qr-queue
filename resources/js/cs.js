require("./bootstrap");

window.Vue = require("vue");

// import dependecies tambahan
import VueRouter from "vue-router";
import VueAxios from "vue-axios";

Vue.use(VueRouter, VueAxios);

// import file yang dibuat tadi
import App from "./components/App.vue";
import Home from "./components/Home/Home.vue";
import Login from "./components/Login/Login.vue";
// import Read from './components/Read.vue';
// import Update from './components/Update.vue';

// membuat router
const routes = [
  {
    name: "home",
    path: "/",
    component: Home
  },
  {
    name: "login",
    path: "/login",
    component: Login
  }
];

const router = new VueRouter({ routes: routes });
new Vue(Vue.util.extend({ router }, App)).$mount("#app");
