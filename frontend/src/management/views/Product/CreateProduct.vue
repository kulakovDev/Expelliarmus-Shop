<script setup>
import DefaultContainer from "@/management/components/Main/DefaultContainer.vue";
import ProductPhotoTabsForm from "@/management/components/Product/ProductPhotoTabsForm.vue";
import BrandsCombobox from "@/management/components/Product/BrandsCombobox.vue";
import FocusedTextArea from "@/components/Default/Inputs/FocusedTextArea.vue";
import FocusedTextInput from "@/components/Default/Inputs/FocusedTextInput.vue";
import CategoryChooser from "@/management/components/Product/CategoryChooser.vue";
import DescriptionEditor from "@/management/components/Product/DescriptionEditor.vue";
import { ref, toRaw } from "vue";
import WarehouseInputs from "@/management/components/Warehouse/WarehouseInputs.vue";
import ProductAttributesModal from "@/management/components/Warehouse/ProductAttributesModal.vue";
import SingleAttributesGenerator from "@/management/components/Product/SingleAttributesGenerator.vue";
import CombinedAttributesGenerator from "@/management/components/Product/CombinedAttributesGenerator.vue";
import ProductSpecs from "@/management/components/Product/ProductSpecs.vue";
import { ProductService } from "@/services/ProductService.js";
import { useJsonApiFormatter } from "@/composables/useJsonApiFormatter.js";

const options = ref({});

const errorsFromForm = ref([]);

const getOptions = (values) => (options.value = values);

const productData = ref({
  title: null,
  title_description: null,
  main_description: null,
  product_article: null,
  total_quantity: null,
  price: null,
  is_combined_attributes: null,
});

const brand = ref();

const category = ref();

const singleAttributesData = ref({});

const comboAttributesData = ref([]);

const productSpecs = ref([]);

const images = ref([]);

const handleUpdateAttributes = (data) => {
  singleAttributesData.value = data;
};

const handleUpdateComboAttributes = (data) => {
  comboAttributesData.value = data;
};

const handleUpdatedSpecs = (newSpecs) => {
  productSpecs.value = newSpecs;
};

const handleUpdatedImages = (newImages) => {
  images.value = newImages;
};

async function submitForm() {
  let relationships = {
    category: {
      id: category.value.id,
    },
    brand: {
      id: brand.value.id,
    },
  };

  productData.value.is_combined_attributes =
    options.value.withCombinedAttr || null;

  relationships = addOptionalRelationships(relationships);

  await ProductService.createProduct(productData, relationships)
    .then(async (response) => {
      if (response?.data?.data?.id) {
        await ProductService.uploadImagesForProduct(
          response.data.data.id,
          images.value,
        )
          .then((response) => {
            console.log(response);
          })
          .catch((e) => {
            console.log(e);
          });
      }
    })
    .catch((e) => {
      if (e.response.data?.errors) {
        errorsFromForm.value = useJsonApiFormatter().fromJsonApiErrorsFields(
          e.response.data.errors,
        );
      }
    });
}

function addOptionalRelationships(relations) {
  if (productSpecs.value.length > 0) {
    relations.product_specs = productSpecs.value;
  }

  if (
    options.value.withCombinedAttr === true &&
    Object.keys(comboAttributesData.value).length !== 0
  ) {
    relations.product_variations_combinations = toRaw(
      comboAttributesData.value,
    );
  } else if (
    options.value.withCombinedAttr === false &&
    Object.keys(singleAttributesData.value).length !== 0
  ) {
    relations.product_variation = toRaw(singleAttributesData.value);
  }

  return relations;
}
</script>

<template>
  <default-container>
    <section class="container mx-auto my-14 flex flex-col gap-y-10">
      <div>
        <h1 class="font-semibold text-4xl">Create Product Form</h1>
      </div>
      <form class="space-y-6" method="post">
        <div class="mt-4 flex flex-col">
          <span class="text-2xl font-semibold mb-6">General Information</span>
          <span class="mb-2"
            >Maximum 4 photos. Please, use ~576x712 photo size.</span
          >
          <div
            class="flex xl:flex-nowrap flex-wrap items-center justify-between gap-4"
          >
            <product-photo-tabs-form
              v-model="images"
              class="w-full xl:w-auto"
            />

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
              <brands-combobox v-model="brand" />
              <category-chooser v-model="category" />
            </div>
          </div>
        </div>
        <div class="flex flex-col space-y-6">
          <span class="text-2xl font-semibold">Main Description</span>
          <description-editor v-model="productData.main_description" />
        </div>
        <div class="flex flex-col space-y-6">
          <span class="text-2xl font-semibold">Warehouse Information</span>
          <div class="ml-5 space-y-4">
            <div class="space-y-4">
              <span class="text-xl font-semibold">General</span>
              <warehouse-inputs
                v-model:product-article="productData.product_article"
                v-model:total-quantity="productData.total_quantity"
                v-model:default-price="productData.price"
              />
            </div>
            <div class="flex flex-col space-y-4">
              <span class="text-xl font-semibold">Product Attributes</span>
              <product-attributes-modal @update-options="getOptions" />
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
        <div class="flex justify-center !mt-16">
          <button
            type="button"
            @click="submitForm"
            class="px-10 py-3 bg-gray-500 rounded-lg text-white hover:bg-yellow-600 w-1/2"
          >
            Create Product
          </button>
        </div>
      </form>
      <section
        v-if="errorsFromForm.length"
        class="w-1/2 flex justify-center mx-auto bg-red-500 py-6 rounded-md text-gray-200"
      >
        <div class="flex flex-col space-y-4">
          <p v-for="error in errorsFromForm">
            {{ Object.values(error)[0] }}
          </p>
        </div>
      </section>
    </section>
  </default-container>
</template>

<style scoped></style>
