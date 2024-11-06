<template>
  <div class="flex justify-center bg-black text-white py-3">
      <span class="text-sm">
        Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%!
        <a href="#" class="font-bold underline">ShopNow</a>
      </span>
  </div>
  <header class="sticky top-0 bg-white z-10">
    <nav class="container mx-auto flex justify-between items-center max-h-24 pt-9 pb-4">
      <div>
        <router-link @click.prevent="scrollToTop" class="text-2xl font-bold logo" to="/">Expelliarmus Shop</router-link>
      </div>
      <div>
        <ul class="flex space-x-16 text-base">
          <li class="hover:underline underline-offset-4 decoration-2">
            <router-link @click.prevent="scrollToTop" to="/">Home</router-link>
          </li>
          <li class="hover:underline underline-offset-4 decoration-2">
            <router-link @click.prevent="scrollToTop" to="/contact">Contact</router-link>
          </li>
          <li class="hover:underline underline-offset-4 decoration-2">
            <router-link @click.prevent="scrollToTop" to="/about-us">About</router-link>
          </li>
          <li class="hover:underline underline-offset-4 decoration-2">
            <router-link @click.prevent="scrollToTop" to="/sign-up">Sign up</router-link>
          </li>
        </ul>
      </div>
      <div class="flex items-center space-x-4">
        <search-header></search-header>
        <wishlist-header></wishlist-header>
        <cart-header></cart-header>
        <account-menu></account-menu>
      </div>
    </nav>
    <hr class="h-[2px] bg-gray-300 border-0">
  </header>
</template>

<script>
import {MenuButton, MenuItem, MenuItems, Menu} from "@headlessui/vue";
import AccountMenu from "@/components/Default/Header/AccountMenu.vue";
import CartHeader from "@/components/Default/Header/CartHeader.vue";
import WishlistHeader from "@/components/Default/Header/WishlistHeader.vue";
import SearchHeader from "@/components/Default/Header/SearchHeader.vue";

export default {
  components: {WishlistHeader, AccountMenu, MenuItem, MenuItems, MenuButton, Menu, CartHeader, SearchHeader},
  methods: {
    scrollToTop() {
      window.scrollTo({top: 0, behavior: 'smooth'})
    },
  },
}
</script>

<style scoped>

</style>