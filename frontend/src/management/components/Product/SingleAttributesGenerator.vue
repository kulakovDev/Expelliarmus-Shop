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
      :key="n"
    >
      <div class="flex gap-x-4 items-center">
        <focused-text-input
          id="values"
          name="value[]"
          placeholder="Your value"
          :label="`Information about value ${n}`"
          v-model="attributesData.attributes[n - 1].value"
          required
        />
        <focused-text-input
          id="quantity"
          name="quantity[]"
          type="number"
          step="1"
          min="1"
          max="1000000"
          placeholder="1000"
          label="Quantity"
          v-model.number="attributesData.attributes[n - 1].quantity"
          required
        />
        <focused-text-input
          id="price"
          type="number"
          step=".01"
          min="1"
          max="10000000"
          name="price[]"
          placeholder="100.00"
          label="Price"
          v-model="attributesData.attributes[n - 1].price"
          :value="parseFloat(attributesData.attributes[n - 1].price)"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineEmits, onMounted, reactive, ref, watch } from "vue";
import { ProductService } from "@/services/ProductService.js";
import { AutoComplete } from "primevue";
import FocusedTextInput from "@/components/Default/Inputs/FocusedTextInput.vue";

const emit = defineEmits(["update-attributes"]);

const props = defineProps({
  options: Object,
});

const availableAttributes = ref([]);
const selectedAttribute = ref(null);
const filteredAttributes = ref([]);

const attributesData = reactive({
  attribute_id: null,
  attribute_name: "",
  attribute_type: 3,
  attributes: Array.from({ length: props.options.numberOfAttributes }, () => ({
    value: null,
    quantity: null,
    price: null,
  })),
});

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
  attributesData,
  (newData) => {
    emit("update-attributes", newData);
  },
  { deep: true },
);

watch(selectedAttribute, (newValue) => {
  if (newValue?.id) {
    attributesData.attribute_id = newValue.id;
    return;
  }

  attributesData.attribute_name = newValue?.name || "";
});
</script>
