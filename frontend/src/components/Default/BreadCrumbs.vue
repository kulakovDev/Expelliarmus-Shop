<template>
  <div class="space-x-4 text-sm">
    <template v-for="link in linksMapped" :key="link.url">
      <router-link
          :to="link.url"
          :class="link.isLast ? 'text-black' : 'text-gray-400'">
        {{ link.name }}
      </router-link>

      <span v-if="!link.isLast" class="text-gray-400">/</span>
    </template>
  </div>
</template>

<script>
export default {
  props: {
    links: {
      type: Array,
      required: true
    }
  },
  computed: {
    linksMapped() {
      return this.links.map((link, index) => ({
        ...link,
        isLast: index === this.links.length - 1
      }));
    }
  }
}
</script>

<style scoped>

</style>
