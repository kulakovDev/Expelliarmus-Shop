<template>
  <main class="space-y-20 first-of-type:mt-20 last-of-type:mb-20">
    <section class="container mx-auto max-w-screen-2xl">
      <div class="flex justify-between">
        <bread-crumbs :links="links"></bread-crumbs>
        <span class="text-sm">Welcome! <span class="text-[#db4444]">User</span></span>
      </div>
    </section>
    <section class="container mx-auto grid grid-cols-7 grid-rows-5 gap-8 max-w-screen-2xl">
      <tab-group :selectedIndex="selectedTab" @change="changeTab">
        <aside class="col-span-2 row-span-5 space-y-6">
          <div class="flex flex-col gap-3">
            <span class="text-lg font-medium">Manage My Account</span>
            <tab-list class="flex flex-col gap-y-2 items-start ps-8 text-base">
              <tab as="template" v-slot="{ selected }">
                <button
                    :class="{ 'text-[#db4444]': selected, 'text-[#808080]': !selected }"
                    class="focus:outline-none">
                  My Profile
                </button>
              </tab>
              <tab as="template" v-slot="{ selected }">
                <button
                    :class="{ 'text-[#db4444]': selected, 'text-[#808080]': !selected }"
                    class="focus:outline-none">
                  Access Book
                </button>
              </tab>
              <tab as="template" v-slot="{ selected }">
                <button
                    :class="{ 'text-[#db4444]': selected, 'text-[#808080]': !selected }"
                    class="focus:outline-none">
                  My Payment Options
                </button>
              </tab>
            </tab-list>
          </div>
          <div class="flex flex-col gap-3">
            <span class="text-lg font-medium">My Orders</span>
            <tab-list class="flex flex-col gap-y-2 ps-8 items-start text-base">
              <tab as="template" v-slot="{ selected }">
                <button
                    :class="{ 'text-[#db4444]': selected, 'text-[#808080]': !selected }"
                    class="focus:outline-none">
                  My Orders
                </button>
              </tab>
              <tab as="template" v-slot="{ selected }">
                <button
                    :class="{ 'text-[#db4444]': selected, 'text-[#808080]': !selected }"
                    class="focus:outline-none">
                  My Cancellations
                </button>
              </tab>
            </tab-list>
          </div>
        </aside>
        <tab-panels class="col-span-5 row-span-5 col-start-3 bg-white shadow-[0px_1px_9px_0px_rgba(0,_0,_0,_0.1)] rounded-md">
          <tab-panel v-show="selectedTab === 0" class="py-10 px-20 space-y-8">
            <profile-info />
          </tab-panel>
          <tab-panel v-show="selectedTab === 1" class="py-10 px-20 space-y-8">

          </tab-panel>
          <tab-panel v-show="selectedTab === 2" class="py-10 px-20 space-y-8">
            <payment-options/>
          </tab-panel>
          <tab-panel v-show="selectedTab === 3" class="py-10 px-20 space-y-8">
            <my-orders/>
          </tab-panel>
          <tab-panel v-show="selectedTab === 4" class="py-10 px-20 space-y-8">
            <my-cancellations/>
          </tab-panel>
        </tab-panels>
      </tab-group>
    </section>
  </main>
</template>

<script>
import { defineAsyncComponent } from "vue";
import BreadCrumbs from "@/components/Default/BreadCrumbs.vue";
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";

export default {
  components: {
    TabPanel,
    TabPanels,
    Tab,
    TabList,
    TabGroup,
    BreadCrumbs,
    ProfileInfo: defineAsyncComponent(() => import('@/shop/views/Account/ProfileInfo.vue')),
    PaymentOptions: defineAsyncComponent(() => import('@/shop/views/Account/PaymentOptions.vue')),
    MyOrders: defineAsyncComponent(() => import('@/shop/views/Account/MyOrders.vue')),
    MyCancellations: defineAsyncComponent(() => import('@/shop/views/Account/MyCancellations.vue'))
  },
  data() {
    return {
      links: [
        { url: '/', name: 'Home' },
        { url: '/account', name: 'Account' },
      ],
      selectedTab: 0,
    }
  },
  methods: {
    changeTab(index) {
      this.selectedTab = index;
    }
  },
};
</script>

<style scoped>
</style>
