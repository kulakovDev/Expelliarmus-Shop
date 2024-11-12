<template>
  <footer class="mt-auto sticky bottom-0">
    <div class="container mx-auto  max-w-screen-2xl bg-[#CECECE] px-8 pt-5 pb-3 rounded-t-lg shadow-light-mode dark:shadow-dark-mode">
      <nav class="flex items-center dark:text-black relative">
        <div v-show="isContentVisible" class="text-center content">
          <router-link to="" class="font-bold text-xl">
            Expelliarmus<br /><span class="text-base font-normal">Management</span>
          </router-link>
        </div>
        <div v-show="isContentVisible" class="w-full content">
          <ul class="list-none flex justify-around space-x-6">
            <li class="hover:underline underline-offset-4 decoration-2">
              <router-link to="/management">Home</router-link>
            </li>
            <li class="hover:underline underline-offset-4 decoration-2">
              Client
            </li>
            <li class="hover:underline underline-offset-4 decoration-2">
              Orders
            </li>
            <li class="hover:underline underline-offset-4 decoration-2">
              Warehouse
            </li>
            <li>
              <custom-menu :links="contentLinks" drop-to-up>
                <template v-slot:menu-button="{ isOpen }">
                  <span class="hover:underline underline-offset-4 decoration-2">Content Management</span>
                </template>
              </custom-menu>
            </li>
          </ul>
        </div>
        <div v-show="isContentVisible" class="flex-shrink-0 content">
          <button class="flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
            </svg>
            Log Out
          </button>
        </div>
        <button @click="toggleContent" class="py-3 px-3 dark:bg-[#e7a338] bg-gray-700 text-white rounded-2xl absolute -top-10 -right-5">
          <svg v-if="!isContentVisible" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75L12 8.25l7.5 7.5" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
          </svg>
        </button>
      </nav>
    </div>
  </footer>
</template>

<script>
import CustomMenu from "@/components/Default/Menu.vue";

export default {
  components: {
    CustomMenu
  },
  data() {
    return {
      isContentVisible: true,
      contentLinks: [
        { url: '', name: 'Slider' },
        { url: '', name: 'New Arrivals Card' }
      ]
    };
  },
  methods: {
    toggleContent() {
      this.isContentVisible = !this.isContentVisible;
    },
  },
};
</script>

<style scoped>
.content {
  transition: opacity 0.3s ease;
}
.content[style*="display: none"] {
  opacity: 0;
  padding: 0;
}

footer .sticky {
  z-index: 100;
}
</style>
