<template>
  <div class="flex justify-between mb-10">
    <p class="text-4xl font-semibold">{{ title }}</p>
    <div class="flex space-x-4">
      <button @click="previous" class="w-11 h-11 bg-[#b9b9b9] rounded-full flex items-center justify-center" :disabled="currentIndex === 0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
      </button>
      <button @click="next" class="w-11 h-11 bg-[#b9b9b9] rounded-full flex items-center justify-center" :disabled="currentIndex >= maxIndex">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
        </svg>
      </button>
    </div>
  </div>
  <div class="overflow-hidden">
    <div :class="['flex transition-transform duration-300', additionalClasses]" :style="sliderStyle">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: 'Title'
    },
    itemsToShow: {
      type: Number,
      default: 5
    },
    widthBetweenItems: {
      type: Number
    },
    additionalClasses: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      currentIndex: 0
    };
  },
  computed: {
    maxIndex() {
      return Math.max(0, Math.ceil(this.$slots.default().length / this.itemsToShow) - 1);
    },
    sliderStyle() {
      const offset = this.currentIndex * (this.widthBetweenItems * this.itemsToShow);
      return {
        transform: `translateX(-${offset}px)`,
        width: `${this.widthBetweenItems * this.$slots.default().length}px`,
      };
    }
  },
  methods: {
    next() {
      if (this.currentIndex < this.maxIndex) {
        this.currentIndex++;
      }
    },
    previous() {
      if (this.currentIndex > 0) {
        this.currentIndex--;
      }
    }
  }
}
</script>

<style scoped>
.product-card {
  flex: 0 0 calc(100% / var(--items-to-show));
  box-sizing: border-box;
  max-width: calc(100% / var(--items-to-show));
}

:root {
  --items-to-show: 5;
}
</style>
