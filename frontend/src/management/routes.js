import NotFound from "@/components/Default/NotFound.vue";
import Home from "@/management/views/Main/Home.vue";

export default [
    {
        path: '',
        component: Home
    },
    {
        path: '/:any(.*)*',
        component: NotFound
    }
];
