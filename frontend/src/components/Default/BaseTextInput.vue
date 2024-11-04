<template>
  <div class="space-y-2">
    <label v-if="label" :for="id">{{ label }}</label>
    <div
        class="flex items-center bg-gray-100 rounded-md px-4 py-4 focus-within:ring-2 focus-within:ring-gray-500">
      <input
          :id="id"
          :name="name"
          :type="type"
          :placeholder="placeholder"
          v-model="value"
          v-bind="$attrs"
          class="w-full bg-gray-100 outline-none text-gray-700 placeholder-gray-500 text-base"
      />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
    },
    id: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    type: {
      type: String,
      default: 'text'
    },
    placeholder: {
      type: String,
      default: ''
    },
    modelValue: String
  },
  computed: {
    value: {
      get(){
        return this.modelValue;
      },
      set(value){
        this.$emit('update:modelValue', value)
      }
    }
  }
}
</script>

<style scoped>

</style>