<template>
  <span class="font-semibold text-3xl">Product big name 111</span>
  <div class="flex gap-x-4 items-center">
    <star-rating rating="4" review-number="50"></star-rating>
    <div class="border-l-2 border-gray-300 h-full"></div>
    <span class="text-green-500 text-sm">In Stock</span>
  </div>
  <div class="space-y-8">
    <span class="text-2xl font-normal">$198.00</span>
    <p class="text-sm max-w-lg">PlayStation 5 Controller Skin High quality vinyl with air channel adhesive for
      easy bubble free install & mess free removal Pressure sensitive.</p>
    <hr class="h-[2px] bg-gray-300 border-0">
  </div>
</template>

<script>

import {defineComponent} from "vue";
import StarRating from "@/components/Card/StarRating.vue";

export default {
  components: {StarRating},

}
</script>


<style scoped>

</style>