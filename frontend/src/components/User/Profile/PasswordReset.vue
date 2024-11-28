<script setup></script>

<template>
  <form action="" class="space-y-6">
    <section class="flex w-full flex-col gap-y-4">
      <div class="space-y-2">
        <label for="id">Password Changes</label>
        <div
          class="flex items-center bg-gray-100 rounded-md px-4 py-4 focus-within:ring-2 focus-within:ring-gray-500"
        >
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
        class="flex items-center bg-gray-100 rounded-md px-4 py-4 focus-within:ring-2 focus-within:ring-gray-500"
      >
        <input
          name="new_password"
          type="password"
          placeholder="New Password"
          autocomplete="off"
          class="w-full bg-gray-100 outline-none text-gray-700 placeholder-gray-500 text-base"
        />
      </div>
      <div
        class="flex items-center bg-gray-100 rounded-md px-4 py-4 focus-within:ring-2 focus-within:ring-gray-500"
      >
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
      <button
        type="button"
        class="px-12 py-4 bg-[#db4444] text-white text-center hover:bg-red-900 rounded-md"
      >
        Update Password
      </button>
    </section>
  </form>
</template>

<style scoped></style>
