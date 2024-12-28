<template>
  <div class="space-y-8">
    <div
      v-for="c in props.options.numberOfCombinations"
      :key="c"
      class="space-y-4"
    >
      <p>Combination {{ c }}:</p>
      <div class="ml-8 space-y-4">
        <div class="flex">
          <focused-text-input
            v-model="combinations[c - 1].sku"
            :id="`sku${c}`"
            name="sku"
            label="SKU"
            placeholder="SKU identifier"
            tooltip="Unique identifier of this combination. E.x. phone-red-64gb"
            required
          />
        </div>
        <div v-for="n in props.options.numberOfAttributes" :key="n">
          <div class="ml-4 flex gap-x-4 items-center">
            <div class="flex flex-col gap-y-2">
              <label for="autocompletes">Label</label>
              <AutoComplete
                :id="`autocomplete${c + n}`"
                option-label="name"
                :suggestions="filteredAttributes"
                :placeholder="`Attribute name for ${n} value`"
                @update:model-value="onUpdateModelValue(c, n, $event)"
                @complete="search"
              />
            </div>
            <focused-text-input
              v-model="combinations[c - 1].attributes[n - 1].value"
              :id="`values${c + n}`"
              name="value[]"
              placeholder="Your value"
              :label="`Information about ${n} value`"
              required
            />
          </div>
        </div>
        <div class="flex gap-4">
          <focused-text-input
            v-model="combinations[c - 1].quantity"
            :id="`quantity${c}`"
            name="quantity[]"
            type="number"
            step="1"
            min="1"
            max="1000000"
            placeholder="1000"
            label="Products quantity"
            required
          />
          <focused-text-input
            v-model="combinations[c - 1].price"
            :id="`price${c}`"
            type="number"
            step=".01"
            min="1"
            max="10000000"
            name="price[]"
            placeholder="100.00"
            label="Price for this combination"
            tooltip="If your price not depend on combination, leave it empty."
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineEmits, onMounted, reactive, ref, watch } from "vue";
import { ProductService } from "@/services/ProductService.js";
import { AutoComplete } from "primevue";
import FocusedTextInput from "@/components/Default/Inputs/FocusedTextInput.vue";

const emit = defineEmits(["update-combo-attributes"]);

const props = defineProps({
  options: Object,
});

const availableAttributes = ref([]);
const filteredAttributes = ref([]);

const onUpdateModelValue = (
  combinationIndex,
  attributeIndex,
  selectedAttribute,
) => {
  if (typeof selectedAttribute === "object") {
    combinations[combinationIndex - 1].attributes[attributeIndex - 1].id =
      selectedAttribute.id;
    combinations[combinationIndex - 1].attributes[attributeIndex - 1].name =
      null;
  } else {
    combinations[combinationIndex - 1].attributes[attributeIndex - 1].name =
      selectedAttribute;
  }
};

const combinations = reactive(
  Array.from({ length: props.options.numberOfCombinations }, () => ({
    sku: null,
    quantity: null,
    price: null,
    attributes: Array.from(
      { length: props.options.numberOfAttributes },
      () => ({
        id: null,
        value: null,
        name: null,
        type: null,
      }),
    ),
  })),
);

onMounted(async () => {
  availableAttributes.value = await ProductService.getAvailableAttributes();
});

const search = (event) => {
  setTimeout(() => {
    if (!event.query.trim().length) {
      filteredAttributes.value = [...availableAttributes.value];
    } else {
      filteredAttributes.value = availableAttributes.value.filter((attribute) =>
        attribute.name.toLowerCase().startsWith(event.query.toLowerCase()),
      );
    }
  }, 250);
};

watch(
  combinations,
  (newData) => {
    emit("update-combo-attributes", newData);
  },
  { deep: true },
);
</script>
