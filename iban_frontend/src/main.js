import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import { createPinia } from "pinia";
import {useUserStore} from '@/store/user';

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
import NavDefault from "@/components/navigation/nav-default.vue";

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
app.use(createPinia());


axios.defaults.baseURL = "http://localhost:8000/api/";

axios.defaults.headers = {
	'content-type': 'application/json',
	'Authorization': 'Bearer ' + useUserStore().user?.token,
};

axios.interceptors.request.use(function (config) {
	return config;
}, function (error) {
	return Promise.reject(error);
});

// Intercept responses
axios.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    if (error.response && (error.response.status === 401 || error.response.status === 403)) {
      router.push('/login');
    }
    return Promise.reject(error);
  }
);

app.use(ElementPlus);
app.use(VueAxios, axios);

/**
 * Input Fields
 */
app.component("input-field", InputField);
app.component("input-password", InputPassword);
app.component("nav-default", NavDefault);

/**
 * Font Awesome
 */
app.component("font-awesome-icon", FontAwesomeIcon);

app.use(router);
app.mount("#app");
