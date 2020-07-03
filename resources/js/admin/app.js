require("../bootstrap");

window.Vue = require("vue");

Vue.component(
  "customer-service",
  require("./components/CustomerService/CustomerService.vue").default
);
Vue.component("counter", require("./components/Counter/Counter.vue").default);

const app = new Vue({
  el: "#app"
});
