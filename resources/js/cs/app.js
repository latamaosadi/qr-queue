require("../bootstrap");

window.Vue = require("vue");

Vue.component("queue", require("./components/Queue/Queue.vue").default);

const app = new Vue({
  el: "#app",
});
