<script setup>
const props = defineProps({
  cardNumber: {
    type: Number,
    required: true,
  },
});

// TODO: по циклу отобразить все карты операясь на количество cardNumber v-for="index in cardNumber" :key="index"
// TODO: последним элементо создать просто карту с фоном где по середине будет текст Load More
</script>

<template>
<div class="flex justify-between flex-wrap gap-4">
  <div v-for="index in cardNumber" :key="index" class="max-w-[240px] mx-1.5 my-8 ">
    <div class="bg-transparent rounded-2xl overflow-hidden shadow transition-transform duration-300 ease-in-out
    hover:-translate-y-1 hover:shadow-md">
      <div class="p-5 pb-0 h-[150px] overflow-hidden">
        <img
            src="https://dummyimage.com/150x150/000/fff"
            alt="Load More"
            class="w-full h-full object-cover transition-transform duration-300 ease-in-out hover:scale-105"
        />
      </div>
      <div class="p-5">
        <h2 class="text-sm text-gray-900">Title</h2>
        <div class="flex justify-between items-center mt-2">
          <span class="text-xs text-gray-500">xx.xx.xxxx</span>
          <span class="text-xs text-gray-500">#article</span>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="flex justify-center">
    <button class="rounded-full px-4 py-2 duration-300 text-sm text-white shadow-sm bg-gray-400 bg-auto border-2 hover:bg-gray-500 ">Load More</button>
  </div>
</template>

<style scoped>

</style>