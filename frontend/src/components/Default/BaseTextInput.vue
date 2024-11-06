<template>
  <div class="space-y-2">
    <label v-if="label" :for="id">{{ label }}<span v-if="required" class="text-red-800">*</span></label>
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
          :required="required"
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
    required: {
      type: Boolean,
      default: false
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