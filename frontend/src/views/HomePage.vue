<template>
  <main class="space-y-20">
    <section class="container mx-auto">
      <CategoryCarouselSection/>
    </section>
    <section class="container mx-auto">
      <div class="flex items-center gap-x-4 mb-10">
        <div class="bg-[#db4444] w-5 h-10 rounded-md"></div>
        <span class="text-[#db4444] font-semibold">Today's</span>
      </div>
      <div class="space-y-14">
        <ProductSlider :title="'Flash Sales'" :items-to-show="5" :width-between-items="316">
          <ProductDiscountCard class="product-card"/>
          <ProductDiscountCard class="product-card"/>
          <ProductDiscountCard class="product-card"/>
          <ProductDiscountCard class="product-card"/>
          <ProductDiscountCard class="product-card"/>
        </ProductSlider>
        <div class="flex justify-center">
          <router-link to="#" class="px-12 py-4 bg-[#db4444] text-white text-center hover:bg-red-900 rounded-md">
            View All Products
          </router-link>
        </div>
        <div class="h-px bg-gray-300 border-0"></div>
      </div>
    </section>
    <section class="container mx-auto">adad</section>
  </main>
</template>

<script setup>
import CategoryCarouselSection from "@/components/CategoryCarouselSection.vue";
import ProductSlider from "@/components/CardSlider.vue";
import ProductDiscountCard from "@/components/ProductDiscountCard.vue";
</script>
<style scoped>

</style>