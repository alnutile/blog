import Typeahead from "vue-typeahead";
import LiveSearch from "./components/Search.vue";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

Vue.component("j2a-tool", require("./tools/J2A.vue"));

const app = new Vue({
  el: "#app",
  components: {
    Typeahead,
    LiveSearch
  }
});