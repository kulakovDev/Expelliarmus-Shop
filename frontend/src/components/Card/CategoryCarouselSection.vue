<template>
  <div class="flex justify-between relative">
    <div class="mt-10 w-3/6">
      <ul class="space-y-4 text-left">
        <li
            v-for="(category, index) in categories"
            :key="index"
            class="text-lg">
          <a
              href="#"
              @click.prevent="selectCategory(index)"
              class="text-black hover:underline underline-offset-4">
            {{ category }}
          </a>
        </li>
      </ul>
    </div>

    <div class="h-auto w-px bg-gray-300"></div>

    <div class="mt-10 max-w-[1080px] max-h-[512px] ml-10 relative overflow-hidden">
      <div class="flex transition-transform duration-500" :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
        <div
            class="flex flex-shrink-0 w-full"
            v-for="(slide, index) in slides"
            :key="index">
          <img :src="slide" alt="image" class="object-contain w-full">
        </div>
      </div>
      <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <button
            v-for="(slide, index) in slides"
            :key="index"
            @click="goToSlide(index)"
            :class="['w-4 h-4 rounded-full flex items-center justify-center', currentIndex === index ? 'bg-white' : 'bg-gray-400']">
          <span
              :class="['w-2.5 h-2.5 rounded-full', currentIndex === index ? 'bg-[#e8a439]' : 'bg-gray-400']">
          </span>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>

import {onMounted, ref} from "vue";

const currentIndex = ref(0);

const slides = ref([
  "https://dummyimage.com/1080x400/000/fff",
  "https://dummyimage.com/1080x400/000/fff",
  "https://dummyimage.com/1080x400/000/fff",
]);

const categories = ref([
  'Category 1adadadada',
  'Category 2',
  'Category 3',
  'Category 4',
  'Category 5',
  'Category 6',
  'Category 7',
  'Category 8',
]);

function goToSlide(index) {
  currentIndex.value = index;
}

function autoSlide() {
  setInterval(() => {
    currentIndex.value = (currentIndex.value + 1) % slides.value.length;
  }, 3000);
}

onMounted(() => autoSlide())

</script>

<style scoped>
</style>
