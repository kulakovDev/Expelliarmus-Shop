<script setup>

</script>

<template>
  <header>
    <div class="flex justify-center bg-black text-white py-3">
      <span class="text-sm">
        Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%!
        <a href="#" class="font-bold underline">ShopNow</a>
      </span>
    </div>
    <nav class="container mx-auto flex justify-between items-center max-h-24 pt-9 pb-4">
      <div>
        <router-link class="text-2xl font-bold logo" to="/">Expelliarmus Shop</router-link>
      </div>
      <div>
        <ul class="flex space-x-16 text-base">
          <li class="hover:underline underline-offset-4 decoration-2"><router-link to="/">Home</router-link></li>
          <li class="hover:underline underline-offset-4 decoration-2"><a href="#">Contact</a></li>
          <li class="hover:underline underline-offset-4 decoration-2"><router-link to="#">About</router-link></li>
          <li class="hover:underline underline-offset-4 decoration-2"><router-link to="/sign-up">Sign up</router-link></li>
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
        <button class="text-black">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
               class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
          </svg>
        </button>
        <button class="text-black">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
               class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
          </svg>
        </button>
      </div>
    </nav>
    <hr class="h-[2px] bg-gray-300 border-0">
  </header>
</template>

<style scoped>

</style>