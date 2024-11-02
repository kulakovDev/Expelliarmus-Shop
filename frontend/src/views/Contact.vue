<template>
  <main class="space-y-20 first-of-type:mt-20 last-of-type:mb-20">
    <section class="container mx-auto">
      <bread-crumbs :links="links"></bread-crumbs>
    </section>

    <section class="container mx-auto my-20">
      <div class="flex justify-between mt-20">
        <div class="py-10 px-9 rounded-md bg-white drop-shadow-lg">
          <div class="flex flex-col gap-y-8 max-w-80">
            <div class="space-y-8">
              <div class="flex justify-start items-center gap-x-4">
                <div class="w-10 h-10 rounded-full bg-[#db4444] flex justify-center items-center text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                  </svg>
                </div>
                <span class="text-base font-medium">Call To Us</span>
              </div>
              <div class="space-y-4">
                <p>We are available 24/7, 7 days a week.</p>
                <p>Phone: +00000000000000</p>
              </div>
            </div>
            <hr class="h-[2px] bg-gray-300 border-0">
            <div class="space-y-8">
              <div class="flex justify-start items-center gap-x-4">
                <div class="w-10 h-10 rounded-full bg-[#db4444] flex justify-center items-center text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                  </svg>
                </div>
                <span class="text-base font-medium">Write To Us</span>
              </div>
              <div class="space-y-4">
                <p>Fill out our form and we will contact you within 24 hours.</p>
                <p>Emails: customer@expelliarmus.com</p>
                <p>Emails: support@expelliarmus.com</p>
              </div>
            </div>
          </div>
        </div>

        <div class="py-10 px-9 rounded-md bg-white drop-shadow-lg">
          <form class="flex flex-col gap-y-8">
            <div class="flex justify-between gap-x-4">
              <div class="flex items-center bg-gray-100 rounded-md px-4 py-4 focus-within:ring-2 focus-within:ring-gray-500 max-w-xs">
                <input
                    id="name"
                    type="text"
                    placeholder="Your Name"
                    class="w-full bg-gray-100 outline-none text-gray-700 placeholder-gray-500 text-base"
                />
              </div>
              <div class="flex items-center bg-gray-100 rounded-md px-4 py-2 focus-within:ring-2 focus-within:ring-gray-500 max-w-xs">
                <input
                    type="text"
                    placeholder="Your Email"
                    class="w-full bg-gray-100 outline-none text-gray-700 placeholder-gray-500 text-base"
                />
              </div>
              <div class="flex items-center bg-gray-100 rounded-md px-4 py-2 focus-within:ring-2 focus-within:ring-gray-500 max-w-xs">
                <input
                    type="text"
                    placeholder="Your Phone"
                    class="w-full bg-gray-100 outline-none text-gray-700 placeholder-gray-500 text-base"
                />
              </div>
            </div>
            <div class="bg-gray-100 rounded-md px-4 py-2 focus-within:ring-2 focus-within:ring-gray-500">
              <textarea class="w-full bg-gray-100 border-none focus:outline-none resize-none" rows="10" placeholder="Type your text here..."></textarea>
            </div>
            <div class="flex justify-end">
              <button type="button" class="px-12 py-4 bg-[#db4444] text-white text-center hover:bg-red-900 rounded-md">
                Send Message
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>
</template>

<script>

import {defineComponent} from "vue";
import BreadCrumbs from "@/components/Default/BreadCrumbs.vue";

export default defineComponent({
  components: {BreadCrumbs},
  data() {
    return {
      links: [
        {
          url: '/',
          name: 'Home'
        },
        {
          url: '/contact',
          name: 'Contact'
        }
      ]
    }
  }
})
</script>

<style scoped>

</style>
