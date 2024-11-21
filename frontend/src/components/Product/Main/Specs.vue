<template>
  <div v-for="spec in specs">
    <div v-if="Object.hasOwn(spec, 'title')" class="mt-6">
      <div class="feature-title bg-[#f5f5f5] w-1/2 py-2 ps-4 rounded-r-lg">
        <span class="font-semibold text-2xl">{{ spec.title }}</span>
      </div>

      <div
        class="flex justify-between p-4 w-full"
        v-for="specForTitle in spec.specs"
      >
        <div class="spec">
          <span>{{ specForTitle.spec }}</span>
        </div>
        <div class="company">
          <span>{{ specForTitle.description }}</span>
        </div>
      </div>
    </div>

    <div v-else>
      <div class="flex justify-between p-4 w-full">
        <div class="spec">
          <span>{{ spec.spec }}</span>
        </div>
        <div class="company">
          <span>{{ spec.description }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const specs = ref([
  {
    spec: "Company",
    description: "Microsoft",
  },
  {
    spec: "Country",
    description: "USA",
  },
  {
    spec: "Color",
    description: "Green",
  },
  {
    title: "Display",
    specs: [
      {
        spec: "Size",
        description: "6d",
      },
      {
        spec: "Resolution",
        description: "Full HD",
      },
      {
        spec: "Another",
        description: "Another bla bla bla bla",
      },
    ],
  },
]);
</script>

<style scoped>
.spec {
  display: flex;
  align-items: center;
  margin-right: 10px;
}

.company {
  display: flex;
  flex-grow: 1;
  text-align: right;
  align-items: center;
}

.company::before {
  content: "";
  background: repeating-linear-gradient(
    to right,
    currentColor,
    currentColor 1px,
    transparent 2px,
    transparent 4px
  );
  height: 1px;
  flex-grow: 1;
  display: inline-block;
  margin-right: 8px;
}
</style>
