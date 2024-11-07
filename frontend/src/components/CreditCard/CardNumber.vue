<template>
  <div>
    <label for="card-number-input" class="mb-2 block text-sm font-medium text-gray-900"> Card number* </label>
    <input
        type="text"
        id="card-number-input"
        v-model="value"
        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pe-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
        placeholder="xxxx-xxxx-xxxx-xxxx"
        pattern="^4[0-9]{12}(?:[0-9]{3})?$"
        required
    />
  </div>
</template>

<script>
export default {
  props: {
    modelValue: String
  },
  computed: {
    value: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit('update:modelValue', value)
      }
    }
  }
}
</script>

<style scoped>

</style>