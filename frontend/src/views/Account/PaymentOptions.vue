<template>
  <section class="w-full">
    <span class="text-xl font-medium text-[#db4444]">Payment Option</span>
  </section>
  <section class="text-black">
    <form action="#" class="w-full p-4">
      <div class="mb-6 grid grid-cols-2 gap-8">
        <div class="col-span-2 sm:col-span-1">
          <label for="full_name" class="mb-2 block text-sm font-medium text-gray-900"> Full name (as displayed on
            card)* </label>
          <input type="text" id="full_name"
                 class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                 placeholder="Bonnie Green" required/>
        </div>

        <div class="col-span-2 sm:col-span-1">
          <label for="card-number-input" class="mb-2 block text-sm font-medium text-gray-900"> Card number* </label>
          <input type="text" id="card-number-input"
                 class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pe-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                 placeholder="xxxx-xxxx-xxxx-xxxx" pattern="^4[0-9]{12}(?:[0-9]{3})?$" required/>
        </div>

        <div>
          <label for="card-expiration-input" class="mb-2 block text-sm font-medium text-gray-900">Card
            expiration* </label>
          <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
              <svg class="h-4 w-4 text-gray-500" aria-hidden="true"
                   xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path
                    fill-rule="evenodd"
                    d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                    clip-rule="evenodd"
                />
              </svg>
            </div>
            <input id="card-expiration-input" type="date"
                   class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 ps-9 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                   placeholder="12/23" required/>
          </div>
        </div>
        <div>
          <label for="cvv-input" class="mb-2 flex items-center gap-1 text-sm font-medium text-gray-900">
            CVV*
            <div id="cvv-desc" role="tooltip"
                 class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
              The last 3 digits on back of card
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
          </label>
          <input type="number" id="cvv-input" aria-describedby="helper-text-explanation"
                 class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                 placeholder="•••" required/>
        </div>
      </div>
      <section class="flex justify-end gap-x-8">
        <button type="button" class="text-black text-center">
          Cancel
        </button>
        <button type="button"
                class="px-12 py-4 bg-[#db4444] text-white text-center hover:bg-red-900 rounded-md">
          Save Changes
        </button>
      </section>
    </form>
  </section>
</template>

<script>

import {TabPanel} from "@headlessui/vue";

export default {
  components: {TabPanel},
}
</script>

<style scoped>

</style>