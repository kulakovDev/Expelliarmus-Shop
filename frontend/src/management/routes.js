import NotFound from "@/components/Default/NotFound.vue";
import Home from "@/management/views/Main/Home.vue";
import CreateProduct from "@/management/views/Product/CreateProduct.vue";
import AllProducts from "@/management/views/Product/AllProducts.vue";

export default [
  {
    path: "",
    component: Home,
  },
  {
    path: "products/create",
    component: CreateProduct,
  },
  {
    path: "products",
    component: AllProducts,
  },
  {
    path: "/:any(.*)*",
    component: NotFound,
  },
];
