<script setup>
import DefaultContainer from "@/management/components/Main/DefaultContainer.vue";
import ProductPhotoTabsForm from "@/management/components/Product/ProductPhotoTabsForm.vue";
import BrandsCombobox from "@/management/components/Product/BrandsCombobox.vue";
import FocusedTextArea from "@/components/Default/Inputs/FocusedTextArea.vue";
import FocusedTextInput from "@/components/Default/Inputs/FocusedTextInput.vue";
import CategoryChooser from "@/management/components/Product/CategoryChooser.vue";
import DescriptionEditor from "@/management/components/Product/DescriptionEditor.vue";
import { ref } from "vue";

const description = ref(null);
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
              required
              placeholder="Samsung S55"
            ></focused-text-input>

            <focused-text-area
              id="title_description"
              name="title_description"
              label="Title Description (short)"
              :rows="3"
              required
              placeholder="Discover the latest in electronic & smart appliance technology with Samsung. Find the next big thing from smartphones & tablets to laptops & tvs & more."
            ></focused-text-area>
            <brands-combobox></brands-combobox>
            <category-chooser></category-chooser>
          </div>
        </div>
      </div>
      <div class="flex flex-col space-y-6">
        <span class="text-2xl font-semibold">Main Description</span>
        <description-editor v-model="description"></description-editor>
        <textarea
          d="main_description"
          name="main_description"
          v-model="description"
          rows="20"
          class="prose prose-sm max-w-none p-4 rounded-lg bg-white dark:bg-gray-200 text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-green-500"
        ></textarea>
      </div>
      <div class="flex flex-col space-y-6">
        <span class="text-2xl font-semibold">Warehouse Information</span>
      </div>
    </section>
  </default-container>
</template>

<style scoped></style>
