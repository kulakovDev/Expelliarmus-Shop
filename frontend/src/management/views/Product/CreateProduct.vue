<script setup>
import DefaultContainer from "@/management/components/Main/DefaultContainer.vue";
import ProductPhotoTabsForm from "@/management/components/Product/ProductPhotoTabsForm.vue";
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
        </div>
      </div>
    </section>
  </default-container>
</template>

<style scoped></style>
