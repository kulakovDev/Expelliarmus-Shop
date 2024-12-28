<script setup>
import DefaultContainer from "@/management/components/Main/DefaultContainer.vue";
import ProductPhotoTabsForm from "@/management/components/Product/ProductPhotoTabsForm.vue";
import BrandsCombobox from "@/management/components/Product/BrandsCombobox.vue";
import FocusedTextArea from "@/components/Default/Inputs/FocusedTextArea.vue";
import FocusedTextInput from "@/components/Default/Inputs/FocusedTextInput.vue";
import CategoryChooser from "@/management/components/Product/CategoryChooser.vue";
import DescriptionEditor from "@/management/components/Product/DescriptionEditor.vue";
import { ref } from "vue";
import WarehouseInputs from "@/management/components/Warehouse/WarehouseInputs.vue";
import ProductAttributesModal from "@/management/components/Warehouse/ProductAttributesModal.vue";
import SingleAttributesGenerator from "@/management/components/Product/SingleAttributesGenerator.vue";
import CombinedAttributesGenerator from "@/management/components/Product/CombinedAttributesGenerator.vue";
import ProductSpecs from "@/management/components/Product/ProductSpecs.vue";

let options = ref({});

const getOptions = (values) => (options.value = values);

const productData = ref({
  title: null,
  title_description: null,
  brand_id: null,
  category_id: null,
  description: null,
});

const warehouseData = ref({
  product_article: null,
  total_quantity: null,
  default_price: null,
});

const singleAttributesData = ref({});

const comboAttributesData = ref([]);

const updatedProductSpecs = ref([]);

const handleUpdateAttributes = (data) => {
  singleAttributesData.value = data;
};

const handleUpdateComboAttributes = (data) => {
  comboAttributesData.value = data;
};

const handleUpdatedSpecs = (newSpecs) => {
  updatedProductSpecs.value = newSpecs;
};
</script>

<template>
  <default-container>
    <section class="container mx-auto my-14 flex flex-col gap-y-10">
      <div>
        <h1 class="font-semibold text-4xl">Create Product Form</h1>
      </div>
      <div class="mt-4 flex flex-col">
        <span class="text-2xl font-semibold mb-6">General Information</span>
        <span class="mb-2"
          >Maximum 4 photos. Please, use ~576x712 photo size.</span
        >
        <div
          class="flex xl:flex-nowrap flex-wrap items-center justify-between gap-4"
        >
          <product-photo-tabs-form
            class="w-full xl:w-auto"
          ></product-photo-tabs-form>

          <div class="w-full xl:w-1/3 space-y-2">
            <focused-text-input
              id="title"
              name="title"
              label="Title"
              v-model="productData.title"
              required
              placeholder="Samsung S55"
            />

            <focused-text-area
              id="title_description"
              name="title_description"
              v-model="productData.title_description"
              label="Title Description (short)"
              :rows="3"
              required
              placeholder="Discover the latest in electronic & smart appliance technology with Samsung. Find the next big thing from smartphones & tablets to laptops & tvs & more."
            />
            <brands-combobox v-model="productData.brand_id" />
            <category-chooser v-model="productData.category_id" />
          </div>
        </div>
      </div>
      <div class="flex flex-col space-y-6">
        <span class="text-2xl font-semibold">Main Description</span>
        <description-editor v-model="productData.description" />
      </div>
      <div class="flex flex-col space-y-6">
        <span class="text-2xl font-semibold">Warehouse Information</span>
        <div class="ml-5 space-y-4">
          <div class="space-y-4">
            <span class="text-xl font-semibold">General</span>
            <warehouse-inputs
              v-model:product-article="warehouseData.product_article"
              v-model:total-quantity="warehouseData.total_quantity"
              v-model:default-price="warehouseData.default_price"
            />
          </div>
          <div class="flex flex-col space-y-4">
            <span class="text-xl font-semibold">Product Attributes</span>
            <product-attributes-modal
              @update-options="getOptions"
            ></product-attributes-modal>
            <div v-show="Object.keys(options).length !== 0">
              <single-attributes-generator
                v-if="options.withCombinedAttr === false"
                :options="options"
                @update-attributes="handleUpdateAttributes"
              />
              <combined-attributes-generator
                v-else-if="options.withCombinedAttr === true"
                :options="options"
                @update-combo-attributes="handleUpdateComboAttributes"
              />
            </div>
          </div>
          <div class="flex flex-col space-y-4">
            <span class="text-xl font-semibold">Product Specifications</span>
            <product-specs @update-specs="handleUpdatedSpecs" />
          </div>
        </div>
      </div>
    </section>
  </default-container>
</template>

<style scoped></style>
