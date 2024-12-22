<script setup>
import Stepper from "primevue/stepper";
import StepList from "primevue/steplist";
import StepPanels from "primevue/steppanels";
import Step from "primevue/step";
import StepPanel from "primevue/steppanel";
import Button from "primevue/button";
import { Switch } from "@headlessui/vue";
import { ref, watch } from "vue";

const withCombinedAttr = ref(false);
const numberOfAttributes = ref(1);
const numberOfCombinations = ref(null);
const oneToManyAttributesQuantity = ref(null);
const oneToManyAttributesNumber = ref(null);

watch(withCombinedAttr, (value) => {
  numberOfAttributes.value = 1;
  if (value) {
    numberOfCombinations.value = 1;
    oneToManyAttributesQuantity.value = 0;
    oneToManyAttributesNumber.value = 0;
  } else {
    numberOfCombinations.value = null;
    oneToManyAttributesQuantity.value = null;
    oneToManyAttributesNumber.value = null;
  }
});

watch(oneToManyAttributesNumber, (newValue, oldValue) => {
  if (newValue !== 0 && oneToManyAttributesQuantity.value === 0) {
    oneToManyAttributesQuantity.value = 1;
  } else if (newValue === 0 && oldValue !== 0) {
    oneToManyAttributesQuantity.value = 0;
  }
});

watch(oneToManyAttributesQuantity, (newValue, oldValue) => {
  if (newValue !== 0 && oneToManyAttributesNumber.value === 0) {
    oneToManyAttributesNumber.value = 1;
  } else if (newValue === 0 && oldValue !== 0) {
    oneToManyAttributesNumber.value = 0;
  }
});

const emit = defineEmits(["last-step"]);

function lastStep(activateCallback, step) {
  activateCallback(step);
  emit("last-step");
}

defineExpose({
  withCombinedAttr,
  numberOfAttributes,
  numberOfCombinations,
  oneToManyAttributesQuantity,
  oneToManyAttributesNumber,
});
</script>

<template>
  <Stepper value="1" linear>
    <StepList>
      <Step value="1">Step I</Step>
      <Step value="2">Step II</Step>
      <Step value="3">Summarize</Step>
    </StepList>
    <StepPanels>
      <StepPanel v-slot="{ activateCallback }" value="1">
        <div class="flex flex-col h-48">
          <div
            class="rounded bg-surface-50 dark:bg-surface-950 flex-auto flex justify-center items-center font-medium"
          >
            <div class="w-full space-y-6">
              <p>
                In your product, are there any attributes that are always used
                in combination? For example, in clothing, color and size are
                typically combined.
              </p>
              <div class="flex items-center justify-center gap-x-2">
                <span>No</span>
                <Switch
                  v-model="withCombinedAttr"
                  :class="withCombinedAttr ? 'bg-yellow-500' : 'bg-gray-300'"
                  class="relative inline-flex h-[24px] w-[52px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
                >
                  <span class="sr-only">Use setting</span>
                  <span
                    aria-hidden="true"
                    :class="
                      withCombinedAttr ? 'translate-x-7' : 'translate-x-0'
                    "
                    class="pointer-events-none inline-block h-[20px] w-[20px] transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out"
                  />
                </Switch>
                <span>Yes</span>
              </div>
            </div>
          </div>
        </div>
        <div class="flex pt-6 justify-end">
          <Button
            label="Next"
            icon="pi pi-arrow-right"
            @click="activateCallback('2')"
          />
        </div>
      </StepPanel>
      <StepPanel v-slot="{ activateCallback }" value="2">
        <div class="flex flex-col h-52">
          <div
            class="rounded bg-surface-50 dark:bg-surface-950 max-h-48 flex-auto flex justify-center items-center font-medium"
          >
            <div
              class="w-full overflow-y-auto h-full space-y-4"
              v-if="withCombinedAttr"
            >
              <span class="text-lg font-semibold block text-center">
                Combined attributes
                <span class="text-sm font-normal block mt-2 text-center">
                  Please, read the instructions
                </span>
              </span>
              <p class="text-start text-sm font-light">
                For each combination, you will need to define an
                <span class="font-bold">SKU</span> — a short identifier for the
                combination, such as phone-white-128. Depending on the number of
                attributes, fields will be created for input values. For
                example, in the case of a phone, there is a combination of color
                and storage capacity, which means two fields will be created:
                one for 'color' and one for 'storage capacity', along with an
                additional field for the quantity of attributes in this
                combination, as well as the price if it differs from the base
                price.
              </p>
              <p class="text-start text-sm font-light">
                Below, please specify the
                <span class="font-bold">number of attributes</span> in one
                combination and the
                <span class="font-bold">total number of combinations</span>.
              </p>
              <div class="text-start flex justify-around gap-x-6">
                <div class="flex flex-col">
                  <label
                    for="numberOfAttributes"
                    class="text-xs text-gray-700 mb-1"
                    >Number of attributes</label
                  >
                  <input
                    id="numberOfAttributes"
                    type="number"
                    v-model="numberOfAttributes"
                    min="1"
                    class="px-1 py-0.5 text-xs border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none w-20"
                  />
                </div>
                <div class="flex flex-col">
                  <label
                    for="numberOfCombinations"
                    class="text-xs text-gray-700 mb-1"
                    >Number of combinations</label
                  >
                  <input
                    id="numberOfCombinations"
                    type="number"
                    min="1"
                    v-model="numberOfCombinations"
                    class="px-1 py-0.5 text-xs border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none w-20"
                  />
                </div>
              </div>
              <p class="text-start text-sm font-light">
                If you have combinations where
                <span class="font-bold"
                  >one attribute repeats in relation to another</span
                >, for example, in clothing where there is one color and
                different sizes for that color, please specify the
                <span class="font-bold">number of unique attributes</span>.
                Example: Attribute will be color and number of sizes for that
                color - XS S M L XL: 5.
              </p>
              <p class="underline mt-2 text-start text-sm font-light">
                Please note that choosing this option will take priority over
                the previous one.
              </p>
              <div class="flex justify-around !mb-4">
                <div class="flex flex-col">
                  <label
                    for="oneToManyAttributesNumber"
                    class="text-xs text-gray-700 mb-1"
                    >Number of attributes</label
                  >
                  <input
                    id="oneToManyAttributesNumber"
                    type="number"
                    v-model="oneToManyAttributesNumber"
                    min="0"
                    class="px-1 py-0.5 text-xs border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none w-20"
                  />
                </div>
                <div class="flex flex-col">
                  <label
                    for="oneToManyAttributesQuantity"
                    class="text-xs text-gray-700 mb-1"
                    >Quantity</label
                  >
                  <input
                    id="oneToManyAttributesQuantity"
                    type="number"
                    v-model="oneToManyAttributesQuantity"
                    min="0"
                    class="px-1 py-0.5 text-xs border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none w-20"
                  />
                </div>
              </div>
            </div>
            <div class="w-full overflow-y-auto h-full space-y-4" v-else>
              <span class="text-lg font-semibold block text-center">
                Non-Combined attributes</span
              >
              <p class="text-start text-sm font-light">
                This option is suitable for products that have
                <span class="font-bold">only one attribute</span>, such as a
                computer mouse – one model, but with different colors, or
                alcohol – with varying volumes.
              </p>
              <p class="text-start text-sm font-light">
                To proceed, please select the
                <span class="font-bold">number of attributes</span> values for
                the product. For example, a product with 5 different colors.
              </p>
              <div class="flex justify-center !mb-4">
                <div class="flex flex-col">
                  <label
                    for="oneToManyAttributesQuantity"
                    class="text-xs text-gray-700 mb-1"
                    >Quantity</label
                  >
                  <input
                    id="oneToManyAttributesQuantity"
                    type="number"
                    v-model="numberOfAttributes"
                    min="1"
                    class="px-1 py-0.5 text-xs border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none w-20"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex pt-6 justify-between">
          <Button
            label="Back"
            severity="secondary"
            icon="pi pi-arrow-left"
            @click="activateCallback('1')"
          />
          <Button
            label="Next"
            icon="pi pi-arrow-right"
            iconPos="right"
            @click="lastStep(activateCallback, '3')"
          />
        </div>
      </StepPanel>
      <StepPanel v-slot="{ activateCallback }" value="3">
        <div class="flex flex-col h-48">
          <div
            class="rounded bg-surface-50 dark:bg-surface-950 flex-auto flex justify-center items-center font-medium"
          >
            <div class="w-full space-y-4">
              <span class="font-bold text-xl">Let's sum it up</span>

              <div v-if="withCombinedAttr" class="space-y-4">
                <span>You chose combined option with:</span>
                <ul class="font-light">
                  <li>Number of combinations: {{ numberOfCombinations }}</li>
                  <li>
                    Number of attributes in combination:
                    {{ numberOfAttributes }}
                  </li>
                  <li v-if="oneToManyAttributesQuantity > 0">
                    Number of attributes, where unique attributes is related to
                    one: {{ oneToManyAttributesQuantity }}
                  </li>
                </ul>
                <span class="text-sm">If not, go back.</span>
              </div>
              <div v-else class="space-y-4">
                <span>You chose non-combined option with:</span>
                <p class="font-light">
                  Number of attributes:
                  {{ numberOfAttributes }}
                </p>
                <span class="text-sm">If not, go back.</span>
              </div>
            </div>
          </div>
        </div>
        <div class="pt-6">
          <Button
            label="Back"
            severity="secondary"
            icon="pi pi-arrow-left"
            @click="lastStep(activateCallback, '2')"
          />
        </div>
      </StepPanel>
    </StepPanels>
  </Stepper>
</template>

<style scoped></style>
