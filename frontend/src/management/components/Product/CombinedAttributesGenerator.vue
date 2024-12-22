<script setup>
import { onMounted, ref } from "vue";
import { ProductService } from "@/services/ProductService.js";
import { AutoComplete } from "primevue";
import FocusedTextInput from "@/components/Default/Inputs/FocusedTextInput.vue";

const props = defineProps({
  options: Object,
});

const availableAttributes = ref();
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
  <div class="space-y-8">
    <div
      v-for="c in props.options.numberOfCombinations"
      :key="c"
      class="space-y-4"
    >
      <p>Combination {{ c }}:</p>
      <div v-for="n in props.options.numberOfAttributes" :key="n">
        <div class="ml-4 flex gap-x-4 items-center">
          <div class="flex flex-col gap-y-2">
            <label for="autocompletes">Label</label>
            <AutoComplete
              :id="`autocomplete${c + n}`"
              option-label="name"
              :suggestions="filteredAttributes"
              :placeholder="`Attribute name for ${n} value`"
              @complete="search"
            ></AutoComplete>
          </div>
          <focused-text-input
            :id="`values${c + n}`"
            name="value[]"
            :key="n"
            placeholder="Your value"
            :label="`Information about ${n} value`"
            required
          >
          </focused-text-input>
          <focused-text-input
            :id="`quantity${c + n}`"
            name="quantity[]"
            type="number"
            step="1"
            min="1"
            max="1000000"
            placeholder="1000"
            label="Quantity"
            required
          ></focused-text-input>
        </div>
      </div>
      <focused-text-input
        :id="`price${c}`"
        type="number"
        step=".01"
        min="1"
        max="10000000"
        name="price[]"
        placeholder="100.00"
        label="Price for this combination"
        tooltip="If your price not depend on combination, leave it empty."
      ></focused-text-input>
    </div>
  </div>
</template>

<style scoped></style>
