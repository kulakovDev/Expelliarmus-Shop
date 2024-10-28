import HomePage from "@/views/HomePage.vue";
import NotFound from "@/components/Default/NotFound.vue";

export default [
    {
        path: '/',
        component: HomePage
    },
    {
        path: '/:any(.*)*',
        component: NotFound
    }
];
