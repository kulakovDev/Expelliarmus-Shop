<script setup>
import DefaultContainer from "@/management/components/Main/DefaultContainer.vue";
import ProductPhotoTabsForm from "@/management/components/Product/ProductPhotoTabsForm.vue";
import BrandsCombobox from "@/management/components/Product/BrandsCombobox.vue";
import FocusedTextArea from "@/components/Default/Inputs/FocusedTextArea.vue";
import FocusedTextInput from "@/components/Default/Inputs/FocusedTextInput.vue";
</script>

<template>
  <default-container>
    <section class="container mx-auto my-14 flex flex-col gap-y-6">
      <div>
        <h1 class="font-semibold text-4xl">Create Product Form</h1>
      </div>
      <div class="mt-4 flex flex-col">
        <span class="my-2"
          >Maximum 4 photos. Please, use ~576x712 photo size.</span
        >
        <div class="flex justify-between">
          <product-photo-tabs-form></product-photo-tabs-form>
          <div class="w-1/3 space-y-2">
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
            >
            </focused-text-area>
            <brands-combobox></brands-combobox>
          </div>
        </div>
      </div>
    </section>
  </default-container>
</template>

<style scoped></style>
