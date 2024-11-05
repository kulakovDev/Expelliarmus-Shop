import {createRouter, createWebHistory} from "vue-router";
import routes from '@/router/routes.js';
import { start, done} from "@/nprogress.js";


const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    start();
    next();
});

router.afterEach(() => {
    done();
});


export default router;