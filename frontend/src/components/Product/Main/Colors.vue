<template>
  <div class="flex items-center gap-x-6">
    <span class="text-xl">Colors:</span>
    <div v-for="(color, index) in colors" :key="index">
      <input
          :id="'color-'+index"
          type="radio"
          name="product_color"
          class="w-5 h-5 hidden peer"
          :checked="index === 0"
      />
      <label :for="'color-'+index"
             :style="{ backgroundColor: color.color, borderColor: color.color }"
             class="relative flex items-center justify-center p-1 peer-checked:before:hidden before:block before:absolute before:w-full before:h-full before:bg-white w-6 h-6 cursor-pointer border-2 rounded-full overflow-hidden">
        <span
            :style="{ backgroundColor: color.color }"
            class="rounded-full w-3 h-3"
        ></span>
      </label>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    colors: Array,
  },
};
</script>
