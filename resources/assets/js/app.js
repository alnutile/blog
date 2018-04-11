import Typeahead from "vue-typeahead";
import LiveSearch from "./components/Search.vue";
//import Home from "./components/Home.js";
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
Vue.component("home", require("./components/Home.vue"));
Vue.component("j2a-tool", require("./tools/J2A.vue"));
Vue.component("a2j-tool", require("./tools/A2J.vue"));
Vue.component("codename-tool", require("./tools/Codename.vue"));
Vue.component("rekognition", require("./tools/Rekognition.vue"));
Vue.component("celebrity-api", require("./tools/CelebrityAPI.vue"));
Vue.component("text-api", require("./tools/TextAPI.vue"));
Vue.component("face-api", require("./tools/FaceAPI.vue"));
Vue.component("elastic-search", require("./components/ElasticSearch.vue"));
Vue.filter('striphtml', function (value) {
  var div = document.createElement("div");
  div.innerHTML = value;
  var text = div.textContent || div.innerText || "";
  return text;
});
const app = new Vue({
  el: "#app",
  components: {
    Typeahead,
    LiveSearch
  }
});
