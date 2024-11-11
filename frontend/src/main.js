import './assets/main.css';
import { createApp } from 'vue';
import mitt from "mitt";
import App from './App.vue';
import router from "@/router.js";
import vClickOutside from "click-outside-vue3"

const app = createApp(App);

const emitter = mitt();

app.config.globalProperties.$mitt = emitter;

app.use(router);
app.use(vClickOutside);

app.mount('#app')
