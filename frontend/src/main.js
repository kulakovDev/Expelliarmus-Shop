import './assets/main.css';
import { createApp } from 'vue';
import mitt from "mitt";
import App from './App.vue';
import router from "@/router/index.js";

const app = createApp(App);

const emitter = mitt();

app.config.globalProperties.$mitt = emitter;

app.use(router);

app.mount('#app')
