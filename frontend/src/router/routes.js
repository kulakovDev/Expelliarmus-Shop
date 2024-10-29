import HomePage from "@/views/HomePage.vue";
import NotFound from "@/components/Default/NotFound.vue";
import SignUp from "@/views/SignUp.vue";
import LogIn from "@/views/LogIn.vue";

export default [
    {
        path: '/',
        component: HomePage
    },
    {
        path: '/sign-up',
        component: SignUp
    },{
        path: '/log-in',
        component: LogIn
    },
    {
        path: '/:any(.*)*',
        component: NotFound
    }
];
