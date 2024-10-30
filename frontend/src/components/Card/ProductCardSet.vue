<template>
  <div class="flex justify-between mb-10">
    <p class="text-4xl font-semibold">{{ title }}</p>
    <div class="flex space-x-4">
      <router-link
          :to="buttonLink"
          class="w-40 h-14 flex justify-center items-center bg-[#db4444] text-white rounded-md hover:bg-red-900">
        {{ buttonName }}
      </router-link>
    </div>
  </div>
  <div class="flex items-center gap-11">
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String
    },
    buttonName: {
      type: String
    },
    buttonLink: {
      type: String,
      default: '#'
    }
  }
}
</script>

<style lang="scss" scoped>

</style>