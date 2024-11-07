import HomePage from "@/views/Main/HomePage.vue";
import NotFound from "@/components/Default/NotFound.vue";
import SignUp from "@/views/Auth/SignUp.vue";
import LogIn from "@/views/Auth/LogIn.vue";
import Wishlist from "@/views/Order/Wishlist.vue";
import AboutUs from "@/views/Main/AboutUs.vue"
import Contact from "@/views/Main/Contact.vue"
import AccountSettings from "@/views/Account/AccountSettings.vue";
import Cart from "@/views/Order/Cart.vue";
import CheckOut from "@/views/Order/Checkout.vue";
import Product from "@/views/Product/Product.vue";

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
        path: '/shop/:productSlug',
        name: 'product',
        component: Product
    },
    {
        path: '/wishlist',
        component: Wishlist
    },
    {
        path: '/cart',
        component: Cart
    },
    {
        path: '/checkout',
        component: CheckOut
    },
    {
        path: '/about-us',
        component: AboutUs
    },
    {
        path: '/contact',
        component: Contact
    },
    {
        path: '/account',
        component: AccountSettings
    },
    {
        path: '/:any(.*)*',
        component: NotFound
    }
];
