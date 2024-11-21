import "./assets/main.css";
import { createApp } from "vue";
import App from "./App.vue";
import router from "@/router.js";
import vClickOutside from "click-outside-vue3";
import mitt from "mitt";

const app = createApp(App);

const emitter = mitt();

app.use(router);

app.use(vClickOutside);

app.provide("emitter", emitter);

app.mount("#app");
