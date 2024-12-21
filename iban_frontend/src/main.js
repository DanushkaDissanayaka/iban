import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import { createPinia } from "pinia";

/**
 * Axios
 */
import axios from "axios";
import VueAxios from "vue-axios";

/**
 * Element Plus
 */
import ElementPlus from "element-plus";
import "element-plus/dist/index.css";

/**
 * Input Fields
 */
import InputField from "@/components/inputs/input-field.vue";
import InputPassword from "@/components/inputs/input-password.vue";

/**
 * Theme Files
 */

import "./assets/bootstrap.min.css";
// import './assets/style.css'

/**
 * Font Awesome
 */
import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { fab } from "@fortawesome/free-brands-svg-icons";
import { far } from "@fortawesome/free-regular-svg-icons";

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(fas, fab, far);

const app = createApp(App);

axios.defaults.baseURL = "http://localhost:8000/api/";

var count = 0;

axios.interceptors.response.use(
  function (response) {
    count--;
    return response;
  },
  function (error) {
    if (error.response.data.code == 403) {
      window.location.href = "/login";
    }
    count--;
    return Promise.reject(error);
  }
);

app.use(ElementPlus);
app.use(createPinia());
app.use(VueAxios, axios);

/**
 * Input Fields
 */
app.component("input-field", InputField);
app.component("input-password", InputPassword);

/**
 * Font Awesome
 */
app.component("font-awesome-icon", FontAwesomeIcon);

app.use(router);
app.mount("#app");
