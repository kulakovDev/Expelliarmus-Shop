<template>
  <div class="space-y-2">
    <label v-if="label" :for="id"
      >{{ label }}<span v-if="required" class="text-red-800">*</span></label
    >
    <div
      class="relative w-full overflow-hidden cursor-default rounded-lg bg-gray-100 text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
    >
      <input
        :id="id"
        :name="name"
        :type="type"
        :placeholder="placeholder"
        v-model="value"
        class="w-full bg-white outline-none text-gray-700 placeholder-gray-500 text-base p-4 dark:bg-gray-200"
        :required="required"
      />
    </div>
    <span v-if="error" class="text-sm text-red-600 ml-px">{{ error }}</span>
  </div>
</template>

<script setup>
import { computed, defineProps } from "vue";

const props = defineProps({
  label: {
    type: String,
  },
  id: {
    type: String,
    required: true,
  },
  name: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    default: "text",
  },
  placeholder: {
    type: String,
    default: "",
  },
  required: {
    type: Boolean,
    default: false,
  },
  error: {
    type: String,
    default: null,
  },
  modelValue: String,
  bodyClass: {
    type: String,
    default: null,
  },
  inputClass: {
    type: String,
    default: null,
  },
});

const emit = defineEmits(["update:modelValue"]);

const value = computed({
  get: () => props.modelValue,
  set: (newValue) => emit("update:modelValue", newValue),
});
</script>

<style scoped></style>
