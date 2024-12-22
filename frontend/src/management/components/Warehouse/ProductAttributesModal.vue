<script setup>
import DefaultModal from "@/management/components/Main/DefaultModal.vue";
import { ref, watch } from "vue";
import AttributesStepper from "@/management/components/Warehouse/AttributesStepper.vue";

const isModalOpen = ref(false);
const isLastStep = ref(false);
const attributesStepperRef = ref(null);

let optionsFromStepper = {};

const getOptionsFromStepper = () => {
  if (attributesStepperRef.value) {
    optionsFromStepper = attributesStepperRef.value;
    isModalOpen.value = false;
    emit("update-options", optionsFromStepper);
  }
};

watch(isModalOpen, (value) => {
  if (!value) {
    isLastStep.value = false;
  }
});

const emit = defineEmits(["update-options"]);
</script>

<template>
  <div class="flex items-center gap-x-4">
    <div v-if="Object.keys(optionsFromStepper).length === 0">
      <span
        >Leave this section, if your product <b>does not have</b> any
        attributes, like color, sizes etc or
      </span>
      <button
        @click="isModalOpen = true"
        class="px-10 py-3 bg-blue-500 rounded-lg text-white hover:bg-blue-700"
      >
        Generate attribute fields
      </button>
    </div>
    <div v-else>
      <button
        @click="isModalOpen = true"
        class="px-10 py-3 bg-red-500 rounded-lg text-white hover:bg-red-700"
      >
        Re-generate attribute fields
      </button>
    </div>
    <default-modal
      :is-active="isModalOpen"
      @close-modal="isModalOpen = false"
      max-width="max-w-2xl"
    >
      <template #modalHeading>
        <span>Attributes generator</span>
      </template>
      <template #modalBody>
        <attributes-stepper
          @last-step="isLastStep = !isLastStep"
          ref="attributesStepperRef"
        ></attributes-stepper>
      </template>
      <template #modalFooter>
        <div class="space-x-4">
          <button
            @click="isModalOpen = false"
            class="px-4 py-2 bg-gray-300 text-white rounded hover:bg-gray-400"
          >
            Cancel
          </button>
          <button
            v-show="isLastStep"
            @click="getOptionsFromStepper"
            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700"
          >
            Generate
          </button>
        </div>
      </template>
    </default-modal>
  </div>
</template>

<style scoped></style>
