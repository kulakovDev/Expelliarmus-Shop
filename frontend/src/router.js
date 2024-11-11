import {createRouter, createWebHistory} from "vue-router";
import { start, done} from "@/nprogress.js";
import BaseApp from "@/shop/App.vue";
import ManagementApp from "@/management/App.vue";
import shopRoutes from '@/shop/routes.js';
import managementRoutes from '@/management/routes.js';

const routes = [
    {
        path: '/',
        component: BaseApp,
        children: shopRoutes
    },
    {
        path: '/management',
        component: ManagementApp,
        children: managementRoutes
    }
];

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