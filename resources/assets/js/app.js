import Typeahead from "vue-typeahead";
import LiveSearch from "./components/Search.vue";
import swal from 'sweetalert';

import * as uiv from 'uiv'


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
Vue.use(uiv);
Vue.component("j2a-tool", require("./tools/J2A.vue"));
Vue.component("a2j-tool", require("./tools/A2J.vue"));
Vue.component("codename-tool", require("./tools/Codename.vue"));
Vue.component("rekognition", require("./tools/Rekognition.vue"));
Vue.component("celebrity-api", require("./tools/CelebrityAPI.vue"));
Vue.component("text-api", require("./tools/TextAPI.vue"));

const app = new Vue({
  el: "#app",
  components: {
    Typeahead,
    LiveSearch
  }
});
