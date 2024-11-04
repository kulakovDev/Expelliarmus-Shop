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
        <div class="flex items-center bg-gray-100 rounded-md px-4 py-2 focus-within:ring-2 focus-within:ring-gray-500">
          <input
              type="text"
              placeholder="What are you looking for?"
              class="bg-gray-100 outline-none text-gray-700 placeholder-gray-500 text-xs"
          />
          <button class="ml-2 text-black">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="h-5 w-5">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
            </svg>
          </button>
        </div>
        <div class="relative">
          <router-link @click.prevent="scrollToTop" to="/wishlist" class="text-black">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                 stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
            </svg>
          </router-link>
          <div v-show="wishListCount > 0"
               class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-red-500 flex items-center justify-center">
            <span class="text-white text-xs font-bold">{{ wishListCount }}</span>
          </div>
        </div>
        <div class="relative">
          <router-link to="">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
            </svg>
          </router-link>
        </div>
        <Menu as="div" class="relative">
          <div class="flex items-center">
            <MenuButton
                @click="isOpen = !isOpen"
                v-click-outside="dropDownClose"
                :class="{ 'bg-[#db4444] text-white' : isOpen }"
                class="w-full justify-center rounded-full px-1 py-1 ">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                   stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
              </svg>
            </MenuButton>
          </div>
          <transition
              enter-active-class="transition duration-100 ease-out"
              enter-from-class="transform scale-95 opacity-0"
              enter-to-class="transform scale-100 opacity-100"
              leave-active-class="transition duration-75 ease-in"
              leave-from-class="transform scale-100 opacity-100"
              leave-to-class="transform scale-95 opacity-0"
          >
            <MenuItems
                class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
            >
              <div class="px-1 py-1">
                <MenuItem v-slot="{ active }">
                  <router-link to="/account"
                      :class="[
                  active ? 'bg-[#db4444] text-white' : 'text-gray-900',
                  'group flex justify-between w-full items-center rounded-md px-2 py-2 text-sm',
                ]"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Manage My Account
                  </router-link>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <router-link to=""
                      :class="[
                  active ? 'bg-[#db4444] text-white' : 'text-gray-900',
                  'group flex justify-between w-full items-center rounded-md px-2 py-2 text-sm',
                ]"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    My Order
                  </router-link>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <router-link to=""
                      :class="[
                  active ? 'bg-[#db4444] text-white' : 'text-gray-900',
                  'group flex justify-between w-full items-center rounded-md px-2 py-2 text-sm',
                ]"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                    My Reviews
                  </router-link>
                </MenuItem>
              </div>
              <div class="px-1 py-1">
                <MenuItem v-slot="{ active }">
                  <button
                      :class="[
                  active ? 'bg-[#db4444] text-white' : 'text-gray-900',
                  'group justify-between flex w-full items-center rounded-md px-2 py-2 text-sm',
                ]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    Log Out
                  </button>
                </MenuItem>
              </div>
            </MenuItems>
          </transition>
        </Menu>
      </div>
    </nav>
    <hr class="h-[2px] bg-gray-300 border-0">
  </header>
</template>

<script>
import {MenuButton, MenuItem, MenuItems, Menu} from "@headlessui/vue";

export default {
  components: {MenuItem, MenuItems, MenuButton, Menu},
  data() {
    return {
      wishListCount: 0,
      isOpen: false
    }
  },
  created() {
    this.$mitt.on('add-to-wishlist', this.increaseWishlistCount);
    this.$mitt.on('remove-from-wishlist', this.decreaseWishlistCount);
  },
  methods: {
    increaseWishlistCount() {
      this.wishListCount++;
    },
    decreaseWishlistCount() {
      if (this.wishListCount > 0) {
        this.wishListCount--;
      }
    },
    scrollToTop() {
      window.scrollTo({top: 0, behavior: 'smooth'})
    },
    dropDownClose(event) {
      this.isOpen = false;
    }
  },
}
</script>

<style scoped>

</style>