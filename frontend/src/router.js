import { createRouter, createWebHistory } from "vue-router";
import { done, start } from "@/nprogress.js";
import BaseApp from "@/shop/App.vue";
import ManagementApp from "@/management/App.vue";
import shopRoutes from "@/shop/routes.js";
import managementRoutes from "@/management/routes.js";
import { useAuthStore } from "@/stores/useAuthStore.js";

const routes = [
  {
    path: "/",
    component: BaseApp,
    children: shopRoutes,
  },
  {
    path: "/management",
    component: ManagementApp,
    children: managementRoutes,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to, from, next) => {
  start();
  const auth = useAuthStore();

  if (to.meta.guest && auth.isAuthenticated) {
    return next({ name: "home" });
  }

  if (to.meta.requiresAuth) {
    if (auth.isSessionVerificationInitialize) {
      return await auth.fetchCurrentUser().then(() => {
        if (!auth.isAuthenticated) {
          return next({ name: "login" });
        }
        return next();
      });
    }
  }

  next();
});

router.afterEach(() => {
  done();
});

export default router;
