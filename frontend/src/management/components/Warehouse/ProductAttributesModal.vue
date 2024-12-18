<script setup>
import DefaultModal from "@/management/components/Main/DefaultModal.vue";
import { ref } from "vue";
import AttributesStepper from "@/management/components/Warehouse/AttributesStepper.vue";

const isModalOpen = ref(false);
</script>

<template>
  <div class="flex items-center gap-x-4">
    <span
      >Leave this section, if your product <b>does not have</b> any attributes,
      like color, sizes etc or
    </span>
    <button
      @click="isModalOpen = true"
      class="px-10 py-3 bg-blue-500 rounded-lg text-white hover:bg-blue-700"
    >
      Generate attribute fields
    </button>
    <default-modal
      :is-active="isModalOpen"
      @close-modal="isModalOpen = false"
      max-width="max-w-2xl"
    >
      <template #modalHeading>
        <span>Attributes generator</span>
      </template>
      <template #modalBody>
        <attributes-stepper></attributes-stepper>
      </template>
      <template #modalFooter>
        <button
          @click="isModalOpen = false"
          class="px-4 py-2 bg-gray-300 text-white rounded hover:bg-gray-400"
        >
          Cancel
        </button>
      </template>
    </default-modal>
  </div>
</template>

<style scoped></style>
