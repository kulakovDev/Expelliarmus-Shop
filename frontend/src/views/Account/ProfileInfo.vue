<template>
  <section class="w-full">
    <span class="text-xl font-medium text-[#db4444]">Edit your profile</span>
  </section>
  <form class="space-y-8">
    <section class="grid grid-cols-2 grid-rows-2 gap-8">
      <base-text-input
          id="first-name"
          name="first_name"
          v-model="firstName"
          label="First Name">
      </base-text-input>
      <base-text-input
          id="last-name"
          name="last_name"
          v-model="lastName"
          label="Last Name">
      </base-text-input>
      <base-text-input
          id="email"
          name="email"
          v-model="email"
          label="Email">
      </base-text-input>
      <div class="space-y-2">
        <label for="gender">Gender</label>
        <div
            class="flex items-center bg-gray-100 rounded-md w-full px-4 py-4 focus-within:ring-2 focus-within:ring-gray-500">
          <select id="gender"
                  class="w-full bg-gray-100 outline-none text-gray-700 placeholder-gray-500 text-base">
            <option selected value="man">Man</option>
            <option value="woman">Woman</option>
            <option value="other">Other</option>
          </select>
        </div>
      </div>
    </section>
    <section class="flex w-full flex-col gap-y-4">
      <div class="space-y-2">
        <label for="id">Password Changes</label>
        <div
            class="flex items-center bg-gray-100 rounded-md px-4 py-4 focus-within:ring-2 focus-within:ring-gray-500">
          <input
              id="old-password"
              name="old_password"
              type="password"
              autocomplete="off"
              placeholder="Old Password"
              class="w-full bg-gray-100 outline-none text-gray-700 placeholder-gray-500 text-base"
          />
        </div>
      </div>
      <div
          class="flex items-center bg-gray-100 rounded-md px-4 py-4 focus-within:ring-2 focus-within:ring-gray-500">
        <input
            name="new_password"
            type="password"
            placeholder="New Password"
            autocomplete="off"
            class="w-full bg-gray-100 outline-none text-gray-700 placeholder-gray-500 text-base"
        />
      </div>
      <div
          class="flex items-center bg-gray-100 rounded-md px-4 py-4 focus-within:ring-2 focus-within:ring-gray-500">
        <input
            name="confirm_password"
            autocomplete="off"
            type="password"
            placeholder="Confirm Password"
            class="w-full bg-gray-100 outline-none text-gray-700 placeholder-gray-500 text-base"
        />
      </div>
    </section>
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
</template>

<script>

import {defineComponent} from "vue";
import BaseTextInput from "@/components/Default/BaseTextInput.vue";
import {TabPanel} from "@headlessui/vue";

export default defineComponent({
  components: {TabPanel, BaseTextInput},
  data() {
    return {
      firstName: 'John',
      lastName: 'Doe',
      email: 'example@gmail.com'
    }
  },
  created() {
    console.log('i created');
  },
  mounted() {
    console.log('i mounted');
  }
})
</script>

<style scoped>

</style>