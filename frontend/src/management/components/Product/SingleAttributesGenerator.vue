<script setup>
import { onMounted, ref } from "vue";
import { ProductService } from "@/services/ProductService.js";
import { AutoComplete } from "primevue";
import FocusedTextInput from "@/components/Default/Inputs/FocusedTextInput.vue";

const props = defineProps({
  options: Object,
});

const availableAttributes = ref();
const selectedAttribute = ref();
const filteredAttributes = ref();

onMounted(async () => {
  availableAttributes.value = await ProductService.getAvailableAttributes();
});

const search = (event) => {
  setTimeout(() => {
    if (!event.query.trim().length) {
      filteredAttributes.value = [...availableAttributes.value];
    } else {
      filteredAttributes.value = availableAttributes.value.filter(
        (attribute) => {
          return attribute.name
            .toLowerCase()
            .startsWith(event.query.toLowerCase());
        },
      );
    }
  }, 250);
};
</script>

<template>
  <div v-if="props.options.withCombinedAttr === false">
    <AutoComplete
      option-label="name"
      v-model="selectedAttribute"
      :suggestions="filteredAttributes"
      placeholder="Enter attribute name"
      @complete="search"
    ></AutoComplete>

    <div
      class="flex flex-col gap-y-4 mt-4"
      v-for="n in props.options.numberOfAttributes"
    >
      <div class="flex gap-x-4 items-center">
        <focused-text-input
          id="values"
          name="value[]"
          :key="n"
          placeholder="Your value"
          :label="`Information about ${n} value`"
          required
        >
        </focused-text-input>
        <focused-text-input
          id="quantity"
          name="quantity[]"
          type="number"
          step="1"
          min="1"
          max="1000000"
          placeholder="1000"
          label="Quantity"
          required
        ></focused-text-input>
        <focused-text-input
          id="price"
          type="number"
          step=".01"
          min="1"
          max="10000000"
          name="price[]"
          placeholder="100.00"
          label="Price"
          tooltip="If your price not depend on value, leave it empty."
        ></focused-text-input>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
