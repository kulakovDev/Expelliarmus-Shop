import HomePage from "@/views/HomePage.vue";
import NotFound from "@/components/Default/NotFound.vue";
import SignUp from "@/views/SignUp.vue";
import LogIn from "@/views/LogIn.vue";
import Wishlist from "@/views/Wishlist.vue";
import AboutUs from "@/views/AboutUs.vue"
import Contact from "@/views/Contact.vue"

export default [
    {
        path: '/',
        component: HomePage
    },
    {
        path: '/sign-up',
        component: SignUp
    },
    {
        path: '/log-in',
        component: LogIn
    },
    {
        path: '/wishlist',
        component: Wishlist
    },
    {
        path: '/about-us',
        component: AboutUs
    },{
        path: '/contact',
        component: Contact
    },
    {
        path: '/:any(.*)*',
        component: NotFound
    }
];
