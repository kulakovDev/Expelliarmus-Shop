<script setup>
import { TreeSelect } from "primevue";
</script>

<template>
  <div class="space-y-2">
    <span>Category<span class="text-red-800">*</span></span>
    <div
      class="relative w-full cursor-default overflow-hidden rounded-lg bg-gray-100 text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white"
    >
      <TreeSelect
        placeholder="Click on me"
        class="w-full bg-gray-100 outline-none text-gray-700 placeholder-gray-500 text-base p-4"
      />
    </div>
  </div>
</template>

<style scoped></style>
